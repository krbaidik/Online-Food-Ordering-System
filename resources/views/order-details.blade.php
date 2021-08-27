@extends('cmaster')

@section('title')
 FOS | Orders 
@endsection

@section('content')

<div class="content text-primary">
        <div class="row" style="height: 800px">
          <div class="col-md-12">
              <div class="card-header">
                <h4 class="card-title"> Order Detail</h4>
              </div><hr>

              <div class="card-body text-success">

                <div class="row">
                  <div class="col-md-8 p-5">
                  <h5><u>Your Orders delicious Hot Food ! </u></h5><br>

                <div class="table-responsive">
                  <table class="table table-bordered">                    
                    
                     <thead>                     
                      <th >
                        Order No(#)
                      </th>
                      <th >
                        Image
                      </th>
                       <th colspan="2">
                       Food Name
                      </th>
                      <th>
                       Quantity
                      </th>
                      <th>
                       Price
                      </th>
                      <th>
                       Payment
                      </th>
                  
                    </thead>
                    <tbody>
                      @forelse($order_details as $order)

                      <tr>
                        <td>#{{ $order->order_no}}</td>
                        <td ><img src="/uploads/{{$order->food->image ?? 'food4me.jpg'}}" width="100" style="height: 100px !important;"></td>
                        <td colspan="2"><b>{{$order->food->food_name}}<br> </b>{{$order->food->description}}<br>
                          <td><b>{{$order->quantity}}</b><br>
                        </td>

                        <td><b>Rs. {{$order->total_price}}</b></td>
                        <td><b>@if($order->payment_status == '0') <span class="text-danger">remaining.</span> @elseif($order->payment_status == '1') <span class="text-success">done.</span> @endif</b></td>
                      </tr>
                      @empty
                      <td colspan="6" class="alert alert-danger">No Any Items</td>
                     @endforelse

                    </tbody>
                  </table>
                </div>
                 </div>

                 <div class="col-md-4 border border-warning pt-2">
                  <h4 class="text-center">Shipping Address</h4>

                  <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th>District</th>
                      <td>{{$address->district->name}}</td>
                    </tr>
                    <tr>
                      <th>Street Address</th>
                      <td>{{$address->street_address}}</td>
                    </tr>
                    <tr>
                      <th>City</th>
                      <td>{{$address->city->name}}</td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td>{{$address->phone}}</td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td>{{$address->email ?? 'N/A'}}</td>
                    </tr>
                  </table>
                </div><hr>
                    <br>
                <center> 
                  <form action="/invoice" method="post">
                    @csrf
                    <input type="submit" name="submit" value="INVOICE" class="btn btn-outline-danger">
                  </form><br>
                <p class="alert alert-danger"><b>Shipping Charge :- Rs.{{$sc = $order_details->first()->shipping_charge}}</b></p>
                <p class="alert alert-success"><b>Total Price :- Rs.{{$order_details->sum('total_price') + $sc}}</b></p>
                 </center>                  
                 </div>
            

                </div>
              </div>
          </div>
        </div>
      </div>
 
</div>


@endsection

