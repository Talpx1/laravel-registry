<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Contracts;

use BackedEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sushi\Sushi;

/**
 * @template TEnum of \BackedEnum
 *
 * @property-read string $id
 */
abstract class EnumModel extends Model {
    use Sushi;

    /** @var class-string<TEnum> */
    public readonly string $enum;

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->enum = $this->getOrGuessEnumClass();

        $this->keyType = (new \ReflectionEnum($this->enum))->getBackingType()?->getName() ?? 'int';

        if ($this->keyType === 'string') {
            $this->incrementing = false;
        }
    }

    /**
     * Returns an array to be used as Sushi model rows.
     * Pure enums are not supported.
     *
     * @return array<string, mixed>[]
     *
     * @throws \Exception if the provided enum is not a backed enum.
     * @throws \Exception if sushiModelMappings method is missing in the provided enum.
     */
    public function getRows(): array {
        if (! is_a($this->enum, \BackedEnum::class, true)) {
            throw new \Exception("Only backed enums can be used as Sushi model. {$this->enum} is not a backed enum.");
        }

        return array_map([$this, 'enumMappings'], $this->enum::cases());
    }

    /**
     * @return class-string<TEnum>
     */
    protected function getOrGuessEnumClass(): string {
        $partial_enum_config_key = str(class_basename($this))->lower()->plural()->toString();
        $enum_config_key = "registry.enums.{$partial_enum_config_key}";
        $fallback = '\\App\\Enums\\'.Str::plural(class_basename($this));

        $enum = config($enum_config_key, $fallback);

        if (! is_string($enum)) {
            throw new \Exception("{$enum_config_key} config must be a backed enum class-string.");
        }

        if (! class_exists($enum)) {
            throw new \Exception('Enum for model '.__CLASS__." could not be guessed ({$enum} enum does not exist).");
        }

        if (! is_a($enum, BackedEnum::class, true)) {
            throw new \Exception('Guessing enum for model '.__CLASS__.": {$enum} found, but it's not a backed enum.");
        }

        /** @var class-string<TEnum> */
        return $enum;
    }

    /**
     * Get the corresponding enum case for the current model
     *
     * @return TEnum
     */
    public function enumCase(): \BackedEnum {
        return $this->enum::from($this->id);
    }

    /**
     * Returns an array to be used as a map to generate the attributes of the sushi model.
     *
     * @internal type-hinting $case as object because \BackedEnum is available for type checks only.
     *
     * @param  TEnum  $case
     * @return array<string, string|\Closure(TEnum):mixed>
     */
    abstract protected function enumMappings(\BackedEnum $case): array;
}
