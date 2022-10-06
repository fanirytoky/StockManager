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
                    <tr>
                        <th>Référence</th>
                        <th>Nom</th>
                        <th>Choisir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($val as $frns)
                    <tr>
                        <td>{{$frns->CT_Num}}</td>
                        <td>{{$frns->CT_Intitule}}</td>
                        <td><a class="fw_icon" href="{{ route('setSessionFrns', ['CT_Num' => $frns->CT_Num,'id_Fiche' => $id_Fiche]) }}"><i class="fa fa-check-square" style="padding-left: 15px;"></i></a></td>
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