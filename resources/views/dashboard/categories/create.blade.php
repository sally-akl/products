@extends('dashboard.layouts.master')
@section('content')
<div class="py-5 text-center">
  <img class="d-block mx-auto mb-4" src="{{ asset('css/assets/brand/bootstrap-logo.svg') }}" alt="" width="72" height="57">
  <h2>Categories</h2>
</div>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Add category </h3>
  </div>
  <div class="card-body py-3">
    <div class="alert alert-danger alert-danger-modal" style="display:none">
    </div>
    <div class="alert alert-success alert-success-modal" style="display:none">
    </div>
    <form method="POST" action="{{ url('dashboard/category') }}" enctype="multipart/form-data" class="form_submit_model">
      @csrf
    <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
          <label class="form-label">Categoy Name</label>
          <input type="text" class="form-control" name="name" value="{{old('name')}}">
        </div>
      </div>
      <div class="col-lg-6">
        <div class="mb-3">
           <label class="form-label">Categoy Parent Name</label>
           <input type="text" class="form-control" name="pname" value="{{old('pname')}}">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="mb-3">
          <label class="form-label">Is active</label>
          <select class="form-control" name="isactive">
            <option value="1" {{old('isactive') == 1?"selected":""}}>Active</option>
            <option value="0" {{old('isactive') == 0?"selected":""}}>Not active</option>
          </select>
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

</script>
@endsection
