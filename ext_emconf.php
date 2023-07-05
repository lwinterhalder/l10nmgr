<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "l10nmgr".
 * Auto generated 10-03-2015 18:54
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/
$EM_CONF[$_EXTKEY] = [
    'title'            => 'Localization Manager',
    'description'      => 'Module for managing localization import and export',
    'category'         => 'module',
    'version'          => '12.0.0',
    'state'            => 'alpha',
    'clearCacheOnLoad' => true,
    'author'           => 'Kasper Skaarhoej, Daniel Zielinski, Daniel Poetzinger, Fabian Seltmann, Andreas Otto, Jo Hasenau, Peter Russ',
    'author_email'     => 'kasperYYYY@typo3.com, info@loctimize.com, info@cybercraft.de, pruss@uon.li',
    'author_company'   => 'Localization Manager Team',
    'constraints'      => [
        'depends'   => [
            'typo3'              => '10.0.0-11.5.99',
            'scheduler'          => '10.0.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests'  => [],
    ],
];
