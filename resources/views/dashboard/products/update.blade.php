@extends('dashboard.layouts.master')
@section('content')
<div class="py-5 text-center">
  <img class="d-block mx-auto mb-4" src="{{ asset('css/assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
  <h2>Categories</h2>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Update Product </h3>
  </div>
  <div class="card-body py-3">
    <div class="alert alert-danger alert-danger-modal" style="display:none">
    </div>
    <div class="alert alert-success alert-success-modal" style="display:none">
    </div>
    <form method="POST" action="{{ url('dashboard/products') }}/{{$product->id}}" enctype="multipart/form-data" class="form_submit_model">
      @csrf
      {!! method_field('patch') !!}
      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="mb-3">
             <label class="form-label">Description</label>
             <input type="text" class="form-control" name="description" value="{{$product->description}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select class="form-control" name="category">
              <option value="">Select</option>
                 @foreach(\App\Category::all() as $category)
                    <option value="{{$category->id}}" {{$category->id == $product->category_id?"selected":""}}>{{$category->name}}</option>
                 @endforeach
            </select>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="mb-3">
            <label class="form-label">Photo</label>
            <input  name="picture" type="file" id="imageInput" class="form-control-file">

            <img src="/uploads/{{$product->picture}}" width="100" height="100" />
          </div>
        </div>

      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="mb-3">
             <label class="form-label">Tags</label>
             <input type="text" class="form-control" name="tags" value="{{implode(', ', $product->productTags->pluck('name')->toarray())}}" >

          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">+ Save </button>
  </form>
  </div>

</div>
@endsection
@section('footerjscontent')
<script type="text/javascript">
var i = 1;
var html = "";
var _sucess = function(response)
{
  if(response.sucess)
  {
    $(".alert-success-modal").html(response.sucess_text);
    $(".alert-success-modal").css("display","block");
    $('#add_edit_modal').modal('hide');
    $("input[name='method_type']").val("add");
  //  window.location.href = '{{url("/dashboard/country")}}';
  }
  else
  {
    var $error_text = "";
    var errors = response.errors;

    $.each(errors, function (key, value) {
      $error_text +=value+"<br>";
    });

    $(".alert-danger-modal").html($error_text);
    $(".alert-danger-modal").css("display","block");

  }

}

$(".form_submit_model").submit(function(e){

    e.preventDefault();
    var submit_form_url = $(this).attr('action');
    var $method_is = "POST";
    var formData = new FormData($(this)[0]);
    $(".alert-success-modal").css("display","none");
    $(".alert-danger-modal").css("display","none");
    $.ajax({
        url: submit_form_url,
        type: $method_is,
        data: formData,
        async: false,
        dataType: 'json',
        success: function (response) {
                  _sucess(response);
        },
        error : function( data )
        {

        },
        cache: false,
        contentType: false,
        processData: false
    });

      return false;
});
var input = document.querySelector('input[name=tags]');
new Tagify(input)

</script>
@endsection
