<div class="col-lg-12">
    <table class="table table-striped">
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
                    <th>Actions</th>
                    <!-- <th>Détails</th> -->
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
                <td style="white-space: nowrap">
                    <a class="fw_icon" href="{{ route('Pharma/fiche-edit', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-danger fa fa-edit" disabled></button></a>
                    <a class="fw_icon" href="{{ route('Pharma/fiche-details', ['id_dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-info fa fa-eye"></button></a>
                </td>
                @endif
                @if($fiche->Etat == 2)
                <td style="white-space: nowrap">
                    <a class="fw_icon" href="{{ route('Pharma/fiche-edit', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-danger fa fa-edit"></button></a>
                    <a class="fw_icon" href="{{ route('Pharma/fiche-details', ['id_dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-info fa fa-eye"></button></a>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="pagination">
    <div class="col-md-12">
        {{ $val->onEachSide(1)->links() }}
    </div>
</div>