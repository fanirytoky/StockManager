@extends('Template.template')
@section('vue')
<html>
<div class="col-md-12">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;"><i class="fa fa-file-text-o"></i> Ajout emplacements</h2>
            </div>
        </div>

    </div>
    <div class="row column4 graph">
        <div class="col-md-4">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Détails Fiche N° {{$details[0]->dt_Fiche_ref}}</h2>
                    </div>
                </div>
                <div class="full progress_bar_inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="msg_section">
                                <div class="msg_list_main">
                                    <ul class="msg_list">
                                        @foreach($details as $dt)
                                        <li>
                                            <span>
                                                <p class="name_user">Article réference</p>
                                                <p class="msg_user">{{$dt->AR_Ref}}</p>
                                                <p class="name_user">Désignation</p>
                                                <p class="msg_user">{{$dt->AR_Design}}</p>
                                                <p class="name_user">N° Lot</p>
                                                <p class="msg_user">{{$dt->num_Lot}}</p>
                                            </span>
                                        </li>
                                        <li>
                                            <span>
                                                <p class="name_user">Date de peremption</p>
                                                <p class="msg_user">{{$dt->date_peremp}}</p>
                                                <p class="name_user">Présentation</p>
                                                <p class="msg_user">{{$dt->P_Intitule}}</p>
                                                <p class="name_user">Quantite</p>
                                                <p class="msg_user">{{$dt->quantite}}</p>
                                                <p class="name_user">Type de stockage</p>
                                                <p class="msg_user">{{$dt->Type_Stockage}}</p>
                                            </span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Emplacement</h2>
                    </div>
                </div>
                @if(session('success'))
                <div class="full">
                    <div class="alert alert-success">
                        <p>{{session('success')}}</p>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                <div class="full">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif


                <form id="selectform" method="POST" action="{{ route('emplacement.Store') }}">
                    @csrf
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <b for="solidInput">N° Rack correspendant</b>
                                    @if($adresse != null)
                                    <input type="text" class="form-control input-solid" value="{{$adresse[0]->DP_Code}}" disabled>
                                    @else
                                    <input type="text" class="form-control input-solid" value="DEFAULT" disabled>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <br>
                                    <b for="solidInput">Position Rack</b>
                                    @if($adresse != null)
                                    <input type="text" class="form-control input-solid" value="{{$adresse[0]->DP_Code}}" disabled>
                                    @else
                                    <input type="text" class="form-control input-solid" value="DEFAULT" disabled>
                                    @endif
                                </div>
                                <div class="col-md-4"><br>
                                    <b for="solidInput">Depot</b>
                                    <select class="form-control input-pill" id="DE_No" name="DE_No">
                                        @if($adresse != null)
                                        <option value="{{$adresse[0]->DE_No}}" selected>{{$adresse[0]->DE_Intitule}}</option>
                                        @endif
                                        @foreach($depot as $depot)
                                        <option value="{{$depot->DE_No}}">{{$depot->DE_Intitule}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <br>
                                    <b for="solidInput">N° Rack</b>
                                    @if($DP_Code != null)
                                    <input type="text" class="form-control input-solid" value="{{$DP_Code}}" id="num_rack" name="num_rack" placeholder="N° rack" data-toggle="modal" data-target="#modalForm">
                                    @else
                                    @if($adresse != null)
                                    <input type="text" class="form-control input-solid" value="{{$adresse[0]->DP_Code}}" id="num_rack" name="num_rack" placeholder="N° rack" data-toggle="modal" data-target="#modalForm">
                                    @else
                                    <input type="text" class="form-control input-solid" value="DEFAULT" id="num_rack" name="num_rack" placeholder="N° rack" data-toggle="modal" data-target="#modalForm">
                                    @endif
                                    @endif
                                    <input type="hidden" value="{{$details[0]->dt_Fiche_ref}}" autocomplete="off" id="dt_Fiche_ref" name="dt_Fiche_ref" class="form-control" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <br>
                                    <b for="solidInput">Reste non mise en place</b>
                                    <input type="text" class="form-control input-solid" value="{{$reste}}" disabled>
                                </div>
                                <div class="col-md-8">
                                    <br>
                                    <b for="solidInput">Quantite</b>
                                    <input type="number" min="0" step="1" max="{{$reste}}" class="form-control input-solid" id="quantite" name="quantite" placeholder="Quantite">
                                </div>
                            </div>
                            <br>
                            <b for="solidInput">Observations</b>
                            <textarea type="text" rows="3" class="form-control input-solid" id="observation" name="observation" placeholder="Observations"></textarea>
                        </div>
                    </div>
                    <div class="flex items-center justify-end mt-4 col-md-12">
                        @if($reste <= 0) <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success" disabled>
                            Enregister
                            </button>
                            @else
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                Enregister
                            </button>

                            @endif
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

</html>

<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
    <div class="modal-dialog modal-lg fixed">
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
                                <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeAdresses()">
                                <input type="hidden" value="{{$details[0]->dt_Fiche_ref}}" autocomplete="off" id="dt_Fiche_ref" name="dt_Fiche_ref" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="ajaxlisteAdresse">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="{{url('js/jquery2.min.js')}}"></script>

<script src="{{url('js/bootstrap2.min.js')}}"></script>

<script>
    function reset() {
        document.getElementById('selectform').reset();
    }

    function listeAdresses(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxlisteAdresse").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        var dt_Fiche_ref = document.getElementById('dt_Fiche_ref').value
        if (page <= 1) var url = '/adresses?filtre=' + name + '&&dt_Fiche_ref=' + dt_Fiche_ref;
        else {
            var url = '/adresses?page=' + page + '&&filtre=' + name + '&&dt_Fiche_ref=' + dt_Fiche_ref;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBar')
    recBar.addEventListener("onchange", listeAdresses)
    listeAdresses()

    $(document).ready(function() {
        $(document).on('click', ".pagination a,.num_rack", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeAdresses(page);
        });


        $('#searchBar').on('input', function() {
            $value = $(this).val();
            listeAdresses(1);
        });
    });
</script>
@endsection