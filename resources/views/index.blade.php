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
        <div class="row bg_white">
          <div class="col-md-6">
             <div id="chartContainer" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
          </div>
          <div class="col-md-3">
             <div id="chartContainer2" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
          </div>
          <div class="col-md-3">
             <div id="chartContainer3" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
          </div>
       </div>
       <div class="row">
        <div class="col-md-12">
           <div id="chartContainer4" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
        </div>
     </div>
     <div class="row">
      <div class="col-md-6">
         <div id="chartContainer5" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
      </div>
      <div class="col-md-6">
         <div class="assienment">
            <div class="assigndatashow">
               <h2>Assigned</h2>
               <h3>5</h3>
            </div>
            <div class="row margindown">
               <div class="col-md-6">
                  <div class="presale">
                     <h2>Presale</h2>
                     <h3>5</h3>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="presale">
                     <h2>Marketing</h2>
                     <h3>5</h3>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="lastbtn">
                     <button class="btn btn-primary last">Yesterday</button><button class="btn btn-primary last datashow">Last Week</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
    <div class="col-md-12">
       <div class="rating">
          <h2>Call Record & History</h2>
          <div class="scrolltable">
             <p>Support
             <p>
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
             <p>Presale
             <p>
             <table class="table custom_table">
                <thead class="thead-dark">
                   <tr>
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
         	axisX:{
         		title: "",
         		minimum: -0.02,
         		maximum: 3.02
         	},
         	toolTip:{
         		shared: true
         	},
         	data: [
         	{
         		type: "stackedArea100",
         		name: "Presale",
         		showInLegend: "true",
         		dataPoints: [
         			{ y: 45120 , label: "Spring" },
         			{ y: 50350, label: "Summer" },
         			{ y: 48410, label: "Autumn" },
         			{ y: 53120, label: "Fall" }
         		]
         	},
         	{
         		type: "stackedArea100",
         		name: "Marketing",
         		showInLegend: "true",
         		dataPoints: [
         			{ y: 11050, label: "Spring" },
         			{ y: 16100, label: "Summer" },
         			{ y: 15010, label: "Autumn" },
         			{ y: 23100, label: "Fall" }
         		]
         	}]
         });
         chart.render();
         
         var chart = new CanvasJS.Chart("chartContainer2", {
         	theme: "light2", // "light1", "light2", "dark1", "dark2"
         	exportEnabled: true,
         	animationEnabled: true,
         	title: {
         		text: "pre-sale"
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
         			{ y: 51.08, label: "Finshed" },
         			{ y: 10.62, label: "pending" },
         		
         		]
         	}]
         });
         chart.render();
         
         var chart = new CanvasJS.Chart("chartContainer3", {
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
         			{ y: 51.08, label: "Finshed" },
         			{ y: 10.62, label: "pending" },
         		
         		]
         	}]
         });
         chart.render();
         
         
         var chart = new CanvasJS.Chart("chartContainer4", {
         	animationEnabled: true,
         	title:{
         		text: ""
         	},
         	axisX:{
         		title: "",
         		minimum: -0.02,
         		maximum: 3.02
         	},
         	toolTip:{
         		shared: true
         	},
         	data: [
         	{
         		type: "stackedArea100",
         		name: "Call received",
         		showInLegend: "true",
         		dataPoints: [
         			{ y: 45120 , label: "Spring" },
         			{ y: 50350, label: "Summer" },
         			{ y: 48410, label: "Autumn" },
         			{ y: 53120, label: "Fall" }
         		]
         	},
         	{
         		type: "stackedArea100",
         		name: "Missed",
         		showInLegend: "true",
         		dataPoints: [
         			{ y: 11050, label: "Spring" },
         			{ y: 16100, label: "Summer" },
         			{ y: 15010, label: "Autumn" },
         			{ y: 23100, label: "Fall" }
         		]
         	}]
         });
         chart.render();
         
         var chart = new CanvasJS.Chart("chartContainer5", {
         	theme: "light2", // "light1", "light2", "dark1", "dark2"
         	exportEnabled: true,
         	animationEnabled: true,
         	title: {
         		
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
         			{ y: 51.08, label: "callback" },
         			{ y: 27.34, label: "received" },
         			{ y: 10.62, label: "Missed" },
         		
         		]
         	}]
         });
         chart.render();
</script>
@stop
