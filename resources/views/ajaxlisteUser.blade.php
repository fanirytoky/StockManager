<div class="col-md-12">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Poste</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody id="ajaxlisteUser">
            @foreach($val as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->titre_post}}</td>
                <td><a class="fw_icon" href="{{ route('user.update', ['id' => $user->id]) }}"><i class="fa fa-edit" style="padding-left: 20px;"></i></a></td>
                <td><a class="fw_icon" href="{{ route('user.delete', ['id' => $user->id]) }}"><i class="fa fa-trash" style="padding-left: 30px;"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="col-md-12 pagination">
    <div class="col-md-12">
        {{ $val->links() }}
    </div>
</div>