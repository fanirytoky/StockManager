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
                        <th>Désignation</th>
                        <th>Famille</th>
                        <th>Choix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($val as $articles)
                    <tr>
                        <td>{{$articles->AR_Ref}}</td>
                        <td>{{$articles->AR_Design}}</td>
                        <td>{{$articles->FA_Intitule}}</td>
                        <td><a class="fw_icon" href="{{ route('setSession', ['AR_ref' => $articles->AR_Ref]) }}"><i class="fa fa-check-square" style="padding-left: 15px;"></i></a></td>
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