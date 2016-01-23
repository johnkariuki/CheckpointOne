<?php

namespace John\Cp;

use John\Exceptions\UrbanWordException;

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
     * return Urban array of words from John/Cp/UrbanWords.
     *
     * @return array
     */
    public function getWords()
    {
        return $this->words;
    }

    /**
     * @param string $slang
     * @param string $desc
     * @param string $sentence
     *
     * @return bool
     *
     * @throws \John\Exceptions\UrbanWordException
     */
    public function addWord($slang = '', $desc = '', $sentence = '')
    {
        $this->slang = $slang;
        $this->desc = $desc;
        $this->sentence = $sentence;

        if (!empty($this->slang) && !empty($this->desc) && !empty($this->sentence)) {
            foreach ($this->words as $urbanWord) {
                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {
                    throw new UrbanWordException('Urban word already exists.');
                }
            }

            $newWord = [
                'slang' => $this->slang,
                'description' => $this->desc,
                'sample-sentence' => $this->sentence,
            ];

            array_push($this->words, $newWord);

            return $newWord;
        } else {
            throw new UrbanWordException('Urban word detail omitted.');
        }
    }

    /**
     * @param string $slang
     *
     * @return bool
     *
     * @throws \John\Exceptions\UrbanWordException
     */
    public function readWord($slang = '')
    {
        $this->slang = $slang;

        $foundWord = [
            'success' => false,
            'key' => null,
        ];

        if (!empty($this->slang)) {
            foreach ($this->words as $urbanWordKey => $urbanWord) {
                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {
                    $foundWord['success'] = true;
                    $foundWord['key'] = $urbanWordKey;

                    break;
                }
            }
        } else {
            throw new UrbanWordException('Urban word omitted.');
        }

        if ($foundWord['success']) {
            return [
                'word' =>  $this->words[$foundWord['key']],
                'position' => $foundWord['key']
            ];
        } else {
            throw new UrbanWordException('Urban word not found in our data store.');
        }
    }

    /**
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
        if (!empty($slangUpdate) && !empty($descUpdate) && !empty($sentenceUpdate)) {
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
            throw new UrbanWordException('Cannot Update: Urban word details omitted.');
        }
    }

    /**
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

        if (!empty($this->slang)) {
            foreach ($this->words as $urbanWordKey => $urbanWord) {
                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {
                    $foundWord['success'] = true;
                    $foundWord['key'] = $urbanWordKey;
                    $foundWord['urbanWord'] = $this->words[$urbanWordKey];

                    break;
                }
            }
        } else {
            throw new UrbanWordException('Urban word omitted.');
        }

        if ($foundWord['success']) {
            unset($this->words[$foundWord['key']]);

            return $foundWord['urbanWord'];
        } else {
            throw new UrbanWordException('Urban word not found in our data store.');
        }
    }
}
