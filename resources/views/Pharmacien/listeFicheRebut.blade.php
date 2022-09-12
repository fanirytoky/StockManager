@extends('Template.template')
@section('vue')
<div class="card">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;">Liste des Rebuts</h2>
            </div>
        </div>
        <div class="table_section padding_infor_info">
            <div class="inbox-head">
                <div class="input-append">
                    <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeNewFiche()">
                </div>
            </div>
            <div class="col-md-12" id="ajaxlisteFicheAvalider">
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
                document.getElementById("ajaxlisteFicheAvalider").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        if (page <= 1) var url = '/Pharmacien/AjaxListeFiche.rebut?filtre=' + name;
        else {
            var url = '/Pharmacien/AjaxListeFiche.rebut?filtre='+name +'&&page=' + page;
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