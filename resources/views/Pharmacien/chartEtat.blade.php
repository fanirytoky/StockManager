@extends('Template.template')
@section('vue')

<head>
    <style>
        th,
        td {
            padding: 10px 20px;
            border: 1px solid #000;
        }

        #myChart {
            display: inline-block;
            position: relative;
            /* width: 100%; */
            height: 100%;
        }
    </style>
</head>
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
                        <label style="color: black;">&nbsp;Trier par</label><br>
                        <select class="sr-input green_color" id="typeObject" name="typeObject" onchange="myChart()">
                            <option value="2">DUREE DE VIE</option>
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
                        <h2><i class="fa fa-bar-chart-o"></i> Comparaison produits par durée de vie</h2>
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
        <div class="table_section padding_infor_info">
            <div style="color:black" id="detailsStat"></div>
        </div>
    </div>
</div>

<script>
    function myChart(page) {
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
                // console.log('labels', labels);

                var data = response.data.map(function(e) {
                    return e
                })
                // console.log('data', data);

                // console.log( JSON.parse(response.type));
                var chartType = JSON.parse(response.type)
                var typeObj = JSON.parse(response.typeObj)
                var typeChart = 0

                for (var i in labels) {
                    ict_unit.push("ICT Unit " + labels[i].ict_unit);
                    efficiency.push(labels[i].efficiency);
                    coloR.push(dynamicColors());
                }
                if (chartType == null || chartType == 0) {
                    if (typeObj != 2) {
                        chartType = "horizontalBar";
                    } else {
                        chartType = "bar";
                    }
                } else {
                    if (chartType == 1 && typeObj == 2) {
                        chartType = "line";
                        coloR = "rgb(120, 243, 204)";
                    }
                    if (chartType == 2) {
                        typeChart = 1;
                        chartType = "doughnut";
                    }
                }
                // console.log(chartType);
                // var ctx = $('#myChart');
                var ctx = document.getElementById("myChart");
                var ctxP = ctx.getContext('2d');
                if (typeChart != 1) {
                    var config = {
                        type: chartType,
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Total scores',
                                data: data,
                                backgroundColor: coloR,

                            }]
                        },
                        options: {
                            plugins: {
                                subtitle: {
                                    display: true,
                                    text: 'Title goes here ...',
                                    color: '#ff0000',
                                    font: {
                                        size: 20
                                    }
                                }
                            },
                            legend: {
                                display: false
                            },
                            y: {
                                beginAtZero: true
                            },
                            scales: {
                                xAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }],
                                yAxes: [{
                                    stacked: true
                                }]
                            }
                        }
                    };
                } else {
                    var config = {
                        type: chartType,
                        data: {
                            labels: labels,
                            datasets: [{
                                data: data,
                                backgroundColor: coloR,

                            }]
                        },
                        options: {
                            plugins: {
                                subtitle: {
                                    display: true,
                                    text: 'Title goes here ...',
                                    color: '#ff0000',
                                    font: {
                                        size: 20
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true
                            },
                            responsive: true
                        }
                    };
                }
                var chart = new Chart(ctxP, config);


                ctx.onclick = function(e) {

                    var slice = chart.getElementAtEvent(e);
                    if (!slice.length) return;
                    var label = slice[0]._model.label;
                    switch (label) {
                        case "Moins de 6 Mois":

                            createList(page, 6);
                            $(document).ready(function() {
                                $(document).on('click', ".pagination a", function(event) {
                                    event.preventDefault();
                                    var page = $(this).attr('href').split('page=')[1];
                                    var data = 6;
                                    createList(page, data);
                                });
                            });

                            break;
                        case "12 Mois":

                            createList(page, 12);
                            $(document).ready(function() {
                                $(document).on('click', ".pagination a", function(event) {
                                    event.preventDefault();
                                    var page = $(this).attr('href').split('page=')[1];
                                    var data = 12;
                                    createList(page, data);
                                });
                            });

                            break;
                        case "24 Mois":

                            createList(page, 24);
                            $(document).ready(function() {
                                $(document).on('click', ".pagination a", function(event) {
                                    event.preventDefault();
                                    var page = $(this).attr('href').split('page=')[1];
                                    var data = 24;
                                    createList(page, data);
                                });
                            });

                            break;
                        case "Plus de 24 Mois":

                            createList(page, 48);
                            $(document).ready(function() {
                                $(document).on('click', ".pagination a", function(event) {
                                    event.preventDefault();
                                    var page = $(this).attr('href').split('page=')[1];
                                    var data = 48;
                                    createList(page, data);
                                });
                            });

                            break;
                    }
                }
            },
            error: function(xhr) {
                console.log(xhr.responseJSON);
            }
        });
    }

    function createList(page, data) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("detailsStat").innerHTML = xhr.responseText
                // console.log(xhr.responseText)
            }
        }
        if (page <= 1) var url = '/Article-expiration/Chart?data=' + data;
        else {
            var url = '/Article-expiration/Chart?data=' + data + '&&page=' + page;
        }
        xhr.open('GET', url, true)
        xhr.send();
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
    myChart()
</script>
@endsection