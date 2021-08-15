<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Category;
use App\District;
use App\City;
use App\Food;
use App\Order;
use App\Address;
use Nexmo\Laravel\Facade\Nexmo;

class DashboardController extends Controller
{
    function aboutUs(){
            return view('about_us');
    }
 function howToOrder(){
            return view('how_to_order');
    }

    function registered(){
    	$data = User::all();

    	return view('admin.registered',['data'=>$data]);
    }

    function userdelete(Request $req){
    	$user = User::find($req->id);

    	$user->delete();
    	return redirect('registered');
    }

     function useredit($id){
    	$user = User::find($id);

    	return view('admin.useredit',['user'=>$user]);
    }

    function submitform(Request $req){
        $data = User::find($req->id);

        $data->name = $req->name;
        $data->email = $req->email;
        $data->usertype = $req->usertype;

        $data->save();

        return redirect('registered')->with('status','Updated Successfully !! ');
    }

    function foodcategory(){

        $category = Category::all();
        return view('admin.foodcategory',['category'=>$category]);
    }

    function submitcategory(Request $req){
        $category = new Category();

        $category->category = $req->category;
        $category->save();

        return redirect('foodcategory')->with('success','Food Category Created !!');
    }

    function categorydelete($id){
        $category = Category::find($id);

        $category->delete();

        return redirect('foodcategory')->with('success','Food Category Deleted !!');
    }

    function district(){

        $district = District::all();
        return view('admin.district',['district'=>$district]);
    }

    function addDistrict(Request $req){
        $district = new District();

        $district->name = $req->name;
        $district->save();

        return redirect('district')->with('success','District Created !!');
    }

    function districtDelete($id){
        $district = District::find($id);

        $district->delete();

        return redirect('district')->with('success','District Deleted !!');
    }

    function city(){

        $city = City::all();
        $district = District::all();
        return view('admin.city',['city'=>$city,'district'=>$district]);
    }

    function addCity(Request $req){
        $city = new City();

        $city->name = $req->name;
        $city->district_id = $req->district_id;
        $city->save();

        return redirect('city')->with('success','city Created !!');
    }

    function cityDelete($id){
        $city = City::find($id);

        $city->delete();

        return redirect('city')->with('success','city Deleted !!');
    }

    function foodmenu(){

        $foods = Food::all();

        return view('admin.foodmenu',['foods'=>$foods]);
    }


    function addfood(){
        $category = Category::all();

        return view('admin.addfood',['cat'=>$category]);
    }

    function submitaddfood(Request $req){
       $req->validate([
            'type' =>'required',
        ]);
        $food = new Food();

        $food->category = $req->category;
        $food->food_name = $req->name;
        $food->description = $req->description;
        $food->type = $req->type;

        if ($req->hasfile('image')) {
            $file = $req->file('image');
            $originalName = $file->getClientOriginalName();
            $filename = time().'.'.$originalName;
            $file->move('uploads/',$filename);
            $food->image = $filename;
        }

        $food->price = $req->price;

        $food->save();

        return redirect('foodmenu')->with('success','Food Created Successfully!');;
    }

    function foodedit(Request $req){
        $food = Food::find($req->id);
        $cat = Category::all();

        return view('admin.foodedit',['food'=>$food, 'cat'=>$cat]);


    }

    function fooddelete($id){
        $food = Food::find($id);
        if($food->image){            
        unlink(public_path().'/uploads/'.$food->image);
        }
        $food->delete();

        return redirect('foodmenu')->with('success','Food Deleted Successfully!');
    }


    function submiteditfood(Request $req){
        $food = Food::find($req->id);
        $food->category = $req->category;
        $food->food_name = $req->name;
        $food->description = $req->description;
        $food->type = $req->type;
        

        if ($req->hasfile('image')) {
            if($food->image){
            unlink(public_path().'/uploads/'.$food->image);
            }
            $file = $req->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/',$filename);
            $food->image = $filename;
        }

        $food->price = $req->price;

        $food->save();

        return redirect('foodmenu')->with('success','Food Updated Successfully!');

    }

    function orders(){
        $orders = DB::table('orders')
        ->join('users','orders.u_id','users.id')

        ->select(
            'orders.*',
            'users.*',
            'orders.id as order_id')->paginate(10);
        return view('admin.orders',['orders'=>$orders]);
    }

    function search(Request $req){
        $value = $req->search;
        $searches = DB::table('orders')
        ->join('users','orders.u_id','users.id')
        ->select(
            'orders.*',
            'users.*',
            'orders.id as order_id')
        ->where('order_status','like','%'.$value.'%')->paginate(10);
        return view('admin.orders',['orders'=>$searches]);
    }


    function vieworders($id){
        $user = Order::where('id',$id)->first()->u_id;
        $address = Address::where('u_id',$user)->first();

        $orders = DB::table('orders')
        ->join('foods','orders.f_id','foods.id')
        ->join('users','orders.u_id','users.id')
        ->select(
            'orders.*',
            'foods.*',
            'users.*',
            'orders.id as order_id')
        ->where('orders.id',$id)
        ->get();

        return view('admin.view-order-details',['orders'=>$orders,'address' => $address]);
    }

    function updateorder(Request $req){
        $order = Order::find($req->id);
        $order->order_status = $req->os;
        $order->save();
        $user_phone = User::where([['id',$order->u_id]])->first()->phone;
        $sms = Nexmo::message()->send([
            'to'   => $user_phone,
            'from' => '9779868638416',
            'text' => ($req->os == 1) ? 'Your order is confirmed' : (($req->os == 2) ? 'Your ordered food is picked up, be patient!' : 'Your Order is delivered!, Thank you for your order!'),
        ]);
        if($sms){
            return redirect('orders')->with('success','We notified to the customer through SMS');
        }

        return redirect('orders')->with('success','order status saved and sms sent to the customer');

    }
    


    function dashboard(){
        $data = [];

        $data['total_order'] = Order::all()->count();
        $data['new_order'] = Order::all()
        ->where('order_status','0')
        ->count();
        $data['order_confirmed'] = Order::all()
        ->where('order_status','1')
        ->count();

        $data['food_pickup'] = Order::all()
        ->where('order_status','2')
        ->count();

        $data['food_delivered'] = Order::all()
        ->where('order_status','3')
        ->count();


        $data['total_regd_users'] = User::count();

    return view('admin.dashboard',compact('data',$data));

    }
}
