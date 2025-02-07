<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Talp1\LaravelRegistry\Enums\BloodTypes;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\EducationLevels;
use Talp1\LaravelRegistry\Enums\EyeColors;
use Talp1\LaravelRegistry\Enums\Genders;
use Talp1\LaravelRegistry\Enums\HairColors;
use Talp1\LaravelRegistry\Enums\MaritalStatuses;
use Talp1\LaravelRegistry\Enums\Religions;
use Talp1\LaravelRegistry\Enums\SkinTones;
use Talp1\LaravelRegistry\Models\Person;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Person>
 */
class PersonFactory extends Factory {
    protected $model = Person::class;

    public function definition(): array {
        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => Genders::randomValue(),
            'date_of_birth' => fake()->dateTimeBetween(startDate: '-100 years'),
            'birth_city' => fake()->city(),
            'birth_country' => Countries::randomValue(),
            'height_in_cm' => rand(110, 210),
            'weight_in_kg' => rand(40, 200),
            'education_level' => EducationLevels::randomValue(),
            'eyes_color' => EyeColors::randomValue(),
            'hair_color' => HairColors::randomValue(),
            'skin_tone' => SkinTones::randomValue(),
            'blood_type' => BloodTypes::randomValue(),
            'marital_status' => MaritalStatuses::randomValue(),
            'religion' => Religions::randomValue(),
            'notes' => fake()->paragraph(),
        ];
    }

    public function withoutMiddleName(): self {
        return $this->state(fn (): array => ['middle_name' => null]);
    }

    public function ofAge(int $age): self {
        return $this->state(fn (): array => ['date_of_birth' => Carbon::yesterday()->subYears($age)]);
    }

    public function withGender(Genders $gender): self {
        return $this->state(fn (): array => ['gender' => $gender->value]);
    }

    public function withEducationLevel(EducationLevels $education_level): self {
        return $this->state(fn (): array => ['education_level' => $education_level->value]);
    }

    public function bornInCountry(Countries $country): self {
        return $this->state(fn (): array => ['birth_country' => $country->value]);
    }

    public function withEyeColor(EyeColors $education_level): self {
        return $this->state(fn (): array => ['education_level' => $education_level->value]);
    }

    public function withHairColor(HairColors $hair_color): self {
        return $this->state(fn (): array => ['hair_color' => $hair_color->value]);
    }

    public function withSkinTone(SkinTones $skin_tone): self {
        return $this->state(fn (): array => ['skin_tone' => $skin_tone->value]);
    }

    public function withBloodType(BloodTypes $blood_type): self {
        return $this->state(fn (): array => ['blood_type' => $blood_type->value]);
    }

    public function withMaritalStatus(MaritalStatuses $marital_status): self {
        return $this->state(fn (): array => ['marital_status' => $marital_status->value]);
    }

    public function ofReligion(Religions $religion): self {
        return $this->state(fn (): array => ['religion' => $religion->value]);
    }
}
