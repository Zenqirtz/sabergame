<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Daftar game PS3 & PS4 yang tersedia di Saber Game Malang. Pilih game favoritmu!" />
    <title>List Game - Saber Game Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @vite('resources/css/app.css')
    <style>
        /* Layout section game: header-logo, body (grid + konsol), footer-btn */
        .game-section-inner {
            display: flex;
            align-items: flex-start;
            gap: 24px;
        }

        .games-grid {
            flex: 1;
            min-width: 0;
        }

        /* Gambar konsol di kanan section, tidak overlap */
        .console-side-img {
            flex-shrink: 0;
            width: 160px;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            align-self: stretch;
        }

        .console-side-img img {
            width: 100%;
            max-height: 220px;
            object-fit: contain;
            filter: drop-shadow(0 4px 16px rgba(0,0,0,0.45));
            pointer-events: none;
            user-select: none;
        }

        /* Tombol More Games — posisi normal (bukan absolute lagi) */
        .more-games-btn {
            position: static !important;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 20px;
            background: rgba(255,255,255,0.15);
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
            padding: 10px 24px;
            border: 2px solid rgba(255,255,255,0.5);
            backdrop-filter: blur(4px);
            font-size: 0.875rem;
            transition: background 0.25s ease, transform 0.25s ease, border-color 0.25s ease;
            cursor: pointer;
        }

        .more-games-btn:hover {
            background: rgba(255,255,255,0.28);
            border-color: rgba(255,255,255,0.85);
            transform: translateY(-2px);
        }

        /* Override padding-bottom section (tidak perlu ruang absolut lagi) */
        .game-section {
            padding-bottom: 28px !important;
        }

        @media (max-width: 680px) {
            .game-section-inner { flex-direction: column; }
            .console-side-img { width: 100%; align-items: center; }
            .console-side-img img { max-height: 140px; }
        }
    </style>
</head>
<body>
    @include('nav')

    <main class="container">
        <h2 class="section-title">List Game</h2>

        {{-- PS4 Games Section --}}
        <section class="game-section ps4-section">
            {{-- Logo kanan atas --}}
            <div class="header-section">
                <img src="{{ asset('images/logo4.png') }}" alt="PlayStation 4" class="console-logo" />
            </div>

            {{-- Isi: grid game + gambar konsol di kanan --}}
            <div class="game-section-inner">
                <div class="games-grid" id="ps4-grid">
                    {{-- Game yang selalu tampil --}}
                    <img src="{{ asset('images/Game4/tkn8.png') }}" alt="Tekken 8"          title="Tekken 8" />
                    <img src="{{ asset('images/Game4/nrt.png') }}"  alt="Naruto Storm 4"    title="Naruto Storm 4" />
                    <img src="{{ asset('images/Game4/efb.png') }}"  alt="eFootball / PES"   title="eFootball / PES" />
                    <img src="{{ asset('images/Game4/fc.png') }}"   alt="EA FC 25"          title="EA FC 25" />
                    <img src="{{ asset('images/Game4/gow.png') }}"  alt="God of War Ragnarök" title="God of War Ragnarök" />
                    <img src="{{ asset('images/Game4/nba.png') }}"  alt="NBA 2K25"          title="NBA 2K25" />
                    <img src="{{ asset('images/Game4/it2.png') }}"  alt="It Takes Two"      title="It Takes Two" />
                    {{-- Game tambahan, tersembunyi dulu --}}
                    <img class="extra-game"
                         src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
                         alt="GTA V" title="Grand Theft Auto V" />
                </div>

                {{-- Gambar konsol PS4 — di samping kanan grid, tidak overlap --}}
                <div class="console-side-img">
                    <img src="{{ asset('images/device4.png') }}" alt="PlayStation 4 Console" />
                </div>
            </div>

            <button class="btn more-games-btn" id="ps4-more-btn"
                    onclick="toggleMoreGames('ps4-grid','ps4-more-btn')">
                More Games... <i class="fas fa-chevron-down" id="ps4-icon"></i>
            </button>
        </section>

        {{-- PS3 Games Section --}}
        <section class="game-section ps3-section">
            {{-- Logo kanan atas --}}
            <div class="header-section">
                <img src="{{ asset('images/logo3.png') }}" alt="PlayStation 3" class="console-logo" />
            </div>

            {{-- Isi: grid game + gambar konsol PS3 di kanan --}}
            <div class="game-section-inner">
                <div class="games-grid" id="ps3-grid">
                    {{-- Game yang selalu tampil --}}
                    <img src="{{ asset('images/game3/nrt.png') }}" alt="Naruto Storm"    title="Naruto Storm" />
                    <img src="{{ asset('images/game3/efb.png') }}" alt="eFootball / PES" title="eFootball / PES" />
                    <img src="{{ asset('images/game3/fc3.png') }}" alt="Far Cry 3"       title="Far Cry 3" />
                    <img src="{{ asset('images/game3/gow.png') }}" alt="God of War"      title="God of War" />
                    {{-- Game tambahan, tersembunyi dulu --}}
                    <img class="extra-game"
                         src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
                         alt="GTA V" title="Grand Theft Auto V" />
                </div>

                {{-- Gambar konsol PS3 di samping kanan grid (transparan seperti PS4 device4.png) --}}
                <div class="console-side-img">
                    <img src="{{ asset('images/device3.png') }}" alt="PlayStation 3 Console" />
                </div>
            </div>

            <button class="btn more-games-btn" id="ps3-more-btn"
                    onclick="toggleMoreGames('ps3-grid','ps3-more-btn')">
                More Games... <i class="fas fa-chevron-down" id="ps3-icon"></i>
            </button>
        </section>
    </main>

    <script>
        /**
         * Toggle tampilkan / sembunyikan .extra-game dalam grid
         */
        function toggleMoreGames(gridId, btnId) {
            var grid = document.getElementById(gridId);
            var btn  = document.getElementById(btnId);
            if (!grid || !btn) return;

            var isOpen = grid.classList.toggle('show-all');
            var icon   = btn.querySelector('i');

            btn.childNodes[0].textContent = isOpen ? 'Sembunyikan ' : 'More Games... ';
            if (icon) {
                icon.className = isOpen ? 'fas fa-chevron-up' : 'fas fa-chevron-down';
            }
        }
    </script>

    @include('footer')
</body>
</html>
