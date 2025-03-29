<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSocialNetworkProfiles {
    /** @return MorphMany<\Illuminate\Database\Eloquent\Model, $this> */
    public function socialNetworkProfiles(): MorphMany {
        /** @var class-string<\Illuminate\Database\Eloquent\Model> */
        $model = config('registry.models.social_network_profile');
        /** @var string */
        $morph_name = config('registry.database.morph_names.social_network_profile_owner');

        return $this->morphMany($model, $morph_name);
    }

    // scopes
    // TODO: whereHasSocialNetworkProfileFor(SocialNetwork)
}
