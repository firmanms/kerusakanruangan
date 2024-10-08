<x-filament::page>
    <div>
        <h1 class="text-2xl font-bold">Dashboard Harian Formulir</h1>

        <div class="mt-4">
            {{ $this->filtersForm }}
        </div>

        <div class="mt-6">
            @php
                // Fetch initial data based on the selected date range
                $data = $this->getData();

                $labelsa = collect($data)->pluck('date')->map(function ($date) {
                    return \Carbon\Carbon::parse($date)->format('Y-m-d'); // Format to date only
                })->toArray();
                // var_dump($labelsa);
                $counts = collect($data)->pluck('count')->toArray();

                // Fetch initial data based on the selected date range
                $data2 = $this->getData2();

                $labelsa2 = collect($data2)->pluck('date')->map(function ($date) {
                    return \Carbon\Carbon::parse($date)->format('Y-m-d'); // Format to date only
                })->toArray();
                // var_dump($labelsa);
                $counts2 = collect($data2)->pluck('count')->toArray();
            @endphp

            <h2 class="text-lg font-semibold">Data Input Formulir dari tanggal {{ $this->startDate }} to {{ $this->endDate }}</h2>
            <canvas id="myChart" style="height: 400px;"></canvas>
            <br><br>
            <h1 class="text-2xl font-bold">Dashboard Harian Usulan</h1>
            <h2 class="text-lg font-semibold">Data Input Usulan dari tanggal {{ $this->startDate }} to {{ $this->endDate }}</h2>
            <canvas id="myChart2" style="height: 400px;"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');

        // Initial chart setup
        console.log(@json($labelsa));
        let myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsa) !!},
                datasets: [{
                    label: 'Entries',
                    data: @json($counts),
                    borderColor: 'rgba(76, 175, 80, 1)',
                    backgroundColor: 'rgba(76, 175, 80, 0.2)',
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'end',
                        formatter: (value) => {
                            return value; // Show the count value
                        },
                        color: 'rgba(76, 175, 80, 1)',
                    }
                }
            },
            plugins: [ChartDataLabels] // Register the data labels plugin
        });

        // Function to update the chart
        function updateChart(labels, counts) {
            myChart.data.labels = labels;
            myChart.data.datasets[0].data = counts;
            myChart.update();
        }

        // Watch for updates in the labels and counts
        window.addEventListener('updateChartData', function(event) {
            updateChart(event.detail.labels, event.detail.counts);
        });
    </script>

<script>
    const ctx2 = document.getElementById('myChart2').getContext('2d');

    // Initial chart setup
    console.log(@json($labelsa));
    let myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsa2) !!},
            datasets: [{
                label: 'Entries',
                data: @json($counts2),
                borderColor: 'rgba(76, 175, 80, 1)',
                backgroundColor: 'rgba(76, 175, 80, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                datalabels: {
                    anchor: 'end',
                    align: 'end',
                    formatter: (value) => {
                        return value; // Show the count value
                    },
                    color: 'rgba(76, 175, 80, 1)',
                }
            }
        },
        plugins: [ChartDataLabels] // Register the data labels plugin
    });

    // Function to update the chart
    function updateChart(labels, counts) {
        myChart.data.labels = labels;
        myChart.data.datasets[0].data = counts;
        myChart.update();
    }

    // Watch for updates in the labels and counts
    window.addEventListener('updateChartData', function(event) {
        updateChart(event.detail.labels, event.detail.counts);
    });
</script>
</x-filament::page>
