<div class="white_shd full margin_bottom_30">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-xs">
            <div class="pagination">
                {{ $mvt_stock->links() }}
            </div>
        </div>
    </div>
</div>