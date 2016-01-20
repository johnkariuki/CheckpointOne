<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 20/01/2016
 * Time: 11:57
 */

namespace John\Cp\Test;

use John\Cp\UrbanWordsCRUD;
use John\Cp\UrbanWordException;

class urbanWordsCRUDTest extends \PHPUnit_Framework_TestCase
{
    public function testFetchArray()
    {
        $urbanWords = new UrbanWordsCRUD();
        $this->assertTrue(is_array($urbanWords->getWords()));
        $this->assertEquals(3, count($urbanWords->getWords()));
    }

    public function testAddNewWord()
    {
        $urbanWords = new UrbanWordsCRUD();
        $this->assertTrue($urbanWords->addWord("bae", "endearing term for lover", "I need a Bae."));

       // $this->assertFalse($urbanWords->addWord("Tight", "When someone performs an awesome task", "Prosper has finished the curriculum, Tight."));
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word detail omitted.
     */
    public function testUrbanWordDetailsOmission()
    {
        //No Urban word details provided

        $urbanWords = new UrbanWordsCRUD();
        $urbanWords->addWord();
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word already exists.
     */

    public function testDuplicateUrbanWord()
    {
        $urbanWords = new UrbanWordsCRUD();
        $urbanWords->addWord("Tight", "When someone performs an awesome task", "Prosper has finished the curriculum, Tight.");
    }
}
