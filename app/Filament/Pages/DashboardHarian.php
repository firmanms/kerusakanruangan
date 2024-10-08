<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class DashboardHarian extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard-harian';

    use HasFiltersForm;

    public $startDate;
    public $endDate;

    public function mount(): void
    {
        // Set default values for the date range
        $this->startDate = '2024-01-01';
        $this->endDate = now()->endOfMonth()->format('Y-m-d'); // Set endDate to the end of the current month
    }

    // public function filtersForm(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Section::make('Select Date Range')
    //                 ->schema([
    //                     DatePicker::make('startDate')
    //                         ->label('Start Date')
    //                         ->default($this->startDate)
    //                         ->reactive()
    //                         ->afterStateUpdated(fn($state) => $this->updateStartDate($state)),

    //                     DatePicker::make('endDate')
    //                         ->label('End Date')
    //                         ->default($this->endDate)
    //                         ->reactive()
    //                         ->afterStateUpdated(fn($state) => $this->updateEndDate($state)),
    //                 ])
    //                 ->columns(2),
    //         ]);
    // }

    public function updateStartDate($state): void
    {
        $this->startDate = $state;
    }

    public function updateEndDate($state): void
    {
        $this->endDate = $state;
    }

    public function getData(): array
    {
        // Fetch data based on the selected date range
        $data = DB::table('formulirs')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->groupBy('date')
            ->get();

        return $data->toArray(); // Return the array
    }

    public function getData2(): array
    {
        // Fetch data based on the selected date range
        $data2 = DB::table('usulanrehabs')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->groupBy('date')
            ->get();

        return $data2->toArray(); // Return the array
    }

    public function updateChartData()
{
    $data = DB::table('formulirs')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
        ->whereBetween('created_at', [$this->startDate, $this->endDate])
        ->groupBy('date')
        ->get();

    $labelsa = collect($data)->pluck('date')->map(function ($date) {
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    })->toArray();

    $counts = collect($data)->pluck('count')->toArray();

    // Emit the event with the new labels and counts
    $this->emit('updateChartData', ['labels' => $labelsa, 'counts' => $counts]);
}
}
