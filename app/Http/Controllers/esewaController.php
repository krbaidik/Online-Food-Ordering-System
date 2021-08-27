<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Order;
use Illuminate\Support\Facades\Session;

class esewaController extends Controller
{
    public function success(Request $req){
    	if (isset($req->refId) && isset($req->amt) && isset($req->oid)) {
    		$url = "https://uat.esewa.com.np/epay/transrec";
		$data =[
		    'amt'=> $req->amt,
		    'rid'=> $req->refId,
		    'pid'=> $req->oid,
		    'scd'=> 'EPAYTEST'
		];

	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    $response = curl_exec($curl);
	    curl_close($curl);
	    $response_code = $this->get_xml_node_value('response_code', $response);
	    if(trim($response_code) == 'Success'){
	    	$carts = Cart::content();

        foreach($carts as $cart){
            $order = Order::create([
                'u_id' => auth()->user()->id,
                'f_id' => $cart->id,
                'order_no' => random_int(000000, 999999),
                'order_status' => '0',
                'quantity' => $cart->qty,
                'shipping_charge' => '50',
                'total_price' => $cart->price * $cart->qty,
                'payment_method' => '2',
                'payment_status' => '1',
            ]);

            }
            if($order){
            	Session::pull('cart');
            	return redirect()->route('myorders')->with('success','payment success and order placed!');
            }
	    }
    }

  }

    public function fail(Request $req){
    	return redirect()->route('myorders')->with('success','payment Failed and your order is could not be saved! Try again !');
    }

    public function get_xml_node_value($node,$xml){
    	if($xml == false){
    		return false;
    	}
    	$found = preg_match('#<'.$node.'(?:\s+[^>]+)?>(.*?)'.'</'.$node.'>#s',$xml,$matches);
    	if($found != false){
    		return $matches[1];
    	}
    	return false;
    }
}
