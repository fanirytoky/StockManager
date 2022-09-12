<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2>Responsive Tables</h2>
        </div>
    </div>
    <div class="table_section padding_infor_info">
        <div class="table-sm">
            <table class="table">
                <thead>
                    <tr style="color: black;"><b>
                            <th>Adresse</th>
                            <th>AR_Ref</th>
                            <th>Position</th>
                            <th>Depôt</th>
                            <th>Action</th>
                        </b></tr>
                </thead>
                <tbody id="ajaxlisteAdresse">
                    @foreach($val as $adresses)
                    <tr>
                        <td>{{$adresses->DP_Code}}</td>
                        <td>{{$adresses->AR_Ref}}</td>
                        <td>{{$adresses->DP_Intitule}}</td>
                        <td>{{$adresses->DE_Intitule}}</td>
                        <td>
                            <div class="button_block"><a class="fw_icon" href="{{ route('ChefRayon/lot-emplacement', ['DP_Code' => $adresses->DP_Code , 'dt_Fiche_ref' => $dt_Fiche_ref]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-cubes"> Choisir</button></a></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs">
            <div class="pagination">
                {{ $val->links() }}
            </div>
        </div>
    </div>
</div>