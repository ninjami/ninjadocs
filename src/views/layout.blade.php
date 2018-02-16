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
            padding: 3rem 0;
          }

          .container {
            max-width: 730px;
          }

          .table-of-contents {
            margin: 3rem 0;
          }

          .anchor {
            color: #000;
          }
          .anchor:hover {
            color: #000;
          }
          .anchor:focus {
            outline: none;
          }

          h1, h2, h3, h4, h5, h6 {
            margin-top: 2rem;
            margin-bottom: 1rem;
          }

          .anchor h2, .anchor h3 {
            font-weight: normal;
          }

          .h1-link { margin-left: 0em; font-weight: bold; }
          .h2-link { margin-left: 0em; font-weight: bold; }
          .h3-link { margin-left: 1.5em; }
          .h4-link { margin-left: 3em; }
          .h5-link { margin-left: 4.5em; }
          .h6-link { margin-left: 6em; }

          img {
            max-width: 100%;
          }

        </style>
    </head>
    <body>

        @yield('content')

    </body>
</html>
