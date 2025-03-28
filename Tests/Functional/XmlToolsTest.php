<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Test;

/***************************************************************
 * Copyright notice
 * (c) 2007 Kasper Ligaard (ligaard@daimi.au.dk)
 * All rights reserved
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Localizationteam\L10nmgr\Model\Tools\XmlTools;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

/**
 * Test case for checking the xmltools class
 *
 * @author Daniel Poetzinger <poetzinger@aoemedia.de>
 * @author Michael Klapper <klapper@aoemedia.de>
 */
class XmlToolsTest extends FunctionalTestCase
{
    protected XmlTools $XMLtools;

    protected array $testExtensionsToLoad = ['typo3conf/ext/l10nmgr'];

    public function setUp(): void
    {
        parent::setUp();
        $this->XMLtools = $this->getContainer()->get(XmlTools::class);
    }

    /**
     * @test
     */
    public function isXMLString(): void
    {
        //prepare testdatas
        $_fixture_noXML = '<a>my test<p>test</p>';
        $_fixture_noXML2 = 'my test & du';
        $_fixture_validXML = '<a>my test</a><p>test</p><strong>&amp;<i></i><br /></strong>';

        //do the Tests
        self::assertFalse($this->XMLtools->isValidXMLString($_fixture_noXML), 'invalid xml is detected as XML!');
        self::assertFalse($this->XMLtools->isValidXMLString($_fixture_noXML2), 'invalid xml 2 is detected as XML!');
        self::assertTrue($this->XMLtools->isValidXMLString($_fixture_validXML), 'XML should be valid');
    }

    /**
     * @test
     */
    public function simpleTransformationTest(): void
    {
        //prepare testdata
        $fixtureRTE = '<link 3>my link</link><strong>strong text</strong>' . "\n";
        $fixtureRTE .= 'test';

        //do the test:
        $transformed = $this->XMLtools->XML2RTE($this->XMLtools->RTE2XML($fixtureRTE));
        self::assertEquals(
            $transformed,
            $fixtureRTE,
            'transformationresult:' . $transformed . ' is not equal to source.'
        );
    }

    /**
     * @test
     */
    public function transformationLinkTagTest(): void
    {
        //prepare testdata
        $fixtureRTE = '<link 3 target class "name">my link</link><strong>strong text</strong>' . "\n";
        $fixtureRTE .= 'test';

        //do the test:
        $transformed = $this->XMLtools->XML2RTE($this->XMLtools->RTE2XML($fixtureRTE));

        self::assertEquals(
            $transformed,
            $fixtureRTE,
            'transformationresult:' . $transformed . ' is not equal to source.'
        );
    }

    /**
     * @test
     */
    public function transformationEntityTest(): void
    {
        //prepare testdata
        $fixtureRTE = '& &amp; &nbsp; ich&du';

        $transfxml = $this->XMLtools->RTE2XML($fixtureRTE);

        //test if entities and & were transformed correct
        self::assertEquals($transfxml, '<p>&amp; &amp;amp; &nbsp; ich&amp;du</p>', 'entities transformed incorrect');

        //do the test:
        $transformed = $this->XMLtools->XML2RTE($transfxml);

        self::assertEquals($transformed, $fixtureRTE, 'transformationresult is not equal to source.');
    }

    /**
     * @test
     */
    public function keepXHTMLValidBRTest(): void
    {
        // prepare the test data
        $fixtureRTE = 'here coms some .. 8747()/=<="($<br />';

        $fixtureXML = $this->XMLtools->RTE2XML($fixtureRTE);
        $transformed = $this->XMLtools->XML2RTE($fixtureXML);

        self::assertEquals($transformed, $fixtureRTE, 'transformation result is not as expected ');
    }

    /**
     * @test
     */
    public function keepXHMLValidBRInnerList(): void
    {
        //prepare the test data
        $fixtureRTE = '<ul><li>  Sign on with a single user name and password to simplify user management and support  </li><li> Easily share individual applications and documents with the click of a mouse  </li><li> Simplify meeting participation with callbacks and 800 numbers through our integrated telephony and audio<br /><br /> </li></ul>';

        $fixtureXML = $this->XMLtools->RTE2XML($fixtureRTE);
        $transformed = $this->XMLtools->XML2RTE($fixtureXML);

        self::assertEquals($transformed, $fixtureRTE, 'transformation result is not as expected ');
    }

    /**
     * @test
     */
    public function removeDeadLinkHandlingTest(): void
    {
        // prepare testdata
        $fixtureRTE = 'here comes some ... <link 92783928>this is my link</link>';

        $transformed = $this->XMLtools->XML2RTE($this->XMLtools->RTE2XML($fixtureRTE));

        self::assertEquals($transformed, $fixtureRTE, 'transformation result is not as expected ');
    }
}
