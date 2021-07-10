@extends('admin.master')

@section('title')
Food Menu
@endsection


@section('orders')
  active
@endsection

@section('content')

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Orders</h4>
              </div><hr>
              <div class="card-body">
                <h>Orders / Filter</h5>
                <div class="row m-auto">
              <div class="col-md-2">           
                <form action="/search" method="post">
                  @csrf
                 <input type="hidden" name="search" value="">
                 <button class="btn btn-primary" type="submit">All Orders</button> 
                </form>
              </div>
                  <div class="col-md-2">           
              	<form action="/search" method="post">
                  @csrf
                 <input type="hidden" name="search" value="0">
                 <button class="btn btn-primary" type="submit">Not Confirmed</button> 
                </form>
              </div>
              <div class="col-md-2">           
                <form action="/search" method="post">
                  @csrf
                 <input type="hidden" name="search" value="1">
                 <button class="btn btn-primary" type="submit">Confirmed</button> 
                </form>
              </div>
              <div class="col-md-2">           
                <form action="/search" method="post">
                  @csrf
                 <input type="hidden" name="search" value="2">
                 <button class="btn btn-primary" type="submit">Food Pickup</button> 
                </form>
              </div>
              <div class="col-md-2">           
                <form action="/search" method="post">
                  @csrf
                 <input type="hidden" name="search" value="3">
                 <button class="btn btn-primary" type="submit">Food Delivered</button> 
                </form>
              </div>
                <div class="table-responsive">
                	<h4><u>All Orders</u></h4>
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        S.No.
                      </th>
                     
                      <th>
                        Order Number
                      </th>
                       <th>
                       Customer
                      </th>
                      <th>
                        Order Date
                      </th>
                      
                      <th class="text-right" colspan="2">
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      @foreach($orders as $order)

                      <tr>
                        <td>{{$i}}</td>
                        <td>{{$order->order_no}}</td>
                        <td>{{$order->name}}</td>

                        <td>{{$order->created_at}}</td>
                        <td><a href="view-order-details/{{$order->order_id}}">View Details</a></td>
                      </tr>
                      <?php $i++; ?>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	
@endsection

     
