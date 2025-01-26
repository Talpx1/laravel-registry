<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Talp1\LaravelRegistry\Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in(__DIR__);

require_once __DIR__.'/utils/helpers.php';
require_once __DIR__.'/utils/schema_assertions.php';
require_once __DIR__.'/utils/casing_expectations.php';
