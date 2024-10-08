<?php

namespace App\Filament\Dashboards;

use App\Filament\Widgets\StatsOverview;
use Filament\Dashboards\Dashboard;
use App\Filament\Widgets\YourCustomWidget; // Adjust to your widget

class CustomDashboard extends Dashboard
{
    protected static ?string $heading = 'My Custom Dashboard';

    protected function getWidgets(): array
    {
        return [
            StatsOverview::class,
            // Add other widgets here
        ];
    }
}
