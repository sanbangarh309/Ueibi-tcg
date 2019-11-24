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

       {{-- Charts HTML --}}
       <div class="row" >
         <div class="col-md-6">
            <div class="colmn_1 white_bg boxside">
               <div id="chartContainer" style="height: 250px;width:100%;"></div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="row colmn_1 white_bg boxside">
               <div class="col-md-6">
                  <h3 class="text-center font_16 mar_b0">Pre Sales</h3>
                  <div id="chartContainer2" style="height: 210px;width:100%;"></div>
               </div>
               <div class="col-md-6">
                  <h3 class="text-center font_16 mar_b0">Marketing</h3>
                  <div id="chartContainer3" style="height: 210px;width:100%;"></div>
               </div>
            </div>
         </div>
      </div>
      {{-- End Chart HTML --}}
      {{-- Middle Section --}}
      <div class="colmn_1 white_bg boxside">
         <div id="chartContainer5" style="height: 200px;width:100%;margin-bottom: 25px;"></div>
         <div class="row">
         <div class="col-md-9">
               <div class="assienment">
                  <div class="assigndatashow">
                     <div class="width_100">
                        <h2>Assigned</h2>
                        <h3>5</h3>
                     </div>
                  </div>
                  <div class="margindown">
                     <div class="">
                        <div class="presale mar_b20">
                           <h2>Presale</h2>
                           <h3>5</h3>
                        </div>
                     </div>
                     <div class="">
                        <div class="presale">
                           <h2>Marketing</h2>
                           <h3>5</h3>
                        </div>
                     </div>
                  </div>
                  <div class="margindown">
                     <div class="">
                        <div class="presale mar_b20">
                           <h2>Presale</h2>
                           <h3>5</h3>
                        </div>
                     </div>
                     <div class="">
                        <div class="presale">
                           <h2>Marketing</h2>
                           <h3>5</h3>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3">
               <div id="chartContainer4" style="height: 250px;width:100%;margin: 0 0 25px;"></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 text-left">
               <div class="lastbtn">
                  <button class="btn btn-primary last">Yesterday</button><button class="btn btn-primary last datashow">Last Week</button>
               </div>
            </div>
         </div>
      </div>
      {{-- End Middle Section --}}
      {{-- Table Part --}}
      <div class="row">
            <div class="col-md-12">
               <div class="rating">
                  <h2>Call Record & History</h2>
                  <div class="scrolltable">
                     <p>Support</p>
                     <table class="table custom_table">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col" class="table_5">Call#</th>
                              <th scope="col" class="table_10">Phone no</th>
                              <th scope="col" class="table_10">Person name</th>
                              <th scope="col" class="table_15">Copany</th>
                              <th scope="col" class="table_10">City</th>
                              <th scope="col" class="table_10">Website</th>
                              <th scope="col" class="table_10">Status</th>
                              <th scope="col" class="table_10">Date &amp; Time</th>
                              <th scope="col" class="table_5">No of calls</th>
                              <th scope="col" class="table_10">Remark</th>
                              <th scope="col" class="table_5"><button onclick="showaddCallModal('support');"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                           </tr>
                        </thead>
                        <tbody id="support_body">
                        </tbody>
                     </table>
                  </div>
                  <div class="scrolltable">
                     <p>Marketing & Pre-sales</p>
                     <table class="table custom_table">
                        <thead class="thead-dark">
                           <tr>
                              <th scope="col" class="table_5">Call#</th>
                              <th scope="col" class="table_10">Phone no</th>
                              <th scope="col" class="table_10">Person name</th>
                              <th scope="col" class="table_15">Copany</th>
                              <th scope="col" class="table_10">City</th>
                              <th scope="col" class="table_10">Website</th>
                              <th scope="col" class="table_10">Status</th>
                              <th scope="col" class="table_10">Date &amp; Time</th>
                              <th scope="col" class="table_5">No of calls</th>
                              <th scope="col" class="table_10">Remark</th>
                              <th scope="col" class="table_5"><i class="fa fa-phone font_phone" aria-hidden="true"></i></th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="table_5">C12005</td>
                              <td class="table_10">8088911670</td>
                              <td class="table_10">Deepak sharma</td>
                              <td class="table_15">HArishankar bhambham bhole Pvt Ltd</td>
                              <td class="table_10">Chandigarh</td>
                              <td class="table_10">www.harishankar.com</td>
                              <td class="table_10"><a href="" class="table_btn bg_green">Self-Name</a></td>
                              <td class="table_10">
                                 <span class="dis_block">11:20PM</span>
                                 <span class="dis_block">27/09/1990</span>
                              </td>
                              <td class="table_5"><a href="" class="table_btn bg_green">10</a></td>
                              <td class="table_10"><input type="text" name="" class="custom_width"></td>
                              <td class="table_5"><i class="fa fa-clipboard" aria-hidden="true" style="font-size: 20px;"></i></td>
                           </tr>
                           <tr>
                              <td class="table_5">C12005</td>
                              <td class="table_10">8088911670</td>
                              <td class="table_10">Deepak sharma</td>
                              <td class="table_15">HArishankar bhambham bhole Pvt Ltd</td>
                              <td class="table_10">Chandigarh</td>
                              <td class="table_10">www.harishankar.com</td>
                              <td class="table_10"><a href="" class="table_btn bg_green">Self-Name</a></td>
                              <td class="table_10">
                                 <span class="dis_block">11:20PM</span>
                                 <span class="dis_block">27/09/1990</span>
                              </td>
                              <td class="table_5">10</td>
                              <td class="table_10"><input type="text" name="" class="custom_width"></td>
                              <td class="table_5"><i class="fa fa-clipboard" aria-hidden="true" style="font-size: 20px;"></i></td>
                           </tr>

                        </tbody>
                     </table>
                  </div>
                  
               </div>
            </div>
         </div>
      {{-- End Table Part --}}
       <div class="row">
        <div class="col-md-12">
           <div id="chartContainer4" style="height: 370px;width:100%;margin: 0 0 25px;"></div>
        </div>
     </div>
     
   <div class="row">
    <div class="col-md-12">
       <div class="rating">
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
   animationEnabled: true,
   title:{
      text: "",
      horizontalAlign: "left"
   },
   data: [{
      type: "doughnut",
      startAngle: 60,
      //innerRadius: 60,
      indexLabelFontSize: 17,
      //indexLabel: "{label} - #percent%",
      toolTipContent: "<b>{label}:</b> {y} (#percent%)",
      dataPoints: [
         { y: 67, },
         { y: 28, },
         { y: 10, },
         //{ y: 7, },
         //{ y: 15, },
         //{ y: 6, }
      ]
   }]
});
chart.render();
         
