<div class="white_shd full margin_bottom_30">
    <div class="table_section padding_infor_info">
        <div class="table-sm">
            <table class="table">
                <thead>
                    <tr style="color: black;"><b>
                            <th>Référence</th>
                            <th>Désignation</th>
                            <th>Famille</th>
                            <th>Action</th>
                        </b></tr>
                </thead>
                <tbody>
                    @foreach($val as $articles)
                    <tr>
                        <td>{{$articles->AR_Ref}}</td>
                        <td>{{$articles->AR_Design}}</td>
                        <td>{{$articles->FA_Intitule}}</td>
                        <td><a class="fw_icon green_color" href="{{ route('setSession', ['AR_ref' => $articles->AR_Ref]) }}"><i class="fa fa-check-square" style="padding-left: 15px;"></i></a></td>
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