  @extends('cmaster')

  @section('title')
  FOS | Home 
  @endsection
<style>
  .img{
    overflow: hidden;
  }
  .orderbtn{
    color: #dc3545 !important;
  }
  .orderbtn:hover{
    background-color: #dc3545!important;
    color: white !important;
  }
  .orderdiv{
    box-shadow: 0px 0px 10px 1px gray;
    padding: 20px;
    margin-bottom: 15px;
  }
</style>

  @section('content')

  <div class="jumbotron">
  <p>You are ready to Order delicious hot Food !!</p>
  @if(Session::has('success'))
  <p class="alert alert-success msg">{{Session::get('success')}}</p>
  @else
  <p class="alert-success msg"></p>
  @endif
  <div class="container-fluid">
  <div class="row">
  <div class="col-md-7 items"><hr>
    <ol>
    @forelse($carts as $i=>$cart)
    <div class="orderdiv">
      <li>
    <img src="uploads/{{$cart->options->image ?? 'food4me.jpg'}}" width="200" style="display: inline-block; padding: 4px;overflow: hidden; height: 190px !important;" align="left" class=" img-thumbnail" alt="Food Image"><br>

  <p style="float: right; padding: 8px;" id="{{$i}}" class="font-weight-bold ml-3 btn btn-outline-danger remove"
  onclick="removeCart(event,id)">Remove</p>
  <div>
    <p id="{{$i}}" style="float: right; padding: 8px;" class="btn btn-success font-weight-bold btnupdate" onclick="updateCart(event,id)">Update Cart</p>
  </div>

      <div style="display: inline;">
          <p class="ml-4"><b>{{$cart->name}}</b></p>
    <p>{{$cart->options->description}}</p>
        </div>
    <div class="d-flex gparent" style="justify-content: space-between;">
      <div class="input-group quantity float-right" style="width: 130px">
        <input type="hidden" value="{{$cart->price}}" class="aprice">
          <div class="input-group-prepend decrement-btn" style="cursor: pointer">
              <span class="input-group-text">-</span>
          </div>
          <input type="text" class="qty-input form-control qntt" min="1" max="10" value="{{ $cart->qty}}" readonly>
          <div class="input-group-append increment-btn" style="cursor: pointer">
              <span class="input-group-text">+</span>
          </div>
          <div>
          <p class="font-weight-bold text-success m-2 p-1 text-right"> Total : <input type="text" class="price" value="{{$cart->subtotal}}" disabled></p>
          </div>
      </div>
    </div>
  </li>
  </div>
@empty
    <img src="/slider/emptycart.png" width="60%" >
  <h4 align="center">Looks like you have no item in your cart.</h4>
  <h4 align="center">Click <a href="{{ route('frontend.home')}}">here</a> to order food.</h4>
@endforelse
  </ol>

  <div class="col-md-4" align="center">
    <span class="text-danger"></span>
   
  </div>
  </div>
  <div class="col-md-4">
    <div class="container text-center">
      <table class="table table-responsive">
        <tr>
          <th>Grand Total : </th>
          <td class="grandtotal">{{ Cart::subtotal()}}</td>
        </tr>
      </table>

@if(Cart::count() > 0)
      <a href="/checkout" class="text-white btn btn-danger float-right orderbtn">Checkout</a>
@endif 
    </div>
  </div>
  </div>
  </div>
</div>

  <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
  <script>


  
  $(document).ready(function () {

$('.btnupdate').hide();
      $('.increment-btn').click(function (e) {
          e.preventDefault();
          $(this).parents('.orderdiv').find('.btnupdate').show();
          var incre_value = $(this).parents('.quantity').find('.qty-input').val();
          var value = parseInt(incre_value, 10);
          value = isNaN(value) ? 0 : value;
          if(value<10){
              value++;
             var qty = $(this).parents('.quantity').find('.qty-input').val(value).val();
              var price = $(this).parent('.quantity').find('.aprice').val();
              var total_price = qty*price;
              $(this).parent('.quantity').find('.price').val(total_price);
          }

      });

      $('.decrement-btn').click(function (e) {
          e.preventDefault();
          $(this).parents('.orderdiv').find('.btnupdate').show();
          var decre_value = $(this).parents('.quantity').find('.qty-input').val();
          var value = parseInt(decre_value, 10);
          value = isNaN(value) ? 0 : value;
          if(value>1){
              value--;
              var qty = $(this).parents('.quantity').find('.qty-input').val(value).val();
              var price = $(this).parent('.quantity').find('.aprice').val();
              var total_price = qty*price;
              $(this).parent('.quantity').find('.price').val(total_price);

          }
      });

  });
  function removeCart(e,id) {
          e.preventDefault();
          var confirmation = confirm('Are you sure ?')
          if(confirmation){
            $.ajax({
            url: 'removecart/'+id,
            type: 'POST',
            data: {
              '_token':"{{ csrf_token() }}",
              'id':id,

            },
            success: function(res){
                  div = $("#"+id).parents('.orderdiv').remove();
                  $('.msg').addClass('alert');
                  $('.msg').html('Item Removed');
                  item = $('.items').find('.orderdiv').length;
                  $('.cartcount').html(item);
                  $('.grandtotal').html(res);
                  if(item < 1){
                    $('.orderbtn').remove();
                    $('.items').html('<img src="/slider/emptycart.png" width="60%" ><h4 align="center">You have no item in your cart.</h4><h4 align="center">Click <a href="{{ route('frontend.home')}}">here</a> to order food.</h4>')
                  }

            },
            error: function(err){
              console.log(err.statusText);
            }
          })
          }

      };

      function updateCart(e,id) {
        const qty = $("#"+id).parents('.orderdiv').find('.qntt').val();
          e.preventDefault();
            $.ajax({
            url: 'updatecart/'+id,
            type: 'POST',
            data: {
              '_token':"{{ csrf_token() }}",
              'id':id,
              'qty':qty,
            },
            success: function(res){
              $('.grandtotal').html(res);
              $("#"+id).parents('.orderdiv').find('.btnupdate').hide();
              $('.msg').addClass('alert');
              $('.msg').html('Cart Updated !');

            },
            error: function(err){
              console.log(err.statusText);
            }
          })

      };

  // order food

  $('.orderbtn').on('click', function(){

    var price = $(this).parents('.gparent').find('.price').val();
    var quantity = $(this).parents('.gparent').find('.qty-input').val();
    var food_id = $(this).parents('.gparent').find('.food_id').val();
    var carts_id = $(this).parents('.gparent').find('.carts_id').val();
        $('.oprice').val(price);
        $('.oqty').val(quantity);
        $('.fid').val(food_id);
        $('.cid').val(carts_id);

  });
  
  $('.porder').on('click', function(event){
    if($('.flat').val() == ''){
      event.preventDefault();
      $('.flat').css('border','1px dashed red');
      $('.flat').after('<p class="text-danger">* The flat field is required</p>');
    }
    if($('.city').val() == ''){
      event.preventDefault();
      $('.city').css('border','1px dashed red');
      $('.city').after('<p class="text-danger">* The city field is required</p>');
    }
    if($('.street_name').val() == ''){
      event.preventDefault();
      $('.street_name').css('border','1px dashed red');
      $('.street_name').after('<p class="text-danger">* The street name field is required</p>');
    }
    if($('.area').val() == ''){
      event.preventDefault();
      $('.area').css('border','1px dashed red');
      $('.area').after('<p class="text-danger">* The area field is required</p>');
    }

  });

  </script>

  @endsection