var chart = new CanvasJS.Chart("chartContainer3", {
   animationEnabled: true,
   title:{
      text: "",
      horizontalAlign: "left"
   },
   data: [{
      type: "doughnut",
      startAngle: 60,
      //innerRadius: 60,
      indexLabelFontSize: 17,
      //indexLabel: "{label} - #percent%",
      toolTipContent: "<b>{label}:</b> {y} (#percent%)",
      dataPoints: [
         { y: 67, },
         { y: 28, },
         { y: 10, },
         //{ y: 7, },
         //{ y: 15, },
         //{ y: 6, }
      ]
   }]
});
chart.render();

var chart = new CanvasJS.Chart("chartContainer4", {
   animationEnabled: true,
   title:{
      text: "",
      horizontalAlign: "left"
   },
   data: [{
      type: "doughnut",
      startAngle: 60,
      //innerRadius: 60,
      indexLabelFontSize: 17,
      //indexLabel: "{label} - #percent%",
      toolTipContent: "<b>{label}:</b> {y} (#percent%)",
      dataPoints: [
         { y: 67, },
         { y: 28, },
         { y: 10, },
         //{ y: 7, },
         //{ y: 15, },
         //{ y: 6, }
      ]
   }]
});
chart.render();
         
var chart = new CanvasJS.Chart("chartContainer5", {
   animationEnabled: true,
   theme: "light2",
   title:{
      text: ""
   },
   axisY:{
      includeZero: false
   },
   data: [{        
      type: "line",       
      dataPoints: [
         { y: 450 },
         { y: 414},
         { y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
         { y: 460 },
         { y: 450 },
         { y: 500 },
         { y: 480 },
         { y: 480 },
         { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
         { y: 500 },
         { y: 480 },
         { y: 510 }
      ]
   },
   {        
      type: "line",       
      dataPoints: [
         { y: 450 },
         { y: 414},
         { y: 420, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
         { y: 460 },
         { y: 450 },
         { y: 500 },
         { y: 440 },
         { y: 480 },
         { y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
         { y: 560 },
         { y: 780 },
         { y: 810 }
      ]
   }
   ]
});
chart.render();
</script>
@stop
