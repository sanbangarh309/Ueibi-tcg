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
		  <div class="col-lg-12 col-12 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Pre Sales & Marketing</h5>
                  <div id="chartContainer" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
                </div>
              </div>
            </div>
		  <div class="col-lg-6 ">
              <div class="card">
                <div class="card-body">
                  <div id="chartContainer1" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
</div>
                </div>
              </div>
              <div class="col-lg-6 ">
                <div class="card">
                  <div class="card-body">
                    <div id="chartContainer2" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
        </div>
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
    <div class="row">
        <div class="col-md-12">
          <div class="rating">
          <h2>Call Record & History</h2>
          <div class="scrolltable">
        <p>Support</p>
        <table class="table custom_table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Call#</th>
            <th scope="col">Phone no</th>
            <th scope="col">Person name</th>
            <th scope="col">Copany</th>
            <th scope="col">City</th>
            <th scope="col">Website</th>
            <th scope="col">Status</th>
            <th scope="col">Date & Time</th>
            <th scope="col">No of calls</th>	
            <th scope="col">Remark</th>		 
            <th><button onclick="showaddCallModal('support');"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
          </tr>
        </thead>
        <tbody id="support_body">
        </tbody>
      </table>
    </div>
    
    <div class="scrolltable">
      <p>Marketing & Presales</p>
        <table class="table custom_table">
        <thead class="thead-dark">
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
<script src="/js/canvasjs.min.js"></script>
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
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: ""
	},
	axisY :{
		includeZero: false,
		prefix: "$"
	},
	toolTip: {
		shared: true
	},
	legend: {
		fontSize: 13
	},
	data: [
	{
		type: "splineArea", 
		showInLegend: true,
		name: "Denied",
		yValueFormatString: "$#,##0",
		dataPoints: [
			{ x: new Date(2016, 2), y: 20100 },
			{ x: new Date(2016, 3), y: 16000 },
			{ x: new Date(2016, 4), y: 14000 },
			{ x: new Date(2016, 5), y: 18000 },
			{ x: new Date(2016, 6), y: 18000 },
			{ x: new Date(2016, 7), y: 21000 },
			{ x: new Date(2016, 8), y: 22000 },
			{ x: new Date(2016, 9), y: 25000 },
			{ x: new Date(2016, 10), y: 23000 },
			{ x: new Date(2016, 11), y: 25000 },
			{ x: new Date(2017, 0), y: 26000 },
			{ x: new Date(2017, 1), y: 25000 }
		]
 	},
	{
		type: "splineArea", 
		showInLegend: true,
		name: "Completed",
		yValueFormatString: "$#,##0",     
		dataPoints: [
			{ x: new Date(2016, 2), y: 10100 },
			{ x: new Date(2016, 3), y: 6000 },
			{ x: new Date(2016, 4), y: 3400 },
			{ x: new Date(2016, 5), y: 4000 },
			{ x: new Date(2016, 6), y: 9000 },
			{ x: new Date(2016, 7), y: 3900 },
			{ x: new Date(2016, 8), y: 4200 },
			{ x: new Date(2016, 9), y: 5000 },
			{ x: new Date(2016, 10), y: 14300 },
			{ x: new Date(2016, 11), y: 12300 },
			{ x: new Date(2017, 0), y: 8300 },
			{ x: new Date(2017, 1), y: 6300 }
		]
 	}]
});
chart.render();

var chart1 = new CanvasJS.Chart("chartContainer1", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Presale"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: 10.62, label: "Published" },
			{ y: 5.02, label: "Unpublished" },

		]
	}]
});
chart1.render();

var chart = new CanvasJS.Chart("chartContainer2", {
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	exportEnabled: true,
	animationEnabled: true,
	title: {
		text: "Marketing"
	},
	data: [{
		type: "pie",
		startAngle: 25,
		toolTipContent: "<b>{label}</b>: {y}%",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - {y}%",
		dataPoints: [
			{ y: 10.62, label: "Published" },
			{ y: 5.02, label: "Unpublished" },

		]
	}]
});
chart.render();
</script>
@stop
