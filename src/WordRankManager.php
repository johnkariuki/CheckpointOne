<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 21/01/2016
 * Time: 22:26.
 */
namespace John\Cp;

use John\Exceptions\UrbanWordException;
use John\Exceptions\WordRankManagerException;

/**
 * WordRankManager: A class that returns the occurence of words in a sentence as an associative array
 * Class wordRanker.
 */
class WordRankManager
{
    /**
     * @var string
     */private $sentence;

    /**
     * WordRankManager constructor.
     *
     * @param string $sentence
     */
    public function __construct($sentence = '')
    {
        $this->sentence = $sentence;
    }

    /**
     * Return sentence to show occurence
     *
     * @return string
     */
    public function getWord()
    {
        return $this->sentence;
    }

    /**
     * Rank occurence of words in a sentence
     *
     * @return array
     *
     * @throws \John\Exceptions\WordRankManagerException
     */
    public function ranker()
    {
        if (! empty($this->sentence)) {

            $wordsArray = preg_split('/\s+/', $this->sentence);
            $rankedArray = [];

            foreach ($wordsArray as $word) {

                if (array_key_exists($word, $rankedArray)) {

                    $rankedArray[$word] += 1;
                } else {
                    $rankedArray[$word] = 1;
                }
            }

            if (arsort($rankedArray)) {
                return $rankedArray;
            }
        }

        throw new WordRankManagerException('Sentence is empty.');
    }
}
