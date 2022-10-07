@extends('Template.template')
@section('vue')
<div class="col-md-12">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
            <div class="heading1 margin_0">
                <h2><i class="fa fa-file-text-o"></i> Fiche de Stock N° {{$details[0]->id_fiche_stock}}</h2>
            </div>
        </div>
        <div class="full">
            <div class="invoice_inner">
                <div class="row">
                    <div class="col-md-4">
                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                            <h4>Détails</h4>
                            <p>
                                <strong>CODE : </strong><a>{{$details[0]->AR_Ref}}</a><br>
                                <strong>DESIGNATION : </strong><a>{{$details[0]->AR_Design}}</a><br>
                                <strong>N° LOT : </strong><a>{{$details[0]->num_Lot}}</a><br>
                                <strong>PRESENTATION : </strong><a>{{$details[0]->P_Intitule}}</a><br>
                                <strong>DATE DE PEREMPTION : </strong><a>{{$details[0]->date_peremp}}</a><br>
                                <strong>DEPOT : </strong><a>{{$details[0]->DE_Intitule}}</a><br>
                                <strong>QUANTITE : </strong><a>{{$details[0]->quantite}}</a><br>
                            </p>
                            <br>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab_style2">
                            <div class="tabbar padding_infor_info">
                                <div class="card-header" id="entete">
                                    <div class="card-title">
                                        <h5 style="color: white;">Mouvement stock</h5>
                                    </div>
                                </div>
                                <div class="card-body" style="background-color: #f8f8f8;">
                                    <form method="POST" action="{{ route('mvtFicheStock.Store') }}">
                                        @csrf
                                        @if(session('success'))
                                        <div class="full">
                                            <div class="alert alert-success">
                                                <p>{{session('success')}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">N° RACK</label>
                                            </div>
                                            <div class="col-md-10">
                                                @if($num_rack != null)
                                                <input type="" value="{{$num_rack}}" autocomplete="off" id="popup" name="num_rack" class="form-control" data-toggle="modal" data-target="#modalForm" />
                                                <input type="hidden" value="{{$id_empl}}" autocomplete="off" id="id_stock_empl" name="id_stock_empl" class="form-control" />
                                                @endif
                                                @if($num_rack == null)
                                                <input type="" placeholder="N° Rack" autocomplete="off" value="" id="popup" class="form-control" data-toggle="modal" data-target="#modalForm" />
                                                @endif
                                                <input type="hidden" value="{{$details[0]->id_fiche_stock}}" autocomplete="off" id="idFS" name="idFS" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">FRNS/CLIENT</label>
                                            </div>
                                            <div class="col-md-10">
                                                @if($CT_Num != null)
                                                @foreach($CT_Num as $CT)
                                                <input type="" value="{{$CT->CT_Intitule}}" autocomplete="off" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                                                <input type="hidden" value="{{$CT->CT_Num}}" autocomplete="off" id="CT_Num" name="CT_Num" class="form-control" />
                                                @endforeach
                                                @endif
                                                @if($CT_Num == null)
                                                <input type="" placeholder="Fournisseur" autocomplete="off" value="" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">N° DOC</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control input-solid" id="num_doc" name="num_doc" value="" placeholder="N° Document">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">QUANTITE</label>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="input-group" id="dropdown1">
                                                    <div class="input-group-btn">
                                                        <select class="form-control input-square" id="type_mvt" name="type_mvt">
                                                            <option value="0">ENTREE</option>
                                                            <option value="1">SORTIE</option>
                                                            <option value="2">INVENTAIRE</option>
                                                        </select>
                                                    </div>
                                                    <input type="number" class="form-control" id="quantite" name="quantite" placeholder="Quantite">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">DATE</label>
                                            </div>
                                            <div class="col-md-10">
                                                <input type="date" class="form-control input-solid" id="date" name="date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-2">
                                                <label class="col-form-label">OBSERVATION</label>
                                            </div>
                                            <div class="col-md-10">
                                                <textarea type="text" class="form-control input-solid" id="observations" name="observations" placeholder="Oberservations"></textarea>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end mt-4 col-lg-12">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                Enregistrer
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="inbox-head">
                            <form method="POST" action="{{ route('fiche_stock.PDF') }}">
                                @csrf
                                <div class="input-group">
                                    <div class="input-append">
                                        <label style="color: black;">Report du </label><br>
                                        <input type="date" name="searchBarDateDebut" id="searchBarDateDebut" class="sr-input" onchange="report()">
                                        <input type="hidden" value="{{$details[0]->id_fiche_stock}}" id="idFicheStock" name="idFicheStock">
                                    </div>
                                    &nbsp;&nbsp;<div class="input-append">
                                        <label style="color: black;">Au </label><br>
                                        <input type="date" name="searchBarDateFin" id="searchBarDateFin" class="sr-input" onchange="report()">
                                    </div>
                                    &nbsp;&nbsp;<div class="input-append">
                                        <label style="color: black;">EXPORTER EN PDF</label><br>
                                        <div class="button_block"><button style="color: white;" type="submit" class="sr-input btn-info fa fa-file-pdf-o"> Exporter</button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2><i class="fa fa-sort-alpha-asc"></i>   Liste des mouvements de stock</h2>
                            </div>
                        </div>
                        <div class="col-lg-12" id="ajax-report">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog modal-xs fixed">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <!-- <h4 class="modal-title" id="myModalLabel">Contact Form</h4> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="inbox-head">
                            <div class="input-append">
                                <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeArticles()">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="ajaxlisteStockRack">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button> -->
            </div>
        </div>
    </div>
</div>

<!-- frns/client -->
<div class="modal fade" id="modalFormFrns" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
                <!-- <h4 class="modal-title" id="myModalLabel">Contact Form</h4> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="inbox-head">
                            <div class="input-group" id="dropdown1">
                                <div class="input-append">
                                    <input type="text" name="searchBarFrns" id="searchBarFrns" class="sr-input" placeholder="Recherche" oninput="listeFrns()">
                                </div>
                                <div class="input-append">
                                    <select class="sr-input green_color" id="CT_Type" name="CT_Type">
                                        <option value="1">FOURNISSEUR</option>
                                        <option value="0">CLIENT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="ajaxlisteFrns">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button> -->
            </div>
        </div>
    </div>
</div>
<!--  -->
<!-- jQuery library -->
<script src="{{url('js/jquery2.min.js')}}"></script>

<!-- Latest minified bootstrap js -->
<script src="{{url('js/bootstrap2.min.js')}}"></script>

<script>
    function reset() {
        document.getElementById('selectform').reset();
    }


    // report

    function report(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajax-report").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var debut = document.getElementById('searchBarDateDebut').value
        var fin = document.getElementById('searchBarDateFin').value
        var idFicheStock = document.getElementById('idFicheStock').value

        if (page <= 1) var url = '/stock-report?debut=' + debut + '&&fin=' + fin + '&&idFicheStock=' + idFicheStock;
        else {
            var url = '/stock-report?page=' + page + '&&debut=' + debut + '&&fin=' + fin + '&&idFicheStock=' + idFicheStock;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBarDebut = document.getElementById('searchBarDateDebut')
    var recBarFin = document.getElementById('searchBarDateFin')
    recBarDebut.addEventListener("onchange", report)
    recBarFin.addEventListener("onchange", report)
    report()

    $(document).ready(function() {
        $(document).on('click', ".pagination a,.searchBarDateDebut,.searchBarDateFin", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            report(page);
        });


        $('#searchBarDateDebut').on('onchange', function() {
            $value = $(this).val();
            report(1);
        });
        $('#searchBarDateFin').on('onchange', function() {
            $value = $(this).val();
            report(1);
        });
    });


    // --------------------------------------------------------------------------------------------------

    function listeArticles(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxlisteStockRack").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        var idFS = document.getElementById('idFS').value
        if (page <= 1) var url = '/stock-emplacement?designation=' + name + '&&idFiche_Stock=' + idFS;
        else {
            var url = '/stock-emplacement?page=' + page + '&&designation=' + name + '&&idFiche_Stock=' + idFS;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBar')
    recBar.addEventListener("onchange", listeArticles)
    listeArticles()

    $(document).ready(function() {
        $(document).on('click', ".pagination a,.popup", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeArticles(page);
        });


        $('#searchBar').on('input', function() {
            $value = $(this).val();
            listeArticles(1);
        });
    });

    // --------------------------------------------FOURNISSEUR--------------------------------------------------------

    function listeFrns(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxlisteFrns").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBarFrns').value
        var CT_Type = document.getElementById('CT_Type').value
        var idFS = document.getElementById('idFS').value

        if (page <= 1) var url = '/frns/client?CT_Intitule=' + name + '&&CT_Type=' + CT_Type + '&&idFiche_Stock=' + idFS;
        else {
            var url = '/frns/client?page=' + page + '&&CT_Intitule=' + name + '&&CT_Type=' + CT_Type + '&&idFiche_Stock=' + idFS;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBarFrns')
    var type = document.getElementById('CT_Type')
    recBar.addEventListener("onchange", listeFrns)
    type.addEventListener("onchange", listeFrns)
    listeFrns()

    $(document).ready(function() {
        $(document).on('click', ".pagination a,.popupFrns", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeFrns(page);
        });


        $('#searchBarFrns').on('input', function() {
            $value = $(this).val();
            listeFrns(1);
        });
        $('#CT_Type').on('change', function() {
            $value = $(this).val();
            listeFrns(1);
        });
    });
</script>
@endsection