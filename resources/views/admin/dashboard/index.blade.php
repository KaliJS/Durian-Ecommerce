@extends('layouts.admin')

@section('content')

<div class="container-fluid">
   <div class="row">
            <div class="col-xl-3 mb-30">
               <div class="card-box height-100-p widget-style1">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="progress-data">
                        <div id="chart"></div>
                     </div>
                     <div class="widget-data">
                        <div class="h4 mb-0">{{$users}}</div>
                        <div class="weight-600 font-14">Total Users</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 mb-30">
               <div class="card-box height-100-p widget-style1">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="progress-data">
                        <div id="chart2"></div>
                     </div>
                     <div class="widget-data">
                        <div class="h4 mb-0">{{$orders}}</div>
                        <div class="weight-600 font-14">Total Orders</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 mb-30">
               <div class="card-box height-100-p widget-style1">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="progress-data">
                        <div id="chart3"></div>
                     </div>
                     <div class="widget-data">
                        <div class="h4 mb-0">{{$products}}</div>
                        <div class="weight-600 font-14">Total Products</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 mb-30">
               <div class="card-box height-100-p widget-style1">
                  <div class="d-flex flex-wrap align-items-center">
                     <div class="progress-data">
                        <div id="chart4"></div>
                     </div>
                     <div class="widget-data">
                        <div class="h4 mb-0">{{$remaining_orders}}</div>
                        <div class="weight-600 font-14">Remaining Orders</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
</div>

@stop