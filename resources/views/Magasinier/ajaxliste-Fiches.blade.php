<div class="col-lg-12">
    <table class="table table-striped col-lg-12 ">
        <thead>
            <tr style="color:black;"><b>
                    <th>N° Fiche</th>
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>Fournisseur</th>
                    <th>Quantite Total</th>
                    <th>Date de controle</th>
                    <th>Etat</th>
                    <th>Actions</th>
                    <th></th>
                </b></tr>
        </thead>
        <tbody id="ajaxlisteFiche">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->id_Fiche}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->CT_Intitule}}</td>
                <td>{{$fiche->total}}</td>
                <td>{{$fiche->date_controle}}</td>
                <td>{{$fiche->position}}</td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('fiche.ajoutLot', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-info fa fa-plus-square"> <b>Ajout Lot</b></button></a></div>
                </td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('fiche.valider', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-paper-plane-o"> <b>Envoyer</b></button></a></div>
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