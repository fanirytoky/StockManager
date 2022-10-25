@extends('Template.template')
@section('vue')
<div class="col-md-12">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
            <div class="heading1 margin_0">
                <h2><i class="fa fa-file-text-o"></i> Details du Fiche N° {{$details[0]->id_Fiche}}</h2>
            </div>
        </div>
        <div class="full">
            <div class="invoice_inner">
                <div class="row">
                    <div class="col-md-4">
                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                            <h4>Details information</h4>
                            <p>
                                <strong>N° Lot : </strong><a>{{$details[0]->num_Lot}}</a><br>
                                <strong>Désignation : </strong><a>{{$details[0]->AR_Design}}</a><br>
                                <strong>Dosage : </strong><a>{{$details[0]->dosage}} MG/ML</a><br>
                                <strong>Forme : </strong><a>{{$details[0]->FO_designation}}</a><br>
                                <strong>Présentation : </strong><a>{{$details[0]->P_Intitule}}</a><br>
                                <strong>Quantite : </strong><a>{{$details[0]->quantite}}</a><br>
                                <strong>Type de Stockage : </strong><a>{{$details[0]->Type_Stockage}}</a><br>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                            <h4>Details date</h4>
                            <p>
                                <strong>Date de controle : </strong><a>{{$details[0]->date_controle}}</a><br>
                                <strong>Date de fabrication : </strong><a>{{$details[0]->date_fab}}</a><br>
                                <strong>Date de peremption : </strong><a>{{$details[0]->date_peremp}}</a><br>
                                <strong>Expire dans : </strong><a>{{$details[0]->ANS}} <b>ans et</b> {{$details[0]->MOIS}} <b>mois</b></a><br>
                            </p>
                            <div class="col-md-12">
                                @if($details[0]->ANS <= 1 && $details[0]->MOIS <= 3 ) <span class="skill" style="width:85%;">Pourcentage vie restante <span class="info_valume">25%</span></span>
                                        <div class="progress skill-bar ">
                                            <div class="progress-bar progress-bar-animated progress-bar-striped bg-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                            </div>
                                        </div>
                                        @endif
                                        @if($details[0]->ANS >= 1 && $details[0]->ANS < 2 && $details[0]->MOIS >=6 || $details[0]->ANS >= 2 && $details[0]->ANS < 3 && $details[0]->MOIS >=0)
                                                <span class="skill" style="width:85%;">Pourcentage vie restante : <span class="info_valume"> 50%</span></span>
                                                <div class="progress skill-bar ">
                                                    <div class="progress-bar prog ress-bar-animated progress-bar-striped bg-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                                    </div>
                                                </div>
                                                @endif
                                                @if($details[0]->ANS >= 3 && $details[0]->ANS < 4) <span class="skill" style="width:85%;">Pourcentage vie restante <span class="info_valume">75%</span></span>
                                                    <div class="progress skill-bar ">
                                                        <div class="progress-bar progress-bar-animated progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if($details[0]->ANS >= 4)
                                                    <span class="skill" style="width:85%;">Pourcentage vie restante <span class="info_valume">100%</span></span>
                                                    <div class="progress skill-bar ">
                                                        <div class="progress-bar progress-bar-animated progress-bar-striped bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                                        </div>
                                                    </div>
                                                    @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                            <h4>Details Scores</h4>
                            <p id="detailsScoreAjax">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($details[0]->etat != -3)
    <div class="full invoice_blog padding_infor_info padding-bottom_30">
        <div class="col-lg-12">
            <div class="white_shd full margin_bottom_30">
                <div class="full graph_head">
                    <div class="heading1 margin_0">
                        <h2>Controles physique et conditionnement avec RATING</h2>
                    </div>
                </div>
                <div class="full inner_elements">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="tab_style3">
                                <div class="tabbar padding_infor_info">
                                    <nav>
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                            <a class="nav-item nav-link active" id="Libelle" data-toggle="pill" href="#first" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape 1 :</b> Conditionnements Primaire-Secondaire</a>
                                            @foreach($conditionnements as $cd)
                                            @if($cd->id_libelle != 1)
                                            <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#Libelle-{{$cd->id_libelle}}" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape {{$cd->id_libelle}} :</b> {{$cd->Libelle}}</a>
                                            @endif
                                            @endforeach
                                            @if($details[0]->etat != -3)
                                            <a class="nav-item nav-link" onclick="reloadScore()" id="Libelle" data-toggle="pill" href="#decision" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape 6 :</b> Décision</a>
                                            @endif
                                        </div>
                                    </nav>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first">
                                            <div class="form-group">
                                                <!-- <form method="POST" action="{{ route('score.Store') }}">
                                                    @csrf -->
                                                <div class="form-group">
                                                    <div class="row">
                                                        @foreach($conditionnements as $cd)
                                                        @if($cd->id_libelle == 1)
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <label for="solidInput">{{$cd->normes}}</label>
                                                                    <input type="number" min="0" step="0.5" max="{{$cd->Notation}}" class="form-control input-solid" id="score{{$cd->cond_controle_ref}}" name="score{{$cd->cond_controle_ref}}" placeholder="Score">
                                                                    <input type="hidden" class="form-control input-solid" id="condition_ref{{$cd->cond_controle_ref}}" name="condition_ref{{$cd->cond_controle_ref}}" value="{{$cd->cond_controle_ref}}">
                                                                    <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <label for="solidInput">Notations</label>
                                                                    <input type="text" class="form-control input-solid" value="{{$cd->Notation}}" disabled>
                                                                </div>
                                                            </div>
                                                            <label for="solidInput">Observations</label>
                                                            <textarea type="text" class="form-control input-solid" id="observation{{$cd->cond_controle_ref}}" name="observation{{$cd->cond_controle_ref}}" placeholder="Observations"></textarea>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                                    <div class="flex items-center justify-end mt-4 col-lg-12">
                                                        <div class="nav nav-tabs" id="nav-tab" role="tablist" aria-orientation="horizontal">
                                                            <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#success-1" role="tab" aria-controls="v-pills-home" aria-selected="false"><button onclick="storeScore()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                                    Valider
                                                                </button></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- </form> -->
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="success-1" role="tabpanel" aria-labelledby="success-1">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>Etape 1 effectué</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Libelle-2" role="tabpanel" aria-labelledby="Libelle-2">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <label for="solidInput">{{$conditionnements[2]->normes}}</label>
                                                            <input type="number" min="0" step="0.5" max="{{$conditionnements[2]->Notation}}" class="form-control input-solid" id="scoree" name="scoree" placeholder="Score">
                                                            <input type="hidden" class="form-control input-solid" id="condition_refe" name="condition_refe" value="{{$conditionnements[2]->cond_controle_ref}}">
                                                            <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="solidInput">Notations</label>
                                                            <input type="text" class="form-control input-solid" value="{{$conditionnements[2]->Notation}}" disabled>
                                                        </div>
                                                    </div>
                                                    <label for="solidInput">Observations</label>
                                                    <textarea type="text" class="form-control input-solid" id="observations" name="observations" placeholder="Observations"></textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end mt-4 col-lg-12">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist" aria-orientation="horizontal">
                                                    <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#success-2" role="tab" aria-controls="v-pills-home" aria-selected="false"><button onclick="storeScores2()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                            Valider
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="success-2" role="tabpanel" aria-labelledby="success-2">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>Etape 2 effectué</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Libelle-3" role="tabpanel" aria-labelledby="Libelle-3">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <label for="solidInput">{{$conditionnements[3]->normes}}</label>
                                                            <input type="number" min="0" step="0.5" max="{{$conditionnements[3]->Notation}}" class="form-control input-solid" id="score3" name="score3" placeholder="Score">
                                                            <input type="hidden" class="form-control input-solid" id="condition_ref3" name="condition_ref3" value="{{$conditionnements[3]->cond_controle_ref}}">
                                                            <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="solidInput">Notations</label>
                                                            <input type="text" class="form-control input-solid" value="{{$conditionnements[3]->Notation}}" disabled>
                                                        </div>
                                                    </div>
                                                    <label for="solidInput">Observations</label>
                                                    <textarea type="text" class="form-control input-solid" id="observation3" name="observation3" placeholder="Observations"></textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end mt-4 col-lg-12">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist" aria-orientation="horizontal">
                                                    <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#success-3" role="tab" aria-controls="v-pills-home" aria-selected="false"><button onclick="storeScores3()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                            Valider
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="success-3" role="tabpanel" aria-labelledby="success-3">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>Etape 3 effectué</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Libelle-4" role="tabpanel" aria-labelledby="Libelle-4">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <label for="solidInput">{{$conditionnements[4]->normes}}</label>
                                                            <input type="number" min="0" step="0.5" max="{{$conditionnements[4]->Notation}}" class="form-control input-solid" id="score4" name="score4" placeholder="Score">
                                                            <input type="hidden" class="form-control input-solid" id="condition_ref4" name="condition_ref4" value="{{$conditionnements[4]->cond_controle_ref}}">
                                                            <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="solidInput">Notations</label>
                                                            <input type="text" class="form-control input-solid" value="{{$conditionnements[4]->Notation}}" disabled>
                                                        </div>
                                                    </div>
                                                    <label for="solidInput">Observations</label>
                                                    <textarea type="text" class="form-control input-solid" id="observation4" name="observation4" placeholder="Observations"></textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end mt-4 col-lg-12">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist" aria-orientation="horizontal">
                                                    <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#success-4" role="tab" aria-controls="v-pills-home" aria-selected="false"><button onclick="storeScores4()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                            Valider
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="success-4" role="tabpanel" aria-labelledby="success-4">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>Etape 4 effectué</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Libelle-5" role="tabpanel" aria-labelledby="Libelle-5">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <label for="solidInput">{{$conditionnements[5]->normes}}</label>
                                                            <input type="number" min="0" step="0.5" max="{{$conditionnements[5]->Notation}}" class="form-control input-solid" id="score5" name="score5" placeholder="Score">
                                                            <input type="hidden" class="form-control input-solid" id="condition_ref5" name="condition_ref5" value="{{$conditionnements[5]->cond_controle_ref}}">
                                                            <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <label for="solidInput">Notations</label>
                                                            <input type="text" class="form-control input-solid" value="{{$conditionnements[5]->Notation}}" disabled>
                                                        </div>
                                                    </div>
                                                    <label for="solidInput">Observations</label>
                                                    <textarea type="text" class="form-control input-solid" id="observation5" name="observation5" placeholder="Observations"></textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end mt-4 col-lg-12">
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist" aria-orientation="horizontal">
                                                    <a class="nav-item nav-link" id="Libelle" data-toggle="pill" href="#success-5" role="tab" aria-controls="v-pills-home" aria-selected="false"><button onclick="storeScores5()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                            Valider
                                                        </button></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="success-5" role="tabpanel" aria-labelledby="success-5">
                                            <div class="form-group">
                                                <div class="col-lg-12">
                                                    <div class="alert alert-success">
                                                        <ul>
                                                            <li>Etape 5 effectué</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="decision" role="tabpanel" aria-labelledby="decision">
                                            <div id="AjaxDecision"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
