## CheckpointOne

![Build Pass] (https://travis-ci.org/andela-jkariuki/CheckpointOne.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/andela-jkariuki/CheckpointOne/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/andela-jkariuki/CheckpointOne/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/andela-jkariuki/CheckpointOne/badge.svg?branch=master)](https://coveralls.io/github/andela-jkariuki/CheckpointOne?branch=master)

###  Urban Dictionary Agnostic PHP Package

Andela Checkpoint One. 

### Urban Words Manager

An urban words dictionary, Urban Word CRUD and Ranking System for word occurence in a sentence. 

### Word Rank Manager

Rank the occurence of words in a sentence.

**#TIA**

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
use John\Exceptions\WordRankManagerException;
use John\Exceptions\WordManagerException;

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
try {

    $urbanWord = new UrbanWordsManager();

    //Add new word, description and sentence
    print_r($urbanWord->addWord('Bae', 'Endearing term for lover', 'Your bae has a bae'));

    //Pass slang word to read
    print_r($urbanWord->readWord('Bae'));

    //Update slang word details
    print_r($urbanWord->updateWord("Bae", "Foo", "Bar", "Foo Bar"));

    //Pass slang word to delete
    print_r($urbanWord->deleteWord('Turnt'));

    print_r($urbanWord->getWords());

} catch (WordManagerException $e) {
    echo $e->errorMessage();
}

//Class WordRankManager returns the frequency of occurence of a word in a sentence


try {
    $sentence = new WordRankManager("The big brown fox is just a big brown fox jumping up all in the lazy dog's business");
    print_r($sentence->ranker());
} catch (WordRankManagerException $e) {
    echo $e->errorMessage();
}
```

## Contributing

Contributions are **welcome** and will be fully **credited**.

We accept contributions via Pull Requests on [Github](https://github.com/andela-jkariuki/CheckpointOne/).

## Pull Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - The easiest way to apply the conventions is to install [PHP Code Sniffer](http://pear.php.net/package/PHP_CodeSniffer).

- **Add tests!** - Your patch won't be accepted if it doesn't have tests.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date.

- **Consider our release cycle** - We try to follow [SemVer v2.0.0](http://semver.org/). Randomly breaking public APIs is not an option.

- **Create feature branches** - Don't ask us to pull from your master branch.

- **One pull request per feature** - If you want to do more than one thing, send multiple pull requests.

- **Send coherent history** - Make sure each individual commit in your pull request is meaningful. If you had to make multiple intermediate commits while developing, please [squash them](http://www.git-scm.com/book/en/v2/Git-Tools-Rewriting-History#Changing-Multiple-Commit-Messages) before submitting.

## Security

If you discover any security related issues, please email me at [John Kariuki](john.kariuki@andela.com) or create an issue.

## Credits

[John kariuki](https://github.com/andela-jkariuki)

## License

### The MIT License (MIT)

Copyright (c) 2016 John kariuki <john.kariuki@andela.com>

> Permission is hereby granted, free of charge, to any person obtaining a copy
> of this software and associated documentation files (the "Software"), to deal
> in the Software without restriction, including without limitation the rights
> to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
> copies of the Software, and to permit persons to whom the Software is
> furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in
> all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
> IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
> FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
> AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
> LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
> OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
> THE SOFTWARE.
