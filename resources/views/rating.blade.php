@extends('cmaster')
@section('content')

	<table class="table table-responsive m-auto">
		<tr>
			<th>Rating Value</th>
			<th>Rating Date</th>
		</tr>
@foreach($all as $al)
		<tr>
			<td>{{$al->rating_value}}</td>
			<td>{{$al->created_at->diffForHumans()}}</td>
		</tr>
		@endforeach
	</table>
@endsection

