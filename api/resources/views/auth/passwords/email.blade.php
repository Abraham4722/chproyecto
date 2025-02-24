<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - CH-SHIRTS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background: url('tu-imagen.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .reset-box {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            max-height: 85vh; /* No ocupa todo el alto */
            overflow-y: auto; /* Solo muestra scroll si es necesario */
            text-align: center;
        }

        .reset-box h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .btn-reset {
            width: 100%;
            font-size: 15px;
            font-weight: bold;
            padding: 10px;
        }

        .input-group input {
            padding: 10px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="reset-box">
        <h1>Recuperar Contraseña</h1>
        <p>Ingresa tu nueva contraseña</p>

        <form>
            <div class="mb-2">
                <label for="email" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input id="email" type="email" class="form-control" placeholder="correo@ejemplo.com" required>
                </div>
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">Nueva Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input id="password" type="password" class="form-control" placeholder="********" required>
                </div>
            </div>

            <div class="mb-2">
                <label for="password-confirm" class="form-label">Confirmar Nueva Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input id="password-confirm" type="password" class="form-control" placeholder="********" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-reset">Restablecer Contraseña</button>
            </div>
        </form>

        <div class="mt-2">
            <small>¿Ya la recordaste? <a href="login.html">Inicia sesión</a></small>
        </div>
    </div>
</body>
</html>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
