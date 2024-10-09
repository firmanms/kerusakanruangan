<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Forms;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StatsUsulanbWidget extends ChartWidget
{
    protected static ?string $heading = 'Usulan Per Tanggal';

    public $month;
    public $year;

    public function mount(): void
    {
        // Set default values for month and year
        $this->month = date('m');
        $this->year = date('Y');
    }

    protected function getData(): array
    {
        // Retrieve data based on the selected month and year
        $user = Auth::user();
        // Jika pengguna adalah super_admin, tampilkan semua data usulan
        if (auth()->user()->hasRole('super_admin')) {
            $data = DB::table('formulirs')
            ->select(DB::raw('DATE(created_at) as date, COUNT(*) as count'))
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        }else{
            $data = DB::table('formulirs')
            ->select(DB::raw('DATE(created_at) as date, COUNT(*) as count'))
            ->whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('user_id',$user->id)
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        }

        // Prepare the chart data
        $dates = [];
        $counts = [];

        // Generate all dates for the selected month
        $startDate = Carbon::createFromFormat('Y-m', "{$this->year}-{$this->month}")->startOfMonth();
        $endDate = Carbon::createFromFormat('Y-m', "{$this->year}-{$this->month}")->endOfMonth();

        $dateRange = [];
        while ($startDate <= $endDate) {
            $dateRange[] = $startDate->format('Y-m-d');
            $startDate->addDay();
        }

        // Initialize counts for all dates in the range
        foreach ($dateRange as $date) {
            $dates[] = $date;
            $counts[] = 0; // Default count is 0
        }

        // Fill in counts from the retrieved data
        foreach ($data as $item) {
            $index = array_search($item->date, $dates);
            if ($index !== false) {
                $counts[$index] = $item->count; // Update the count for the existing date
            }
        }

        return [
            'labels' => $dates,
            'datasets' => [
                [
                    'label' => 'Data Count',
                    'data' => $counts,
                    'borderColor' => '#4caf50',
                    'backgroundColor' => 'rgba(76, 175, 80, 0.2)',
                    'fill' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('month')
                ->label('Select Month')
                ->options([
                    '01' => 'January',
                    '02' => 'February',
                    '03' => 'March',
                    '04' => 'April',
                    '05' => 'May',
                    '06' => 'June',
                    '07' => 'July',
                    '08' => 'August',
                    '09' => 'September',
                    '10' => 'October',
                    '11' => 'November',
                    '12' => 'December',
                ])
                ->default($this->month)
                ->reactive()
                ->afterStateUpdated(fn($state) => $this->month = $state),

            Forms\Components\Select::make('year')
                ->label('Select Year')
                ->options(range(date('Y'), date('Y') - 5)) // Last 5 years
                ->default($this->year)
                ->reactive()
                ->afterStateUpdated(fn($state) => $this->year = $state),
        ];
    }

    public function updated($propertyName): void
    {
        // Trigger the chart data to update whenever a filter changes
        if (in_array($propertyName, ['month', 'year'])) {
            $this->refresh();
        }
    }
}
