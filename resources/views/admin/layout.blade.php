<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Raquibul Islam | Admin</title>
  <link rel="icon" href="{{ asset('raquibul-logo-favicon.png') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
  // Global toastr defaults
  toastr.options = {
    closeButton: true,
    progressBar: true,
    newestOnTop: true,
    positionClass: "toast-bottom-right",
    timeOut: 2500,
    extendedTimeOut: 1000,
    preventDuplicates: true
  };
</script>
   <style>
  /* make sure toasts sit above modals/dropzones */
  #toast-container { z-index: 999999; }
</style>
  <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
  <script>
    tinymce.init({
        selector: '#body',   // Target your textarea
        license_key: 'gpl',
        plugins: 'link image code lists table emoticons preview',
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image table emoticons | code preview',
        menubar: false,
        height: 400,
        branding: false,
        placeholder: 'Write your blog content here...',
    });
</script>
</head>
<body>
  <main class="container">
    @yield('content')
  </main>




@stack('scripts')


</body>
</html>
