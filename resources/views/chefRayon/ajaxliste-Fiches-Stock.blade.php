<div class="col-lg-12">
    <table class="table table-striped col-lg-12 ">
        <thead>
            <tr style="color: black;"><b>
                    <th>N°</th>
                    <th>CODE</th>
                    <th>DESIGNATION</th>
                    <th>PRESENTATION</th>
                    <th>PEREMPTION</th>
                    <th>N° LOT</th>
                    <th>QUANTITE</th>
                    <th>DEPOT</th>
                    <th>ACTION</th>
                </b></tr>
        </thead>
        <tbody id="ajaxlisteFicheAvalider">
            @foreach($val as $fiche)
            <tr>
                <td>{{$fiche->id_fiche_stock}}</td>
                <td>{{$fiche->AR_Ref}}</td>
                <td>{{$fiche->AR_Design}}</td>
                <td>{{$fiche->P_Intitule}}</td>
                <td>{{$fiche->date_peremp}}</td>
                <td>{{$fiche->num_Lot}}</td>
                <td>{{$fiche->total}}</td>
                <td>{{$fiche->DE_Intitule}}</td>
                <td>
                    <div class="button_block"><a class="fw_icon" href="{{ route('ChefRayon/fiche-stock-details', ['id_fiche_stock' => $fiche->id_fiche_stock]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-file-code-o"> Détails</button></a></div>
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