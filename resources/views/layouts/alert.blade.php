@if ($message = Session::get('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
      <script type="text/javascript">
        window.onload = contoh();
        function contoh() {
           swal.alert({
                title: "Berhasil!",
                text: "Pop-up berhasil ditampilkan",
                icon: "success",
                button: true
            });
        }
    </script>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-error alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
      </div>
    @endif
    

    @if ($message = Session::get('warning'))
      <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('info'))
      <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
      </div>
    @endif

    @if ($errors->any())
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        Please check the form below for errors
    </div>
    @endif