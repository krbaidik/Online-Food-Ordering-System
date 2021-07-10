@extends('admin.master')

@section('title')
Food Menu
@endsection


@section('foodmenu')
  active
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

@endsection

@section('content')

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Food Menu</h4>
              </div><hr>
              <div class="card-body">

              	<a href="addfood" class="btn btn-primary float-right">Add Food</a>
                <div class="table-responsive">
                	<h3><u>Manage Food</u></h3>
                  @if(Session::has('success'))
                  <p class="alert alert-success">{{ Session::get('success')}}</p>
                  @endif
                  <table class="table" id="DataTable">
                    <thead>
                      <tr>
                          <th>S.No.</th>
                          <th> Category Name</th>
                          <th>Item Name</th>
                          <th>Price</th>
                          <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php $i=1; ?>
                        @forelse($foods as $food)
                        <td>
                          {{$i}}
                        </td>
                        <td>
                          {{$food->category}}
                        </td>
                        <td>
                          {{$food->food_name}}
                          
                        </td>
                        <td>
                          {{$food->price}}
                         
                        </td>
                        <td class="text-right">
                          <div class="d-flex"> 
                          <a href="foodedit/{{$food->id}}" class="btn btn-success mr-2">Edit</a>
                          <form action="fooddelete/{{$food->id}}">
                            <input type="submit" onclick="myfun(event)" class="btn btn-danger" value="Delete" />
                          </form>
                        </div>
                        </td>
                      </tr>
                      <?php $i++; ?>
                      @empty
                      <td colspan="5" class="text-danger">No Data Found</td>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


@endsection
@section('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script> 

  function myfun(e){
    e.preventDefault();
     var r = confirm("Press a button!\nEither OK or Cancel.\nThe button you pressed will be displayed in the result window.");
     if(r == true){
      $('form').submit();
     }
  }

 $(document).ready( function () {
    $('#DataTable').DataTable();
} );

</script>

@endsection

     
