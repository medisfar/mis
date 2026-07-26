<div>
    @push('messcripts')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @endpush

    <div class="table-responsive">
        <div id="chart_div" style="overflow-x: auto;"></div>
    </div>

    @push('messcripts')
    <script>
        google.charts.load('current', {'packages':['gantt']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Task ID');
            data.addColumn('string', 'Task Name');
            data.addColumn('string', 'Resource');
            data.addColumn('date', 'Start Date');
            data.addColumn('date', 'End Date');
            data.addColumn('number', 'Duration');
            data.addColumn('number', 'Percent Complete');
            data.addColumn('string', 'Dependencies');

            // Convert PHP data to Google Date objects
            const rawData = @json($gcdata);
            const formattedData = rawData.map(item => {
                return [
                    item[0],
                    item[1],
                    item[2],
                    new Date(item[3]), // Start
                    new Date(item[4]), // End
                    item[5],
                    item[6],
                    item[7]
                ];
            });

            data.addRows(formattedData);

            var options = {
                height: 400,
                gantt: {
                    trackHeight: 30
                }
            };

            var chart = new google.visualization.Gantt(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    @endpush
</div>