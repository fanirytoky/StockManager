<div class="col-lg-12">
    <table class="table table-striped col-lg-12 ">
        <thead>
            <tr style="color: black;"><b>
                    <th>N° Fiche</th>
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>Fournisseur</th>
                    <th>Quantite Total</th>
                    <th>Date de controle</th>
                    <th>Etat</th>
                    <th>Export PDF</th>
                    <th>Détails</th>
                </b></tr>
        </thead>
        <tbody id="ajaxlisteFicheAvalider">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->dt_Fiche_ref}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->CT_Intitule}}</td>
                <td>{{$fiche->total}}</td>
                <td>{{$fiche->date_controle}}</td>
                <td>{{$fiche->position}}</td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('Stock/fiche-PDF', ['dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-info fa fa-file-pdf-o"> Exporter</button></a></div>
                </td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('Stock/fiche-details', ['id_dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-eye"> Voir</button></a></div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-12 pagination">
    <div class="col-md-12">
        {{ $val->onEachSide(1)->links() }}
    </div>
</div>