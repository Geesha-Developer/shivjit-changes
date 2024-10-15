@extends('layouts.broker.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
 <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<style>
.tab {
    background: #c7c7c6;
}

.tab button {
  background: #a5a5a5;
    float: left;
    border: none;
    cursor: pointer;
    transition: 0.3s;
    font-size: 15px;
    padding: 9px;
    border-radius: 6px;
    margin: 0 6px;
    font-weight: 500;
}

.tab button:hover {
    border: 1px solid #ccc !important;
    border-radius: 6px;
    background: #555555 !important;
    color: #fff !important;
}
.tab button.active {
  background: #555555 !important;
  color:#fff;
}

.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
select.broker-list {
  margin-left: 10px;
    padding: 5px 13px;
    border-radius: 8px;;
}
.broker-menu {
    padding: 9px 0;
}
</style>
</head>
<body>
    

<section class="content">
<div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Agent Data</h2>
                </div>
            </div>
        </div>
<div class="tab d-flex" style="justify-content: space-between;align-items: center;">
  <div>
    <select class="broker-list">
        <option value="">
          Select Broker
        </option>
        @foreach($brokers as $broker)
          <option value="{{$broker->id}}">
              {{$broker->name}}
          </option>
        @endforeach
    </select>  
  </div>
  <div class="broker-menu" style="display:none"> 
    <button class="tablinks all-data" onclick="openCity(event, 'All')" id="defaultOpen">All</button>
    <button class="tablinks customer-data" onclick="openCity(event, 'Customer')">Customer</button>
    <button class="tablinks carrier-data" onclick="openCity(event, 'Carrier')">Carrier</button>
    <button class="tablinks shipper-data" onclick="openCity(event, 'Shipper')">Shipper</button>
    <button class="tablinks consignee-data" onclick="openCity(event, 'Consignee')">Consignee</button>
    <button class="tablinks load-data" onclick="openCity(event, 'Load')">Load</button>
  </div>
</div>
<div id="All" class="tabcontent">
  <h3>ALL Load Data</h3>
  <div class="content">
      <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
      </div>
        <div class="data-table-content">
          <table class="load-table">
            <thead>
              <tr>
                <!-- <th><input type="checkbox" id="select-invoice"></th> -->
                <th>Load #</th>
                <th>W/O #</th>
                <th>Customer Refrence #</th>
                <th>Customer #</th>
                <th>Load Create Date</th>
                <th>Shipper Date</th>
                <th>Deliver date</th>
                <th>Carrier</th>
                <th>Pickup Location</th>
                <th>Unloading Location</th>
                <th>Actual Del Date</th>
                <th>Load Status</th>
                <th>Margin</th>
                <th>Aging</th>
                <th>CPR Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- DataTables will populate this -->
            </tbody>
          </table>
        </div>
      <div>
    </div>
  </div>  
</div>
<div id="Customer" class="tabcontent">
  <h3>Customer</h3>
  <div class="content">
    <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
      </div>
      <div class="data-table-content">
        <table class="customer-table">
          <thead>
            <tr>
              <!-- <th><input type="checkbox" id="select-invoice"></th> -->
              <th>#</th>
              <th>Customer Name</th>
              <th>Customer Address</th>
              <th>Customer Country</th>
              <th>Customer State</th>
              <th>Customer city</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
              <!-- DataTables will populate this -->
          </tbody>
        </table>
      </div>
  </div>
</div>
      
<div id="Carrier" class="tabcontent">
<h3>Consignee</h3>
  <div class="content">
    <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
    </div>
    <div class="data-table-content">
      <table class="carrier-table">
        <thead>
          <tr>
            <!-- <th><input type="checkbox" id="select-invoice"></th> -->
            <th>#</th>
            <th>Consignee Name</th>
            <th>Consignee Address</th>
            <th>Consignee Country</th>
            <th>Consignee State</th>
            <th>Consignee city</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <!-- DataTables will populate this -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="Shipper" class="tabcontent">
<h3>Shipper</h3>
  <div class="content">
    <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
    </div>
    <div class="data-table-content">
      <table class="shipper-table">
        <thead>
          <tr>
            <!-- <th><input type="checkbox" id="select-invoice"></th> -->
            <th>#</th>
            <th>Shipper Name</th>
            <th>Shipper Address</th>
            <th>Shipper Country</th>
            <th>Shipper State</th>
            <th>Shipper city</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <!-- DataTables will populate this -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="Consignee" class="tabcontent">
  <h3>Consignee</h3>
  <div class="content">
    <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
    </div>
    <div class="data-table-content">
      <table class="consignee-table">
        <thead>
          <tr>
            <!-- <th><input type="checkbox" id="select-invoice"></th> -->
            <th>#</th>
            <th>Consignee Name</th>
            <th>Consignee Address</th>
            <th>Consignee Country</th>
            <th>Consignee State</th>
            <th>Consignee city</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <!-- DataTables will populate this -->
        </tbody>
      </table>
    </div>
  </div>
</div>

<div id="Load" class="tabcontent">
  <h3>ALL Load Data</h3>
  <div class="content">
      <div class="crud-list">
        <!-- Links for the creation and other actions goes here -->
      </div>
        <div class="data-table-content">
          <table class="load-table">
            <thead>
              <tr>
                <!-- <th><input type="checkbox" id="select-invoice"></th> -->
                <th>Load #</th>
                <th>W/O #</th>
                <th>Customer Refrence #</th>
                <th>Customer #</th>
                <th>Load Create Date</th>
                <th>Shipper Date</th>
                <th>Deliver date</th>
                <th>Carrier</th>
                <th>Pickup Location</th>
                <th>Unloading Location</th>
                <th>Actual Del Date</th>
                <th>Load Status</th>
                <th>Margin</th>
                <th>Aging</th>
                <th>CPR Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- DataTables will populate this -->
            </tbody>
          </table>
        </div>
      <div>
    </div>
  </div>  
</div>
</section>
<script>
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  // getLoadData();
}
// document.getElementById("defaultOpen").click();
$('.broker-list').on('change',function(){
  if($(this).val() == "")
  {
    $('.broker-menu').hide();
  }
  else{
    $('.broker-menu').show();
  }
});
/**
 * Data Table Loaders STarts from here
 */
