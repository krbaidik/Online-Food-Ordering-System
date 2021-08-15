@extends('admin.master')

@section('title')
FOS | City
@endsection


@section('city')
   active
@endsection

@section('content')

	<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">city</h4><hr>

              </div>

              <div class="card-body">

                <div style="border: 1px solid black; padding: 30px;">
                  <h3 class="text-primary">City</h3><hr>
                <form action="{{ asset('addcity')}}" method="post">

                  @csrf
                  <select class="form-control" style="font-size: 18px; height: 42px; margin-bottom: 10px" name="district_id">
                    <option>select district</option>
                    @foreach($district as $dis)
                    <option value="{{ $dis->id}}">{{ $dis->name}}</option>
                    @endforeach
                  </select>
                <input type="text" name="name" placeholder="Enter city.." class="form-control" style="font-size: 18px; height: 42px;" required><br>
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
                        District
                      </th>
                      <th>
                        City
                      </th>
                      <th colspan="2" class="text-right">
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        <?php $i=1 ?>
                        @forelse($city as $cit)
                        <td>
                          {{$i}}
                        </td>
                        <td>
                          {{$cit->districts->name}}
                        </td>
                        <td>
                          {{$cit->name}}
                        </td>
                        
                        <td class="text-right">
                          <form action="citydelete/{{$cit->id}}" method="Delete">
                            @csrf
                            <button class="btn btn-danger" onclick="del(event)">Delete</button>
                          </form>
                        </td>
                      </tr>
                      <?php $i++; ?>
                      @empty
                      <h5 class="bg-danger">No city Found !!</h5>
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

     
