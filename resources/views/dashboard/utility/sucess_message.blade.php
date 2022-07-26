<div>
  @if(Session::has("message"))
    <div class="alert alert-success in_table">
          <strong>Success!</strong> {{Session::get("message")}}
    </div>
    <script type="text/javascript">
        setTimeout(function(){ $(".alert-success").fadeOut(); {{Session::forget('message')}} }, 2000);
    </script>
 @endif
</div>
