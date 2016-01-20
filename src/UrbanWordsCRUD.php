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
     * @throws UrbanWordException
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

    public function readWord()
    {

    }

    public function updateWord()
    {

    }

    public function deleteWord()
    {

    }

}

$x = new UrbanWordsCRUD();