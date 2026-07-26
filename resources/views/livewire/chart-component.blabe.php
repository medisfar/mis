<div>
    <div style="background:white;padding:20px;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.1);">
        @if($title)
            <h3 style="margin-top:0;margin-bottom:15px;">{{ $title }}</h3>
        @endif
        <div wire:ignore id="{{ $chartId }}" style="width:100%;height:400px;"></div>
    </div>

    @push('mescripts')
    <script>
        let chartInstance_{{ $chartId }} = null;

        function initChart{{ $chartId }}() {
            const container = document.getElementById('{{ $chartId }}');
            if (!container) return;

            // Destroy previous instance if exists
            if (chartInstance_{{ $chartId }}) {
                chartInstance_{{ $chartId }}.destroy();
                chartInstance_{{ $chartId }} = null;
            }

            chartInstance_{{ $chartId }} = Highcharts.chart('{{ $chartId }}', {
                chart: {
                    type: '{{ $chartType }}'
                },
                title: {
                    text: null
                },
                xAxis: {
                    categories: @json($labels),
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '{{ $yAxisTitle ?? '' }}'
                    }
                },
                tooltip: {
                    shared: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: @json($datasets)
            });
        }

        // Initialize on first load
        initChart{{ $chartId }}();

        // Re-init on Livewire updates
        Livewire.hook('morph.updated', ({ el }) => {
            if (el.querySelector('#{{ $chartId }}')) {
                initChart{{ $chartId }}();
            }
        });
    </script>
    @endpush
</div>