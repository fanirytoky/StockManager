@extends('Template.template')
@section('vue')
<div class="card">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;">Liste des adresses sur rack par articles</h2>
            </div>
        </div>
        <div class="table_section padding_infor_info">
            <div class="inbox-head">
                <div class="input-append">
                    <input type="text" name="searchBar" id="searchBar" class="sr-input" placeholder="Recherche" oninput="listeAdresses()">
                </div>
            </div>
            <div class="col-md-12" id="ajaxlisteAdresse">
            </div>
        </div>
    </div>
</div>
<!-- jQuery library -->
<script src="{{url('js/jquery2.min.js')}}"></script>

<!-- Latest minified bootstrap js -->
<script src="{{url('js/bootstrap2.min.js')}}"></script>

<script>
    function listeAdresses(page) {
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = (e) => {
            e.preventDefault()
            if (xhr.readyState === 4) {
                document.getElementById("ajaxlisteAdresse").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('searchBar').value
        if (page <= 1) var url = 'Magasinier/adresses?filtre=' + name;
        else {
            var url = 'Magasinier/adresses?page=' + page + '&&filtre=' + name;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('searchBar')
    recBar.addEventListener("onchange", listeAdresses)
    listeAdresses()

    $(document).ready(function() {
        $(document).on('click', ".pagination a,.num_rack", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeAdresses(page);
        });


        $('#searchBar').on('input', function() {
            $value = $(this).val();
            listeAdresses(1);
        });
    });
</script>

@endsection