<div class="white_shd full margin_bottom_30">
    <div class="full graph_head">
        <div class="heading1 margin_0">
            <h2>Stock disponible</h2>
        </div>
    </div>
    <div class="table_section padding_infor_info">
        <div class="table-sm">
            <table class="table">
                <thead>
                    <tr style="color: black;"><b>
                            <th>N° RACK</th>
                            <th>LOT</th>
                            <th>QUANTITE</th>
                            <th>ACTION</th>
                        </b></tr>
                </thead>
                <tbody id="ajaxlisteAdresse">
                    @foreach($val as $adresses)
                    <tr>
                        <td>{{$adresses->num_Rack}}</td>
                        <td>{{$adresses->num_Lot}}</td>
                        <td>{{$adresses->Reste}}</td>
                        <td>
                            @if($adresses->Reste > 0)
                            <div class="button_block"><a class="fw_icon" href="{{ route('setSessionNumRack', ['num_Rack' => $adresses->num_Rack ,'id_fiche_stock' => $adresses->id_fiche_stock ,'id_stock_Empl' => $adresses->id_stock_Empl]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-check"></button></a></div>
                            @else
                            <div class="button_block"><a class="fw_icon" href="{{ route('setSessionNumRack', ['num_Rack' => $adresses->num_Rack ,'id_fiche_stock' => $adresses->id_fiche_stock ,'id_stock_Empl' => $adresses->id_stock_Empl]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-check" disabled></button></a></div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs">
            <div class="pagination">
                {{ $val->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>