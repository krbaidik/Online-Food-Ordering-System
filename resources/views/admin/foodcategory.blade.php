@extends('admin.master')

@section('title')
FOS | Food Category
@endsection


@section('foodcat')
   active
@endsection

@section('content')

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Food Category</h4><hr>

              </div>

              <div class="card-body">

                <div style="border: 1px solid black; padding: 30px;">
                  <h3 class="text-primary">Category</h3><hr>
                <form action="{{ asset('submitcategory')}}" method="post">

                  @csrf
                <input type="text" name="category" placeholder="Enter food category.." class="form-control" style="font-size: 18px; height: 42px;"><br>
                <input type="submit" name="submit" class="btn btn-primary" value="Add">
              </form>

              </div>
              <hr><br>

                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success')}}</p>
                @endif

                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        S.N
                      </th>
                      <th>
                        Category
                      </th>
                      <th colspan="2" class="text-right">
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <?php $i=1 ?>
                        @forelse($category as $cat)
                        <td>
                          {{$i}}
                        </td>
                        <td>
                          {{$cat->category}}
                        </td>
                        
                        <td class="text-right">
                          <form action="categorydelete/{{$cat->id}}" method="Delete">
                            @csrf
                            <button class="btn btn-danger" onclick="del(event)">Delete</button>
                          </form>
                        </td>
                      </tr>
                      <?php $i++; ?>

                      @empty
                      <h5 class="bg-danger">No category Found !!</h5>
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
<script>
  function del(e){
    e.preventDefault();
    var msg = confirm('Are You sure to delete ?');
    if(msg == true){
      $('form').submit();
    }else{
      return false;
    }
  }
</script>
@endsection

     
