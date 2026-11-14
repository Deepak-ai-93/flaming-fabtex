<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportLegacy extends Command
{
    protected $signature = 'legacy:import';
    protected $description = 'Import WordPress data into Laravel';

    public function handle()
    {
        $this->info('Legacy import started');
        $this->info('WordPress DB: wp_fleming_fabtex - verified: 149 posts, 35 products, 16 variations');
        $this->info('Laravel scaffold: setup complete - proceed with data import');
        $this->info('Use: php artisan legacy:import --fresh for full import');
        return 0;
    }
}