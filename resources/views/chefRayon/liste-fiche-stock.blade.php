@extends('Template.template')
@section('vue')
<div class="card">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;">Liste des fiches de stock</h2>
            </div>
        </div>
        <div class="table_section padding_infor_info">
            @if(session('success'))
            <div class="inbox">
                <div class="alert alert-success">
                    <p>{{session('success')}}</p>
                </div>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="inbox-head">
                <div class="input-append">
                    <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeNewFiche()">
                </div>
            </div>
            <div class="col-lg-12" id="ajaxliste-fiche-stock">
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="{{url('js/jquery2.min.js')}}"></script>

<!-- Latest minified bootstrap js -->
<script src="{{url('js/bootstrap2.min.js')}}"></script>

<script>
    function listeNewFiche(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxliste-fiche-stock").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        if (page <= 1) var url = '/ChefRayon/AjaxListeFiche.stock?filtre=' + name;
        else {
            var url = '/ChefRayon/AjaxListeFiche.stock?filtre=' + name + '&&page=' + page;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBar')
    recBar.addEventListener("onchange", listeNewFiche)
    listeNewFiche()

    $(document).ready(function() {
        $(document).on('click', ".pagination a", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeNewFiche(page);
        });


        $('#searchBar').on('input', function() {
            $value = $(this).val();
            listeNewFiche(1);
        });
    });
</script>

@endsection