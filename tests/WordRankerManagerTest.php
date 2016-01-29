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
    protected $wordRanker;

    protected function setUp()
    {
        $this->wordRanker = new WordRankManager("The big brown fox is just a weird big brown fox jumping over a lazy dog.\nCumon' fox ");
    }

    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testIsArray()
    {
        $this->assertTrue(is_array($this->wordRanker->ranker()));
    }

    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testWordCount()
    {
        $this->assertArrayHasKey("fox", $this->wordRanker->ranker());
        $this->assertArrayHasKey("brown", $this->wordRanker->ranker());
    }

    /**
     * @throws \John\Exceptions\UrbanWordException
     */
    public function testManageExpectation()
    {
        $expectation = [
            "fox" => 3,
            "brown" => 2,
            "lazy" => 1,
            "a" => 2
        ];

        $this->assertArraySubset($expectation, $this->wordRanker->ranker());
    }

    /**
     * @expectedException \John\Exceptions\WordRankManagerException
     * @expectedExceptionMessage Sentence is empty.
     * @throws \John\Exceptions\WordRankManagerException
     */

    public function testNoStringProvided()
    {
        $wordRanker = new WordRankManager();
        $wordRanker->ranker();
    }
}
