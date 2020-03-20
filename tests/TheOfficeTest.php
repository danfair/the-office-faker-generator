<?php

use Faker\Generator as Faker;
use PHPUnit\Framework\TestCase;
use TheOfficeFaker\Data\Companies;
use TheOfficeFaker\Data\MaleNames;
use TheOfficeFaker\Data\FemaleNames;
use TheOfficeFaker\Provider\TheOffice;

final class TheOfficeTest extends TestCase
{
    /**
     * @var TheOffice
     */
    private $faker;
    private $names;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = new Faker();
        $this->faker->addProvider(new TheOffice($this->faker));
        $this->names = array_merge(MaleNames::get(), FemaleNames::get());
    }

    public function testNameReturnsANameFromTheKnownListOfNames(): void
    {
        $this->assertContains($this->faker->name, $this->names);
    }

    public function testCompanyReturnsACompanyNameFromTheKnownListOfCompanies(): void
    {
        $this->assertContains($this->faker->company, Companies::get());
    }

    public function testCanGetACharacterName(): void
    {
        $this->assertContains($this->faker->character()->name, $this->names);
    }

    public function testCanGetACharacterFirstName(): void
    {
        $character = $this->faker->character();

        $firstName = explode(' ', $character->name)[0];
        $this->assertEquals($firstName, $character->firstName);
    }

    public function testCanGetACharacterLastName(): void
    {
        $character = $this->faker->character();

        $lastName = explode(' ', $character->name)[1];
        $this->assertEquals($lastName, $character->lastName);
    }

    public function testCanGetACharacterSafeEmail()
    {
        $character = $this->faker->character();
        $firstName = explode(' ', $character->name)[0];
        $lastName = explode(' ', $character->name)[1];
        $emailName = strtolower($firstName). '.' . strtolower($lastName);

        $this->assertTrue(strpos($character->safeEmail, $emailName) >= 0);
        $this->assertTrue(!!strpos($character->safeEmail, '@example.net') >= 0);
    }

    public function testCanGetACharacterEmail(): void
    {
        $character = $this->faker->character();
        $firstName = explode(' ', $character->name)[0];
        $lastName = explode(' ', $character->name)[1];
        $emailName = strtolower($firstName). '.' . strtolower($lastName);

        $this->assertEquals("{$emailName}@dunder-mifflin.com", $character->email);
    }

    public function testCanGetAFemaleCharacter(): void
    {
        $character = $this->faker->characterFemale();

        $this->assertContains($character->name, FemaleNames::get());
        $this->assertNotContains($character->name, MaleNames::get());
    }

    public function testCanGetAMaleCharacter(): void
    {
        $character = $this->faker->characterMale();

        $this->assertContains($character->name, MaleNames::get());
        $this->assertNotContains($character->name, FemaleNames::get());
    }
}