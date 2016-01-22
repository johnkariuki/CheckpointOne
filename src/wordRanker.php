<?php
/**
 * Created by PhpStorm.
 * User: johnkariuki
 * Date: 21/01/2016
 * Time: 22:26.
 */
namespace John\Cp;

/**
 * Class wordRanker.
 */
class WordRanker
{
    /**
     * @var string
     */private $sentence;

    /**
     * wordRanker constructor.
     *
     * @param string $sentence
     */
    public function __construct($sentence = '')
    {
        $this->sentence = $sentence;
    }

    /**
     * @return string
     */
    public function getWord()
    {
        return $this->sentence;
    }

    /**
     * @return array
     *
     * @throws \John\Cp\UrbanWordException
     */
    public function ranker()
    {
        if (!empty($this->sentence)) {
            //split sentence
            //consider newline and new tab
            $wordsArray = preg_split('/\s+/', $this->sentence);
            $rankedArray = [];

            foreach ($wordsArray as $word) {
                if (array_key_exists($word, $rankedArray)) {
                    //word exists in array
                    $rankedArray[$word] += 1;
                } else {
                    $rankedArray[$word] = 1;
                }
            }

            if (arsort($rankedArray)) {
                return $rankedArray;
            }

            throw new UrbanWordException('Sentence is empty.');
        }

        throw new UrbanWordException('Sentence is empty.');
    }
}
