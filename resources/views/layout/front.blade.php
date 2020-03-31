<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Final - @yield('titulo')</title>
</head>

<body>

    <header>
        @section('header')
        <h1>Algunas entradas</h1>
        @show
    </header>

    <nav>

    </nav>

    <div class="container">
        <section>
            @yield('section')
        </section>
    </div>


    <footer>
        @section('footer')
            <h3>bloque Footer</h3>
        @show
    </footer>


</body>

</html>