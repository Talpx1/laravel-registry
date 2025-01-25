<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Talp1\LaravelRegistry\Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

/**
 * Scan the migration folder and run all files found.
 */
function runMigrations(): void {
    foreach (File::allFiles(__DIR__.'/../database/migrations') as $migration) {
        (include $migration->getRealPath())->up();
    }
}

/**
 * Drop all tables in the database.
 */
function dropAllTables(): void {
    foreach (Schema::getTableListing() as $table) {
        Schema::dropIfExists($table);
    }
}

/**
 * Drop all tables and then run all the migrations.
 *
 * @see dropAllTables(), runMigrations()
 */
function recreateAllTables(): void {
    dropAllTables();
    runMigrations();
}

/**
 * Get the table name for a model.
 *
 * @param  class-string<Model>  $model
 */
function getTableNameForModel(string $model): string {
    return (new $model)->getTable();
}

/**
 * If the provided string is a model class-string, return the table name for it,
 * otherwise return the string as is.
 */
function maybeGetTableNameForModel(string $maybe_model): string {
    return is_a($maybe_model, Model::class, true) ? getTableNameForModel($maybe_model) : $maybe_model;
}

/**
 * Get the column definition for a column in a table.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 *
 * @return array{name:string,type_name: string, type: string, collation: string|null, nullable: bool, default: mixed, auto_increment: bool, comment: string|null, generation: string|null}
 */
function getColumn(string $table, string $column): array {
    $table = maybeGetTableNameForModel($table);

    return array_values(Arr::where(
        Schema::getColumns($table),
        fn ($col): bool => $col['name'] === $column
    ))[0];
}

/**
 * Assert that a column in a table is nullable.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 */
function assertColumnIsNullable(string $table, string $column): void {
    test()->expect(getColumn($table, $column)['nullable'])->toBeTrue();
}

/**
 * Assert that a column in a table is not nullable.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 */
function assertColumnIsRequired(string $table, string $column): void {
    test()->expect(getColumn($table, $column)['nullable'])->toBeFalse();
}

/**
 * Assert that a table exists in the database.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 */
function assertDatabaseHasTable(string $table): void {
    test()->expect(Schema::hasTable(maybeGetTableNameForModel($table)))->toBeTrue();
}

/**
 * Assert that a table does not exist in the database.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 */
function assertDatabaseMissingTable(string $table): void {
    test()->expect(Schema::hasTable(maybeGetTableNameForModel($table)))->toBeFalse();
}

/**
 * Assert that a table has a one or more columns.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 */
function assertTableHasColumns(string $table, string ...$columns): void {
    test()->expect(Schema::getColumnListing(maybeGetTableNameForModel($table)))->toContain(...$columns);
}

/**
 * Assert that a table has a unique index.
 *
 * If the provided table is a model class-string, the table name will be inferred from the model.
 *
 * @param  string|string[]  $columns  The column(s) that make up the index. If the index is composed of multiple columns, pass them as an array.
 */
function assertIndexIsUnique(string $table, string|array $columns): void {
    if (! is_array($columns)) {
        $columns = [$columns];
    }

    $found = collect(Schema::getIndexes(maybeGetTableNameForModel($table)))
        ->contains(fn ($index): bool => $index['unique'] && sort($index['columns']) === sort($columns));

    test()->expect($found)->toBeTrue();
}
