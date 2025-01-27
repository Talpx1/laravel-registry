<?php

declare(strict_types=1);

namespace Talp1\LaravelRegistry\Models\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BaseModel extends Model {
    protected string $model_name;

    /** @var string[] */
    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);

        $this->model_name ??= Str::snake(class_basename(static::class));

        // dd($this->primaryKey);

        $this->guarded[] = $this->primaryKey;

        /** @var string|null $table */
        $table = config('registry.database.table_names.'.Str::plural($this->model_name));
        $this->table = $table ?: parent::getTable();
    }
}
