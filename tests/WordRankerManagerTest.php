<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 21/01/2016
 * Time: 22:26
 */

namespace John\Tests;

use John\Cp\WordRankManager;
use PHPUnit_Framework_TestCase;

/**
 * Class wordRankerTest
 * @package John\Tests
 */
class WordRankManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testIsArray()
    {
        $wordRanker = new WordRankManager("Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight");
        $this->assertTrue(is_array($wordRanker->ranker()));
    }

    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testWordCount()
    {
        $wordRanker = new WordRankManager("The big brown fox is just a weird big brown fox jumping over a lazy dog.\nCumon' fox ");

        $this->assertArrayHasKey("fox", $wordRanker->ranker());
        $this->assertArrayHasKey("brown", $wordRanker->ranker());
    }

    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testManageExpectation()
    {
        $wordRanker = new WordRankManager("The big brown fox is just a weird big brown fox jumping over a lazy dog.\nCumon' fox ");

        $expectation = [
            "fox" => 3,
            "brown" => 2,
            "lazy" => 1,
            "a" => 2
        ];

        $this->assertArraySubset($expectation, $wordRanker->ranker());
    }

    /**
     * @expectedException \John\Exceptions\UrbanWordException
     * @expectedExceptionMessage Sentence is empty.
     * @throws \John\Exceptions\UrbanWordException
     */

    public function testNoStringProvided()
    {
        $wordRanker = new WordRankManager();
        $wordRanker->ranker();
    }
}
