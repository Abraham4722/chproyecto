<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CH-SHIRTS | Login</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <style>
        /* Fondo con imagen desvanecida */
        body {
            background: url('/img/fondo.jpg') repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden; /* Evita el scroll */
        }

        /* Capa para oscurecer el fondo */
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

        /* Estilo del cuadro de login */
        .login-box {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 380px; /* Más compacto */
            text-align: center;
        }

        .login-box h1 {
            font-size: 22px;
            font-weight: bold;
            color: #2c3e50;
        }

        /* Botón de inicio de sesión */
        .btn-login {
            width: 100%;
            font-size: 14px;
            font-weight: bold;
            padding: 8px;
        }

        /* Estilos para los botones sociales */
        .social-auth {
            margin-top: 10px;
        }

        .social-auth a {
            display: block;
            width: 100%;
            font-size: 14px;
            margin-bottom: 8px;
            font-weight: bold;
            padding: 6px;
        }

        .social-auth a i {
            margin-right: 6px;
        }

        /* Enlaces */
        .login-links {
            font-size: 13px;
            margin-top: 10px;
        }

        /* Reducir tamaño de input */
        .input-group input {
            padding: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h1>CH-SHIRTS</h1>

        <p>Inicia sesión para continuar</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
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

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-login">Iniciar Sesión</button>
            </div>
        </form>

        <!-- Botones sociales -->
        <div class="social-auth">
        <hr>
            <p>- O -</p>
            <a href="#" class="btn btn-danger">
                <i class="bi bi-google"></i> Iniciar con Google
            </a>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-facebook"></i> Iniciar con Facebook
            </a>
        </div>

        <!-- Enlaces -->
        <div class="login-links">
            <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a><br>
            <a href="{{ route('register') }}">Registrarse</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>




@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
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

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
