<div>
    <script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>
    <div id="gc"></div>
    @push('messcripts')
    <script>
        // THE CHART
Highcharts.ganttChart('gc', {
    title: {
        text: 'Gantt Chart with Progress Indicators',
        align: 'left'
    },

    xAxis: {
        min: '2025-01-01',
        max: '2025-03-31'
    },

    accessibility: {
        point: {
            descriptionFormat: '{yCategory}. ' +
                '{#if completed}Task {(multiply completed.amount 100):.1f}% ' +
                'completed. {/if}' +
                'Start {x:%Y-%m-%d}, end {x2:%Y-%m-%d}.'
        }
    },

    lang: {
        accessibility: {
            axis: {
                xAxisDescriptionPlural: 'The chart has a two-part X axis ' +
                    'showing time in both week numbers and days.'
            }
        }
    },

    series:  [{
        name: 'Project 1',
        data: @json($gcdata)
    }]
});
    </script>
    @endpush
</div>
