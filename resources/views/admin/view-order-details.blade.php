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

                <div class="row">
                  <div class="col-md-6">
                  <h5><u>User Details </u></h5>


                <div class="table-responsive">
                  <table class="table text-primary">                        
                      @foreach($orders as $i)
                      <tr>
                        <th>Order Number</th>
                      <td>{{$i->order_no}}</td>
                      </tr>
                      <tr>
                        <th>Name</th>
                      <td>{{$i->name}}</td>
                      </tr>
                      <tr>
                      <th>District</th>
                      <td>{{$address->district}}</td>
                      </tr>
                      <tr>
                      <th>Street Address</th>
                      <td>{{$address->street_address}}</td>
                      </tr>
                      <tr>
                      <th>City</th>
                      <td>{{$address->city}}</td>
                      </tr>
                      <tr>
                      <th>Zip Code</th>
                      <td>{{$address->zip_code ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                      <th>Phone</th>
                      <td>{{$address->phone}}</td>
                      </tr><tr>
                      <th>Email</th>
                      <td>{{$address->email ?? $i->email ?? 'N/A'}}</td>
                      </tr>
                      <tr>
                      <th>Order Status</th>
                      <td class="text-success font-weight-bold">
                        @if($i->order_status == '0')
                        waiting for approval.
                        @elseif($i->order_status == '1')
                        Order Confirmed
                        @elseif($i->order_status == '2')
                        Food Pickup
                        @elseif($i->order_status == '3')
                        Food delivered
                        @endif
                      </td>
                      </tr>
                      @endforeach
                  </table>
                </div>
                 </div>

                 <div class="col-md-6">
                  <h5><u>Order Details </u></h5>

                <div class="table-responsive">
                  <table class="table text-primary">                    
                    
                     <thead class=" text-primary">
                      <th>
                        S.No.
                      </th>
                     
                      <th>
                        Food
                      </th>
                       <th>
                       Food Name
                      </th>
                      <th>
                        Qty
                      </th>
                      <th>
                        Unit Price
                      </th>
                  
                    </thead>
                    <tbody>
                      <?php $i=1; ?>
                      @foreach($orders as $order)

                      <tr>
                        <td>{{$i}}</td>
                        <td><img src="/uploads/{{$order->image}}" height="60" width="100"></td>
                        <td>{{$order->food_name}}</td>
                        <td>{{$order->quantity}}</td>

                        <td>Rs.{{$order->price}}</td>
                      </tr>
                      <?php $i++; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="4">Grand Total</th>
                        <td>Rs.{{$order->price * $order->quantity}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                 </div>
            

                </div><hr>
                <h5 style="text-transform: uppercase;">Change Order Status </h5>
                 <form action="/update-order" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{$order->order_id}}">
                   <select class="form-control" name="os" required>
                    <option value="">Select Order Status</option>
                     <option @if($order->order_status == '1') selected @endif value="1">Order Confirmed</option>
                     <option @if($order->order_status == '2') selected @endif value="2">Food Pickup</option>
                     <option @if($order->order_status == '3') selected @endif value="3">Food delivered</option>
                   </select>

                   <input type="submit" name="submit" value="Update" class="btn btn-danger">
                 </form><br><br>

                      @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>

	
@endsection

     
