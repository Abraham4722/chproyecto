<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - CH-SHIRTS</title>
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

        .register-box {
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

        .register-box h1 {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }

        .btn-register {
            width: 100%;
            font-size: 15px;
            font-weight: bold;
            padding: 10px;
        }

        .input-group input {
            padding: 10px;
            font-size: 14px;
        }

        .social-buttons .btn {
            width: 100%;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h1>Registro en CH-SHIRTS</h1>
        <p>Crea una cuenta para continuar</p>

        <!-- Botones de registro con redes sociales -->
        <div class="social-buttons">
            <button class="btn btn-outline-dark">
                <i class="bi bi-google"></i> Registrarse con Google
            </button>
            <button class="btn btn-outline-primary">
                <i class="bi bi-facebook"></i> Registrarse con Facebook
            </button>
        </div>

        <hr>

        <!-- Formulario de registro -->
        <form>
            <div class="mb-2">
                
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input id="name" type="text" class="form-control" placeholder="Tu Nombre" required>
                </div>
            </div>

            <div class="mb-2">
                
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input id="email" type="email" class="form-control" placeholder="correo@ejemplo.com" required>
                </div>
            </div>

            <div class="mb-2">
                
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input id="password" type="password" class="form-control" placeholder="Contraseña" required>
                </div>
            </div>

            <div class="mb-2">
                
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar Contraseña" required>
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-register">Registrarse</button>
            </div>
        </form>

        <div class="mt-2">
            <small>¿Ya tienes cuenta? <a href="login.html">Inicia sesión</a></small>
        </div>
    </div>
</body>
</html>






@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
