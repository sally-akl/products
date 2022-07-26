
<div class="alert alert-danger in_form" style="{{count($errors) > 0 ?'display:block':'display:none'}}">

  @foreach ($errors->all() as $error)
    <span  role="alert">
        <strong>{{  $error }}</strong>
    </span> <br>
  @endforeach
</div>
