@extends('cmaster')

@section('title')
Food4me: Food delivery service in Nepal
@endsection

@section('content')

<div class="container-fluid background">
	<div class="row fooddiv">

    

		@foreach($foods as $food)
		<div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
			<div class="card mt-3" style="width: 100%;">
        <a href="food-details/{{$food->id}}"><img class="card-img-top" src="uploads/{{$food->image ?? 'food4me.jpg'}}" alt="Card image cap" height="150px">
        </a>
  <div class="card-body">
    <h5 class="card-title text-primary">{{$food->food_name}}</h5>
  </div>
  <ul class="list-group list-group-flush">

    <li class="list-group-item font-weight-bold text-danger">Rs.{{$food->price}}</li>
  </ul>
  <div class="view">
    <a href="food-details/{{$food->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
  </div>
</div>
		</div>
		@endforeach
  

	</div>
  <h5 style="display: flex; justify-content: center;">{{$foods->links()}}</h5>
<p class="text-center font-weight-bold list-title">Recommendation..</p><br>
<div class="row fooddiv">

   @if(Auth::User() and \Auth::user()->type == '1')
    @forelse($recommendation_veg as $r)
    <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
      <div class="card mt-3" style="width: 100%;">
        <a href="food-details/{{$r->id}}"><img class="card-img-top" src="uploads/{{$r->image ?? 'food4me.jpg'}}" alt="Card image cap" height="150px">
        </a>
  <div class="card-body">
    <h5 class="card-title">{{$r->food_name}}</h5>
  </div>
  <ul class="list-group list-group-flush">

    <li class="list-group-item font-weight-bold text-danger">Rs.{{$r->price}}</li>
  </ul>
  <div class="view">
    <a href="food-details/{{$r->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
  </div>
</div>
    </div>
    @empty
    <h4>recommendation display here..</h4>
    @endforelse

    @elseif(Auth::User() and \Auth::user()->type == '2')
    @foreach($recommendation_nonveg as $rn)
    <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
      <div class="card mt-3" style="width: 100%;">
        <a href="food-details/{{$rn->id}}"><img class="card-img-top" src="uploads/{{$rn->image ?? 'food4me.jpg'}}" alt="Card image cap" height="150px">
        </a>
  <div class="card-body">
    <h5 class="card-title">{{$rn->food_name}}</h5>
  </div>
  <ul class="list-group list-group-flush">

    <li class="list-group-item font-weight-bold text-danger">Rs.{{$rn->price}}</li>
  </ul>
  <div class="view">
    <a href="food-details/{{$rn->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
  </div>
</div>
    </div>
    @endforeach

    @elseif(Auth::User())
      @foreach($recommendation_both as $rb) 
   <div class="col-md-4 col-lg-3 col-sm-6 col-xs-12">
      <div class="card mt-3" style="width: 100%;">
        <a href="food-details/{{$rb->id}}"><img class="card-img-top" src="uploads/{{$rb->image ?? 'food4me.jpg'}}" alt="Card image cap" height="150px">
        </a>
  <div class="card-body">
    <h5 class="card-title">{{$rb->food_name}}</h5>
  </div>
  <ul class="list-group list-group-flush">

    <li class="list-group-item font-weight-bold text-danger">Rs.{{$rb->price}}</li>
  </ul>
  <div class="view">
    <a href="food-details/{{$rb->id}}" class="btn btn-danger"><i class="fa fa-eye"></i> View</a>
  </div>
</div>
    </div>
    @endforeach
    @else
     <h5><a href="{{asset('login')}}">Login</a> to view recommended food!</h5>
    @endif

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