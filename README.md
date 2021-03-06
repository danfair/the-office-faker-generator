# The Office Faker Generator (Provider)

[![Latest Stable Version](https://poser.pugx.org/recycledbeans/the-office-faker/version)](https://packagist.org/packages/recycledbeans/the-office-faker) [![Build Status](https://travis-ci.org/recycledbeans/the-office-faker-generator.svg?branch=master)](https://travis-ci.org/recycledbeans/the-office-faker-generator) [![StyleCI](https://github.styleci.io/repos/246913160/shield?branch=master)](https://github.styleci.io/repos/246913160)

## Bears. Beets. Battlestar Galactica.

With this package, you can extend the extremely useful Faker ([fzaninotto/faker](https://github.com/fzaninotto/Faker)) 
Library to seed your application with fake data using characters, companies, (and in a future release) locations from 
the hit TV series, The Office (US).

This is vital for when we launch Dunder Mifflin Infinity #2PointOh!

### Installation

Install this package using Composer.

```shell script
composer require recycledbeans/the-office-faker
```

### Usage

Start using characters and company names immediately using the Faker methods you are already familiar with. The
example below is using a Laravel Factory as an example, but Faker (and this provider) can be used in so many other ways
and in any other framework.

```php

$factory->define(Volunteer::class, function (Faker $faker) {

    // Add the TheOffice Provider so Faker starts using the methods within the provider
    $faker->addProvider(new \TheOfficeFaker\Provider\TheOffice($faker));

    return [
        'given_name' => $faker->firstName,
        'family_name' => $faker->lastName,
        'email' => $faker->safeEmail,
    ];
});

```

### Characters

The default usage above creates truly randomized first and last names, so you will end up with names like "Roy Kapoor" or
"Jim Schrute". If you would like the have the first and last names be consistent with the characters on the show (which 
is probably what most people would enjoy), you can use the character() method to return an object of a character's details.

```php

$factory->define(Volunteer::class, function (Faker $faker) {

    // Add the TheOffice Provider so Faker starts using the methods within the provider
    $faker->addProvider(new \TheOfficeFaker\Provider\TheOffice($faker));

    $character = $faker->character();

    return [
        'given_name' => $character->firstName,
        'family_name' => $character->lastName,
        'email' => $character->safeEmail,
    ];
});

```

### Companies

There is a small, but growing, list of fictional (and some Scranton-area) company names taken from episodes of The 
Office. You can use these the same way you would use the normal company attribute.

```php
// Michael Scott Paper Company, for instance
$company = $faker->company; 
```

### Running unit test

This project uses PHPUnit. You can run tests with or without code coverage.

With no code coverage
```bash
./vendor/bin/phpunit
```

With code coverage (you must have Xdebug installed to run code coverage)
```bash
./vendor/bin/phpunit --coverage-html tests/coverage
```

To view the code coverage report open `tests/coverage/index.html` in your browser.

### Identified Areas of Improvement (I would love your help!)

There is a short list of things I would like to improve or add in the near future to make this provider even better. If 
you would like to help in this endeavor, please feel free to create a pull request. Even if you don't feel like coding, 
if you see someone major that is missing from the characters list or a company that hasn't been added, please create a PR!

- Add more company names: there are plenty of references to fictional companies and Scranton-area places that could be
added for even more variability. 
- Cities and localities: I don't know if there will be enough cities mentioned in the office (mostly from the PA area), 
but I think it's worth looking into whether the provider can _provide_ enough cities to have them added.
- Lines from the episodes? Maybe a text provider that returns a random sentence from an actual line of dialog?
