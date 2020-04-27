@if(Session::has('error'))
    <input type="hidden" id="status" value="{{Session::get('error')}}">
    <script type='text/javascript'>
      window.onload = function(event) {
        let sts = document.getElementById('status').value;
        swal('Error!', sts, 'error')
      };
  </script> 
@endif

@if(Session::has('success'))
  <input type="hidden" id="status" value="{{Session::get('success')}}">
    <script type='text/javascript'>
      window.onload = function(event) {
        let sts = document.getElementById('status').value;
        swal('Succes!', sts, 'success')
      };
  </script> 
@endif
