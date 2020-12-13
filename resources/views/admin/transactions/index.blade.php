@extends('layouts.admin')

@section('content')

<!-- Simple Datatable start -->
   <div class="card-box mb-30">
      <div class="pd-20">
         <h4 class="text-dark h4">Transactions List</h4>
      </div>
      <div class="pb-20">
         <table class="data-table table stripe hover nowrap">
            <thead>
               <tr>
                  <th class="table-plus datatable-nosort">Id</th>
                  <th>Order Id</th>
                  <th>Amount</th>
                  <th>Payment Id</th>
                  <th>Payer Email</th>
                  <th>Merchant Id</th>
                  <th>Payment Status</th>
                  <th>Payer Id</th>
                  <th>Transaction Datetime</th>
               </tr>
            </thead>
            <tbody>

               @foreach($transactions as $transaction)
               <tr>
                  <td class="table-plus">{{$transaction->id}}</td>
                  <td>{{$transaction->order_id}}</td>
                  <td>{{$transaction->amount}}</td>
                  <td>{{$transaction->payment_id}}</td>
                  <td>{{$transaction->payer_email}}</td>
                  <td>{{$transaction->merchant_id}}</td>
                  <td>{{ucwords($transaction->payment_status)}}</td>
                  <td>{{$transaction->payer_id}}</td>
                  <td>{{date("j F Y g:i A",strtotime($transaction->created_at))}}</td>
               </tr>
               @endforeach

            </tbody>
         </table>
      </div>
   </div>

@stop
