<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 21/01/2016
 * Time: 22:26
 */

namespace John\Cp\Test;

use John\Cp\WordRanker;

/**
 * Class wordRankerTest
 * @package John\Cp\Test
 */
class wordRankerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @throws \John\Cp\UrbanWordException
     */
    public function testIsArray()
    {
        $wordRanker = new wordRanker("Prosper has finished the curriculum and he will submit it to Nadayar. Tight Tight Tight");
        $this->assertTrue(is_array($wordRanker->ranker()));
    }

    /**
     * @throws \John\Cp\UrbanWordException
     */
    public  function testWordCount()
    {
        $wordRanker = new wordRanker("The big brown fox is just a weird big brown fox jumping over a lazy dog.\nCumon' fox ");

        $this->assertArrayHasKey("fox", $wordRanker->ranker());
        $this->assertArrayHasKey("brown", $wordRanker->ranker());
    }

    /**
     * @throws \John\Cp\UrbanWordException
     */
    public  function testManageExpectation()
    {
        $wordRanker = new wordRanker("The big brown fox is just a weird big brown fox jumping over a lazy dog.\nCumon' fox ");

        $expectation = [
            "fox" => 3,
            "brown" => 2,
            "lazy" => 1,
            "a" => 2
        ];

        $this->assertArraySubset($expectation, $wordRanker->ranker());
    }

    /**
     * @expectedException \John\Cp\UrbanWordException
     * @expectedExceptionMessage Sentence is empty.
     * @throws \John\Cp\UrbanWordException
     */

    public function testNoStringProvided()
    {
        $wordRanker = new wordRanker();
        $wordRanker->ranker();
    }
}