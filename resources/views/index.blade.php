@php($page = 'Dashboard')
@extends('voyager::master')
@section('css')
<link rel="stylesheet" href="/css/card.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<style>
/* .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
} */
</style>
@stop
@section('content')
    <div class="page-content">
        @include('voyager::alerts')
        @include('voyager::dimmers')
        <div class="analytics-container row">
          <!-- <div class="col-md-6" id="chartContainer2" style="height: 370px;padding: 0px;"></div> -->
          <!-- <div class="col-md-1" id="chartContainer2" style="height: 370px;"></div> -->
          <!-- <div class="col-md-3 " id="chartContainer" style="height: 370px;"></div>
		  <div class="col-md-3" id="chartContainer3" style="height: 370px;"></div> -->
		  <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Pre Sales & Marketing</h5>
                  <canvas id="lineChart" style="height:250px"></canvas>
                </div>
              </div>
            </div>
		  <div class="col-lg-6 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Pre Sales & Marketing</h5>
                  <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
              </div>
			</div>
        </div>
		<div class="row mb-4">
			<div class="col-lg-12 mb-4">
          <div class="card">
			    <div class="card-body">
              <h5 class="card-title mb-4">Area chart</h5>
              <canvas id="areaChart" style="height:250px;"></canvas>
          </div>
			</div>
      </div>
			<div class="col-lg-6 col-12 mb-4">
              <div class="card">
			  <div class="card-body text-center">
				<p class="card-text">Some text inside the fifth card</p>
				</div>
              </div>
			</div>
		</div>
    </div>
    <div class="row">
    <div class="col-lg-12 col-12 mb-4">
    <div class="card">
    <div class="card-body text-center">
    <h2>Call Record & History</h2>
    <p>Support</p>
    <div class="table-responsive">
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Call#</th>
        <th>Phone No.</th>
        <th>Person Name</th>
        <th>Company</th>
        <th>City</th>
        <th>Website</th>
        <th>Status</th>
        <th>Date & Time</th>
        <th>No. of Calls</th>
        <th>Remarks</th>
        <th><button onclick="showaddCallModal('support');"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
      </tr>
    </thead>
    <tbody id="support_body">
    </tbody>
  </table>
  </div>
  <p>Marketing & Presales</p>
  <div class="table-responsive">
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Call#</th>
        <th>Phone No.</th>
        <th>Person Name</th>
        <th>Company</th>
        <th>City</th>
        <th>Website</th>
        <th>Status</th>
        <th>Date & Time</th>
        <th>No. of Calls</th>
        <th>Remarks</th>
        <th><button onclick="showaddCallModal('mp');"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
      </tr>
    </thead>
    <tbody id="marketing_presales_body">
    </tbody>
  </table>
  </div>
    </div>
    </div>
    </div>
    </div>
@stop

@section('javascript')
<!-- <script src="/js/canvasjs.min.js"></script> -->
<script src="/js/Chart.min.js"></script>
<!-- <script src="/js/chart.js"></script> -->
<script src="/js/off-canvas.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script>
getCalls();
// let allCalls = San_Helpers.getCalls("{{route('calls.index')}}");
function getCalls(){
  axios.get("{{route('calls.index')}}").then((res) => {
    let calls = res.data.detail;
    let minifyHtml = '';
    $.each(calls, function( index, call ) {
      minifyHtml = '<tr><td>'+call.id+'</td><td>'+call.phone+'</td><td>'+call.person_name+'</td><td>'+call.company+'</td><td>'+call.city+'</td><td>'+call.website+'</td><td>'+call.status+'</td><td>'+call.date_time+'</td><td>'+call.no_of_calls+'</td><td>'+call.remarks+'</td><td><button><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>';
      if (call.type == 'support'){
        $('#support_body').append(minifyHtml);
      }else{
        $('#marketing_presales_body').append(minifyHtml);
      }
    });
    // $('#support_body').html(minifyHtml);
  });
}
// console.log('toater', toastr);
// toastr.success('done');
let userType;
function showaddCallModal(type) {
  userType = type;
  $('#addCall input[name="type"]').val(type);
  $('#addCall').modal('show');
}
$('#call_form').on('submit',function(e){
  let data = new FormData(this);
  axios.post("{{route('calls.store')}}",data).then((response) => {
    console.log(response.data.detail);
    let call = response.data.detail;
    let minifyHtml = '<tr><td>'+call.id+'</td><td>'+call.phone+'</td><td>'+call.person_name+'</td><td>'+call.company+'</td><td>'+call.city+'</td><td>'+call.website+'</td><td>'+call.status+'</td><td>'+call.date_time+'</td><td>'+call.no_of_calls+'</td><td>'+call.remarks+'</td><td><button><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>';
    if (userType == 'support'){
      $('#support_body').append(minifyHtml);
    }else{
      $('#marketing_presales_body').append(minifyHtml);
    }
    $('#addCall').modal('hide');
    toastr.success(response.data.msg);
  }).catch((error) => {
    toastr.error("toastr alert-type " + error.response.data.msg + " is unknown");
    console.log(error);
  });
  return false;
})
$('#date_time_picker').datetimepicker();
var doughnutPieData = {
    datasets: [{
      data: [60, 40],
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.5)',
        'rgba(255, 206, 86, 0.5)',
        'rgba(75, 192, 192, 0.5)',
        'rgba(153, 102, 255, 0.5)',
        'rgba(255, 159, 64, 0.5)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Pending',
      'Finished',
    ]
  };
  var doughnutPieOptions = {
    responsive: true,
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

  if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
      type: 'doughnut',
      data: doughnutPieData,
      options: doughnutPieOptions
    });
  }
  var data = {
    labels: ["2013", "2014", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [10, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1
    }]
  };
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      point: {
        radius: 0
      }
    }

  };
  if ($("#lineChart").length) {
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: data,
      options: options
    });
  }
  var areaData = {
    labels: ["2013", "2014", "2015", "2016", "2017"],
    datasets: [{
      label: '# of Votes',
      data: [12, 19, 3, 5, 2, 3],
      backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
      ],
      borderWidth: 1,
      fill: 'origin', // 0: fill to 'origin'
      fill: '+2', // 1: fill to dataset 3
      fill: 1, // 2: fill to dataset 1
      fill: false, // 3: no fill
      fill: '-2' // 4: fill to dataset 2
    }]
  };
  var areaOptions = {
    plugins: {
      filler: {
        propagate: true
      }
    }
  }
  if ($("#areaChart").length) {
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    var areaChart = new Chart(areaChartCanvas, {
      type: 'line',
      data: areaData,
      options: areaOptions
    });
  }
</script>
@stop
