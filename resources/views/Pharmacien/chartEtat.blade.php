@extends('Template.template')
@section('vue')
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full">
            <div class="inbox-head">
                <div class="input-group">
                    <div class="input-append">
                        <label style="color: black;">Recherche </label><br>
                        <input type="text" name="filtre" id="filtre" class="sr-input green_color" placeholder="Recherche" oninput="myChart()">
                    </div>
                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Frns/Article</label><br>
                        <select class="sr-input green_color" id="typeObject" name="typeObject" onchange="myChart()">
                            <option value="0">ARTICLE</option>
                            <option value="1">FOURNISSEUR</option>
                        </select>
                    </div>
                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Unite</label><br>
                        <select class="sr-input green_color" id="unite" name="unite" onchange="myChart()">
                            <option value="0">QUANTITE</option>
                            <option value="1">POURCENTAGE</option>
                        </select>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-append">
                        <label style="color: black;">Date debut </label><br>
                        <input type="date" name="debut" id="debut" class="sr-input green_color" onchange="myChart()">
                    </div>
                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">Date fin </label><br>
                        <input type="date" name="fin" id="fin" class="sr-input green_color" onchange="myChart()">
                    </div>
                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Representation graphique</label><br>
                        <select class="sr-input green_color" id="type" name="type" onchange="myChart()">
                            <option value="0">Bar</option>
                            <option value="1">Line</option>
                            <option value="2">Doughnut</option>
                        </select>
                    </div>
                </div>
                <div class="full graph_head">
                    <br>
                    <div class="heading1 margin_0">
                        <h2><i class="fa fa-bar-chart-o"></i> Score qualité des produits par fournisseurs</h2>
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
        var typeChart = document.getElementById('type').value
        var filtre = document.getElementById('filtre').value
        var typeObject = document.getElementById('typeObject').value
        var unite = document.getElementById('unite').value
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
            url: "{{ route('Pharmacien.chart') }}",
            data: {
                debut: debut,
                fin: fin,
                type: typeChart,
                typeObject: typeObject,
                unite: unite,
                filtre: filtre
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

                // console.log('typeeeeeeee', JSON.parse(response.type));
                var chartType = JSON.parse(response.type)

                if (chartType == null || chartType == 0) {
                    chartType = "bar";
                } else {
                    if (chartType == 1) {
                        chartType = "line";
                    }
                    if (chartType == 2) {
                        chartType = "doughnut";
                    }
                }
                for (var i in labels) {
                    ict_unit.push("ICT Unit " + labels[i].ict_unit);
                    efficiency.push(labels[i].efficiency);
                    coloR.push(dynamicColors());
                }
                console.log(chartType);
                var ctx = $('#myChart');
                var config = {
                    type: chartType,
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Scores qualité par fournisseurs',
                            data: data,
                            backgroundColor: coloR,

                        }]
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
    var recBarType = document.getElementById('type')
    recBarDebut.addEventListener("onchange", myChart)
    recBarFin.addEventListener("onchange", myChart)
    recBarType.addEventListener("onchange", myChart)
    myChart()
    $(document).ready(function() {
        $('#filtre').on('oninput', function() {
            $value = $(this).val();
            myChart(1);
        });
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