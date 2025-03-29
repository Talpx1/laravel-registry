<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasAddresses;
use Talp1\LaravelRegistry\Models\Traits\HasEmailAddresses;
use Talp1\LaravelRegistry\Models\Traits\HasJobs;
use Talp1\LaravelRegistry\Models\Traits\HasPhoneNumbers;
use Talp1\LaravelRegistry\Models\Traits\HasSocialNetworkProfiles;
use Talp1\LaravelRegistry\Models\Traits\HasWebsites;

/**
 * @property-read int $id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property \Talp1\LaravelRegistry\Enums\Genders|null $gender
 * @property \Carbon\Carbon|null $date_of_birth
 * @property string|null $birth_city
 * @property \Talp1\LaravelRegistry\Enums\Countries|null $birth_country
 * @property int|null $height_in_cm
 * @property int|null $weight_in_kg
 * @property \Talp1\LaravelRegistry\Enums\EducationLevels|null $education_level
 * @property \Talp1\LaravelRegistry\Enums\EyeColors|null $eyes_color
 * @property \Talp1\LaravelRegistry\Enums\HairColors|null $hair_color
 * @property \Talp1\LaravelRegistry\Enums\SkinTones|null $skin_tone
 * @property \Talp1\LaravelRegistry\Enums\BloodTypes|null $blood_type
 * @property \Talp1\LaravelRegistry\Enums\MaritalStatuses|null $marital_status
 * @property \Talp1\LaravelRegistry\Enums\Religions|null $religion
 * @property string|null $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $full_name
 * @property-read int|null $age
 * @property-read string|null $birth_week_day
 * @property-read float|null $height_in_meters
 * @property-read float|null $height_in_inches
 * @property-read float|null $height_in_feet
 * @property-read string|null $height_in_feet_human_readable
 * @property-read float|null $weight_in_pounds
 * @property-read \Illuminate\Database\Eloquent\Collection<Address> $addresses
 * @property-read \Illuminate\Database\Eloquent\Collection<EmailAddress> $emailAddresses
 * @property-read \Illuminate\Database\Eloquent\Collection<PhoneNumber> $phoneNumbers
 * @property-read \Illuminate\Database\Eloquent\Collection<SocialNetworkProfile> $socialNetworkProfiles
 * @property-read \Illuminate\Database\Eloquent\Collection<Website> $websites
 * @property-read \Illuminate\Database\Eloquent\Collection<Job> $jobs
 *
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany addresses()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany emailAddresses()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany phoneNumbers()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany socialNetworkProfiles()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany websites()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany jobs()
 */
class Person extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\PersonFactory> */
    use HasAddresses, HasEmailAddresses, HasFactory, HasJobs, HasPhoneNumbers, HasSocialNetworkProfiles, HasWebsites;

    private const float CM_TO_INCHES_COEFFICIENT = 0.393701;

    private const float CM_TO_FEET_COEFFICIENT = 0.0328084;

    private const float KG_TO_POUNDS_COEFFICIENT = 2.2046;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var array<string, class-string> */
        $enums = config('registry.enums');

        return [
            'gender' => $enums['genders'],
            'birth_country' => $enums['countries'],
            'education_level' => $enums['education_levels'],
            'eyes_color' => $enums['eye_colors'],
            'hair_color' => $enums['hair_colors'],
            'skin_tone' => $enums['skin_tones'],
            'blood_type' => $enums['blood_types'],
            'marital_status' => $enums['marital_statuses'],
            'religion' => $enums['religions'],
            'date_of_birth' => 'date',
        ];
    }

    /** @return Attribute<string, never> */
    protected function fullName(): Attribute {
        return Attribute::get(fn (): string => implode(' ',
            array_map(fn (string $part) => ucfirst($part),
                array_filter([$this->first_name, $this->middle_name, $this->last_name])
            ))
        );
    }

    /** @return Attribute<int|null, never> */
    protected function age(): Attribute {
        return Attribute::get(fn (): ?int => $this->date_of_birth?->age);
    }

    /** @return Attribute<string|null, never> */
    protected function birthWeekDay(): Attribute {
        return Attribute::get(fn (): ?string => $this->date_of_birth?->format('l'));
    }

    /** @return Attribute<float|null, never> */
    protected function heightInMeters(): Attribute {
        return Attribute::get(fn (): ?float => is_null($this->height_in_cm) ? null : round($this->height_in_cm / 100, 2));
    }

    /** @return Attribute<float|null, never> */
    protected function heightInInches(): Attribute {
        return Attribute::get(fn (): ?float => is_null($this->height_in_cm) ? null : round($this->height_in_cm * self::CM_TO_INCHES_COEFFICIENT, 2));
    }

    /** @return Attribute<float|null, never> */
    protected function heightInFeet(): Attribute {
        return Attribute::get(fn (): ?float => is_null($this->height_in_cm) ? null : round($this->height_in_cm * self::CM_TO_FEET_COEFFICIENT, 2));
    }

    /** @return Attribute<string|null, never> */
    protected function heightInFeetHumanReadable(): Attribute {
        return Attribute::get(function (): ?string {
            if (is_null($this->height_in_cm)) {
                return null;
            }

            $inches = $this->height_in_cm / 2.54;
            $feet = intval($inches / 12);
            $inches %= 12;

            return "{$feet}' {$inches}\"";
        });
    }

    /** @return Attribute<float|null, never> */
    protected function weightInPounds(): Attribute {
        return Attribute::get(fn (): ?float => is_null($this->weight_in_kg) ? null : round($this->weight_in_kg * self::KG_TO_POUNDS_COEFFICIENT, 2));
    }
}