$('.all-data').on('click',function(){
  destroyDataTableIfExists('load-table');
  getLoadData();
});
$('.customer-data').on('click',function(){
  destroyDataTableIfExists('customer-table');
  getCustomerData();
});
$('.load-data').on('click',function(){
  destroyDataTableIfExists('load-table');
  getLoadData();
});
$('.consignee-data').on('click',function(){
  // consignee-table
  destroyDataTableIfExists('consignee-table');
  getConsigneeData();
});
$('.shipper-data').on('click',function(){
  // consignee-table
  destroyDataTableIfExists('shipper-table');
  getShipperData();
});
$('.carrier-data').on('click',function(){
  destroyDataTableIfExists('carrier-table');
  getCarrierData();
})


function getCarrierData(){
  $('.carrier-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('carrier-agent.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = $('.broker-list').val();
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'carrier_name', name: 'carrier_name' },
        // { data: 'customer_refrence_number', name: 'customer_refrence_number' },
        { data: 'carrier_address', name: 'carrier_address' },
        { data: 'carrier_country', name: 'carrier_country' },
        { data: 'carrier_state', name: 'carrier_state' },
        { data: 'carrier_city', name: 'carrier_city' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}
function getShipperData(){
  $('.shipper-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('shipper-agent.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = $('.broker-list').val();
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'shipper_name', name: 'shipper_name' },
        // { data: 'customer_refrence_number', name: 'customer_refrence_number' },
        { data: 'shipper_address', name: 'shipper_address' },
        { data: 'shipper_country', name: 'shipper_country' },
        { data: 'shipper_state', name: 'shipper_state' },
        { data: 'shipper_city', name: 'shipper_city' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}

function getConsigneeData(){
  $('.consignee-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('consginee.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = $('.broker-list').val();
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'consignee_name', name: 'consignee_name' },
        // { data: 'customer_refrence_number', name: 'customer_refrence_number' },
        { data: 'consignee_address', name: 'consignee_address' },
        { data: 'consignee_country', name: 'consignee_country' },
        { data: 'consignee_state', name: 'consignee_state' },
        { data: 'consignee_city', name: 'consignee_city' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}
//function to get the load data for all
function getLoadData() {
  $('.load-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('loads.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = $('.broker-list').val();
        }
    },
    columns: [
        { data: 'load_number', name: 'load_number' },
        { data: 'load_workorder', name: 'load_workorder' },
        { data: 'customer_refrence_number', name: 'customer_refrence_number' },
        { data: 'load_bill_to', name: 'load_bill_to' },
        { data: 'created_at', name: 'created_at' },
        { data: 'created_at', name: 'created_at' },
        { data: 'created_at', name: 'created_at' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_carrier', name: 'load_carrier' },
        { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        { data: 'load_status', name: 'load_status' },
        { data: 'load_status', name: 'load_status' },
        { data: 'load_status', name: 'load_status' },
        { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}

function destroyDataTableIfExists(tableClass) {
    if ($.fn.DataTable.isDataTable(`.${tableClass}`)) {
        $(`.${tableClass}`).DataTable().clear().destroy();
    }
}

function getCustomerData() {
  $('.customer-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '{{ route('customers.data') }}',
        type: 'GET',
        data: function(d) {
            d.id = $('.broker-list').val();
        }
    },
    columns: [
        { data: 'id', name: 'id' },
        { data: 'customer_name', name: 'customer_name' },
        { data: 'customer_address', name: 'customer_address' },
        { data: 'customer_country', name: 'customer_country' },
        { data: 'customer_state', name: 'customer_state' },
        { data: 'customer_city', name: 'customer_city' },
        // { data: 'created_at', name: 'created_at' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_carrier', name: 'load_carrier' },
        // { data: 'load_actual_delivery_date', name: 'load_actual_delivery_date' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'load_status', name: 'load_status' },
        // { data: 'cpr_check', name: 'cpr_check' },
        { data: 'action', name: 'action', orderable: false, searchable: false }
    ]
  });
}

</script>
   
@endsection