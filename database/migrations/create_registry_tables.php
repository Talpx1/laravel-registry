<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Some of the columns in these tables, even if created as primitive types, should only be populated with an enumeration of possible values.
// This behavior should be enforced by the application (eg. during validation).
// Not using an enum type column nor a foreign key constraint because of the reasons explained in the documentation.
// See: TODO: link here when the docs will be done

return new class extends Migration {
    public function __construct(
        /** @var string[] */
        private array $morph_names = config('registry.database.table_names'),

        /** @var string[] */
        private array $table_names = config('registry.database.morph_names')
    ) {}

    public function up(): void {
        Schema::create($this->table_names['addresses'], function (Blueprint $table) {
            $table->id();

            $table->morphs($this->morph_names['address_owner']);

            $table->string('title')->nullable();
            $table->string('street');
            $table->string('civic_number');
            $table->string('postal_code');
            $table->string('city');

            // This column should only be populated with values from `Countries::values()`
            $table->string('country');

            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });

        Schema::create($this->table_names['social_network_profiles'], function (Blueprint $table) {
            $table->id();

            $table->morphs($this->morph_names['social_network_profile_owner']);

            // This column should only be populated with values from `SocialNetworks::values()`
            $table->string('social_network');

            $table->string('title')->nullable();
            $table->string('url');
            $table->string('handle')->nullable();

            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });

        Schema::create($this->table_names['websites'], function (Blueprint $table) {
            $table->id();

            $table->morphs($this->morph_names['website_owner']);

            $table->string('title')->nullable();
            $table->string('url');
            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });

        Schema::create($this->table_names['phone_numbers'], function (Blueprint $table) {
            $table->id();

            $table->morphs($this->morph_names['phone_number_owner']);

            // This column should only be populated with values from `PhoneLineTypes::values()`
            $table->string('line_type');

            $table->string('title')->nullable();

            // This column should only be populated with values from `Countries::allPhonePrefixes()`
            $table->string('prefix')->default(config('registry.defaults.phone_number_prefix'));

            $table->string('phone_number');
            $table->boolean('accepts_sms')->default(true);
            $table->boolean('accepts_calls')->default(true);
            $table->boolean('accepts_faxes')->default(false);
            $table->boolean('is_receive_only')->default(false);
            $table->boolean('is_operated_by_human')->default(true);
            $table->mediumText('notes')->nullable();

            $table->timestamps();
        });

        Schema::create($this->table_names['email_addresses'], function (Blueprint $table) {
            $table->id();

            $table->morphs($this->morph_names['email_address_owner']);

            $table->string('title')->nullable();
            $table->string('email_address');
            $table->boolean('is_certified')->default(false);
            $table->boolean('is_no_reply')->default(false);
            $table->boolean('is_operated_by_human')->default(true);
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
