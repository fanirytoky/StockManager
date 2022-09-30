<hr>
<div class="grid-margin stretch-card">
    <div class="table-striped">
        <table class="table table-bordered">
            <thead>
                <tr style="color: black;"><b>
                    <th>N° Fiche</th>
                    <th>Désignation</th>
                    <th>N° Lot</th>
                    @if($val[0]->Etat == 2)
                    <th>Forme</th>
                    @endif
                    <th>Date de peremption</th>
                    <th>Type de Stockage</th>
                    <th>Date de controle</th>
                    <th>Etat</th>
                    @if($val[0]->Etat != 2)
                    <th>Observation</th>
                    @endif
                    <th>Modifier</th>
                    <th>Détails</th>
                </b></tr>
            </thead>
            <tbody id="ajaxlisteFicheAvalider">
                @foreach($val as $fiche)
                <tr>
                    <td><b>{{$fiche->id_Fiche}}</b></td>
                    <td>{{$fiche->AR_Design}}</td>
                    <td><b>{{$fiche->num_Lot}}</b></td>
                    @if($fiche->Etat == 2)
                    <td>{{$fiche->FO_designation}}</td>
                    @endif
                    <td>{{$fiche->date_peremp}}</td>
                    <td>{{$fiche->Type_Stockage}}</td>
                    <td>{{$fiche->date_controle}}</td>
                    <td>{{$fiche->position}}</td>
                    @if($fiche->Etat != 2)
                    <td>{{$fiche->Observation}}</td>
                    <td>
                        <div class="button_block"><a class="fw_icon" href="{{ route('Pharma/fiche-edit', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-danger" disabled>Modifier</button></a></div>
                    </td>
                    @endif
                    @if($fiche->Etat == 2)
                    <td>
                        <div class="button_block"><a class="fw_icon" href="{{ route('Pharma/fiche-edit', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-danger">Modifier</button></a></div>
                    </td>
                    @endif
                    <td>
                        <div class="button_block"><a class="fw_icon" href="{{ route('Pharma/fiche-details', ['id_dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-info">Voir</button></a></div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    <div class="col-md-12">
        {{ $val->links() }}
    </div>
</div>