<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Talp1\LaravelRegistry\Models\Contracts\BaseModel;
use Talp1\LaravelRegistry\Models\Traits\HasAddresses;
use Talp1\LaravelRegistry\Models\Traits\HasEmailAddresses;
use Talp1\LaravelRegistry\Models\Traits\HasPhoneNumbers;
use Talp1\LaravelRegistry\Models\Traits\HasSocialNetworkProfiles;
use Talp1\LaravelRegistry\Models\Traits\HasWebsites;

/**
 * @property-read int $id
 * @property string $name
 * @property string $vat_code
 * @property \Talp1\LaravelRegistry\Enums\CompanyTypes $company_type
 * @property int|null $parent_company_id
 * @property \Talp1\LaravelRegistry\Enums\CompanyLegalForms|null $legal_form
 * @property \Talp1\LaravelRegistry\Enums\EconomicSectors|null $economic_sector
 * @property int|null $share_capital_amount
 * @property \Talp1\LaravelRegistry\Enums\Currencies|null $share_capital_currency
 * @property \Illuminate\Support\Carbon|null $foundation_date
 * @property \Talp1\LaravelRegistry\Enums\Countries|null $foundation_country
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read string $full_company_name
 * @property-read int|null $years_of_activity
 * @property-read string|null $share_capital
 * @property-read \Illuminate\Database\Eloquent\Collection<Person> $employees
 * @property-read \Illuminate\Database\Eloquent\Collection<EmailAddress> $emailAddresses
 * @property-read \Illuminate\Database\Eloquent\Collection<PhoneNumber> $phoneNumbers
 * @property-read \Illuminate\Database\Eloquent\Collection<SocialNetworkProfile> $socialNetworkProfiles
 * @property-read \Illuminate\Database\Eloquent\Collection<Website> $websites
 *
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany employees()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany emailAddresses()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany phoneNumbers()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany socialNetworkProfiles()
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany websites()
 */
class Company extends BaseModel {
    /** @use HasFactory<\Talp1\LaravelRegistry\Database\Factories\PersonFactory> */
    use HasAddresses, HasEmailAddresses, HasFactory, HasPhoneNumbers, HasSocialNetworkProfiles, HasWebsites;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        /** @var array<string, class-string> */
        $enums = config('registry.enums');

        return [
            'company_type' => $enums['company_types'],
            'legal_form' => $enums['company_legal_forms'],
            'economic_sector' => $enums['economic_sectors'],
            'share_capital_currency' => $enums['currencies'],
            'foundation_date' => 'date',
        ];
    }

    /** @return BelongsTo<Company, $this> */
    public function parent(): BelongsTo {
        return $this->belongsTo(Company::class, 'parent_company_id');
    }

    /** @return Attribute<string, never> */
    protected function fullCompanyName(): Attribute {
        return Attribute::get(fn (): string => implode(' ', array_filter([$this->name, $this->legal_form?->abbreviations()[0] ?? null])));
    }

    /** @return Attribute<int|null, never> */
    protected function yearsOfActivity(): Attribute {
        return Attribute::get(fn (): ?int => is_null($this->foundation_date) ? null : intval($this->foundation_date->diffInYears()));
    }

    /** @return Attribute<string|null, never> */
    protected function shareCapital(): Attribute {
        return Attribute::get(fn (): ?string => is_null($this->share_capital_amount) || is_null($this->share_capital_currency) ?
            null :
            "{$this->share_capital_amount}{$this->share_capital_currency->symbolOrAbbreviation()}"
        );
    }
}
