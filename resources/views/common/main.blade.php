<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        table {
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
    </head>
    <body id="public">
        <div id="nav">
            <a href="{{ url('/') }}">Home</a>
            <a href="{{ url('/price_rules') }}">Price Rules</a>
        </div>
        @yield('content')
        @yield('scripts')
    </body>
</html>