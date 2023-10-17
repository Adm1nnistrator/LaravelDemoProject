<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateSalesActiveStatus extends Command
{
    protected $signature = 'app:update-sales-active-status';
    protected $description = 'Update sales active status';

    public function handle()
    {
        // Inside the handle method
        $now = now();

        $activeSales = DB::table('sales')
            ->where('sale_from', '<=', $now)
            ->where('sale_to', '>=', $now)
            ->get();

        $inactiveSales = DB::table('sales')
            ->where('sale_to', '<', $now)
            ->get();

        // Log the active and inactive sales
        $this->info('Active Sales: ' . count($activeSales));
        $this->info('Inactive Sales: ' . count($inactiveSales));

        // Update the sales and log the result
        $updatedActive = DB::table('sales')
            ->where('sale_from', '<=', $now)
            ->where('sale_to', '>=', $now)
            ->update(['is_sale_active' => true]);

        $updatedInactive = DB::table('sales')
            ->where('sale_to', '<', $now)
            ->update(['is_sale_active' => false]);

        $this->info('Updated active sales: ' . $updatedActive);
        $this->info('Updated inactive sales: ' . $updatedInactive);
    }
}
