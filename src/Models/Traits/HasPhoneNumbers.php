<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPhoneNumbers {
    /** @return MorphMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function phoneNumbers(): MorphMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.phone_number');
        /** @var string */
        $morph_name = config('registry.database.morph_names.phone_number_owner');

        return $this->morphMany($model, $morph_name);
    }

    // attributes
    // TODO: hasFixedLineNumber
    // TODO: hasMobileLineNumber
    // TODO: hasNumberWithSmsCapability
    // TODO: hasNumberWithFaxCapability
    // TODO: hasNumberWithCallCapability
    // TODO: hasReceiveOnlyNumber
    // TODO: hasOperatedByHumanNumber

    // scopes
    // TODO: whereHasFixedLineNumber
    // TODO: whereHasMobileLineNumber
    // TODO: whereHasPhoneNumberForCountry
    // TODO: whereHasMobileNumberForCountry
    // TODO: whereHasFixedNumberForCountry
    // TODO: whereHasNumberWithSmsCapability
    // TODO: whereHasNumberWithCallCapability
    // TODO: whereHasNumberWithFaxCapability
    // TODO: whereHasReceiveOnlyNumber
    // TODO: whereHasOperatedByHumanNumber

    // relations
    // TODO: fixedLineNumbers
    // TODO: mobileLineNumbers
    // TODO: smsCapableNumbers
    // TODO: callCapableNumbers
    // TODO: faxCapableNumbers
    // TODO: receiveOnlyNumbers
    // TODO: humanOperatedNumbers
}
