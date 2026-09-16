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
</head>
<body>
    @include('nav')

    <main class="container">
        <h2 class="section-title">List Game</h2>

        {{-- PS4 Games Section --}}
        <section class="game-section ps4-section">
            <div class="header-section">
                <img src="{{ asset('images/logo4.png') }}" alt="PS4 Logo" class="console-logo" />
            </div>

            <div class="games-grid" id="ps4-grid">
                {{-- Game yang selalu tampil --}}
                <img src="{{ asset('images/Game4/tkn8.png') }}" alt="Tekken 8" title="Tekken 8" />
                <img src="{{ asset('images/Game4/nrt.png') }}"  alt="Naruto Storm 4" title="Naruto Storm 4" />
                <img src="{{ asset('images/Game4/efb.png') }}"  alt="eFootball PES" title="eFootball / PES" />
                <img src="{{ asset('images/Game4/fc.png') }}"   alt="EA FC 25" title="EA FC 25" />
                <img src="{{ asset('images/Game4/gow.png') }}"  alt="God of War Ragnarok" title="God of War Ragnarök" />
                <img src="{{ asset('images/Game4/nba.png') }}"  alt="NBA 2K25" title="NBA 2K25" />
                <img src="{{ asset('images/Game4/it2.png') }}"  alt="It Takes Two" title="It Takes Two" />
                {{-- Game tambahan (tersembunyi dulu) --}}
                <img class="extra-game"
                     src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
                     alt="GTA V" title="Grand Theft Auto V" />
            </div>

            <div class="console-image-container">
                <img src="{{ asset('images/device4.png') }}" alt="PS4 Console" class="console-image" />
            </div>

            <button class="btn more-games-btn" id="ps4-more-btn" onclick="toggleMoreGames('ps4-grid','ps4-more-btn')">
                More Games...
            </button>
        </section>

        {{-- PS3 Games Section --}}
        <section class="game-section ps3-section">
            <div class="header-section">
                <img src="{{ asset('images/logo3.png') }}" alt="PS3 Logo" class="console-logo" />
            </div>

            <div class="games-grid" id="ps3-grid">
                {{-- Game yang selalu tampil --}}
                <img src="{{ asset('images/game3/nrt.png') }}" alt="Naruto Storm" title="Naruto Storm" />
                <img src="{{ asset('images/game3/efb.png') }}" alt="eFootball PES" title="eFootball / PES" />
                <img src="{{ asset('images/game3/fc3.png') }}" alt="Far Cry 3" title="Far Cry 3" />
                <img src="{{ asset('images/game3/gow.png') }}" alt="God of War" title="God of War" />
                {{-- Game tambahan (tersembunyi dulu) --}}
                <img class="extra-game"
                     src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
                     alt="GTA V" title="Grand Theft Auto V" />
            </div>

            <div class="console-image-container"></div>

            <button class="btn more-games-btn" id="ps3-more-btn" onclick="toggleMoreGames('ps3-grid','ps3-more-btn')">
                More Games...
            </button>
        </section>
    </main>

    <script>
        /**
         * Toggle tampilkan/sembunyikan game tambahan (.extra-game)
         * @param {string} gridId  - ID elemen games-grid
         * @param {string} btnId   - ID tombol "More Games"
         */
        function toggleMoreGames(gridId, btnId) {
            var grid = document.getElementById(gridId);
            var btn  = document.getElementById(btnId);
            if (!grid || !btn) return;

            var isOpen = grid.classList.toggle('show-all');
            btn.textContent = isOpen ? 'Sembunyikan ▲' : 'More Games...';
        }
    </script>

    @include('footer')
</body>
</html>
