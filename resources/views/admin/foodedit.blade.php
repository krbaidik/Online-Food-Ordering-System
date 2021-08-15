@extends('admin.master')

@section('title')
FOS | Food Edit 
@endsection


@section('foodmenu')
   active
@endsection

@section('content')

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Food Menu</h4><hr>
              </div>
              <div class="card-body">
                <h3><u>Edit Food Info</u></h3>
                <form method="post" action="{{ asset('submiteditfood')}}" enctype="multipart/form-data">
                  @csrf

                  <input type="hidden" name="id" value="{{$food->id}}">
                  <div class="form-group">
                    <label for="name">Category</label>
                  <select class="form-control" name="category" required>
                    <option value="">Select Category</option>
                    @foreach($cat as $c)
                    <option @if ($food->category == $c->category)
                      selected 
                    @endif value="{{$c->category}}">{{$c->category}}</option>
                    @endforeach
                  </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" value="{{$food->food_name}}" required >
                  </div>

                  <div class="form-group">
                    <label for="des">Description</label>
                    <textarea class="form-control" required placeholder="Write Description.." name="description">{{$food->description}}</textarea>
                  </div><br>

                  <div class="form-group">
                    <label for="FoodType">Food Type(optional): </label> 
                    <div class="foodtype">
                     <select id="type" class="form-control" name="type" required autofocus>
                                     @if($food->type == 1)
                                          <option value="0">None</option>
                                          <option value="1" selected>Vegiterian</option>
                                          <option value="2">Non-Vegiterian</option>
                                     @elseif($food->type == 2)
                                          <option value="0">None</option>
                                          <option value="1">Vegiterian</option>
                                          <option value="2" selected>Non-Vegiterian</option>
                                      @else
                                      <option value="0">None</option>
                                      <option value="1">Vegiterian</option>
                                      <option value="2">Non-Vegiterian</option>
                                     @endif
                                </select>
                    </div>
                  </div><br>
                  <div class="input-group">
                    <label>Image</label>
                  <input type="file" name="image" class="form-control"><img src="/uploads/{{$food->image}}" height="100" width="150">
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                  <input type="number" id="price" name="price" class="form-control" value="{{$food->price}}" required >
                  </div>

                  <div class="form-group">
                    <input type="submit" name="submit" value="Add" class="btn btn-success">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

	
@endsection

     
