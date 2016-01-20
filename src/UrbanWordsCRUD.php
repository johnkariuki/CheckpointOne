<?php
namespace John\Cp;

use John\Cp\UrbanWordException;

/**
 * Class UrbanWordsCRUD
 * @package John\Cp
 */

class UrbanWordsCRUD
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
        $this->words = UrbanWords::$data;
    }

    /**
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
     * @return bool
     * @throws \John\Cp\UrbanWordException
     */

    public function addWord($slang = "", $desc = "", $sentence = "")
    {
        $this->slang = $slang;
        $this->desc = $desc;
        $this->sentence = $sentence;

        if(!empty($this->slang) && !empty($this->desc) && !empty($this->sentence)) {

            foreach($this->words as $urbanWord) {

                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {
                    //throw exception
                    throw new UrbanWordException("Urban word already exists.");
                }
            }

            array_push(UrbanWords::$data, [
                "slang" => $this->slang,
                "description" => $this->desc,
                "sample-sentence" => $this->sentence
            ]);

            return true;
        } else {
            //throw exception
            throw new UrbanWordException("Urban word detail omitted.");
        }
    }

    /**
     * @param string $slang
     * @return bool
     * @throws \John\Cp\UrbanWordException
     */
    public function readWord($slang = "")
    {
        $this->slang = $slang;

        //if it doesn't throw exception
        //check array for the key word,
        //if it exists return it
        //else return false

        $foundWord = [
            "success" => false,
            "key" => null
        ];

        if(!empty($this->slang)) {
            foreach ($this->words as $urbanWordKey => $urbanWord) {
                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {

                    $foundWord["success"] = true;
                    $foundWord["key"] = $urbanWordKey;

                    break;
                }
            }
        } else {
            throw new UrbanWordException('Urban word omitted.');
        }

        if ($foundWord["success"]) {
            return $this->words[$foundWord["key"]];
        } else {
            return false;
        }
    }

    public function updateWord()
    {

    }

    public function deleteWord($slang = "")
    {
        $this->slang = $slang;

        //if it doesn't throw exception
        //check array for the key word,
        //if it exists return it
        //else return false

        $foundWord = [
            "success" => false,
            "key" => null,
            "urbanWord" => []
        ];

        if(!empty($this->slang)) {
            foreach ($this->words as $urbanWordKey => $urbanWord) {
                if (strtolower($urbanWord['slang']) === strtolower($this->slang)) {

                    $foundWord["success"] = true;
                    $foundWord["key"] = $urbanWordKey;

                    break;
                }
            }
        } else {
            throw new UrbanWordException('Urban word omitted.');
        }

        if ($foundWord["success"]) {

            unset($this->words[$foundWord["key"]]);
            return $foundWord["urbanWord"];
        } else {
            return false;
        }
    }

}

$x = new UrbanWordsCRUD();