@extends('Template.template')
@section('vue')
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full">
            <div class="inbox-head">
                <div class="input-group">
                    <div class="input-append">
                        <label style="color: black;">Désignation </label><br>
                        <input type="text" name="filtre" id="filtre" class="sr-input green_color" placeholder="Recherche" oninput="myChart()">
                        <select class="sr-input green_color" id="filter" name="filter">
                        </select>
                    </div>

                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Regroupée par</label><br>
                        <select class="sr-input green_color" id="grp" name="grp" onchange="myChart()">
                            <option value="0">GLOBALE</option>
                            <option value="1">FICHE</option>
                            <option value="2">ARTICLE</option>
                        </select>
                    </div>

                    &nbsp;&nbsp;<div class="input-append">
                        <label style="color: black;">&nbsp;Par</label><br>
                        <select class="sr-input green_color" id="par" name="par" onchange="myChart()">
                            <option value="0">-</option>
                            <option value="1">LOT</option>
                            <option value="2">N° RACK</option>
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
        var filtre = document.getElementById('filtre').value
        var grp = document.getElementById('grp').value
        var par = document.getElementById('par').value
        var ict_unit = [];
        var efficiency = [];
        var coloR = [];
        var select;

        var dynamicColors = function() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgb(" + r + "," + g + "," + b + ")";
        };

        if (grp == 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('ChefRayon.chart.filtre') }}",
                data: {
                    filtre: filtre
                },
                success: function(response) {
                    var designation = response.designation.map(function(e) {
                        return e
                    })
                    var id_Fiche = response.id_Fiche.map(function(e) {
                        return e
                    })
                    console.log(designation);
                    select = document.getElementById("filter");
                    for (i = 0; i <= designation.length - 1; i++) {
                        var d = designation[i];
                        option = document.createElement('option');
                        option.value = id_Fiche[i];
                        option.text = designation[i];
                        select.remove(i);
                        select.add(option, null);
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                }
            });
        }
        $.ajax({
            type: "GET",
            url: "{{ route('ChefRayon.chart') }}",
            data: {
                debut: debut,
                fin: fin,
                type: 'bar',
                grp: grp,
                par: par,
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

                for (var i in labels) {
                    ict_unit.push("ICT Unit " + labels[i].ict_unit);
                    efficiency.push(labels[i].efficiency);
                    coloR.push(dynamicColors());
                }
                var ctx = $('#myChart');
                var config = {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: coloR,

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
    var recBarGrp = document.getElementById('grp')
    var recBarPar = document.getElementById('par')
    recBarDebut.addEventListener("onchange", myChart)
    recBarFin.addEventListener("onchange", myChart)
    recBarGrp.addEventListener("onchange", myChart)
    recBarPar.addEventListener("onchange", myChart)
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