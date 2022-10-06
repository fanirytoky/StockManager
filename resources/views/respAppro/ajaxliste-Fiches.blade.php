<div class="col-lg-12">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>N° Fiche</th>
                <th>Réference</th>
                <th>Désignation</th>
                <th>Fournisseur</th>
                <th>Quantite Total</th>
                <th>Date de controle</th>
                <th>Etat</th>
                <th>Ajout réference</th>
            </tr>
        </thead>
        <tbody id="ajaxlisteFicheAvalider">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->id_Fiche}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->CT_Intitule}}</td>
                <td>{{$fiche->total}}</td>
                <td>{{$fiche->date_controle}}</td>
                <td>{{$fiche->position}}</td>
                <td><div class="button_block"><a class="fw_icon" href="{{ route('referencier.fiche', ['id_Fiche' => $fiche->id_Fiche]) }}"><button type="button" class="btn cur-p btn-outline-info fa fa-book"> <b>Détails</b></button></a></div></td>
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


