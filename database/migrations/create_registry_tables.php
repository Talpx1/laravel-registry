<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Some of the columns in these tables, even if created as primitive types, should only be populated with an enumeration of possible values.
// This behavior should be enforced by the application (eg. during validation).
// Not using an enum type column nor a foreign key constraint because of the reasons explained in the documentation.
// See: https://github.com/Talpx1/laravel-registry?tab=readme-ov-file#database-design-choices

return new class extends Migration {
    /** @var string[] */
    private array $morph_names = [];

    /** @var string[] */
    private array $table_names = [];

    public function __construct() {
        /** @var string[] */
        $morph_names = config('registry.database.morph_names');
        $this->morph_names = $morph_names;

        /** @var string[] */
        $table_names = config('registry.database.table_names');
        $this->table_names = $table_names;
    }

    public function up(): void {
        // ADDRESSES
        Schema::create($this->table_names['addresses'], function (Blueprint $table): void {
            $table->id();

            $table->morphs($this->morph_names['address_owner']);

            $table->string('title')->nullable();
            $table->string('street');
            $table->string('civic_number');
            $table->string('postal_code');
            $table->string('city');

            // This column should only be populated with values from `Countries::values()`
            $table->string('country');

            // This column should only be populated with values from `SitePurposes::values()`
            // See documentation for design choices about this column: https://github.com/Talpx1/laravel-registry?tab=readme-ov-file#purpose-aware-addresses
            $table->string('purpose')->nullable();

            $table->mediumText('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'street',
                'civic_number',
                'postal_code',
                'city',
                'country',
                $this->morph_names['address_owner'].'_type',
                $this->morph_names['address_owner'].'_id',
            ]);
        });

        // SOCIAL NETWORK PROFILES
        Schema::create($this->table_names['social_network_profiles'], function (Blueprint $table): void {
            $table->id();

            $table->morphs($this->morph_names['social_network_profile_owner']);

            // This column should only be populated with values from `SocialNetworks::values()`
            $table->string('social_network');

            $table->string('title')->nullable();
            $table->string('url');
            $table->string('username')->nullable();
            $table->mediumText('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'url',
                $this->morph_names['social_network_profile_owner'].'_type',
                $this->morph_names['social_network_profile_owner'].'_id',
            ]);

            $table->unique([
                'username',
                'social_network',
                $this->morph_names['social_network_profile_owner'].'_type',
                $this->morph_names['social_network_profile_owner'].'_id',
            ]);
        });

        // WEBSITES
        Schema::create($this->table_names['websites'], function (Blueprint $table): void {
            $table->id();

            $table->morphs($this->morph_names['website_owner']);

            $table->string('title')->nullable();
            $table->string('url');
            $table->mediumText('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'url',
                $this->morph_names['website_owner'].'_type',
                $this->morph_names['website_owner'].'_id',
            ]);
        });

        // PHONE NUMBERS
        Schema::create($this->table_names['phone_numbers'], function (Blueprint $table): void {
            $table->id();

            $table->morphs($this->morph_names['phone_number_owner']);

            // This column should only be populated with values from `PhoneLineTypes::values()`
            $table->string('line_type');

            $table->string('title')->nullable();

            // This column should only be populated with values from `Countries::allPhonePrefixes()`
            $table->string('prefix')->nullable();

            $table->string('phone_number');
            $table->boolean('accepts_sms');
            $table->boolean('accepts_calls');
            $table->boolean('accepts_faxes');
            $table->boolean('is_receive_only');
            $table->boolean('is_operated_by_human');
            $table->mediumText('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'prefix',
                'phone_number',
                $this->morph_names['phone_number_owner'].'_type',
                $this->morph_names['phone_number_owner'].'_id',
            ]);
        });

        // EMAIL ADDRESSES
        Schema::create($this->table_names['email_addresses'], function (Blueprint $table): void {
            $table->id();

            $table->morphs($this->morph_names['email_address_owner']);

            $table->string('title')->nullable();
            $table->string('email_address');
            $table->string('provider')->nullable();
            $table->boolean('is_certified');
            $table->boolean('is_no_reply');
            $table->boolean('is_operated_by_human');
            $table->mediumText('notes')->nullable();

            $table->timestamps();

            $table->unique([
                'email_address',
                $this->morph_names['email_address_owner'].'_type',
                $this->morph_names['email_address_owner'].'_id',
            ]);
        });

        // PEOPLE
        Schema::create($this->table_names['people'], function (Blueprint $table): void {
            $table->id();

            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');

            // This column should only be populated with values from `Genders::values()`
            $table->string('gender')->nullable();

            $table->integer('height_in_cm')->nullable();
            $table->integer('weight_in_kg')->nullable();

            // This column should only be populated with values from `EyeColors::possibleEyeColors()`
            $table->string('eyes_color')->nullable();
            // This column should only be populated with values from `HairColor::values()`
            $table->string('hair_color')->nullable();
            // This column should only be populated with values from `SkinTones::values()`
            $table->string('skin_tone')->nullable();
            // This column should only be populated with values from `BloodTypes::values()`
            $table->string('blood_type')->nullable();
            // This column should only be populated with values from `MaritalStatuses::values()`
            $table->string('marital_status')->nullable();
            // This column should only be populated with values from `Religions::values()`
            $table->string('religion')->nullable();

            $table->timestamp('date_of_birth')->nullable();
            $table->string('birth_city')->nullable();

            // This column should only be populated with values from `Countries::values()`
            $table->string('birth_country')->nullable();

            // This column should only be populated with values from `EducationLevels::values()`
            $table->string('education_level')->nullable();
            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });

        // COMPANIES
        Schema::create($this->table_names['companies'], function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('vat_code')->unique();

            // This column should only be populated with values from `CompanyTypes::values()`
            $table->string('company_type')->nullable();

            $table->foreignId('parent_company_id')->nullable()->constrained($this->table_names['companies']);

            // This column should only be populated with values from `CompanyLegalForms::values()`
            $table->string('legal_form')->nullable();

            // This column should only be populated with values from `EconomicSectors::values()`
            $table->string('economic_sector')->nullable();

            $table->integer('share_capital_amount')->nullable();

            // This column should only be populated with values from `Currencies::values()`
            $table->string('share_capital_currency')->nullable();

            $table->year('foundation_year')->nullable();

            // This column should only be populated with values from `Currencies::values()`
            $table->string('foundation_country')->nullable();

            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        foreach ($this->table_names as $table_name) {
            Schema::dropIfExists($table_name);
        }
    }
};
