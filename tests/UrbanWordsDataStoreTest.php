<?php

namespace John\Tests;

use John\Cp\UrbanWordsDataStore;
use PHPUnit_Framework_TestCase;

/**
 * Class UrbanWordsTest.
 */
class UrbanWordsDataStoreTest extends PHPUnit_Framework_TestCase
{
    /**
     * Assert that the static data variable is an array.
     */
    public function testArray()
    {
        $this->assertTrue(is_array(UrbanWordsDataStore::$data));
    }

    /**
     * Assert that the static array contains Urban Word details.
     */
    public function testArrayHasUrbanWords()
    {
        $this->assertNotEmpty(UrbanWordsDataStore::$data);

        $this->assertEquals('Tight', UrbanWordsDataStore::$data[0]['slang']);
        $this->assertEquals('When someone performs an awesome task', UrbanWordsDataStore::$data[0]['description']);
        $this->assertEquals('Prosper has finished the curriculum, Tight.', UrbanWordsDataStore::$data[0]['sample-sentence']);
    }

    /**
     * Assert that the static array is of the specified format(slang, description and sample-sentence).
     */
    public function testArrayHasKeys()
    {
        $keys = [
            'slang',
            'description',
            'sample-sentence',
        ];

        $this->assertArrayHasKey($keys[0], UrbanWordsDataStore::$data[0]);
        $this->assertArrayHasKey($keys[1], UrbanWordsDataStore::$data[0]);
        $this->assertArrayHasKey($keys[2], UrbanWordsDataStore::$data[0]);
    }
}
