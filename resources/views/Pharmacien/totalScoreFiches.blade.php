<div class="tab-pane fade" id="decision" role="tabpanel" aria-labelledby="first">
    <div class="row">
        <div class="col-lg-12">
            @foreach($total_score as $total)
            @if($total->total > 0 || $total->total != null)
            <h5 style="color:red">Total score : {{$total->total}}/5</h5><br>
            @else
            <h5 style="color:red">Total score : 0/5</h5><br>
            @endif
            @endforeach
        </div>

        <div class="col-lg-12">
            @if($total_score != null)
            @foreach($total_score as $total)
            @if($total->total > 3)
            <div class="alert alert-success" role="alert">{{$total->etat_score}}</div>
            @endif
            @if($total->total <= 3) <div class="alert alert-danger" role="alert">{{$total->etat_score}}
        </div>
        @endif
        @endforeach
        @endif
        @foreach($total_score as $total)
        @if($total->total == null)
        <div class="alert alert-danger" role="alert">Veuillez procéder à l’évaluation </div>
        @endif
        @endforeach
    </div>
</div>
@foreach($total_score as $total)
@if($total->total != null)
<div class="row">
    @foreach($details as $dt)
    @if($dt->etat == 2)
    <div class="col-lg-4">
        <a data-toggle="modal" data-target="#accepteModal">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon bg-success">
                    <i class="fa fa-check"></i>
                </div>
                <div class="social_cont">
                    <div class="cont_table_price_blog">
                        <p class="blue1_color"><span class="price_no"></span>Acceptée</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4">
        <a data-toggle="modal" data-target="#quarantaineModal">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon bg-warning">
                    <i class="fa fa-close"></i>
                </div>
                <div class="social_cont">
                    <div class="cont_table_price_blog">
                        <p class="blue1_color"><span class="price_no"></span>Quarantaine</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4">
        <a data-toggle="modal" data-target="#rebutModal">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon bg-danger">
                    <i class="fa fa-trash"></i>
                </div>
                <div class="social_cont">
                    <div class="cont_table_price_blog">
                        <p class="blue1_color"><span class="price_no"></span>REBUT</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif
    @if($dt->etat != 2)
    <div class="col-lg-4">
        <a data-toggle="modal" data-target="#accepteModal">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon bg-success">
                    <i class="fa fa-check"></i>
                </div>
                <div class="social_cont">
                    <div class="cont_table_price_blog">
                        <p class="blue1_color"><span class="price_no"></span>Acceptée</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-4">
        <a data-toggle="modal" data-target="#rebutModal">
            <div class="full socile_icons google_p margin_bottom_30">
                <div class="social_icon bg-danger">
                    <i class="fa fa-trash"></i>
                </div>
                <div class="social_cont">
                    <div class="cont_table_price_blog">
                        <p class="blue1_color"><span class="price_no"></span>REBUT</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif
    @endforeach
</div>
@endif
@endforeach