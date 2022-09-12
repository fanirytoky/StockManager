@extends('Template.template')
@section('vue')
<div class="col-md-12">
    <!-- <div class="white_shd full margin_bottom_30"> -->
    <div class="midde_cont">
        <div class="container-fluid">
            <div class="row column_title">
                <div class="col-md-12">
                    <div class="page_title" id="entete">
                        <h2 style="color: white;">FICHE DE CONTROLE PHYSIQUE ET CONTROLE CONDITIONNEMENT</h2>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row column1">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="white_shd full">
                        <div class="full graph_head">
                            <div class="heading1 margin_0">
                                <h2>Détails Fiche N° {{$details[0]->id_Fiche}}</h2>
                            </div>
                        </div>
                        <div class="full price_table">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="full dis_flex center_text">
                                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                                            <h4>{{$details[0]->AR_Design}}</h4>
                                            <p>
                                                <strong>N° Lot : </strong><a>{{$details[0]->num_Lot}}</a><br>
                                                <strong>Dosage : </strong><a>{{$details[0]->dosage}} MG/ML</a><br>
                                                <strong>Forme : </strong><a>{{$details[0]->FO_designation}}</a><br>
                                                <strong>Présentation : </strong><a>{{$details[0]->P_Intitule}}</a><br>
                                                <strong>Quantite : </strong><a>{{$details[0]->quantite}}</a><br>
                                                <strong>Type de Stockage : </strong><a>{{$details[0]->Type_Stockage}}</a><br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="full dis_flex center_text">
                                        <div class="full invoice_blog padding_infor_info padding-bottom_0">
                                            <h4>CONTROLES PHYSIQUES ET CONDITIONNEMENT AVEC RATING</h4>
                                            @foreach($details as $val)
                                            <p><strong>{{$val->normes}} : </strong><a class="info_valume">{{$val->score}}/{{$val->Notation}}</a></p>
                                            <p><strong>Observations : </strong><a class="info_valume">{{$val->observation}}</a></p>
                                            @if($val->id_libelle == 5)
                                            <p><strong>{{$val->normes}} : </strong><a class="info_valume">{{$val->score}}/{{$val->Notation}}</a></p>
                                            <p><strong>Observations : </strong><a class="info_valume">{{$val->observation}}</a></p>
                                            @endif
                                            @endforeach
                                            @foreach($total_score as $total)
                                            <p><strong>Total score : </strong><a>{{$total->total}}</a><br></p>
                                            
                                            <div class="col-md-4">
                                                <span class="skill" style="width:85%;"> Pourcentage: <span class="info_valume"> {{$total->pourc}}%</span></span>
                                                <div class="progress skill-bar ">
                                                    <div class="progress-bar progress-bar-animated progress-bar-striped" role="progressbar" aria-valuenow="{{$total->pourc}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$total->pourc}}%;">
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach

                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="full inner_elements">
                            <div class="row margin_bottom_30">
                                <div class="col-md-12">
                                    <div class=" full button_sction padding_infor_info button_style1 padding-bottom_0">
                                        <div class="center"><a data-role="button" class="btn cur-p btn-outline-info fa fa-file-pdf-o" data-inline="true" href="{{ route('Stock/fiche-PDF', ['dt_Fiche' => $details[0]->dt_Fiche_ref]) }}"> <b>Export PDF</b></a>
                                            @if($details[0]->etat == 3)
                                            <p>&nbsp;</p><a data-role="button" class="btn cur-p btn-outline-success fa fa-save" data-inline="true" href="{{route('Stock/fiche.decision',['dt_Fiche_ref' => $details[0]->dt_Fiche_ref])}}"> <b>Enregistrer</b></a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <!-- end row -->
        </div>
    </div>
</div>
<!-- </div> -->
</div>
@endsection