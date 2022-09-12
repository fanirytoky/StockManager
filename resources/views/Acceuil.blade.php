@extends('Template.template')
@section('vue')
<div class="row column1">
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 yellow_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-user"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no whi">2500</p>
                    <p class="head_couter">Welcome</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 blue1_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no">123.50</p>
                    <p class="head_couter">Average Time</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 green_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-cloud-download"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no">1,805</p>
                    <p class="head_couter">Collections</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full counter_section margin_bottom_30 red_bg">
            <div class="couter_icon">
                <div>
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
            <div class="counter_no">
                <div>
                    <p class="total_no">54</p>
                    <p class="head_couter">Comments</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row column1 social_media_section">
    <div class="col-md-6 col-lg-3">
        <div class="full socile_icons fb margin_bottom_30">
            <div class="social_icon">
                <i class="fa fa-facebook"></i>
            </div>
            <div class="social_cont">
                <ul>
                    <li>
                        <span><strong>35k</strong></span>
                        <span>Friends</span>
                    </li>
                    <li>
                        <span><strong>128</strong></span>
                        <span>Feeds</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full socile_icons tw margin_bottom_30">
            <div class="social_icon">
                <i class="fa fa-twitter"></i>
            </div>
            <div class="social_cont">
                <ul>
                    <li>
                        <span><strong>584k</strong></span>
                        <span>Followers</span>
                    </li>
                    <li>
                        <span><strong>978</strong></span>
                        <span>Tweets</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full socile_icons linked margin_bottom_30">
            <div class="social_icon">
                <i class="fa fa-linkedin"></i>
            </div>
            <div class="social_cont">
                <ul>
                    <li>
                        <span><strong>758+</strong></span>
                        <span>Contacts</span>
                    </li>
                    <li>
                        <span><strong>365</strong></span>
                        <span>Feeds</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="full socile_icons google_p margin_bottom_30">
            <div class="social_icon">
                <i class="fa fa-google-plus"></i>
            </div>
            <div class="social_cont">
                <ul>
                    <li>
                        <span><strong>450</strong></span>
                        <span>Followers</span>
                    </li>
                    <li>
                        <span><strong>57</strong></span>
                        <span>Circles</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row column2 graph margin_bottom_30">
    <div class="col-md-l2 col-lg-12">
        <div class="white_shd full">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Extra Area Chart</h2>
                </div>
            </div>
            <div class="full graph_revenue">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <div class="area_chart">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="{{url('js/chart.js')}}"></script> -->
<script>
  const labels = [
    'Janvier',
    'Fevrier',
    'Mars',
    'Avril',
    'Mai',
    'Juin',
  ];

  const data = {
    labels: labels,
    datasets: [{
      label: 'My First dataset',
      backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
      borderColor: 'rgb(255, 99, 132)',
      data: [05, 10, 5, 2, 20, 30, 45],
    }]
  };

//   'doughnut','bar','line'
  const config = {
    type: 'bar',
    data: data,
    options: {}
  };
</script>
<script>
  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
</script>

@endsection