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
    <div class="row">
    <div class="col-lg-12 col-12 mb-4">
    <div class="card">
    <div class="card-body text-center">
    <h2>Orders</h2>
    <div class="table-responsive">
    <table class="table table-hover">
    <thead>
      <tr>
        <th>Order#</th>
        <th>Company Name</th>
        <th>Area</th>
        <th>City</th>
        <th>Address</th>
        <th>Contact</th>
        <th>Email</th>
        <th>Industry</th>
        <th>Assigned Date</th>
        <th>Remarks</th>
        <th><button onclick="showaddCallModal('support');"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
      </tr>
    </thead>
    <tbody id="order_body">
    </tbody>
  </table>
  </div>
    </div>
    </div>
    </div>
    </div>
@stop

@section('javascript')
<script>
getOrders();
// let allCalls = San_Helpers.getCalls("{{route('calls.index')}}");
function getOrders(){
  axios.get("{{route('orders.index')}}").then((res) => {
    let orders = res.data.detail;
    let minifyHtml = '';
    $.each(orders, function( index, call ) {
      minifyHtml = '<tr><td>'+call.orderno+'</td><td>'+call.area+'</td><td>'+call.city+'</td><td>'+call.company+'</td><td>'+call.address+'</td><td>'+call.contact+'</td><td>'+call.email+'</td><td>'+call.industry+'</td><td>'+call.assigned_date+'</td><td><button><i class="fa fa-pencil" aria-hidden="true"></i></button></td></tr>';
      $('#order_body').append(minifyHtml);
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
    $('#order_body').append(minifyHtml);
    $('#addCall').modal('hide');
    toastr.success(response.data.msg);
  }).catch((error) => {
    toastr.error("toastr alert-type " + error.response.data.msg + " is unknown");
    console.log(error);
  });
  return false;
})
// $('#date_time_picker').datetimepicker();
</script>
@stop
