<div>
    <canvas id="chart-{{ $id }}"></canvas>
    <script>
        const ctx = document.getElementById('chart-{{ $id }}').getContext('2d');
        const chart = new Chart(ctx, {
            type: '{{ $type }}',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: '{{ $data['datasets'][0]['label'] }}',
                    data: @json($data['datasets'][0]['data']),
                    borderColor: '{{ $data['datasets'][0]['borderColor'] }}',
                    backgroundColor: '{{ $data['datasets'][0]['backgroundColor'] }}',
                    fill: true,
                }]
            },
            options: {
                // Add chart options here
            }
        });
    </script>
</div>
