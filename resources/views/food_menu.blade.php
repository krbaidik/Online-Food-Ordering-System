@extends('cmaster')

@section('title')
 Food4Me | Menu List
@endsection

@section('menuactive')
active
@endsection

@section('content')
<h1 class="text-center text-danger">Food Menu List</h1>
<div id="accordion">
  <div class="card-menu-list">
    <div class="card-header bg-success" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <h3 class="text-white"> -> Veg. Items</h3>
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
        	@forelse($data['veg_food'] as $veg_food)
        	<li>
        		<a href="food-details/{{$veg_food->id}}" class="text-success">{{ $veg_food->food_name}} -> Rs.{{$veg_food->price}}/-</a>
        	</li>
        	@empty
        	<li>Veg food list not available.</li>
        	@endforelse
        </ol>
      </div>
    </div>
  </div>
  <div>
    <div class="card-header bg-danger" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        	<h3 class="text-white"> -> Non-veg. Items</h3>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
        	@forelse($data['nonveg_food'] as $nonveg_food)
        	<li>
        		<a href="food-details/{{$nonveg_food->id}}" class="text-danger">{{ $nonveg_food->food_name}} -> Rs.{{$nonveg_food->price}}/-</a>
        	</li>
        	@empty
        	<li>Non-Veg food list not available.</li>
        	@endforelse
        </ol>
      </div>
    </div>
  </div>
  <div class="card-menu-list">
    <div class="card-header bg-warning" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
          <h3 class="text-white"> -> Drinks</h3>
        </button>
      </h5>
    </div>

    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        <ol class="flist">
          @forelse($data['drinks'] as $drinks)
          <li>
            <a href="food-details/{{$drinks->id}}" class="text-warning">{{ $drinks->food_name}} -> Rs.{{$drinks->price}}/-</a>
          </li>
          @empty
          <li>Drinks Items not available.</li>
          @endforelse
        </ol>
      </div>
    </div>
  </div>
</div>
@endsection