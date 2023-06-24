<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\LanguageRestriction\Collection;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use Doctrine\DBAL\DBALException;
use Localizationteam\L10nmgr\Constants;
use PDO;
use RuntimeException;
use SplDoublyLinkedList;
use TYPO3\CMS\Core\Collection\AbstractRecordCollection;
use TYPO3\CMS\Core\Collection\CollectionInterface;
use TYPO3\CMS\Core\Collection\EditableCollectionInterface;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Language Restriction Collection to handle records attached to a language
 */
class LanguageRestrictionCollection extends AbstractRecordCollection implements EditableCollectionInterface
{
    /**
     * The table name collections are stored to
     *
     * @var string
     */
    protected static $storageTableName = Constants::L10NMGR_LANGUAGE_RESTRICTION_FOREIGN_TABLENAME;

    /**
     * Name of the language-restrictions-relation field (used in the MM_match_fields/fieldname property of the TCA)
     *
     * @var string
     */
    protected string $relationFieldName = Constants::L10NMGR_LANGUAGE_RESTRICTION_FIELDNAME;

    /**
     * Creates this object.
     *
     * @param string|null $tableName Name of the table to be working on
     * @param string|null $fieldName Name of the field where the language restriction relations are defined
     * @throws RuntimeException
     */
    public function __construct(string $tableName = null, string $fieldName = null)
    {
        parent::__construct();
        if (!empty($tableName)) {
            $this->setItemTableName($tableName);
        } elseif (empty($this->itemTableName)) {
            throw new RuntimeException(self::class . ' needs a valid itemTableName.', 1341826168);
        }
        if (!empty($fieldName)) {
            $this->setRelationFieldName($fieldName);
        }
    }

