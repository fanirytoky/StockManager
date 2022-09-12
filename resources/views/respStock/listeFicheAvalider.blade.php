@extends('Template.template')
@section('vue')
<div class="card">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;">Liste des nouvelles fiches validées</h2>
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
            <div class="inbox-head">
                <div class="input-append">
                    <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeNewFiche()">
                </div>
            </div>
            <div class="col-lg-12" id="ajaxlisteFicheAvalider">
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- Latest minified bootstrap js -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
    function listeNewFiche(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxlisteFicheAvalider").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        if (page <= 1) var url = '/Stock/AjaxListeFiche.new?filtre=' + name;
        else {
            var url = '/Stock/AjaxListeFiche.new?filtre=' + name + '&&page=' + page;
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