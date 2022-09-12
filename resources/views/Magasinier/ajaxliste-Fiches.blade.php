<div class="col-lg-12">
    <table class="table">
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
                    <div class="dropdown_section">
                        <a type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v" style="font-size: 15px;"></i></a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('fiche.ajoutLot', ['id_Fiche' => $fiche->id_Fiche]) }}"><i class="fa fa-plus-square-o" style="font-size:16px;"> Ajout Lot</i></a>
                            <a class="dropdown-item" href="{{ route('fiche.valider', ['id_Fiche' => $fiche->id_Fiche]) }}"><i class="fa fa-check-square-o" style="font-size:16px;"> Envoyer</i></a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-12 pagination">
    <div class="col-md-12">
        {{ $val->links() }}
    </div>
</div>