</div>
<div class="modal fade" id="accepteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: green;">Confirmation de la validation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Pharma/fiche.decision') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{ $details[0]->dt_Fiche_ref }}" class="form-control" id="dt_Fiche_ref" name="dt_Fiche_ref">
                        <input type="hidden" value="0" class="form-control" id="etat" name="etat">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observations</label>
                        <textarea class="form-control" id="observation" name="observation"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="quarantaineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: #ffc107;">Confirmation de la mise en quarantaine</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Pharma/fiche.decision') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{ $details[0]->dt_Fiche_ref }}" class="form-control" id="dt_Fiche_ref" name="dt_Fiche_ref">
                        <input type="hidden" value="1" class="form-control" id="etat" name="etat">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observations</label>
                        <textarea class="form-control" id="observation" name="observation"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-warning">Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="rebutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: red;">Confirmation de la mise au Rebut</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('Pharma/fiche.decision') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" value="{{ $details[0]->dt_Fiche_ref }}" class="form-control" id="dt_Fiche_ref" name="dt_Fiche_ref">
                        <input type="hidden" value="2" class="form-control" id="etat" name="etat">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Observations</label>
                        <textarea class="form-control" id="observation" name="observation"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Valider</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="{{url('js/jquery2.min.js')}}"></script>

<!-- Latest minified bootstrap js -->
<script src="{{url('js/bootstrap2.min.js')}}"></script>
<script>
    function detailsScore(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("detailsScoreAjax").innerHTML = xhr.responseText
                reloadScore()
                // console.log(xhr.responseText)
            }
        }
        var dtFiche = document.getElementById('dt_fiche_ref').value
        var url = '/Pharmacien/AjaxDetailsScore?dt_fiche_ref=' + dtFiche;
        xhr.open('GET', url, true)
        xhr.send();
    }
    detailsScore()

    function storeScore() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                detailsScore()
                reloadScore()
            }
        }
        var score1 = document.getElementById('score1').value;
        var score2 = document.getElementById('score2').value;
        var observation1 = document.getElementById('observation1').value;
        var observation2 = document.getElementById('observation2').value;
        var cond_ref1 = document.getElementById('condition_ref1').value;
        var cond_ref2 = document.getElementById('condition_ref2').value;
        var dt_fiche_ref = document.getElementById('dt_fiche_ref').value;
        var url = '/fiche-ajout-score?score1=' + score1 + '&&score2=' + score2 + '&&observation1=' + observation1 + '&&observation2=' + observation2 + '&&cond_ref1=' + cond_ref1 + '&&cond_ref2=' + cond_ref2 + '&&dt_fiche_ref=' + dt_fiche_ref;
        xhr.open('GET', url, true)
        xhr.send();
    }

    function storeScores2() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                detailsScore()
                reloadScore()
            }
        }
        var score = document.getElementById('scoree').value;
        var observation = document.getElementById('observations').value;
        var cond_ref = document.getElementById('condition_refe').value;
        var dt_fiche_ref = document.getElementById('dt_fiche_ref').value;
        var url = '/fiche-ajout-scores?score=' + score + '&&observation=' + observation + '&&condition_ref=' + cond_ref + '&&dt_fiche_ref=' + dt_fiche_ref;
        xhr.open('GET', url, true)
        xhr.send();
    }

    function storeScores3() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                detailsScore()
                reloadScore()
            }
        }
        var score = document.getElementById('score3').value;
        var observation = document.getElementById('observation3').value;
        var cond_ref = document.getElementById('condition_ref3').value;
        var dt_fiche_ref = document.getElementById('dt_fiche_ref').value;
        var url = '/fiche-ajout-scores?score=' + score + '&&observation=' + observation + '&&condition_ref=' + cond_ref + '&&dt_fiche_ref=' + dt_fiche_ref;
        xhr.open('GET', url, true)
        xhr.send();
    }

    function storeScores4() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                detailsScore()
                reloadScore()
            }
        }
        var score = document.getElementById('score4').value;
        var observation = document.getElementById('observation4').value;
        var cond_ref = document.getElementById('condition_ref4').value;
        var dt_fiche_ref = document.getElementById('dt_fiche_ref').value;
        var url = '/fiche-ajout-scores?score=' + score + '&&observation=' + observation + '&&condition_ref=' + cond_ref + '&&dt_fiche_ref=' + dt_fiche_ref;
        xhr.open('GET', url, true)
        xhr.send();
    }

    function storeScores5() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                detailsScore()
                reloadScore()
            }
        }
        var score = document.getElementById('score5').value;
        var observation = document.getElementById('observation5').value;
        var cond_ref = document.getElementById('condition_ref5').value;
        var dt_fiche_ref = document.getElementById('dt_fiche_ref').value;
        var url = '/fiche-ajout-scores?score=' + score + '&&observation=' + observation + '&&condition_ref=' + cond_ref + '&&dt_fiche_ref=' + dt_fiche_ref;
        xhr.open('GET', url, true)
        xhr.send();
    }

    function reloadScore() {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                // $("AjaxDecision").html(xhr.responseText);
                // console.log(xhr.responseText);
                document.getElementById("AjaxDecision").innerHTML = xhr.responseText
            }
        }
        var dtFiche = document.getElementById('dt_fiche_ref').value
        var url = '/Pharmacien/AjaxDetailsScore/Decision?dt_fiche_ref=' + dtFiche;
        xhr.open('GET', url, true)
        xhr.send();
    }
</script>
@endsection