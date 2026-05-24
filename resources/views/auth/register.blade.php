<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription — GestionVoyages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .register-card { border: 1.5px solid #eee; max-width: 420px; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="w-100 px-3">
        <div class="card register-card mx-auto">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-circle fs-1 text-dark"></i>
                    <h1 class="h4 fw-bold mt-2 mb-0">Créer un compte</h1>
                    <p class="text-muted small">Inscription client</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-person me-1"></i>Nom complet
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="Ex: Mohammed Alami" autofocus required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Email
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="exemple@email.com" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i>Mot de passe
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 8 caractères" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1"></i>Confirmer le mot de passe
                        </label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-dark w-100">
                        <i class="bi bi-person-plus me-1"></i>S'inscrire
                    </button>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted small mb-2">Déjà un compte ?</p>
                    <a href="{{ route('login') }}" class="btn btn-outline-dark w-100">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Se connecter
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
