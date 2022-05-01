<?php

namespace Tests\Unit;

use App\Domains\ProfileMatcher\ProfileMatcher;
use App\Models\Field;
use App\Models\Property;
use App\Models\SearchProfile;
use PHPUnit\Framework\TestCase;

class ProfileMatcherUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_not_matchSearchProfilesToProperty_matchProfileToProperty()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 1000000;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'numberOfRooms';
        $searchProfileField->value = 10;

        $searchProfile = new SearchProfile();
        $searchProfile->fields = collect([
            $searchProfileField,
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNull($result);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_not_matchSearchProfilesToProperty_matchProfileEvenWhenThereAreMatchingCases()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField1 = new Field();
        $propertyField1->name = 'area';
        $propertyField1->value = 250;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 100000;

        $propertyField3 = new Field();
        $propertyField3->name = 'return';
        $propertyField3->value = 100;

        $propertyField4 = new Field();
        $propertyField4->name = 'yearOfConstruction';
        $propertyField4->value = 2016;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
            $propertyField3,
            $propertyField4
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'return';
        $searchProfileField->value = [5, 95];

        $searchProfileField1 = new Field();
        $searchProfileField1->name = 'thisIsAWeirdNameThatWillNotMatchWhenLookingAtThisCode';
        $searchProfileField1->value = [5, 95];

        $searchProfileField2 = new Field();
        $searchProfileField2->name = 'price';
        $searchProfileField2->value = [null, 95000];

        $searchProfileField3 = new Field();
        $searchProfileField3->name = 'yearOfConstruction';
        $searchProfileField3->value = [2005, 2015];

        $searchProfileField4 = new Field();
        $searchProfileField4->name = 'area';
        $searchProfileField4->value = [150, 270];

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $searchProfileField1,
            $searchProfileField2,
            $searchProfileField,
            $searchProfileField3,
            $searchProfileField4
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNull($result);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_matchSearchProfilesToProperty_matchProfileToProperty()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $field1 = new Field();
        $field1->name = 'rooms';
        $field1->value = 10;

        $field2 = new Field();
        $field2->name = 'price';
        $field2->value = 1000000;

        $property->fields = collect([
            $field1,
            $field2,
        ]);

        $field3 = new Field();
        $field3->name = 'rooms';
        $field3->value = 10;

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $field3,
            $field2,
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNotNull($result);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_matchSearchProfilesToProperty_haveExpectedNumberOfExactMatches()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 100000;

        $propertyField3 = new Field();
        $propertyField3->name = 'return';
        $propertyField3->value = 10;

        $propertyField4 = new Field();
        $propertyField4->name = 'yearOfConstruction';
        $propertyField4->value = 2010;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
            $propertyField3,
            $propertyField4
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'return';
        $searchProfileField->value = [5, null];

        $searchProfileField2 = new Field();
        $searchProfileField2->name = 'price';
        $searchProfileField2->value = [null, 150000];

        $searchProfileField3 = new Field();
        $searchProfileField3->name = 'yearOfConstruction';
        $searchProfileField3->value = [2005, 2015];

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $propertyField1,
            $searchProfileField2,
            $searchProfileField,
            $searchProfileField3,
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result->exactMatches == 4);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_matchSearchProfilesToProperty_haveExpectedNumberOfLooseMatches()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 100000;

        $propertyField3 = new Field();
        $propertyField3->name = 'return';
        $propertyField3->value = 100;

        $propertyField4 = new Field();
        $propertyField4->name = 'yearOfConstruction';
        $propertyField4->value = 2016;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
            $propertyField3,
            $propertyField4
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'return';
        $searchProfileField->value = [5, 95];

        $searchProfileField2 = new Field();
        $searchProfileField2->name = 'price';
        $searchProfileField2->value = [null, 95000];

        $searchProfileField3 = new Field();
        $searchProfileField3->name = 'yearOfConstruction';
        $searchProfileField3->value = [2005, 2015];

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $searchProfileField2,
            $searchProfileField,
            $searchProfileField3,
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result->looseMatches == 3);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_matchSearchProfilesToProperty_haveExpectedNumberOfExactAndLooseMatches()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField1 = new Field();
        $propertyField1->name = 'area';
        $propertyField1->value = 250;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 100000;

        $propertyField3 = new Field();
        $propertyField3->name = 'return';
        $propertyField3->value = 100;

        $propertyField4 = new Field();
        $propertyField4->name = 'yearOfConstruction';
        $propertyField4->value = 2016;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
            $propertyField3,
            $propertyField4
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'return';
        $searchProfileField->value = [5, 95];

        $searchProfileField2 = new Field();
        $searchProfileField2->name = 'price';
        $searchProfileField2->value = [null, 95000];

        $searchProfileField3 = new Field();
        $searchProfileField3->name = 'yearOfConstruction';
        $searchProfileField3->value = [2005, 2015];

        $searchProfileField4 = new Field();
        $searchProfileField4->name = 'area';
        $searchProfileField4->value = [150, 270];

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $propertyField1,
            $searchProfileField2,
            $searchProfileField,
            $searchProfileField3,
            $searchProfileField4
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result->looseMatches == 3);
        $this->assertTrue($result->exactMatches == 2);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_matchSearchProfilesToProperty_haveNoMatches()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $property = new Property();

        $propertyField1 = new Field();
        $propertyField1->name = 'rooms';
        $propertyField1->value = 10;

        $propertyField1 = new Field();
        $propertyField1->name = 'area';
        $propertyField1->value = 250;

        $propertyField2 = new Field();
        $propertyField2->name = 'price';
        $propertyField2->value = 100000;

        $propertyField3 = new Field();
        $propertyField3->name = 'return';
        $propertyField3->value = 100;

        $propertyField4 = new Field();
        $propertyField4->name = 'yearOfConstruction';
        $propertyField4->value = 2016;

        $property->fields = collect([
            $propertyField1,
            $propertyField2,
            $propertyField3,
            $propertyField4
        ]);

        $searchProfileField = new Field();
        $searchProfileField->name = 'return';
        $searchProfileField->value = [12387912, 123879121];

        $searchProfileField2 = new Field();
        $searchProfileField2->name = 'price';
        $searchProfileField2->value = [2, 5];

        $searchProfileField3 = new Field();
        $searchProfileField3->name = 'yearOfConstruction';
        $searchProfileField3->value = [1500, 1600];

        $searchProfileField4 = new Field();
        $searchProfileField4->name = 'area';
        $searchProfileField4->value = [5, 45];

        $searchProfile = new SearchProfile();
        $searchProfile->id = 5;
        $searchProfile->fields = collect([
            $searchProfileField2,
            $searchProfileField,
            $searchProfileField3,
            $searchProfileField4
        ]);

        // WHEN
        $result = $profileMatcher->matchSearchProfilesToProperty($property, $searchProfile);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result->looseMatches == 0);
        $this->assertTrue($result->exactMatches == 0);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_calculateMatchScore_countExactMatchesAs_2Points()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $exactMatches = 10;
        $looseMatches = 0;

        // WHEN
        $result = $profileMatcher->calculateMatchScore($exactMatches, $looseMatches);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result == 20);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_calculateMatchScore_countLooseMatchesAs_1Point()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $exactMatches = 0;
        $looseMatches = 10;

        // WHEN
        $result = $profileMatcher->calculateMatchScore($exactMatches, $looseMatches);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result == 10);
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_should_calculateMatchScore_expectedPointAmount()
    {
        // GIVEN
        $profileMatcher = new ProfileMatcher();
        $exactMatches = 32;
        $looseMatches = 8;

        // WHEN
        $result = $profileMatcher->calculateMatchScore($exactMatches, $looseMatches);

        // THEN
        $this->assertNotNull($result);
        $this->assertTrue($result == 72);
    }
}
