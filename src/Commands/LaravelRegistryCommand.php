<?php

namespace Talp1\LaravelRegistry\Commands;

use Illuminate\Console\Command;

class LaravelRegistryCommand extends Command {
    public $signature = 'laravel-registry';

    public $description = 'My command';

    public function handle(): int {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
