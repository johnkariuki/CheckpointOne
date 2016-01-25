### CheckpointOne

![Build Pass] (https://travis-ci.org/andela-jkariuki/CheckpointOne.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-jkariuki/CheckpointOne/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-jkariuki/CheckpointOne/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/andela-jkariuki/CheckpointOne/badge.svg?branch=master)](https://coveralls.io/github/andela-jkariuki/CheckpointOne?branch=master)

##  Urban Dictionary Agnostic PHP Package

Andela Checkpoint 1. An urban words dictionary, Urban Word CRUD and Ranking System for word occurence in a sentence. **#TIA**

## Installation
add the package to your projects folder
```
composer require john-kariuki/urban-words
```

Install packages using composer
```
composer install
```

## Usage

Let's get using Urban Words

```php
<?php
    require 'vendor/autoload.php';

    use John\Cp\UrbanWordsDatastore;
    use John\Cp\UrbanWordsManager;
    use John\Cp\WordRankManager;
    use John\Exceptions\UrbanWordException;

    //Class UrbanWordsDatastore contains a static array of urban words
    print_r(UrbanWordsDatastore::$data);

    /**
     * Class UrbanWordsManager performs CRUD methods on the $data array in UrbanWordsDataStore
     * Methods:
     * addWord(word, desc, sentence)
     * readWord(word)
     * updateWord(word, foo, bar, foobar)
     * deleteWord(word)
     */

    $urbanWord = new UrbanWordsManager();

try {
    //Add new word, description and sentence
    print_r($urbanWord->addWord('Bae', 'Endearing term for lover', 'Your bae has a bae'));

    //Pass slang word to read
    print_r($urbanWord->readWord('Bae'));

    //Update slang word details
    print_r($urbanWord->updateWord("Bae", "Foo", "Bar", "Foo Bar"));

    //Pass slang word to delete
    print_r($urbanWord->deleteWord('Turnt'));

    print_r($urbanWord->getWords());

} catch (UrbanWordException $e) {
    echo $e->getMessage();
}

//Class WordRankManager returns the frequency of occurence of a word in a sentence

try {
    $sentence = new WordRankManager("The big brown fox is just a big brown fox jumping up all in the lazy dog's business");
    print_r($sentence->ranker());
} catch (UrbanWordException $e) {
    $e->getMessage();
}
```

## Tests

Run the phpunit command
```
phpunit
```


