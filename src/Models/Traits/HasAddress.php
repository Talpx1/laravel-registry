<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAddress {
    /** @return MorphMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function addresses(): MorphMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.address');
        /** @var string */
        $morph_name = config('registry.database.morph_names.address_owner');

        return $this->morphMany($model, $morph_name);
    }

    // scopes
    // TODO: whereHasAnAddress
    // TODO: whereHasAddressForCountry
    // TODO: whereHasAddressWithPurpose
    // relations
    // TODO: addressesWithPurpose
}
