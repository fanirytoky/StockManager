<p id="detailsScoreAjax">
    @if($total_score[0]->total > 0)
    @foreach($details_score as $dt_score)
    @if($dt_score->id_libelle != 4)
    <strong>{{$dt_score->normes}} : </strong><a>{{$dt_score->score}}<b>/{{$dt_score->Notation}}</b></a><br>
    @endif

    @if($dt_score->id_libelle == 4)
    <strong>AMM Madagascar existante : </strong><a>{{$dt_score->score}}<b>/{{$dt_score->Notation}}</b></a><br>
    @endif
    @if($dt_score->observation != null)
    <strong>Observations : </strong><a>{{$dt_score->observation}}</a><br>
    @endif
    @endforeach
    @endif
    @foreach($total_score as $total)
    <strong>Total score : </strong><a>{{$total->total}}</a><br>
<p class="ratings">
    @for($i=0;$i<($total->total);$i++)
        <span class="fa fa-star"></span>
        @endfor
        @for($i=0;$i<(5-$total->total);$i++)
            <span class="fa fa-star-o"></span>
            @endfor
</p>
@endforeach
</p>