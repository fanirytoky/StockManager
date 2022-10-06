<div class="table_section padding_infor_info">
    <div class="table-sm">
        <table class="table">
            <thead>
                <tr style="color: black;"><b>
                        <th>N° RACK</th>
                        <th>DATE</th>
                        <th>N° DOC</th>
                        <th>FOURNISSEUR/CLIENT</th>
                        <th>ENTREE</th>
                        <th>SORTIE</th>
                        <th>STOCK</th>
                        <th>INVENTAIRE</th>
                    </b></tr>
            </thead>
            <tbody>
                @foreach($mvt_stock as $val)
                <tr>
                    <td>{{$val->num_Rack}}</td>
                    <td>{{$val->date_mvt}}</td>
                    @if($val->num_Doc == null && $val->CT_Intitule == null)
                    <td>Emplacement</td>
                    <td>Chef de Rayon</td>
                    @else
                    <td>{{$val->num_Doc}}</td>
                    <td>{{$val->CT_Intitule}}</td>
                    @endif
                    <td>{{$val->entree}}</td>
                    <td>{{$val->sortie}}</td>
                    <td>{{$val->stock}}</td>
                    @if($val->date_inventaire != null)
                    <td>
                        <h6 style="color: red;">{{$val->observations}},QTE= {{$val->quantite}}</h6>
                    </td>
                    @if($val->stock == $val->quantite)
                    <td>
                        <div class="button_block"><a class="fw_icon" href="{{ route('stock/ajuster', ['inventaire' => $val->quantite , 'stock' => $val->stock, 'id_stock_empl' => $val->id_stock_empl]) }}"><button type="button" class="btn cur-p btn-outline-danger fa fa-warning" disabled> Ajuster</button></a></div>
                    </td>
                    @else
                    <td>
                        <div class="button_block"><a class="fw_icon" href="{{ route('stock/ajuster', ['inventaire' => $val->quantite , 'stock' => $val->stock, 'id_stock_empl' => $val->id_stock_empl]) }}"><button type="button" class="btn cur-p btn-outline-danger fa fa-warning"> Ajuster</button></a></div>
                    </td>
                    @endif
                    @else
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="col-xs">
            <div class="pagination">
                {{ $mvt_stock->onEachSide(1)->links() }}
            </div>
        </div>
    </div>
</div>