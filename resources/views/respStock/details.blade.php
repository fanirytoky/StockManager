<div class="tabbar padding_infor_info">
    <nav>
        <div class="nav nav-tabs" id="nav-tab1" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-dt" data-toggle="tab" href="#nav-home_dt" role="tab" aria-controls="nav-home_s2" aria-selected="true">Details Intrant de sante</a>
            @foreach($details as $dt)
            <a class="nav-item nav-link" id="nav-home-{{$dt->num_Lot}}" data-toggle="tab" href="#nav-home_{{$dt->num_Lot}}" role="tab" aria-controls="nav-home_s2" aria-selected="true">LOT n° {{$dt->num_Lot}}</a>
            @endforeach
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent_2">
        <div class="tab-pane fade show active" id="nav-home_dt" role="tabpanel" aria-labelledby="nav-home-tab">
            <p><b>N° Fiche:</b> {{$details[0]->id_Fiche}}</p>
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
            <p style="color: red;"><b>Etat:</b> {{$dt->position}}</p>
            <div class="full inner_elements">
                <div class="row margin_bottom_30">
                    <div class="col-md-12">
                        <div class=" full button_sction padding_infor_info button_style1 padding-bottom_0">
                            @if($dt->etat>=3)
                            <div class="center"><a data-role="button" class="btn cur-p btn-outline-info fa fa-file-pdf-o" data-inline="true" href="{{ route('Stock/fiche-PDF', ['dt_Fiche' => $dt->dt_Fiche_ref]) }}"> <b>Export PDF</b></a>
                                @if($dt->etat==3)
                                <p>&nbsp;</p><a data-role="button" class="btn cur-p btn-outline-success fa fa-cubes" data-inline="true" href="{{route('Stock/fiche.decision',['dt_Fiche_ref' => $dt->dt_Fiche_ref])}}"> <b>Mise en rayon</b></a>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>