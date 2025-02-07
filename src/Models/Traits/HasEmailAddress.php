<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasEmailAddress {
    /** @return MorphMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function emailAddresses(): MorphMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.email_address');
        /** @var string */
        $morph_name = config('registry.database.morph_names.email_address_owner');

        return $this->morphMany($model, $morph_name);
    }

    // attributes
    // TODO: hasCertifiedEmail
    // TODO: hasNoReplyEmail
    // TODO: hasOperatedByHumanEmail

    // scopes
    // TODO: whereHasEmailOfProvider
    // TODO: whereHasCertifiedEmail
    // TODO: whereHasNoReplyEmail
    // TODO: whereHasOperatedByHumanEmail

    // relations
    // TODO: certifiedEmails
    // TODO: noReplyEmails
    // TODO: operatedByHumanEmails
}
