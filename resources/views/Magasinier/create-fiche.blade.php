@extends('Template.template')
@section('vue')
<html>
<form id="selectform" method="POST" action="{{ route('fiche.Store') }}">
    @csrf
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;"><i class="fa fa-file-text-o"></i> NOUVELLE FICHE DE CONTROLE PHYSIQUE ET CONTROLE CONDITIONNEMENT</h2>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <div class="full graph_head">
        <div class="inbox">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
    @if(session('success'))
    <div class="full graph_head">
        <div class="inbox">
            <div class="alert alert-success">
                <p>{{session('success')}}</p>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <b><label style="color: black;" for="email">Designation</label></b>
                        @if($designation != null)
                        @foreach($designation as $d)
                        <input type="" value="{{$d->AR_Design}}" autocomplete="off" id="popup" name="design" class="form-control" data-toggle="modal" data-target="#modalForm" />
                        <input type="hidden" value="{{$d->AR_Ref}}" autocomplete="off" id="AR_Ref" name="AR_Ref" class="form-control" />
                        @endforeach
                        @endif
                        @if($designation == null)
                        <input type="" placeholder="Désignation" autocomplete="off" value="" id="popup" class="form-control" data-toggle="modal" data-target="#modalForm" />
                        @endif
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="email">Fournisseur</label></b>
                        @if($fournisseur != null)
                        @foreach($fournisseur as $frns)
                        <input type="" value="{{$frns->CT_Intitule}}" autocomplete="off" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                        <input type="hidden" value="{{$frns->CT_Num}}" autocomplete="off" id="CT_Num" name="CT_Num" class="form-control" />
                        @endforeach
                        @endif
                        @if($fournisseur == null)
                        <input type="" placeholder="Fournisseur" autocomplete="off" value="" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                        @endif
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="squareSelect">Forme proposition</label></b>
                        @if($proposition != null)
                        @foreach($proposition as $prop)
                        <input type="text" value="{{$prop->FO_designation}}" class="form-control input-pill green_color" disabled>
                        @endforeach
                        @endif
                        @if($proposition == null)
                        <input type="text" value="" class="form-control input-pill" disabled>
                        @endif
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="squareSelect">Forme</label></b>
                        <select class="form-control input-square" id="forme" name="forme">
                            @foreach($forme as $forme)
                            <option value="{{$forme->FO_ref}}">{{$forme->FO_designation}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="pillInput">Dosage</label></b>
                        <input type="text" class="form-control input-pill" name="dosage" id="dosage" placeholder="Dosage">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <b><label style="color: black;" for="pillSelect">Presentation</label></b>
                                <select class="form-control input-pill" id="presentation" name="presentation">
                                    @foreach($presentation as $p)
                                    <option value="{{$p->P_ref}}">{{$p->P_Intitule}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <b><label style="color: black;" for="pillSelect">Quantite unitaire</label></b>
                                <input type="number" min="0" class="form-control input-pill" name="P_quantite" id="P_quantite" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">N° Lot</label></b>
                        <input type="text" class="form-control input-solid" id="lot" name="lot" placeholder="N° Lot">
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">Date de fabrication</label></b>
                        <input type="date" class="form-control input-solid" id="date_fab" name="date_fab">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">Fabricant</label></b>
                        <input type="text" class="form-control input-solid" id="fabricant" name="fabricant" placeholder="Fabricant">
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">Date de Peremption</label></b>
                        <input type="date" class="form-control input-solid" id="date_peremp" name="date_peremp">
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">Quantite</label></b>
                        <input type="Number" min="0" class="form-control input-solid" id="quantite" name="quantite" value="0">
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="pillSelect">Type de stockage</label></b>
                        <select class="form-control input-pill" id="t_stockage" name="t_stockage">
                            @foreach($stockage as $stockage)
                            <option value="{{$stockage->T_Stockage_ref}}">{{$stockage->Type_Stockage}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <b><label style="color: black;" for="solidInput">Volume</label></b>
                                <input type="number" class="form-control input-solid" id="volume" name="volume" value="0">
                            </div>
                            <div class="col-md-3">
                                <b><label style="color: black;" for="solidInput">Unite</label></b>
                                <input type="text" class="form-control input-solid" value="m3" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-9">
                                <b><label style="color: black;" for="solidInput">Poids</label></b>
                                <input type="number" class="form-control input-solid" id="poids" name="poids" value="0">
                            </div>
                            <div class="col-md-3">
                                <b><label style="color: black;" for="solidInput">Unite</label></b>
                                <input type="text" class="form-control input-solid" value="Kg" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <b><label style="color: black;" for="solidInput">Observations</label></b>
                        <textarea type="text" rows="1" class="form-control input-solid" id="observation" name="observation"></textarea>
                    </div>
                    <div class="form-group">
                        <h5><i class="fa fa-envelope-square"> Notification</i></h5>
                        <div>
                            <input type="checkbox" id="email" name="email" value="email" checked>
                            <strong for="email">Envoyer un email</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex items-center justify-end mt-4 col-lg-12">
        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
            Valider
        </button>
        <button type="reset" onclick="reset()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-danger">
            Reinitialiser
        </button>
    </div>
</form>

</html>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog modal-lg fixed">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Fermer</span>
                </button>
                <!-- <h4 class="modal-title" id="myModalLabel">Contact Form</h4> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Liste des intrants de santé</h2>
                            </div>
                        </div>
                        <div class="inbox-head">
                            <div class="input-append">
                                <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeArticles()">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="ajaxliste">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# card -->
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                <!-- <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button> -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Fournisseur -->
<div class="modal fade" id="modalFormFrns" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Fermer</span>
                </button>
                <!-- <h4 class="modal-title" id="myModalLabel">Contact Form</h4> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Liste des fournisseurs</h2>
                            </div>
                        </div>
                        <div class="inbox-head">
                            <div class="input-append">
                                <input type="text" name="searchBarFrns" id="searchBarFrns" class="sr-input" placeholder="Recherche" oninput="listeFrns()">
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

<!-- jQuery library -->
<script src="{{url('js/jquery2.min.js')}}"></script>

<!-- Latest minified bootstrap js -->
<script src="{{url('js/bootstrap2.min.js')}}"></script>

<script>
    function reset() {
        document.getElementById('selectform').reset();
    }

    function listeArticles(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxliste").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        if (page <= 1) var url = '/articles?designation=' + name;
        else {
            var url = '/articles?page=' + page + '&&designation=' + name;
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
        if (page <= 1) var url = '/fournisseurs?fournisseur=' + name;
        else {
            var url = '/fournisseurs?page=' + page + '&&fournisseur=' + name;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBarFrns')
    recBar.addEventListener("onchange", listeFrns)
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
    });
</script>
@endsection