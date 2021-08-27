@extends('cmaster')

  @section('title')
  FOS | Home 
  @endsection
  @section('css')
  <style>
    .error{
      color: red;
    }
    input[type="radio"]{
      width: auto;
      margin-right: 15px;
    }
    .payment_method{
      border: 1px solid black;
      padding: 25px;
      margin-bottom: 20px;
      background-color: lightcyan;
      box-shadow: 0px 2px 1px 2px gray;
    }
  </style>
  @endsection

@section('content')

  <div class="jumbotron">

    <div class="container">
        <h3 class="text-danger text-center">Checkout</h3><hr>
      <div class="row">
        <div class="col-md-6">
          <h5 class="font-weight-bold alert alert-danger">Shipping Address</h5><hr>
        @if($data['address'])
            @if(Session::has('success'))
                <p class="alert alert-success">{{Session::get('success')}}</p>
            @elseif(Session::has('error'))
                <p class="alert alert-danger">{{Session::get('error')}}</p>
            @endif
          <table class="table table-striped">
            <tr>
              <th>District: </th>
              <td>{{$data['address']->district->name}}</td>
            </tr>
            <tr>
              <th>Town/City: </th>
              <td>{{$data['address']->city->name}}</td>
            </tr>
            <tr>
              <th>Street Address: </th>
              <td>{{$data['address']->street_address}}</td>
            </tr>
            <tr>
              <th>Phone: </th>
              <td>{{$data['address']->phone}}</td>
            </tr>
            <tr>
              <th>Email: </th>
              <td>{{$data['address']->email ?? 'N/A'}}</td>
            </tr>
          </table>

          <p class="text-danger text-right font-weight-bold alert alert-success">Not your shipping Address ? <a href="#" class="btn btn-secondary" data-toggle="modal" data-target="#modalContactForm">Edit</a></p>


  <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <form action="/editaddress" method="post" id="editaddress">
    @csrf
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Edit Address</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form">
          <label data-error="wrong" data-success="right" for="form34">District</label>
          <select name="district" id="district" class="form-control">
              <option>Select district</option>
              @foreach($data['district'] as $district)
                <option value="{{ $district->id }}" 
                  @if($data["address"]->district_id == $district->id) selected @endif>{{ $district->name }}</option>
              @endforeach
              </select>
        </div>

        <div class="md-form">
          <label data-error="wrong" data-success="right" for="city">Town/City</label>
          <select name="city" id="city" class="form-control">
              </select>
        </div>

        <div class="md-form">
          <label data-error="wrong" data-success="right" for="form29">Street Address</label>
          <input type="text" id="form29" class="form-control validate" name="street_address" value="{{$data['address']->street_address}}">
        </div>
        <div class="md-form">
          <label data-error="wrong" data-success="right" for="phone">Phone</label>
          <input type="text" id="phone" class="form-control validate" name="phone" value="{{$data['address']->phone}}">
        </div>
        <div class="md-form">
          <label data-error="wrong" data-success="right" for="email">Email(optional)</label>
          <input type="text" id="email" class="form-control validate" name="email" value="{{$data['address']->email}}">
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-danger">Save changes <i class="fas fa-paper-plane-o ml-1"></i></button>
      </div>
    </div>
  </div>
  </form>
