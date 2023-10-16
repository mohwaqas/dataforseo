<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="scatterChart" width="400" height="400"></canvas>
<script>
    var ctx = document.getElementById('scatterChart').getContext('2d');

    var data = @json($data); // Convert PHP array to a JavaScript array
    var ary =  @json($chart_data);
    var url_data = @json($url_data);
    console.log(ary);


    var urls = data.map(item => item.url);
    var ranks = data.map(item => item.ranked);
    var searchPositions = data.map(item => item.search_position);

    new Chart(ctx, {
        type: 'scatter',
        data: {
            labels: url_data,
            datasets: [{
                label: 'Search Result' , 
                data: ary,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    ///type: 'category',
                    labels: 'Repetition',
                    min:0,
                    max:{{$repetitions}}, 
                },
                x: {
                     labels: 'Ranked',
                    min:0,
                    max:100,
                }
            }
        }
    });


 
</script>
