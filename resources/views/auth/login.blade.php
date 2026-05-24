<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — GestionVoyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-card { border: 1.5px solid #eee; max-width: 420px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="w-100 px-3">
        <div class="card login-card mx-auto">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <i class="bi bi-bus-front-fill fs-1 text-dark"></i>
                    <h1 class="h4 fw-bold mt-2 mb-0">GestionVoyages</h1>
                    <p class="text-muted small">Espace administrateur</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-check-circle-fill"></i>{{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Email
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="admin@travel.ma" autofocus required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i>Mot de passe
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label text-muted small" for="remember">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Se connecter
                    </button>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted small mb-2">Pas encore de compte client ?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-dark w-100">
                        <i class="bi bi-person-plus me-1"></i>Créer un compte client
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
