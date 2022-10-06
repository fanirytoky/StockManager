<hr>
<div class="grid-margin stretch-card">
    <div class="heading1 margin_0">
        <h2><i class="fa fa-table "></i> Détails par durée de vie</h2>
    </div>
    <div class="table-striped">
        <table class="table table-bordered">
            <thead>
                <tr style="color: black;"><b>
                        <th>N° Lot</th>
                        <th>Désignation</th>
                        <th>Fournisseur</th>
                        <th>Date de peremption</th>
                        <th>Etat</th>
                    </b></tr>
            </thead>
            <tbody id="detailsStat">
                @foreach($val as $fiche)
                <tr>
                    <td><b>{{$fiche->num_Lot}}</b></td>
                    <td>{{$fiche->AR_Design}}</td>
                    <td><b>{{$fiche->CT_Intitule}}</b></td>
                    <td>{{$fiche->date_peremp}}</td>
                    <td>{{$fiche->position}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="pagination">
    <div class="col-md-12">
        {{ $val->onEachSide(1)->links() }}
    </div>
</div>