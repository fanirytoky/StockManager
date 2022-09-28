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
                            <p>
                                @foreach($details_score as $dt_score)
                                @if($dt_score->id_libelle != 4)
                                <strong>{{$dt_score->normes}} : </strong><a>{{$dt_score->score}}<b>/{{$dt_score->Notation}}</b></a><br>
                                @endif

                                @if($dt_score->id_libelle == 4)
                                <strong>AMM Madagascar existante : </strong><a>{{$dt_score->score}}<b>/{{$dt_score->Notation}}</b></a><br>
                                @endif
                                @if($dt_score->observation != null)
                                <strong>Observations : </strong><a>{{$dt_score->observation}}</a><br>
                                @endif
                                @endforeach
                                @foreach($total_score as $total)
                                <strong>Total score : </strong><a>{{$total->total}}</a><br>
                            <p class="ratings">
                                @for($i=0;$i<($total->total);$i++)
                                    <span class="fa fa-star"></span>
                                    @endfor
                                    @for($i=0;$i<(5-$total->total);$i++)
                                        <span class="fa fa-star-o"></span>
                                        @endfor
                            </p>
                            @endforeach

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
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="Libelle" data-toggle="pill" href="#first" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape 1 :</b> Conditionnements Primaire-Secondaire</a>
                                        @foreach($conditionnements as $cd)
                                        @if($cd->id_libelle != 1)
                                        <a class="nav-link" id="Libelle" data-toggle="pill" href="#Libelle-{{$cd->id_libelle}}" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape {{$cd->id_libelle}} :</b> {{$cd->Libelle}}</a>
                                        @endif
                                        @endforeach
                                        @if($details[0]->etat != -3)
                                        <a class="nav-link" id="Libelle" data-toggle="pill" href="#decision" role="tab" aria-controls="v-pills-home" aria-selected="true" style="font-size: 15px;"><b style="color:green;font-size:16px;">Etape 6 :</b> Décision</a>
                                        @endif
                                    </div>
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first">
                                            <div class="form-group">
                                                <form method="POST" action="{{ route('score.Store') }}">
                                                    @csrf
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
                                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                                Valider
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        @foreach($conditionnements as $cd)
                                        @if($cd->id_libelle != 1)
                                        <div class="tab-pane fade" id="Libelle-{{$cd->id_libelle}}" role="tabpanel" aria-labelledby="Libelle-{{$cd->id_libelle}}">
                                            <form method="POST" action="{{ route('score2.Store') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <label for="solidInput">{{$cd->normes}}</label>
                                                                <input type="number" min="0" step="0.5" max="{{$cd->Notation}}" class="form-control input-solid" id="score" name="score" placeholder="Score">
                                                                <input type="hidden" class="form-control input-solid" id="condition_ref" name="condition_ref" value="{{$cd->cond_controle_ref}}">
                                                                <input type="hidden" class="form-control input-solid" id="dt_fiche_ref" name="dt_fiche_ref" value="{{$details[0]->dt_Fiche_ref}}">
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label for="solidInput">Notations</label>
                                                                <input type="text" class="form-control input-solid" value="{{$cd->Notation}}" disabled>
                                                            </div>
                                                        </div>
                                                        <label for="solidInput">Observations</label>
                                                        <textarea type="text" class="form-control input-solid" id="observation" name="observation" placeholder="Observations"></textarea>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-end mt-4 col-lg-12">
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 btn btn-success">
                                                        Valider
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        @endif
                                        @endforeach

                                        <div class="tab-pane fade" id="decision" role="tabpanel" aria-labelledby="first">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @foreach($total_score as $total)
                                                    <h5>Total score : {{$total->total}}</h5><br>
                                                    @endforeach
                                                </div>

                                                <div class="col-lg-12">
                                                    @if($total_score != null)
                                                    @foreach($total_score as $total)
                                                    @if($total->total > 3)
                                                    <div class="alert alert-success" role="alert">{{$total->etat_score}}</div>
                                                    @endif
                                                    @if($total->total <= 3) <div class="alert alert-danger" role="alert">{{$total->etat_score}}
                                                </div>
                                                @endif
                                                @endforeach
                                                @endif
                                                @foreach($total_score as $total)
                                                @if($total->total == null)
                                                <div class="alert alert-danger" role="alert">Veuillez remplir les scores</div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        @foreach($total_score as $total)
                                        @if($total->total != null)
                                        <div class="row">
                                            @foreach($details as $dt)
                                            @if($dt->etat == 2)
                                            <div class="col-lg-4">
                                                <a data-toggle="modal" data-target="#accepteModal">
                                                    <div class="full socile_icons google_p margin_bottom_30">
                                                        <div class="social_icon bg-success">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                        <div class="social_cont">
                                                            <div class="cont_table_price_blog">
                                                                <p class="blue1_color"><span class="price_no"></span>Acceptée</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a data-toggle="modal" data-target="#quarantaineModal">
                                                    <div class="full socile_icons google_p margin_bottom_30">
                                                        <div class="social_icon bg-warning">
                                                            <i class="fa fa-close"></i>
                                                        </div>
                                                        <div class="social_cont">
                                                            <div class="cont_table_price_blog">
                                                                <p class="blue1_color"><span class="price_no"></span>Quarantaine</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a data-toggle="modal" data-target="#rebutModal">
                                                    <div class="full socile_icons google_p margin_bottom_30">
                                                        <div class="social_icon bg-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </div>
                                                        <div class="social_cont">
                                                            <div class="cont_table_price_blog">
                                                                <p class="blue1_color"><span class="price_no"></span>REBUT</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                            @if($dt->etat != 2)
                                            <div class="col-lg-4">
                                                <a data-toggle="modal" data-target="#accepteModal">
                                                    <div class="full socile_icons google_p margin_bottom_30">
                                                        <div class="social_icon bg-success">
                                                            <i class="fa fa-check"></i>
                                                        </div>
                                                        <div class="social_cont">
                                                            <div class="cont_table_price_blog">
                                                                <p class="blue1_color"><span class="price_no"></span>Acceptée</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-4">
                                                <a data-toggle="modal" data-target="#rebutModal">
                                                    <div class="full socile_icons google_p margin_bottom_30">
                                                        <div class="social_icon bg-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </div>
                                                        <div class="social_cont">
                                                            <div class="cont_table_price_blog">
                                                                <p class="blue1_color"><span class="price_no"></span>REBUT</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                        @endif
                                        @endforeach
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
                <h5 class="modal-title" id="exampleModalLabel" style="color: green;">Validation</h5>
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
                <h5 class="modal-title" id="exampleModalLabel" style="color: #ffc107;">Mise en quarantaine</h5>
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
                <h5 class="modal-title" id="exampleModalLabel" style="color: red;">Mise en Rebut</h5>
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
@endsection