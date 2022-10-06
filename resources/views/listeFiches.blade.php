@extends('Template.template')
@section('vue')
<div class="card">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head" id="entete">
            <div class="heading1 margin_0">
                <h2 style="color: white;">Liste des Fiches FCPCC</h2>
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
                <div class="input-group" id="dropdown1">
                    <div class="input-append">
                        <input type="text" name="filtre" id="filtre" class="sr-input" placeholder="Recherche" oninput="listeFrns()">
                    </div>
                    <div class="input-append">
                        <label>Fiche au niveau du: </label>
                        <select class="sr-input green_color" id="etat" name="etat">
                            <option value="-1" selected>-</option>
                            <option value="0">Magasinier</option>
                            <option value="1">Approvisionnement</option>
                            <option value="2">Pharmacien Resp.</option>
                            <option value="3">Resp. Stock</option>
                            <option value="4">Chef Rayon</option>
                            <option value="5">Sur Rack</option>
                            <option value="-2">Quarantaine</option>
                            <option value="-3">Rebut</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" id="ajaxlisteFiche">
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
                document.getElementById("ajaxlisteFiche").innerHTML = xhr.responseText
                console.log(xhr.responseText)
            }
        }
        var name = document.getElementById('filtre').value
        var etat = document.getElementById('etat').value
        if (page <= 1) var url = '/AjaxListeFiche/All?filtre=' + name + '&&etat=' + etat;
        else {
            var url = '/AjaxListeFiche/All?filtre=' + name + '&&etat=' + etat + '&&page=' + page;
        }
        xhr.open('GET', url, true)
        xhr.send();
    }
    var recBar = document.getElementById('filtre')
    var etat = document.getElementById('etat')
    recBar.addEventListener("onchange", listeNewFiche)
    etat.addEventListener("onchange", listeNewFiche)
    listeNewFiche()

    $(document).ready(function() {
        $(document).on('click', ".pagination a", function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            listeNewFiche(page);
        });


        $('#filtre').on('input', function() {
            $value = $(this).val();
            listeNewFiche(1);
        });

        $('#etat').on('change', function() {
            $value = $(this).val();
            listeNewFiche(1);
        });
    });
</script>

@endsection