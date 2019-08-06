@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-dashboard"></i>
   </div>
   <div class="header-title">
      <h1>CRM Admin Dashboard</h1>
      <small>Very detailed & featured admin.</small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
    @if( isset($tabs['newcustomers']) && is_numeric($tabs['newcustomers']) )
      <div class=" col-sm-6 col-md-6 col-lg-3">
         <div id="cardbox1">
            <div class="statistic-box">
               <i class="fa fa-user-plus fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{ $tabs['newcustomers'] }}</span>
                  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                  </span>
               </div>
               <h3> New Customers</h3>
            </div>
         </div>
      </div>
      @endif
      @if( isset($tabs['totalcustomers']) && is_numeric($tabs['totalcustomers']) )
      <div class=" col-sm-6 col-md-6 col-lg-3">
         <div id="cardbox2">
            <div class="statistic-box">
               <i class="fa fa-user-secret fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{ $tabs['totalcustomers'] }}</span>
                  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                  </span>
               </div>
               <h3>  Active Clients</h3>
            </div>
         </div>
      </div>
      @endif
      @if( isset($tabs['monthly_sales_total']) && is_numeric($tabs['monthly_sales_total']) )
      <div class=" col-sm-6 col-md-6 col-lg-3">
         <div id="cardbox3">
            <div class="statistic-box">
               <i class="fa fa-money fa-3x"></i>
               <div class="counter-number pull-right">
                  <i class="ti ti-money"></i><span class="count-number">{{ $tabs['monthly_sales_total'] }}</span>
                  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                  </span>
               </div>
               <h3>  Monthly Sales</h3>
            </div>
         </div>
      </div>
      @endif
      @if( isset($tabs['year_sales_total']) && is_numeric($tabs['year_sales_total']) )
      <div class=" col-sm-6 col-md-6 col-lg-3">
         <div id="cardbox4">
            <div class="statistic-box">
               <i class="fa fa-money fa-3x"></i>
               <div class="counter-number pull-right">
                  <i class="ti ti-money"></i><span class="count-number">{{ $tabs['year_sales_total'] }}</span>
                  <span class="slight"><i class="fa fa-play fa-rotate-270"> </i>
                  </span>
               </div>
               <h3> YTD Sales</h3>
            </div>
         </div>
      </div>
      @endif
   </div>

   <div class="row">
    @if( !empty($web_sales) )
      <!-- WebSales chart start -->
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Web Sales</h4>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="webSales" height="100"></canvas>
                </div>
            </div>
        </div>
      <!-- WebSales chart end -->
      @endif
      @if( !empty($digital_sales) )
      <!-- DigitalSales chart start -->
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Digital Sales</h4>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="DigitalSales" height="100"></canvas>
                </div>
            </div>
        </div>
      <!-- DigitalSales chart end -->
      @endif
      {{-- <div class="col-lg-4  col-md-12 col-sm-12 ">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Weekly Earnings & Expenses</h4>
                    </div>
                </div>
                <div class="card-body">
                     <canvas id="singelBarChart" height="323"></canvas>
                  </div>
            </div>
        </div> --}}
   </div>

   <div class="row">
        <div class="col-lg-6 pinpin">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>Upcoming Meetings</h4>
                    </div>
                </div>
                <div class="card-body">
                    @if( count($meetings_list) )
                    @foreach( $meetings_list as $meetings )
                    <div class="work-touchpoint">
                        <div class="work-touchpoint-date">
                            <span class="day">{{ $meetings->MeetingDate() }}</span>
                            <span class="month">{{ $meetings->MeetingMonth() }}</span>
                        </div>
                    </div>
                    <div class="detailswork">
                        <span class="label-custom label label-default float-right">{{ $meetings->meeting_time }}</span>
                        <a href="{{ route('leadedit',$meetings->lead_id) }}" title="headings">{{ $meetings->subject }}</a> <br>
                        <p>{{ $meetings->body }}
                        @if( $current_user_role_id != 3 )
                        <br>
                        Customer Name : {{ $meetings->lead->getCustomerFullName() }}
                        <br>
                        Sales Person Name : {{ $meetings->salesPerson->name }}
                        <br>
                        Lead Status : {{ get_lead_status($meetings->lead->lead_status) }}
                        @endif
                        </p>
                    </div>
                    @endforeach
                    @else
                    <div class="detailswork">
                        <p>No Meetings Found</p>
                    </div>
                    @endif
                    {{-- <div class="work-touchpoint">
                        <div class="work-touchpoint-date2">
                            <span class="day">17</span>
                            <span class="month">Mrc</span>
                        </div>
                    </div>
                    <div class="detailswork">
                        <span class="label-custom label label-default float-right">phone</span>
                        <a href="#" title="headings">Marketing policy</a> <br>
                        <p>Madrid  - spain</p>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
   <!-- /.row -->
   {{-- <div class="row">
      <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card lobicard"  data-sortable="true">
                  <div class="card-header">
                      <div class="card-title custom_title">
                           <h4>Google Map</h4>
                      </div>
                  </div>
                  <div class="card-body">
                        <div class="google-maps">
                           <iframe src="https://maps.google.co.uk/maps?f=q&source=s_q&hl=en&geocode=&q=15+Springfield+Way,+Hythe,+CT21+5SH&aq=t&sll=52.8382,-2.327815&sspn=8.047465,13.666992&ie=UTF8&hq=&hnear=15+Springfield+Way,+Hythe+CT21+5SH,+United+Kingdom&t=m&z=14&ll=51.077429,1.121722&output=embed"></iframe>
                        </div>
                     </div>
              </div>
      </div>
      <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card lobicard lobicard-custom-control"  data-sortable="true">
                  <div class="card-header">
                      <div class="card-title custom_title">
                           <h4>Calender</h4>
                      </div>
                  </div>
                  <!-- Monthly calender widget -->
               <div class="panel panel-bd">
                  <div class="card-body">
                     <div class="monthly_calender">
                        <div class="monthly" id="m_calendar"></div>
                     </div>
                  </div>
               </div>
            </div>
      </div>
   </div> --}}
</section>
<!-- /.content -->
@endsection
@section('scripts')
<!-- End Theme label Script
=====================================================================-->

<script>
    function dash() {
        // single bar chart
        /*
        var ctx = document.getElementById("singelBarChart");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Sun", "Mon", "Tu", "Wed", "Th", "Fri", "Sat"],
                datasets: [{
                    label: "My First dataset",
                    data: [40, 55, 75, 81, 56, 55, 40],
                    borderColor: "rgba(0, 150, 136, 0.8)",
                    width: "1",
                    borderWidth: "0",
                    backgroundColor: "rgba(0, 150, 136, 0.8)"
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        */

        //monthly calender
        /*
        $('#m_calendar').monthly({
        mode: 'event',
        //jsonUrl: 'events.json',
        //dataType: 'json'
        xmlUrl: 'events.xml'
        });
        */

        @if( !empty($web_sales) )
        //webSales chart
        var ctx = document.getElementById("webSales");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September","October", "November", "December"],
            datasets: [
            @foreach( $web_sales as $d )
            {!! "{
                label: '".$d['label']."',
                data: [".$d['data']."],
                borderColor: '".$d['borderColor']."',
                backgroundColor: '".$d['backgroundColor']."',
                width: '1',
                borderWidth: '0'
            }," !!}
            @endforeach
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        }
                    }]
                }
            }
        });
        @endif

        @if( !empty($digital_sales) )
        //DigitalSales chart
        var ctx = document.getElementById("DigitalSales");
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September","October", "November", "December"],
            datasets: [
            @foreach( $digital_sales as $d )
            {!! "{
                label: '".$d['label']."',
                data: [".$d['data']."],
                borderColor: '".$d['borderColor']."',
                backgroundColor: '".$d['backgroundColor']."',
                width: '1',
                borderWidth: '0'
            }," !!}
            @endforeach
            ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        }
                    }]
                }
            }
        });
        @endif

        //counter
        $('.count-number').counterUp({
            delay: 10,
            time: 5000
        });
    }

    dash();
</script>
@endsection
