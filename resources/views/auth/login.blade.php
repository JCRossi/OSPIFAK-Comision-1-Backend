<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSPIFAK</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f3f4f6; margin: 0; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="position: relative; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);  width: 400px; padding: 20px;">

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Usuario -->
            <div style="margin-bottom: 15px;">
                <label for="usuario" style="font-size: 14px; font-weight: bold; display: block; margin-bottom: 5px;">Usuario</label>
                <input id="usuario" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" type="text" name="usuario" value="{{ old('usuario') }}" required autofocus autocomplete="username">
                @if($errors->has('usuario'))
                    <p style="color: #e53e3e; font-size: 12px; margin-top: 5px;">{{ $errors->first('usuario') }}</p>
                @endif
            </div>

            <!-- Contraseña -->
            <div style="margin-bottom: 15px;">
                <label for="password" style="font-size: 14px; font-weight: bold; display: block; margin-bottom: 5px;">Contraseña</label>
                <input id="password" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" type="password" name="password" required autocomplete="current-password">
                @if($errors->has('password'))
                    <p style="color: #e53e3e; font-size: 12px; margin-top: 5px;">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <!-- Recordarme -->
            <div style="margin-bottom: 15px;">
                <label for="remember_me" style="font-size: 14px; font-weight: normal;">
                    <input id="remember_me" type="checkbox" name="remember" style="vertical-align: middle; margin-right: 5px;"> Recordarme
                </label>
            </div>

            <div style="text-align: center;">
                @if (Route::has('password.request'))
                    <a style="text-decoration: underline; font-size: 14px; color: #3182ce; display: block; margin-bottom: 10px;" href="{{ route('password.request') }}">
                        Olvidé mi contraseña
                    </a>
                @endif
                <button type="submit" style="background-color: #48bb78; color: white; border: none; border-radius: 4px; padding: 10px 20px; cursor: pointer;">Ingresar</button>
            </div>
        </form>

        <div style="position: absolute;  bottom: 10px; right: 10px;">
            <img src="imagen.jpeg" alt="Imagen" style="width: 100px; height: 90px; opacity: 0.7;">
        </div>
    </div>

</body>
</html>