</div>


        @endif
          <br>
          <form action="{{ route('orderfood')}}" method="post" id="checkoutform">
            @csrf

            @if(!$data['address'])
             <div class="form-group">
              <label for="district">District</label>
             <select name="district" id="district" class="form-control">
              <option>Select district</option>
              @foreach($data['district'] as $district)
                <option value="{{ $district->id }}">{{ $district->name }}</option>
              @endforeach
              </select>           
             </div>
            <div class="form-group">
              <label for="city">City</label>
             <select name="city" id="city" class="form-control">
              <option>Select city</option>
              </select>           
             </div>
            <div class="form-group">
              <label for="street_address">Street Address</label>
              <input type="text" name="street_address" placeholder="Enter Street Address" class="form-control" id="street_address">
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" name="phone" placeholder="Enter Phone" class="form-control" id="phone">
            </div>
            <div class="form-group">
              <label for="email">Email(optional)</label>
              <input type="text" name="email" placeholder="Enter Email" class="form-control" id="email">
            </div>
            @endif
            <div class="form-group">
              <label for="notes">Order Notes(optional)</label>
              <textarea name="order_note" id="notes" rows="3" class="form-control"></textarea>
            </div>
        </div>
        <div class="col-md-6">
          <h5 class="text-center p-2">Your Order</h>
            <table class="table table-responsive table-bordered w-100 pt-2">
              <tr>
                <th>Food</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Unit price</th>
                <th>Total price</th>
              </tr>
              @forelse($data['cart_content'] as $cart)
              <tr>
                <td><img src="uploads/{{ $cart->options->image ?? 'food4me.jpg'}}" alt="Food image" width="80" style="height:70px !important; padding: 2px;"></td>
                <td>{{ $cart->name}}</td>
                <td>{{ $cart->qty}}</td>
                <td>{{ $cart->price}}</td>
                <td>{{ $cart->subtotal}}</td>
              </tr>
              @empty
              <td colspan="5">No Items</td>
              @endforelse
              
            </table>
            <table class="table table-striped text-left">
              <tr>
                <th>Sub Total</th>
                <td>Rs.{{$subtotal = Cart::subtotal()}}</td>
              </tr>
              <tr>
                <th>Shipping charge</th>
                <td>Rs.50.00 (All over kathmandu valley)</td>
              </tr>
              <tr>
                <th>Total</th>
                <td>Rs.{{str_replace(',','', $subtotal) + '50' }}.00</span></td>
              </tr>
            </table>
            @if(Cart::count() > 0)
            <div class="payment_method">
              Payment Option :
            <input type="radio" name="payment" value="1" id="cod"><label for="cod">Cash on delivery</label> <input type="radio" name="payment" value="2" id="esewa"><label for="esewa">eSewa</label>
            </div>
              <input value="Place an order" type="submit" class="btn btn-danger cod_order">
          </form>

            <div class="esewa_payment">
              <form action="https://uat.esewa.com.np/epay/main" method="POST">
              <input value="{{str_replace(',','', Cart::subtotal()) + '50' }}" name="tAmt" type="hidden">
              <input value="{{  Cart::subtotal() }}" name="amt" type="hidden">
              <input value="0" name="txAmt" type="hidden">
              <input value="0" name="psc" type="hidden">
              <input value="50" name="pdc" type="hidden">
              <input value="EPAYTEST" name="scd" type="hidden">
              <input value="{{ random_int(000000, 999999) }}" name="pid" type="hidden">
              <input value="{{ route('esewa.success')}}" type="hidden" name="su">
              <input value="{{ route('esewa.fail')}}" type="hidden" name="fu">
              <input value="Pay with eSewa" type="submit" class="btn btn-success">
            </form>
            </div>
            @endif
        </div>
      </div>
    </div>
  </div>

@endsection

@section('js')

<script type="text/javascript">
  $('.cod_order').hide();
  $('.esewa_payment').hide();
  $('#cod').on('click', function(){
    $('.esewa_payment').hide();
    $('.cod_order').show();
});

  $('#esewa').on('click', function(){
  $('.cod_order').hide();
  $('.esewa_payment').show();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
  $('#checkoutform').validate({
    rules:{
      district: "required",
      street_address: "required",
      city:"required",
      phone: "required",
      email: {
        email:true,
      },
    }
  });

  $('#editaddress').validate({
    rules:{
      district: "required",
      street_address: "required",
      city:"required",
      phone: "required",
      email: {
        email:true,
      },
    }
  });


  var did = $('#district').val();
  var adid = {{ $data['address']->city_id ?? '0'}};
  $.ajax({
        url: '{{ route('getcity')}}',
          data: {
            "_token": "{{ csrf_token() }}",
            "id": did
            },
          type: 'post',
          dataType: 'json',
          success: function( result )
          {
               $.each( result, function(k, v) {
            if(adid == v.id){

                    $('#city').append( '<option value="'+v.id+'" selected>'+v.name+'</option>' );
                  }else{
                    $('#city').append( '<option value="'+v.id+'">'+v.name+'</option>' );
                  }
               });
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });


  $('#district').on('change', function(){
       var id = $(this).val();
       $.ajax({
        url: '{{ route('getcity')}}',
          data: {
            "_token": "{{ csrf_token() }}",
            "id": id
            },
          type: 'post',
          dataType: 'json',
          success: function( result )
          {
            $("#city option").remove();
               $.each( result, function(k, v) {
                    $('#city').append($('<option>', {value:v.id, text:v.name}));
               });
          },
          error: function()
         {
             //handle errors
             alert('error...');
         }
       });
  });

</script>
@endsection