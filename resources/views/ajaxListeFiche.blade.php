<div class="col-lg-12">
    <table class="table table-striped col-lg-12 ">
        <thead>
            <tr style="color: black;"><b>
                    <th>N° Fiche</th>
                    <th>N° LOT</th>
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>Fournisseur</th>
                    <th>Quantite</th>
                    <th>Date de controle</th>
                    <th>Etat</th>
                    <th>Durée de vie</th>
                </b></tr>
        </thead>
        <tbody id="ajaxlisteFicheAvalider">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->id_Fiche}}</td>
                <td>{{$fiche->num_Lot}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->CT_Intitule}}</td>
                <td>{{$fiche->quantite}}</td>
                <td>{{$fiche->date_controle}}</td>
                <td>{{$fiche->position}}</td>
                <td>{{$fiche->ANS}} Ans et {{$fiche->MOIS}} Mois</td>
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