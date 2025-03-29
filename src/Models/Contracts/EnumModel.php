<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sushi\Sushi;
use Talp1\LaravelRegistry\Enums\Contracts\HasSushiModel;

/**
 * @property-read string $id
 */
abstract class EnumModel extends Model {
    use Sushi;

    /** @var class-string<\UnitEnum&HasSushiModel>|null */
    protected ?string $enum;

    /** @var array{id: string}[] */
    protected array $rows = [];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->enum ??= $this->guessEnumClass(); // @phpstan-ignore assign.propertyType

        $this->rows = $this->enum::sushiArray();
    }

    protected function guessEnumClass(): string {
        return '\\App\\Enums\\'.Str::plural(class_basename($this));
    }

    public function toEnumCase(): HasSushiModel {
        return $this->enum::from($this->id);
    }

    // TODO: proxy property calls to enum case
}
