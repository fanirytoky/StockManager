@extends('Template.template')
@section('vue')
<div class="content">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
            <div class="heading1 margin_0">
                <h2>Fiche n° {{$details[0]->id_Fiche}}</h2>
            </div>
        </div>
        <div class="full inner_elements">
            <div class="row">
                <div class="col-md-5">
                    <div class="tab_style2">
                        <div class="tabbar padding_infor_info">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-dt" data-toggle="tab" href="#nav-home_dt" role="tab" aria-controls="nav-home_s2" aria-selected="true">Details Fiche</a>
                                    @foreach($details as $dt)
                                    <a class="nav-item nav-link" id="nav-home-{{$dt->num_Lot}}" data-toggle="tab" href="#nav-home_{{$dt->num_Lot}}" role="tab" aria-controls="nav-home_s2" aria-selected="true">LOT n° {{$dt->num_Lot}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent_2">
                                <div class="tab-pane fade show active" id="nav-home_dt" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <p><b>Date de contrôle:</b> {{$details[0]->date_controle}}</p>
                                    <p><b>Fournisseur Reference:</b> {{$details[0]->CT_Num}}</p>
                                    <p><b>Fournisseur:</b> {{$details[0]->CT_Intitule}}</p>
                                    <p><b>Designation:</b> {{$details[0]->AR_Design}}</p>
                                    <p><b>Forme:</b> {{$details[0]->FO_designation}}</p>
                                    <p><b>Presentation:</b> {{$details[0]->P_Intitule}}</p>
                                    <p><b>Dosage:</b> {{$details[0]->dosage}}</p>
                                    <p><b>Fabricant:</b> {{$details[0]->fabricant}}</p>
                                    <p><b>Type de stockage:</b> {{$details[0]->Type_Stockage}}</p>
                                    <p><b>Quantite total:</b> {{$total[0]->total}}</p>
                                </div>
                                @foreach($details as $dt)
                                <div class="tab-pane fade" id="nav-home_{{$dt->num_Lot}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <p><b>Numero Lot:</b> {{$dt->num_Lot}}</p>
                                    <p><b>Quantite:</b> {{$dt->quantite}}</p>
                                    <p><b>date de fabrication:</b> {{$dt->date_fab}}</p>
                                    <p><b>date de peremption:</b> {{$dt->date_peremp}}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="tab_style2">
                        <div class="tabbar padding_infor_info" >
                            <div class="card-header" id="entete">
                                <div class="card-title"><h5 style="color: white;">Ajout informations du marché</h5></div>
                            </div>
                            <div class="card-body" style="background-color: #f8f8f8;">
                                <form method="POST" action="{{ route('reference.Store') }}">
                                    @csrf
                                    @if($erreur != null)
                                    <div class="alert alert-danger" role="alert">{{$erreur}}</div>
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
                                    <div class="form-group">
                                        <label for="email">Fournisseur</label>
                                        @if($frns != null)
                                        @foreach($frns as $frns)
                                        <input type="" value="{{$frns->CT_Intitule}}" autocomplete="off" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                                        <input type="hidden" value="{{$frns->CT_Num}}" autocomplete="off" id="CT_Num" name="CT_Num" class="form-control" />
                                        <input type="hidden" value="{{$details[0]->id_Fiche}}" autocomplete="off" id="id_Fiche" name="id_Fiche" class="form-control" />
                                        @endforeach
                                        @endif
                                        @if($frns == null)
                                        <input type="" placeholder="{{$details[0]->CT_Intitule}}" autocomplete="off" value="" id="popupFrns" class="form-control" data-toggle="modal" data-target="#modalFormFrns" />
                                        <input type="hidden" value="{{$details[0]->CT_Num}}" autocomplete="off" id="CT_Num" name="CT_Num" class="form-control" />
                                        <input type="hidden" value="{{$details[0]->id_Fiche}}" autocomplete="off" id="id_Fiche" name="id_Fiche" class="form-control" />
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="solidInput">Reference du marché</label>
                                        <input type="text" class="form-control input-solid" id="ref" name="ref" placeholder="reference">
                                    </div>
                                    <div class="form-group">
                                        <label for="solidInput">Date de livraison</label>
                                        <input type="date" class="form-control input-solid" id="dt_livraison" name="dt_livraison" value="{{$details[0]->date_controle}}">
                                    </div>
                                    <fieldset>
                                        <label><i class="fa fa-envelope-square">  Notification</i></label>
                                        <div>
                                            <input type="checkbox" id="email" name="email" value="email" checked>
                                            <label for="email">Envoyer un email</label>
                                        </div>
                                    </fieldset>
                                    <div class="flex items-center justify-end mt-4 col-lg-12">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                            Valider
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal fournisseur -->
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
                            <div class="input-append">
                                <input type="text" name="searchBarFrns" id="searchBarFrns" class="sr-input" placeholder="Recherche" oninput="listeFrns()">
                                <input type="hidden" value="{{$details[0]->id_Fiche}}" autocomplete="off" id="id_Fiche" name="id_Fiche" class="form-control" />
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
        var id_Fiche = document.getElementById('id_Fiche').value
        if (page <= 1) var url = '/fournisseurs-references?fournisseur=' + name + '&&id_Fiche=' + id_Fiche;
        else {
            var url = '/fournisseurs-references?fournisseur=' + name + '&&page=' + page + '&&id_Fiche=' + id_Fiche;
        }
        console.log(url);
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