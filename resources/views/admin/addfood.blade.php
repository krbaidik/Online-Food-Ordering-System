@extends('admin.master')

@section('title')
FOS | Add Food 
@endsection


@section('foodmenu')
   active
@endsection

@section('content')
<style type="text/css">
  .foodtype{
 display: flex;
 justify-content: space-around;
  }
</style>

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Food Menu</h4><hr>
              </div>
              <div class="card-body">
                <h3><u>Add Food</u></h3>
                <form method="post" action="{{ asset('submitaddfood')}}" enctype="multipart/form-data">
                  @csrf

                  <div class="form-group">
                    <label for="name">Category</label>
                  <select class="form-control" name="category" required>
                    <option value="">Select Category</option>
                  @foreach($cat as $c)

                    <option value="{{$c->category}}">{{$c->category}}</option>
                  @endforeach

                  </select>
                  </div>

                  <div class="form-group">
                    <label for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" required >
                  </div>

                  <div class="form-group">
                    <label for="des">Description</label>
                    <textarea class="form-control" required placeholder="Write Description.." name="description"></textarea>
                  </div><br>
                  <div class="form-group">
                    <label for="FoodType">Food Type: </label> 
                    <div class="foodtype">
                     <select id="type" class="form-control" name="type" required autofocus>
                                    <option>Choose any one..</option>
                                    <option value="1">Vegiterian</option>
                                    <option value="2">Non-Vegiterian</option>
                                </select>
                    </div>
                  </div>
                  <div class="input-group">
                    <label>Image</label>
                  <input type="file" name="image" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                  <input type="number" id="price" name="price" class="form-control" required >
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

     
