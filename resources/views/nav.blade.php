<header class="header">
    <div class="container header-container">
        <div class="logo">
            <img src="{{ asset('images/logo-saber.png') }}" alt="Saber Game" />
        </div>

        {{-- Hamburger untuk mobile --}}
        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav>
            <ul class="nav-links" id="nav-links">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('/device') }}" class="{{ request()->is('device') ? 'active' : '' }}">
                        <i class="fab fa-playstation"></i> Available Device
                    </a>
                </li>
                <li>
                    <a href="{{ url('/listgame') }}" class="{{ request()->is('listgame') ? 'active' : '' }}">
                        <i class="fas fa-gamepad"></i> List Game
                    </a>
                </li>
            </ul>
        </nav>

        <div class="auth-buttons" id="auth-buttons">
            <button class="btn-register" onclick="alert('Fitur Register segera hadir!')">Register</button>
            <button class="btn-signin" onclick="alert('Fitur Sign In segera hadir!')">Sign In</button>
        </div>
    </div>
</header>

<script>
    // Mobile hamburger toggle
    (function () {
        var btn = document.getElementById('hamburger');
        var nav = document.getElementById('nav-links');
        var auth = document.getElementById('auth-buttons');
        if (!btn) return;
        btn.addEventListener('click', function () {
            btn.classList.toggle('open');
            nav.classList.toggle('open');
            auth.classList.toggle('open');
        });
    })();
</script>
