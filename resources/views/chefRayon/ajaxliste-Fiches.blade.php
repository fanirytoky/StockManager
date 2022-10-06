<div class="col-lg-12">
    <table class="table table-striped col-lg-12 ">
        <thead>
            <tr style="color: black;"><b>
                    <th>N° Fiche</th>
                    <th>Réference</th>
                    <th>Désignation</th>
                    <th>N° Lot</th>
                    <th>Presentation</th>
                    <th>Quantite</th>
                    <th>Date de controle</th>
                    <th>Etat</th>
                    <th>Emplacement</th>
                </b></tr>
        </thead>
        <tbody id="ajaxlisteFicheAvalider">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->id_Fiche}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->num_Lot}}</td>
                <td>{{$fiche->P_Intitule}}</td>
                <td>{{$fiche->quantite}}</td>
                <td>{{$fiche->date_controle}}</td>
                <td>{{$fiche->position}}</td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('ChefRayon/fiche-emplacement', ['id_dt_Fiche' => $fiche->dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-cubes"> Mettre en place</button></a></div>
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