<!DOCTYPE html>
<html lang="es" class={{$pageName}}>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Final - @yield('titulo')</title>
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!--HEADER-->
    @include ('layout-front.header')


    <!--CONTAINER SECTION & ASIDE -->
    <div class="container">

        <section>
            @yield('section')
        </section>

        <!--ASIDE-->
        @include ('layout-front.aside')

    </div>

        <!--FOOTER-->
        @include('layout-front.footer')
</body>

</html>