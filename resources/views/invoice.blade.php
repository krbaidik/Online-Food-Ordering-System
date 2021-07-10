<!DOCTYPE html>
<html>
<head>
	<title>Orders Invoice</title>
</head>
<body>	

	<div>
		<h4 align="center">Food Ordering System Project Invoice</h4><hr>
	</div>
	<center><h3 style="font-family: cursive;"><span style="color:green;">{{$orders->first()->user->name}}</span>'s Order Details !</h3></center>
            <table class="table-responsive m-auto" border="1" cellspacing="0" cellpadding="10" align="center">

                <tr>
				<th>#Order</th>
				<th>Food Name</th>
				<th>Qty</th>
				<th>Price (Rs)</th>
                </tr>
		 	@foreach($orders as $order)
                    
               <tr>
				<td>#{{$order->order_no}}</td>
				<td>{{$order->food->food_name}}</td>
				<td>{{$order->quantity}}</td>
				<td>{{$order->total_price}}/-</td>
               </tr>
            @endforeach
            	<tr align="left">
                	<th colspan="3">Shipping Charge (Rs)</th>
               		<th>{{$orders->first()->shipping_charge}}/-</th>
              	</tr>
                <tr align="left">
                	<th colspan="3">Total Price (Rs)</th>
                	<th>{{$orders->sum('total_price') + $order->first()->shipping_charge}}/-</th>
                </tr>

            </table>
            <h3 align="center" style="color: green;">Thank you for your order.</h3><br>
            <p class="text-center"><i>food4me.com.np</i></p>
</body>
</html>