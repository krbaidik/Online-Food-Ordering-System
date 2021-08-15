@extends('cmaster')

@section('title')
 FOS | Orders 
@endsection

@section('orderactive')
active
@endsection

@section('content')

<div class="container-fluid jumbotron">
@if(Session::has('success'))
      <p class="alert alert-success">{{Session::get('success')}}</p>
  @endif
@forelse($orders as $order)
<?php if($order->order_status == "food delivered"){ ?>

<?php }else{ ?>


  <div class="row">
    <div class="col-md-8 m-auto">
  <b>Order #{{$order->order_no}}</b><br>

      <hr>

      <img src="uploads/{{$order->food->image ?? 'food4me.jpg'}}" width="140"style="display: inline-block; padding: 4px; height: 140px !important;" align="left"><br>

          <div style="display: inline-block;">
            <p class="font-weight-bold text-danger">{{$order->food->food_name}}</p>
            <p><b>Order Date: </b>{{$order->created_at}}</p>
            <p><b>Status:</b> @if($order->order_status == '0')
                <span class="text-danger">Waiting for approval.</span>
              @elseif($order->order_status == '1')
              <span class="text-danger">Order Confirmed.</span>
              @elseif($order->order_status == '2')
              <span class="text-danger">Food Pickup.</span>
              @elseif($order->order_status == '3')
              <span class="text-danger">Food delivered.</span>
              @endif
            </p>
            <p><b>Quantity: </b>{{$order->quantity}}</p>
            <p class="font-weight-bold text-success"><u>Rs.{{$order->total_price}}</u></p>
            <p><b>Payment Method: </b>@if($order->payment_method == '1') Cash on delivery @elseif($order->payment_method == '2') eSewa @endif</p>
            <p><b>Payment_status: </b>@if($order->payment_status == '0') <span class="text-danger"> payment remaining..</span> @elseif($order->payment_status == '1') <span class="text-success">Payment done</span> @endif</p>
            @if($order->payment_method != '2' && $order->order_status =='0')
            <p><a href="/cancel_order/{{$order->id}}" class="btn btn-outline-danger">Cancel this order</a></p>
            @endif
          </div>
 </div>
</div>

<?php } ?>
      @empty
      <h3 align="center">No Orders</h3>
<h4 align="center">Click <a href="/">here</a> to order food.</h4>
      @endforelse

      @if(count($orders) != 0)
        <p style="display: flex; justify-content: center; padding: 8px;"><a href="/order-details" class="btn btn-outline-primary">View Details</a></p>
      @endif
 
</div>


<div class="container-fluid jumbotron">
  <div class="row">
    <div class="col-md-8 m-auto">
      
      <h4>Recent Orders </h4>
<div class="table-responsive">
                  <table class="table text-danger table-bordered">                    
                    
                     <thead class=" text-danger">
                      <th>
                        #
                      </th>
                       <th>
                        order_no
                      </th>
                     
                      <th>
                        Food
                      </th>
                       <th>
                       Food Name
                      </th>
                      <th>
                       Quantity
                      </th>
                      <th>
                       Total Price
                      </th>
                  
                    </thead>
                    <tbody>
                  @forelse($recentorder as $index => $order)

                      <tr>
                        <td>{{$index+1}}</td>
                        <td>#{{$order->order_no}}</td>
                        <td><img src="/uploads/{{$order->image ?? 'food4me.jpg'}}" width="100" style="height:90px !important;"></td>
                        <td>{{$order->food_name}}</td>
                        <td>{{$order->quantity}}</td>

                        <td>Rs.{{$order->total_price}}</td>
                      </tr>
                    </tbody>
                    @empty
                    <td colspan="6"> No recent Orders</td>
                  @endforelse

                    <tfoot>
                      <tr class="border border-red">
                        <th colspan="5">Grand Total</th>
                        <td ><b>Rs.{{$rtotal}}</b></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
    </div>
  </div>
</div>





@endsection
