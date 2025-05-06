<!doctype html>
<html lang="ES">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container">
    <form action="{{ route('cuenta.procesar') }}" method="post">

        @csrf

        
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Ingrese el nombre del usuario</label>
            <input type="text" name="usuario" value="' OR'1'='1" class="form-control" id="exampleInputPassword1">
        </div>


        <button type="submit" class="btn btn-primary">CONSULTAR SALDO</button>
    </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  </body>
</html>