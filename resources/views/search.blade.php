@extends('cmaster')

@section('title')
Get food delivered to your home
@endsection


<style type="text/css">
  .background{
    background: /*#ed3c3b;*/ #fff;
    background-repeat: no-repeat;
    background-size: cover;
    padding: 50px 0px;
  }
  .fooddiv{
    margin: -70px 0px 30px 30px !important;
    padding: 20px 20px !important;
    padding-bottom: 40px !important;
    box-shadow: 1px 1px 4px 1px gray;
    border-radius: 5px;
    background-color: #fff;
  }
  .card{
    border-radius: 10px !important;
    border: none !important;
    text-align: center;
    height: 450px;
    padding: 10px !important;
  }
  img{
    border-radius: 10px !important;
    height: 250px !important;
  }
  .card:hover{
    box-shadow: 0px 0px 15px 1px gray;
    transition: all 0.3s ease-in-out;
  }
  .view > a{
    border-radius: 30px;
  }
  .list-title{
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 90px;
    display: inline-block;
    color: #ec3934;
  }
</style>

@section('content')
    <h4 class="text-primary p-3">Search Results: {{$count}} result(s) for '{{$value ?? 'all'}}' </h4><br>
<div class="container-fluid background">
	<div class="row fooddiv">
		@forelse($foods as $food)
		<div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
			<div class="card mt-3" style="width: 100%;">
        <a href="food-details/{{$food->id}}"><img class="card-img-top" src="uploads/{{$food->image ?? 'food4me.jpg'}}" alt="Card image cap" height="150px">
        </a>
  <div class="card-body">
    <h5 class="card-title">{{$food->food_name}}</h5>
  </div>
  <ul class="list-group list-group-flush">

    <li class="list-group-item font-weight-bold text-danger">Rs.{{$food->price}}</li>
  </ul>
  <div class="view">
    <a href="food-details/{{$food->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
  </div>
</div>
		</div>
    @empty
    <h2 class="text-center">No results found</h2>
		@endforelse
  

	</div>
<center>
  <p style="text-align: center;">{{$foods->links()}}</p>

</center>

  </div>

</div>
  <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }

 
  </script>
@endsection