@extends('cmaster')

@section('title')
 FOS | Profiles 
@endsection


@section('content')

<div class="container jumbotron">
	<center>
			<h3>Your Profile !</h3>
		
	</center>
	<div class="row ">
		<div class="col-md-4 bg-success m-auto">
			<table class="table table-responsive text-white">
				<tr>
					@foreach($user as $u)
					<th>Name</th>
					<td>{{$u->name}}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{$u->email}}</td>
				</tr>
				<tr>
					<th>Phone</th>
					<td>{{$u->phone}}</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

@endsection