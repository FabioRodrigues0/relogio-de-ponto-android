<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oops! Algo deu errado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <img src="https://www.layoutcriativo.com/wp-content/uploads/2021/06/cesae.png" alt="Erro" class="img-fluid mb-4">
                <h1 class="display-4 fw-bold">Oops! Algo deu errado.</h1>
                <p class="lead text-muted">Não conseguimos encontrar a página que estavas à procura.</p>
                <div class="mt-4">
                    <a href="{{ route('home.page') }}" class="btn btn-outline-secondary btn-lg">Voltar à Página Inicial</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
