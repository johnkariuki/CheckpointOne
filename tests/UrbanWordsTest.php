<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 20/01/2016
 * Time: 10:06
 */

namespace John\Cp\Test;
use John\Cp\UrbanWords;

/**
 * Class UrbanWordsTest
 * @package John\Cp\Test
 */
class UrbanWordsTest extends \PHPUnit_Framework_TestCase
{
    public function testArray()
    {
        $this->assertTrue(is_array(UrbanWords::$data));
    }

    public function testArrayHasUrbanWords()
    {
        $this->assertNotEmpty(UrbanWords::$data);

        $this->assertEquals('Tight', UrbanWords::$data[0]['slang']);
        $this->assertEquals('When someone performs an awesome task', UrbanWords::$data[0]['description']);
        $this->assertEquals('Prosper has finished the curriculum, Tight.', UrbanWords::$data[0]['sample-sentence']);
    }

    public  function testArrayHasKeys()
    {
        $keys = [
            'slang',
            'description',
            'sample-sentence'
        ];

        $this->assertEmpty(array_diff($keys, array_keys(UrbanWords::$data[0])));
    }
}