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

    public function testReadUrbanWord()
    {
        $urbanWords = new UrbanWordsCRUD();

        //array is returned;

        $this->assertTrue(is_array($urbanWords->readWord("Tight")));

        //array with urban word format is returned

        $keys = [
            'slang',
            'description',
            'sample-sentence'
        ];

        $this->assertEmpty(array_diff($keys, array_keys($urbanWords->getWords()[0])));

        //Search non existent Urban word

        $this->assertFalse($urbanWords->readWord("someRandomstring oshe!"));
    }

    /**
     * @throws UrbanWordException
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testReadEmptyUrbanWord()
    {
        $urbanWords = new UrbanWordsCRUD();
        $urbanWords->readWord();
    }

    public function testDeleteWord()
    {
        $urbanWords = new UrbanWordsCRUD();

        //3 urban words in data array
        $this->assertEquals(4, count($urbanWords->getWords()));

        //delete 'non existent urban Word
        $this->assertFalse($urbanWords->deleteWord("some random string"));
        $this->assertEquals(4, count($urbanWords->getWords()));

        //delete 'bae'
        $this->assertTrue(is_array($urbanWords->deleteWord('bae')));
        $this->assertEquals(3, count($urbanWords->getWords()));
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testDeleteEmptyUrbanWord()
    {
        $urbanWords = new UrbanWordsCRUD();
        $urbanWords->deleteWord();
    }
}
