@extends('dashboard.layouts.master')
@section('content')
<main>
  <div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="{{ asset('css/assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
    <h2>Categories</h2>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Categories</h3>
    </div>
    <div class="card-body border-bottom py-3">


      <div class="d-flex">
        <form method="get" action="{{ url('dashboard/category') }}">
          @csrf

          <div class="mb-3 row">
           <label for="inputPassword" class="col-sm-6 col-form-label">Search Categoy Name</label>
           <div class="col-sm-6">
             <input type="text" class="form-control" name="name">
           </div>
         </div>

         <div class="mb-3 row">
          <label for="inputPassword" class="col-sm-6 col-form-label">Active</label>
          <div class="col-sm-6">
            <select class="form-control" name="isactive">
              <option value="">Select</option>
              <option value="1">Active</option>
              <option value="0">Not active</option>
            </select>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Search </button>
        </form>
      </div>
      <br>


      <div class="d-flex">
        <a href='{{url("/dashboard/category/create")}}' class="btn btn-primary add_btn">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
          Add New
        </a>
      </div>
      <div class="table-responsive">
        @include("dashboard.utility.sucess_message")
        <table class="table card-table table-vcenter text-nowrap datatable">
          <thead>
            <tr>
              <th>
                 Name
              </th>
              <th>
                 Is active
              </th>

              <th></th>
            </tr>
          </thead>
          <tbody>
            	@foreach ($categories as $key => $category)
            <tr>
              <td>{{$category->name}}</td>
              <td>
                @if($category->is_active)
                 <span>True</span>
                @else
                 <span>False</span>

                @endif
              <td class="text-right">
                <a class='btn btn-info btn-xs edit_btn' bt-data="{{$category->id}}" href="{{ url('dashboard/category') }}/{{$category->id}}/edit">
      						<i class="far fa-edit"></i>
                  Edit
      					</a>
      					<a href="#" class="btn btn-danger btn-xs delete_btn"  bt-data="{{$category->id}}" >
      						<i class="far fa-trash-alt"></i>
                  Delete
      					</a>

              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer d-flex align-items-center">
        {{$categories->links('dashboard.vendor.pagination.default')}}
      </div>
    </div>
  </div>
</main>
@include("dashboard/utility/modal_delete")
@endsection
@section('footerjscontent')
<script type="text/javascript">
$(".delete_btn").on("click",function(){
    $('#delete_modal').modal('show');
    $("input[name='delete_val']").val($(this).attr("bt-data"));
    return false;
  });
$(".delete_it_sure").on("click",function(){
    var id = $("input[name='delete_val']").val();
    var url_delete = '{{url("/dashboard/category")}}'+"/"+id;
    $.ajax({url: url_delete ,type: "DELETE", success: function(result){
            var result = JSON.parse(result);
            if(result.sucess)
            {
              window.location.href = '{{url("/dashboard/category")}}';
            }
    }});
  });
</script>
@endsection
