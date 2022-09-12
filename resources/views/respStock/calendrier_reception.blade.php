@extends('Template.template')
@section('vue')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{url('js/jquery.calendar.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/fullcalendar.css')}}" />
    <script src="{{url('js/jquery-ui.min.js')}}"></script>
    <script src="{{url('js/moment.min.js')}}"></script>
    <script src="{{url('js/fullcalendar.min.js')}}"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <script src="{{url('js/bootstrap.calendar.min.js')}}"></script>
</head>

<!-- invoice section -->
<div class="col-xs-12">
    <div class="white_shd full margin_bottom_30">
        <div class="full graph_head">
            <div class="heading1 margin_0">
                <h2><i class="fa fa-calendar" aria-hidden="true"></i> Calendrier de reception des Intrants de sante</h2>
            </div>
        </div>
        <div class="full padding_infor_info">
            <div class="invoice_inner">
                <div class="white_shd full margin_bottom_30">
                    <div class="full progress_bar_inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="full">
                                    <div id="calendar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="details"></div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var booking = <?php echo json_encode($events); ?>;

        $('#calendar').fullCalendar({
            header: {
                left: 'prev, next today',
                center: 'title',
                right: 'month, agendaWeek, agendaDay',
            },
            events: booking,
            selectable: true,
            selectHelper: true,

            eventClick: function(event) {
                $('#bookingModal').modal('toggle');
                var id = event.id;
                var xhr = new XMLHttpRequest()
                xhr.onreadystatechange = (e) => {
                    e.preventDefault()
                    if (xhr.readyState === 4) {
                        document.getElementById("details").innerHTML = xhr.responseText
                        console.log(xhr.responseText)
                    }
                }
                var url = '/reception-detail?id_Fiche=' + id;
                xhr.open('GET', url, true)
                xhr.send();

            },
            selectAllow: function(event) {
                return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
            },



        });
        $('.fc-event').css('font-size', '13px');
    });
</script>
@endsection