@extends('layouts.app')

@section('content')
<!-- Mantenemos tus estilos por si acaso, pero el diseño fuerte va en el bloque style -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cloudflare.com">

<style>
    /* Fondo oscuro unificado con la home */
    body, .main-login-container {
        background-color: #0b0f19 !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #ffffff;
    }

    .main-login-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }

    /* Tarjeta de login futurista y minimalista */
    .custom-login-card {
        background: rgba(22, 30, 49, 0.7) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 16px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        padding: 30px;
        max-width: 450px;
        width: 100%;
    }

    /* Encabezado del Formulario */
    .login-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .login-header .brand-icon {
        font-size: 42px;
        color: #4f46e5; /* Morado IA */
        margin-bottom: 10px;
    }

    .login-header h2 {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
    }

    .login-header h2 span {
        color: #4f46e5;
    }

    .login-header p {
        color: #94a3b8;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Estilos de los inputs */
    .form-group-custom {
        margin-bottom: 25px;
        position: relative;
    }

    .form-group-custom label {
        color: #cbd5e1;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 8px;
        display: block;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #64748b;
        font-size: 16px;
    }

    .form-control-custom {
        width: 100%;
        background-color: #0f172a !important;
        border: 1px solid #334155 !important;
        border-radius: 8px !important;
        padding: 12px 12px 12px 45px !important;
        color: #ffffff !important;
        font-size: 15px;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        border-color: #4f46e5 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2) !important;
    }

    /* Mensajes de error */
    .error-message {
        color: #f87171;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    /* Botón de envío */
    .btn-login-submit {
        background-color: #4f46e5 !important;
        border: none !important;
        color: white !important;
        width: 100%;
        padding: 12px !important;
        border-radius: 8px !important;
        font-size: 16px !important;
        font-weight: 600 !important;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 10px;
    }

    .btn-login-submit:hover {
        background-color: #4338ca !important;
        transform: translateY(-1px);
    }

    /* Enlace de registro abajo */
    .login-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
        color: #94a3b8;
    }

    .login-footer a {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="main-login-container">
    <div class="custom-login-card">

        <!-- Cabecera con la nueva identidad visual -->
        <div class="login-header">
            <div class="brand-icon">
                <i class="fas fa-shirt"></i> <!-- Icono de ropa/moda para StyleMe -->
            </div>
            <h2>Style<span>Me</span></h2>
            <p>Bienvenido de vuelta, ingresa tus credenciales</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Input Email -->
            <div class="form-group-custom">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input id="email" type="email" class="form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="ejemplo@correo.com">
                </div>
                @error('email')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Input Password -->
            <div class="form-group-custom">
                <label for="password">{{ __('Contraseña') }}</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input id="password" type="password" class="form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                </div>
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Botón de Ingresar -->
            <button type="submit" class="btn-login-submit">
                {{ __('Iniciar Sesión') }}
            </button>
        </form>

        <!-- Redirección rápida al registro -->
        <div class="login-footer">
            ¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
        </div>

    </div>
</div>
@endsection
