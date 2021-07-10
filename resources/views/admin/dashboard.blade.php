@extends('admin.master')

@section('title')
Dashboard
@endsection


@section('dashboard')
active  
@endsection

@section('content')

	<div class="content">
        <div class="row" >
          <div class="col-md-12">
            <div class="card " style="text-transform: uppercase;" >
              <div class="card-header">
                <h4 class="card-title">All Orders Details</h4>
              </div>
              <div class="card-body text- ">
                
                <div class="row p-5 m-2">
                  <div class="col-md-4 p-3">
                    <h5>total order</h5><hr>
                    <h5>{{$data['total_order']}} <sub>total orders</sub></h5>
                  </div>
                  <div class="col-md-4 p-3">
                    <h5>new order</h5><hr>
                    <h5>{{$data['new_order']}}</h5>
                  </div>
                  <div class="col-md-4 p-3">
                    <h5>confirmed order</h5><hr>
                    <h5>{{$data['order_confirmed']}}</h5>
                  </div>
                </div>

                <div class="row p-5 m-2">
                   <div class="col-md-4 p-3">
                    <h5>food pickup</h5><hr>
                    <h5>{{$data['food_pickup']}}</h5>
                  </div>
                  <div class="col-md-4 p-3">
                    <h5>total food delivered</h5><hr>
                    <h5>{{$data['food_delivered']}}</h5>
                  </div>
                  <div class="col-md-4 p-3">
                    <h5>total regd. user</h5><hr>
                    <h5>{{$data['total_regd_users']}}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	
@endsection

     
