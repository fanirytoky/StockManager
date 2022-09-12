<div class="white_shd full margin_bottom_30">
    <div class="table_section padding_infor_info">
        <div class="table-sm">
            <table class="table">
                <thead>
                    <tr style="color: black;"><b>
                            <th>Adresse</th>
                            <th>AR_Ref</th>
                            <th>Position</th>
                            <th>Depôt</th>
                        </b></tr>
                </thead>
                <tbody id="ajaxlisteAdresse">
                    @foreach($val as $adresses)
                    <tr>
                        <td>{{$adresses->DP_Code}}</td>
                        <td>{{$adresses->AR_Ref}}</td>
                        <td>{{$adresses->DP_Intitule}}</td>
                        <td>{{$adresses->DE_Intitule}}</td>
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