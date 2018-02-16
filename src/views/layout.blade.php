<!doctype html>
<html lang="{{ app()->getLocale() }}" class="@yield('htmlClass')">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
          @if(array_key_exists('title', View::getSections()))
            @yield('title') - Documentation
          @else
            Documentation
          @endif
        </title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <style>
          body {
            padding: 50px 0;
          }
        </style>
    </head>
    <body>

        @yield('content')

    </body>
</html>
