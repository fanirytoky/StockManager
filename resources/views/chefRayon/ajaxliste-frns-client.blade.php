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
                        <td>
                            <div class="button_block"><a class="fw_icon" href="{{ route('setSessionFrnsClient', ['CT_Num' => $frns->CT_Num,'id_fiche_stock' => $id_fiche_stock]) }}"><button type="button" class="btn cur-p btn-outline-success fa fa-check"></button></a></div>
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