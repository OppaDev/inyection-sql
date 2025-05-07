<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">

</head>

<body>
    <h1>Ataque XSS</h1>

    <div class="container-fluid">

        <form action="{{ route('n.guardar') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Ingrese el comentario</label>
                <textarea class="form-control" id="contenido" name="contenido" rows="3" ></textarea>
            </div>
            <button type="submit" class="btn btn-primary" >Guardar</button>
        </form>
        <hr>

        @foreach ($noticias as $n)
        <li>
            <!-- {!! $n -> contenido !!} -->
            {{ $n -> contenido }}
        </li>
        @endforeach

        <!-- <script>
            alert('Ingresado');
        </script> -->

        <!-- <script>
            document.body.innerHTML = '<h1>Ingrsa tu contrseña</h1><input name="password" type="password"> <button onclick="alert(document.querySelector(\'input[name=password]\').value)">Enviar</button>'
        </script> -->

    </div>


</html>