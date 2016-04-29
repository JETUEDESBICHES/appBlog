<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'AppBlog')</title>
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <body>
        <header>
            <nav class="navbar navbar-default navbar-static-top">@include('partials.nav')</nav>
        </header>
        <div class="container">
            <div class="col-md-8">
                @yield('h1')
                @yield('content')
            </div>
            <div class="col-md-4">
                <div class="sidebar">
                    @yield('sidebar')
                </div>
            </div>

        </div>
                  






        <footer></footer>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>