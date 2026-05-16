@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="https://cloudflare.com">

<style>
    /* Fondo oscuro unificado */
    body, .main-register-container {
        background-color: #0b0f19 !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #ffffff;
    }

    .main-register-container {
        min-height: 90vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }

    /* Tarjeta translúcida con Glassmorphism */
    .custom-register-card {
        background: rgba(22, 30, 49, 0.7) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-radius: 16px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
        padding: 35px;
        max-width: 550px;
        width: 100%;
    }

    /* Encabezado */
    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .register-header .brand-icon {
        font-size: 42px;
        color: #4f46e5;
        margin-bottom: 10px;
    }

    .register-header h2 {
        font-size: 28px;
        font-weight: 700;
        letter-spacing: 1px;
        margin: 0;
    }

    .register-header h2 span {
        color: #4f46e5;
    }

    .register-header p {
        color: #94a3b8;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Formulario en dos columnas para campos cortos */
    .register-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .full-width {
        grid-column: span 2;
    }

    @media (max-width: 576px) {
        .register-grid {
            grid-template-columns: 1fr;
        }
        .full-width {
            grid-column: span 1;
        }
    }

    .form-group-custom {
        margin-bottom: 5px;
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
        font-size: 14px;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        border-color: #4f46e5 !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2) !important;
    }

    .error-message {
        color: #f87171;
        font-size: 13px;
        margin-top: 5px;
        display: block;
    }

    .btn-register-submit {
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
        margin-top: 20px;
    }

    .btn-register-submit:hover {
        background-color: #4338ca !important;
        transform: translateY(-1px);
    }

    .register-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
        color: #94a3b8;
    }

    .register-footer a {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
    }

    .register-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="main-register-container">
    <div class="custom-register-card">

        <div class="register-header">
            <div class="brand-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2>Crear Cuenta en Style<span>Me</span></h2>
            <p>Únete a la experiencia de moda asistida por IA</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="register-grid">

                <!-- Nombre Completo -->
                <div class="form-group-custom full-width">
                    <label for="name">Nombre Completo</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user"></i>
                        <input id="name" type="text" class="form-control-custom @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Tu nombre y apellido">
                    </div>
                    @error('name')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Correo Electrónico -->
                <div class="form-group-custom full-width">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" class="form-control-custom @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ejemplo@correo.com">
                    </div>
                    @error('email')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="form-group-custom">
                    <label for="phone">Número Telefónico</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone"></i>
                        <input id="phone" type="text" class="form-control-custom @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" placeholder="7081-6666">
                    </div>
                    @error('phone')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="form-group-custom">
                    <label for="address">Dirección de Envío</label>
                    <div class="input-wrapper">
                        <i class="fas fa-location-dot"></i>
                        <input id="address" type="text" class="form-control-custom @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="San Salvador, El Salvador">
                    </div>
                    @error('address')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Contraseña -->
                <div class="form-group-custom">
                    <label for="password">Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" class="form-control-custom @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Mínimo 8 caracteres">
                    </div>
                    @error('password')
                        <span class="error-message" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group-custom">
                    <label for="password-confirm">Confirmar Contraseña</label>
                    <div class="input-wrapper">
                        <i class="fas fa-shield-halved"></i>
                        <input id="password-confirm" type="password" class="form-control-custom" name="password_confirmation" required autocomplete="new-password" placeholder="Repite tu contraseña">
                    </div>
                </div>

            </div>

            <button type="submit" class="btn-register-submit">
                Registrar nueva cuenta
            </button>
        </form>

        <div class="register-footer">
            ¿Ya tienes cuenta activa? <a href="{{ route('login') }}">Inicia sesión aquí</a>
        </div>

    </div>
</div>
@endsection