    /**
     * Loads the collections with the given id from persistence
     * For memory reasons, per default only f.e. title, database-table,
     * identifier (what ever static data is defined) is loaded.
     * Entries can be load on first access.
     *
     * @param int $id Id of database record to be loaded
     * @param bool $fillItems Populates the entries directly on load, might be bad for memory on large collections
     * @param string $tableName Name of table from which entries should be loaded
     * @param string $fieldName Name of the language restrictions relation field
     * @return CollectionInterface
     * @throws DBALException
     */
    public static function load($id, $fillItems = false, string $tableName = '', string $fieldName = ''): CollectionInterface
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable(static::$storageTableName);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $collectionRecord = $queryBuilder->select('*')
            ->from(static::$storageTableName)
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($id, PDO::PARAM_INT))
            )
            ->setMaxResults(1)
            ->execute()
            ->fetch();

        $collectionRecord['table_name'] = $tableName;
        $collectionRecord['field_name'] = $fieldName;

        return self::create($collectionRecord, $fillItems);
    }

    /**
     * Creates a new collection objects and reconstitutes the
     * given database record to the new object.
     *
     * @param array $collectionRecord Database record
     * @param bool $fillItems Populates the entries directly on load, might be bad for memory on large collections
     * @return LanguageRestrictionCollection
     */
    public static function create(array $collectionRecord, $fillItems = false): LanguageRestrictionCollection
    {
        /** @var LanguageRestrictionCollection $collection */
        $collection = GeneralUtility::makeInstance(
            self::class,
            $collectionRecord['table_name'],
            $collectionRecord['field_name']
        );
        $collection->fromArray($collectionRecord);
        if ($fillItems) {
            $collection->loadContents();
        }
        return $collection;
    }

    /**
     * Populates the content-entries of the storage
     * Queries the underlying storage for entries of the collection
     * and adds them to the collection data.
     * If the content entries of the storage had not been loaded on creation
     * ($fillItems = false) this function is to be used for loading the contents
     * afterwards.
     */
    public function loadContents()
    {
        $entries = $this->getCollectedRecords();
        $this->removeAll();
        foreach ($entries as $entry) {
            $this->add($entry);
        }
    }

    /**
     * Gets the collected records in this collection, by
     * using <getCollectedRecordsQueryBuilder>.
     *
     * @return array
     * @throws DBALException
     */
    protected function getCollectedRecords(): array
    {
        $relatedRecords = [];

        $queryBuilder = $this->getCollectedRecordsQueryBuilder();
        $result = $queryBuilder->execute();

        while ($record = $result->fetch()) {
            $relatedRecords[] = $record;
        }

        return $relatedRecords;
    }

    /**
     * Selects the collected records in this collection, by
     * looking up the MM relations of this record to the
     * table name defined in the local field 'table_name'.
     *
     * @return QueryBuilder
     */
    protected function getCollectedRecordsQueryBuilder(): QueryBuilder
    {
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable(static::$storageTableName);
        $queryBuilder->getRestrictions()->removeAll()->add(GeneralUtility::makeInstance(DeletedRestriction::class));

        $queryBuilder->select($this->getItemTableName() . '.*')
            ->from(static::$storageTableName)
            ->join(
                static::$storageTableName,
                Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME,
                Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME,
                $queryBuilder->expr()->eq(
                    'sys_language_l10nmgr_language_restricted_record_mm.uid_local',
                    $queryBuilder->quoteIdentifier(static::$storageTableName . '.uid')
                )
            )
            ->join(
                Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME,
                $this->getItemTableName(),
                $this->getItemTableName(),
                $queryBuilder->expr()->eq(
                    Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME . '.uid_foreign',
                    $queryBuilder->quoteIdentifier($this->getItemTableName() . '.uid')
                )
            )
            ->where(
                $queryBuilder->expr()->eq(
                    static::$storageTableName . '.uid',
                    $queryBuilder->createNamedParameter($this->getIdentifier(), PDO::PARAM_INT)
                ),
                $queryBuilder->expr()->eq(
                    Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME . '.tablenames',
                    $queryBuilder->createNamedParameter($this->getItemTableName())
                ),
                $queryBuilder->expr()->eq(
                    Constants::L10NMGR_LANGUAGE_RESTRICTION_MM_TABLENAME . '.fieldname',
                    $queryBuilder->createNamedParameter($this->getRelationFieldName())
                )
            );

        return $queryBuilder;
    }

    /**
     * Gets the name of the language restrictions relation field
     *
     * @return string
     */
    public function getRelationFieldName(): string
    {
        return $this->relationFieldName;
    }

    /**
     * Sets the name of the language restrictions relation field
     *
     * @param string $field
     */
    public function setRelationFieldName(string $field)
    {
        $this->relationFieldName = $field;
    }

    /**
     * Removes all entries from the collection
     * collection will be empty afterwards
     */
    public function removeAll()
    {
        $this->storage = new SplDoublyLinkedList();
    }

    /**
     * Adds on entry to the collection
     *
     * @param mixed $data
     */
    public function add($data)
    {
        $this->storage->push($data);
    }

    /**
     * Getter for the storage table name
     *
     * @return string
     */
    public static function getStorageTableName(): string
    {
        return self::$storageTableName;
    }

    /**
     * Getter for the storage items field
     *
     * @return string
     */
    public static function getStorageItemsField(): string
    {
        return self::$storageItemsField;
    }

    /**
     * Adds a set of entries to the collection
     *
     * @param CollectionInterface $other
     */
    public function addAll(CollectionInterface $other)
    {
        foreach ($other as $value) {
            $this->add($value);
        }
    }

    /**
     * Removes the given entry from collection
     * Note: not the given "index"
     *
     * @param mixed $data
     */
    public function remove($data)
    {
        $offset = 0;
        foreach ($this->storage as $value) {
            if ($value == $data) {
                break;
            }
            $offset++;
        }
        $this->storage->offsetUnset($offset);
    }

    /**
     * Gets the current available items.
     *
     * @return array
     */
    public function getItems(): array
    {
        $itemArray = [];
        foreach ($this->storage as $item) {
            $itemArray[] = $item;
        }
        return $itemArray;
    }

    /**
     * Gets the current available items.
     *
     * @param int $uid
     * @return bool
     */
    public function hasItem(int $uid): bool
    {
        foreach ($this->storage as $item) {
            if (!empty($item['uid']) && $item['uid'] === $uid) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns an array of the persistable properties and contents
     * which are processable by DataHandler.
     * for internal usage in persist only.
     *
     * @return array
     */
    protected function getPersistableDataArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'items' => $this->getItemUidList(),
        ];
    }
}
