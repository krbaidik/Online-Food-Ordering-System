@extends('admin.master')

@section('title')
Registered Users
@endsection


@section('reguser')
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
                <h4 class="card-title">Users Table </h4>
              </div>
              <div class="card-body">
                <div>
                  <table class="table" id="DataTable">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Phone
                      </th>
                      <th>
                        UserType
                      </th>
                      <th >
                        Email
                      </th>
                      <th>
                        Action
                      </th>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($data as $d)
                        <td>
                          {{$d->name}}
                        </td>
                        <td>
                          {{$d->phone}}
                          
                        </td>
                        <td>
                          {{$d->usertype}}
                          
                        </td>
                        <td>
                          {{$d->email}}
                          
                        </td>
                        <td class="text-right">
                          <div class="d-flex">
                          <a href="useredit/{{$d->id}}" class="btn btn-success mr-2">Edit</a>
                          <form action="userdelete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$d->id}}" >
                            <button class="btn btn-danger" onclick="del(event)">Delete</button>
                          </form>
                          </div>
                        </td>
                      </tr>
                        @endforeach

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
  function del(e){
    var msg = confirm('Are you sure to delete ?');
    if(msg){
      $('form').submit();
    }else{
      e.preventDefault();
    }
  }

   $(document).ready( function () {
    $('#DataTable').DataTable();
} );
</script>
@endsection


     
