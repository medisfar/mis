<div wire:key="chart-container-{{ $chartId }}" style="position: relative; height: 400px; width: 100%;">
    <canvas id="{{ $chartId }}" wire:ignore style="height: 100%; width: 100%;"></canvas>
</div>

@push('messcripts')
<script>
    (function() {
        var chartId = '{{ $chartId }}';
        var canvas = document.getElementById(chartId);
        
        if (!canvas) {
            console.error('Canvas #' + chartId + ' introuvable');
            return;
        }

        var ctx = canvas.getContext('2d');
        var data = @json($chartData);
        var options = @json($chartOptions);

        // Données par défaut si vide
        if (!data || !data.labels || data.labels.length === 0) {
            data = {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
                datasets: [{
                    label: 'Données exemple',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderWidth: 1
                }]
            };
        }

        var defaultOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: true, position: 'top' }
            },
            scales: {
                y: { beginAtZero: true }
            }
        };

        try {
            new Chart(ctx, {
                type: '{{ $chartType }}',
                data: data,
                options: Object.assign({}, default