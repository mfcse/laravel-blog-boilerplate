<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{mix('css/app.css')}}">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="//getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css"> --}}
        <link rel="stylesheet" href="//getbootstrap.com/docs/4.0/examples/blog/blog.css">
        
        {{-- <link rel="stylesheet" href="{{mix('css/blog.css')}}"> --}}
<body>

    <div class="container">
      @include('partials.nav-bar')
      {{-- @includeWhen(request()->is('/'),  'partials.jumbotron') --}}
    </div>
    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          @yield('content')
        </div>

        <aside class="col-md-4 blog-sidebar">
        @include('partials.sidebar')
      </aside><!-- /.blog-sidebar -->
      
      </div><!-- /.row -->

    </main><!-- /.container -->

    @include('partials.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/holder.min.js"></script> --}}
    <script src="{{mix('js/app.js')}}"></script>
    <script>
      // Holder.addTheme('thumb', {
      //   bg: '#55595c',
      //   fg: '#eceeef',
      //   text: 'Thumbnail'
      // });

      //echo feature
      //for private
      Echo.private('post.created').listen('PostCreated', (e) => {
        console.log(e.post);
        $.notify(e.post.title+' has been published now');
        //$.notify("Hello World");
    });

    // Echo.private(`post.created.${postId}`)
    // .listen('PostCreated', (e) => {
    //     console.log(e.post);
    //     $.notify(e.post.title+' has been published now');
    // });



        //for public
    //   Echo.channel('post.created').listen('PostCreated', (e) => {
    //     console.log(e.post);
    //     $.notify(e.post.title+' has been published now');
    //     //$.notify("Hello World");
    // });
    </script>
  </body>
</html>