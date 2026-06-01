<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Saber Game - List Game</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
    rel="stylesheet"
  />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  @vite('resources/css/app.css')
</head>

<body>
    @include('nav')
  <main class="container">
    <h2 class="section-title">List Game</h2>

    <!-- PS4 Games Section -->
    <section class="game-section ps4-section">
      <div class="header-section">
        <img src="{{ asset('images/logo4.png') }}" alt="PS4" />
        <span class="console-text"></span>
      </div>
      <div class="games-grid">
        <img src="images/game4/tkn8.png" alt="Tekken 8" />
        <img
          src="images/Game4/nrt.png"
          alt="Naruto Storm 4"
        />
        <img
          src="images/Game4/efb.png"
          alt="PES 2021"
        />
        <img
          src="images/Game4/fc.png"
          alt="FIFA 25"
        />
        <img
          src="images/Game4/gow.png"
          alt="God of War Ragnarok"
        />
        <img
          src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
          alt="GTA V"
        />
        <img
          src="images/Game4/nba.png"
          alt="NBA 2K25"
        />
        <img src="{{ asset('images/Game4/it2.png') }}" alt="It Takes Two" />
      </div>
      <div class="console-image-container">
        {{-- <img src="{{ asset('images/device4.png') }}" alt="" /> --}}
      </div>
      <button class="btn more-games-btn">More Games...</button>
    </section>

    <!-- PS3 Games Section -->
    <section class="game-section ps3-section">
      <div class="header-section">
        <img
          src="images/logo3.png"
          alt="PS3 Logo"
          class="console-logo"
        />
        <span class="console-text"><br /><small></small></span>
      </div>
      <div class="games-grid">
        <img
          src="images/game3/nrt.png"
          alt="Naruto Storm 4"
        />
        <img
          src="images/game3/efb.png"
          alt="PES 2021"
        />
        <img
          src="images/game3/fc3.png"
          alt="Far Cry 3"
        />
        <img
          src="images/game3/gow.png"
          alt="God of War Ragnarok"
        />
        <img
          src="https://upload.wikimedia.org/wikipedia/en/a/a5/Grand_Theft_Auto_V.png"
          alt="GTA V"
        />
      </div>
      <div class="console-image-container">
      </div>
      <button class="btn more-games-btn">More Games...</button>
    </section>
  </main>
  @include('footer')
</body>
</html>
