<?php

namespace John\Cp;

use John\Exceptions\UrbanWordException;
use John\Exceptions\WordManagerException;

/**
 * Class handles the CRUD methods on the static $data array defined in UrbanWordsDataStore class
 * Class UrbanWordsManager.
 */
class UrbanWordsManager
{
    private $words;
    private $slang;
    private $desc;
    private $sentence;

    /**
     * UrbanWordsCRUD constructor.
     */
    public function __construct()
    {
        $this->words = UrbanWordsDataStore::$data;
    }

    /**
     * return Urban array of words from John\Cp\UrbanWords.
     *
     * @return array
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * Add new word into the Urban Word dictionary
     *
     * @param string $slang
     * @param string $desc
     * @param string $sentence
     *
     * @return bool
     *
     * @throws \John\Exceptions\WordManagerException
     */
    public function addWord($slang = '', $desc = '', $sentence = '')
    {
        $this->slang = $slang;
        $this->desc = $desc;
        $this->sentence = $sentence;

        if (! empty($this->slang) && ! empty($this->desc) && ! empty($this->sentence)) {

            foreach ($this->words as $urbanWord) {

                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {

                    throw new WordManagerException('Urban word already exists.');
                }
            }

            $newWord = [
                'slang' => $this->slang,
                'description' => $this->desc,
                'sample-sentence' => $this->sentence,
            ];

            array_push($this->words, $newWord);

            return $newWord;
        }

        throw new WordManagerException('Urban word detail omitted.');
    }

    /**
     * Read words from the Urban Words Dictionary
     *
     * @param string $slang
     *
     * @return bool
     *
     * @throws \John\Exceptions\WordManagerException
     */
    public function readWord($slang = '')
    {
        $this->slang = $slang;

        $foundWord = [
            'success' => false,
            'key' => null,
        ];

        if (! empty($this->slang)) {

            foreach ($this->words as $urbanWordKey => $urbanWord) {

                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {

                    $foundWord['success'] = true;
                    $foundWord['key'] = $urbanWordKey;

                    break;
                }
            }
        } else {

            throw new WordManagerException('Urban word omitted.');
        }

        if ($foundWord['success']) {

            return [
                'word' =>  $this->words[$foundWord['key']],
                'position' => $foundWord['key']
            ];
        }

        throw new WordManagerException('Urban word not found in our data store.');
    }

    /**
     * Update slang Words in the Urban Dictionary
     *
     * @param string $slang
     * @param string $slangUpdate
     * @param string $descUpdate
     * @param string $sentenceUpdate
     *
     * @return mixed
     *
     * @throws \John\Exceptions\UrbanWordException
     */
    public function updateWord($slang = '', $slangUpdate = '', $descUpdate = '', $sentenceUpdate = '')
    {
        if (! empty($slangUpdate) && ! empty($descUpdate) && ! empty($sentenceUpdate)) {

            $this->slang = $slang;
            $wordKey = $this->readWord($this->slang);

            if ($wordKey) {

                $position = $wordKey["position"];

                $this->words[$position]['slang'] = $slangUpdate;
                $this->words[$position]['description'] = $descUpdate;
                $this->words[$position]['sample-sentence'] = $sentenceUpdate;

                return $this->words[$position];
            }
        } else {

            throw new WordManagerException('Cannot Update: Urban word details omitted.');
        }
    }

    /**
     * Delete word from Urban dictionary
     *
     * @param string $slang
     *
     * @return bool
     *
     * @throws \John\Exceptions\UrbanWordException
     */
    public function deleteWord($slang = '')
    {
        $this->slang = $slang;

        $foundWord = [
            'success' => false,
            'key' => null,
            'urbanWord' => [],
        ];

        if (! empty($this->slang)) {

            foreach ($this->words as $urbanWordKey => $urbanWord) {

                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {

                    $foundWord['success'] = true;
                    $foundWord['key'] = $urbanWordKey;
                    $foundWord['urbanWord'] = $this->words[$urbanWordKey];

                    break;
                }
            }
        } else {

            throw new WordManagerException('Urban word omitted.');
        }

        if ($foundWord['success']) {

            unset($this->words[$foundWord['key']]);

            return $foundWord['urbanWord'];
        } else {

            throw new WordManagerException('Urban word not found in our data store.');
        }
    }
}
