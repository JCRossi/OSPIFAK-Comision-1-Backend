<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="ms-auto">
      @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
          @auth
          <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #333;">Ver sesión</a>
          @else
          <a href="{{ route('login') }}" style="text-decoration: none; color: #333;">
              <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
          </a>

          @endauth
        </div>
        @endif
    </div>
  </div>
</nav>
