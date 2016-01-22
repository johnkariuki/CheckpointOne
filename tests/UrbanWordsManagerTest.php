<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 20/01/2016
 * Time: 11:57
 */

namespace John\Cp\Test;

use John\Cp\UrbanWordsManager;
use John\Cp\UrbanWordException;
use PHPUnit_Framework_TestCase;

/**
 * Class UrbanWordsManagerTest
 * @package John\Cp\Test
 */
class UrbanWordsManagerTest extends PHPUnit_Framework_TestCase
{
    public function testFetchArray()
    {
        $urbanWords = new UrbanWordsManager();
        $this->assertTrue(is_array($urbanWords->getWords()));
        $this->assertEquals(3, count($urbanWords->getWords()));
    }

    public function testAddNewWord()
    {
        $urbanWords = new UrbanWordsManager();
        $this->assertTrue(is_array($urbanWords->addWord("bae", "endearing term for lover", "I need a Bae.")));

    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word detail omitted.
     */
    public function testUrbanWordDetailsOmission()
    {
        //No Urban word details provided
        $urbanWords = new UrbanWordsManager();
        $urbanWords->addWord();
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word already exists.
     */

    public function testDuplicateUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->addWord("Tight", "When someone performs an awesome task", "Prosper has finished the curriculum, Tight.");
    }

    /**
     * @throws UrbanWordException
     */
    public function testReadUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();

        //array is returned;
        $this->assertTrue(is_array($urbanWords->readWord("Tight")));

        //array with urban word format is returned
        $keys = [
            'slang',
            'description',
            'sample-sentence'
        ];

        $this->assertArrayHasKey($keys[0], $urbanWords->getWords()[0]);
        $this->assertArrayHasKey($keys[1], $urbanWords->getWords()[0]);
        $this->assertArrayHasKey($keys[2], $urbanWords->getWords()[0]);
    }

    /**
     * @throws UrbanWordException
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testReadEmptyUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->readWord();
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word not found in our data store.
     */
    public function testReadNonExistentWord()
    {
        $urbanWords = new UrbanWordsManager();

        //Search non existent Urban word
        $this->assertFalse($urbanWords->readWord("someRandomstring oshe!"));
    }

    /**
     * @throws UrbanWordException
     */
    public function UpdateDetails()
    {
        $urbanWords = new UrbanWordsManager();
        $update = $urbanWords->updateWord("Bae", "Hella", "Very or Really", "I am Hella tired today.");

        $this->assertTrue(is_array($update));
        $this->assertArrayHasKey('slang', $update);
        $this->assertArrayHasKey('description', $update);
        $this->assertArrayHasKey('sample-sentence', $update);
        $this->assertContains('Hella', $update);
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Cannot Update: Urban word details omitted.
     */
    public function testEmptyUpdateDetails()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->updateWord();
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word not found in our data store.
     */
    public function testUpdateNonExistentUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->updateWord("randomStr", "DFgdfgdf", "DFgfdgf", "DFgdfgf");
    }

    /**
     * @throws UrbanWordException
     */
    public function testDeleteWord()
    {
        $urbanWords = new UrbanWordsManager();

        //3 urban words in data array
        $this->assertEquals(4, count($urbanWords->getWords()));

        //delete 'bae'
        $this->assertTrue(is_array($urbanWords->deleteWord('bae')));
        $this->assertEquals(3, count($urbanWords->getWords()));
        $this->assertNotContains('bae', $urbanWords->getWords());
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testDeleteEmptyUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->deleteWord();
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Urban word not found in our data store.
     * @throws UrbanWordException
     */
    public function testDeleteNonExistentUrbanWord()
    {
        $urbanWords = new UrbanWordsManager();
        $urbanWords->deleteWord("some random string");
    }
}
