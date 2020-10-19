<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="icon" href="../assets/img/favicon.png">
        
        <meta name="keywords" content="">
        <meta name="description" content="">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <title>@yield('title')</title>
        @yield('styles')
    </head>
    <body class="@yield('body')">
        <div class="main">
            @yield('content')
        </div>
        @include('layouts.script')
        @yield('script')
        @stack('scripts')
        <script type="text/javascript">
        </script>
    </body>
</html>