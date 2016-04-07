<?php

namespace John\Tests;

use John\Cp\UrbanWordsManager;
use PHPUnit_Framework_TestCase;

/**
 * Class UrbanWordsManagerTest.
 */
class UrbanWordsManagerTest extends PHPUnit_Framework_TestCase
{
    protected $urbanWords;

    protected function setUp()
    {
        $this->urbanWords = new UrbanWordsManager();
    }

    /**
     * Assert that getWords returns an array
     * with 3 items(3 urban words).
     * .
     *
     * @return void
     */
    public function testFetchArray()
    {
        $this->assertTrue(is_array($this->urbanWords->getWords()));
        $this->assertEquals(3, count($this->urbanWords->getWords()));
    }

    /**
     * Asser that adding a new Urban word
     * returns a true message.
     *
     * @return void
     */
    public function testAddNewWord()
    {
        $this->assertTrue(is_array($this->urbanWords->addWord('bae', 'endearing term for lover', 'I need a Bae.')));
    }

    /**
     * Assert that when a word with missing details is added,
     * an exception is thrown.
     *
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word detail omitted.
     */
    public function testUrbanWordDetailsOmission()
    {
        //No Urban word details provided
        $this->urbanWords->addWord();
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word already exists.
     */
    public function testDuplicateUrbanWord()
    {
        $this->urbanWords->addWord('Tight', 'When someone performs an awesome task', 'Prosper has finished the curriculum, Tight.');
    }

    /**
     * @throws WordManagerException
     */
    public function testReadUrbanWord()
    {
        //array is returned;
        $this->assertTrue(is_array($this->urbanWords->readWord('Tight')));

        //array with urban word format is returned
        $keys = [
            'slang',
            'description',
            'sample-sentence',
        ];

        $this->assertArrayHasKey($keys[0], $this->urbanWords->getWords()[0]);
        $this->assertArrayHasKey($keys[1], $this->urbanWords->getWords()[0]);
        $this->assertArrayHasKey($keys[2], $this->urbanWords->getWords()[0]);
    }

    /**
     * @throws WordManagerException
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testReadEmptyUrbanWord()
    {
        $this->urbanWords->readWord();
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word not found in our data store.
     */
    public function testReadNonExistentWord()
    {
        //Search non existent Urban word
        $this->assertFalse($this->urbanWords->readWord('someRandomstring oshe!'));
    }

    /**
     * @throws WordManagerException
     */
    public function testUpdateDetails()
    {
        $update = $this->urbanWords->updateWord('Turnt', 'Hella', 'Very or Really', 'I am Hella tired today.');

        $this->assertTrue(is_array($update));
        $this->assertArrayHasKey('slang', $update);
        $this->assertArrayHasKey('description', $update);
        $this->assertArrayHasKey('sample-sentence', $update);
        $this->assertContains('Hella', $update);
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Cannot Update: Urban word details omitted.
     */
    public function testEmptyUpdateDetails()
    {
        $this->urbanWords->updateWord();
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word not found in our data store.
     */
    public function testUpdateNonExistentUrbanWord()
    {
        $this->urbanWords->updateWord('randomStr', 'DFgdfgdf', 'DFgfdgf', 'DFgdfgf');
    }

    /**
     * @throws WordManagerException
     */
    public function testDeleteWord()
    {
        //3 urban words in data array
        $this->assertEquals(3, count($this->urbanWords->getWords()));

        //delete 'bae'
        $this->assertTrue(is_array($this->urbanWords->deleteWord('lit')));
        $this->assertEquals(2, count($this->urbanWords->getWords()));
        $this->assertNotContains('lit', $this->urbanWords->getWords());
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word omitted.
     */
    public function testDeleteEmptyUrbanWord()
    {
        $this->urbanWords->deleteWord();
    }

    /**
     * @expectedException \John\Exceptions\WordManagerException
     * @expectedExceptionMessage Urban word not found in our data store.
     *
     * @throws WordManagerException
     */
    public function testDeleteNonExistentUrbanWord()
    {
        $this->urbanWords->deleteWord('some random string');
    }
}
