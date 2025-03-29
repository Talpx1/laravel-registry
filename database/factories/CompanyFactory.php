<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Talp1\LaravelRegistry\Enums\CompanyLegalForms;
use Talp1\LaravelRegistry\Enums\CompanyTypes;
use Talp1\LaravelRegistry\Enums\Countries;
use Talp1\LaravelRegistry\Enums\Currencies;
use Talp1\LaravelRegistry\Enums\EconomicSectors;
use Talp1\LaravelRegistry\Models\Company;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Company>
 */
class CompanyFactory extends Factory {
    protected $model = Company::class;

    public function definition(): array {
        return [
            'name' => fake()->company(),
            'vat_code' => fake()->countryCode().fake()->unique()->numerify('#########'),
            'company_type' => CompanyTypes::randomValue(),
            'parent_company_id' => null,
            'legal_form' => CompanyLegalForms::randomValue(),
            'economic_sector' => EconomicSectors::randomValue(),
            'share_capital_amount' => rand(10000, 1000000),
            'share_capital_currency' => Currencies::randomValue(),
            'foundation_date' => fake()->date(),
            'foundation_country' => Countries::randomValue(),
            'notes' => fake()->paragraph(),
        ];
    }

    public function ofType(CompanyTypes $type): self {
        return $this->state(fn (): array => ['company_type' => $type->value]);
    }

    public function withParent(?Company $company = null): self {
        return $this->for($company ?? Company::factory(), 'parent');
    }

    public function withLegalForm(CompanyLegalForms $form): self {
        return $this->state(fn (): array => ['legal_form' => $form->value]);
    }

    public function ofEconomicSector(EconomicSectors $sector): self {
        return $this->state(fn (): array => ['economic_sector' => $sector->value]);
    }

    public function withShareCapitalCurrency(Currencies $currency): self {
        return $this->state(fn (): array => ['share_capital_currency' => $currency->value]);
    }

    public function foundedInCountry(Countries $country): self {
        return $this->state(fn (): array => ['foundation_country' => $country->value]);
    }
}
