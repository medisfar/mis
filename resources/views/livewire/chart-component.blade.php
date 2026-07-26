<div>
    <div class="p-4 bg-white rounded-lg shadow">
        <!-- ⭐ Only show if $period exists and is not null -->
        
        
        <div class="relative" style="height: 400px;">
            <canvas id="{{ $chartId }}"></canvas>
        </div>
    </div>

    @push('messcripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('livewire:init', function() {
            let chartInstance = null;
            
            function initChart() {
                const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
                
                if (chartInstance) {
                    chartInstance.destroy();
                }
                
                const chartData = @json([
                    'type' => $chartType,
                    'labels' => $labels,
                    'datasets' => $datasets
                ]);
                
                const chartOptions = @json($options);
                
                chartInstance = new Chart(ctx, {
                    type: chartData.type,
                    data: {
                        labels: chartData.labels,
                        datasets: chartData.datasets
                    },
                    options: chartOptions
                });
            }
            
            Livewire.on('refreshChart', function(data) {
                if (data.chartId === '{{ $chartId }}') {
                    initChart();
                }
            });
            
            setTimeout(initChart, 100);
        });
    </script>
    @endpush
</div>