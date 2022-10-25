@extends('Template.template')
@section('vue')
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full">
            <div class="inbox-head">
                <div class="input-group">
                    <div class="input-append">
                        <label style="color: black;">&nbsp;Mois de</label><br>
                        <select class="sr-input green_color" id="mois1" name="mois1" onchange="myChart()">
                            <option value="1">JANVIER</option>
                            <option value="2">FEVRIER</option>
                            <option value="3">MARS</option>
                            <option value="4">AVRIL</option>
                            <option value="5">MAI</option>
                            <option value="6">JUIN</option>
                            <option value="7">JUILLET</option>
                            <option value="8">AOÛT</option>
                            <option value="9">SEPTEMBRE</option>
                            <option value="10">OCTOBRE</option>
                            <option value="11">NOVEMBRE</option>
                            <option value="12">DECEMBRE</option>
                        </select>
                    </div>

                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Au</label><br>
                        <select class="sr-input green_color" id="mois2" name="mois2" onchange="myChart()">
                        <option value="12">DECEMBRE</option>
                        <option value="1">JANVIER</option>
                            <option value="2">FEVRIER</option>
                            <option value="3">MARS</option>
                            <option value="4">AVRIL</option>
                            <option value="5">MAI</option>
                            <option value="6">JUIN</option>
                            <option value="7">JUILLET</option>
                            <option value="8">AOÛT</option>
                            <option value="9">SEPTEMBRE</option>
                            <option value="10">OCTOBRE</option>
                            <option value="11">NOVEMBRE</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-append">
                        <label style="color: black;">Année debut </label><br>
                        <input type="number" min="2000" step="1" value="{{Carbon\Carbon::now()->format('Y')}}" name="debut" id="debut" class="sr-input green_color" onchange="myChart()">
                    </div>
                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">Année fin </label><br>
                        <input type="number" min="2000" step="1" value="{{Carbon\Carbon::now()->format('Y')}}" name="fin" id="fin" class="sr-input green_color" onchange="myChart()">
                    </div>
                </div>
                <div class="full graph_head">
                    <br>
                    <div class="heading1 margin_0">
                        <h2><i class="fa fa-bar-chart-o"></i></h2>
                    </div>
                </div>
                <div class="full graph_revenue">
                    <div class="content">
                        <div class="area_chart" style="margin: 0 auto;">
                            <canvas height="120" id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myChart() {
        var debut = document.getElementById('debut').value
        var fin = document.getElementById('fin').value
        var mois1 = document.getElementById('mois1').value
        var mois2 = document.getElementById('mois2').value
        var ict_unit = [];
        var efficiency = [];
        var coloR = [];

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };
        $.ajax({
            type: "GET",
            url: "{{ route('Stock.chart') }}",
            data: {
                debut: debut,
                fin: fin,
                mois1: mois1,
                mois2: mois2
            },
            success: function(response) {

                var labels = response.labels.map(function(e) {
                    return e
                })
                console.log('labels', labels);

                var data = response.data.map(function(e) {
                    return e
                })
                console.log('data', data);

                for (var i in labels) {
                    ict_unit.push("ICT Unit " + labels[i].ict_unit);
                    efficiency.push(labels[i].efficiency);
                    coloR.push(dynamicColors());
                }
                var ctx = $('#myChart');
                var config = {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: 'rgb(157, 232, 188)',

                        }]
                    },
                    options: {
                        legend: {
                            display: false //This will do the task
                        }
                    }
                };
                var chart = new Chart(ctx, config);
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            }
        });
    }

    var recBarDebut = document.getElementById('debut')
    var recBarFin = document.getElementById('fin')
    recBarDebut.addEventListener("onchange", myChart)
    recBarFin.addEventListener("onchange", myChart)
    myChart()
    $(document).ready(function() {
        $('#debut').on('onchange', function() {
            $value = $(this).val();
            myChart(1);
        });
        $('#fin').on('onchange', function() {
            $value = $(this).val();
            myChart(1);
        });
    });
</script>
@endsection