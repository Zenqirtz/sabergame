<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Cek ketersediaan device PS3 & PS4 rental Saber Game Malang secara real-time." />
    <title>Available Device - Saber Game Malang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    @vite('resources/css/app.css')
</head>
<body>
    @include('nav')

    <main class="container">
        <h2 class="section-title">Available Device</h2>

        {{-- PS4 Section --}}
        <section class="device-section">
            <div class="device-image">
                <span class="device-badge">PS4</span>
                <img src="{{ asset('images/PS4.png') }}" alt="PlayStation 4" />
            </div>
            <div class="device-controls">
                <div class="device-label">
                    <i class="fab fa-playstation"></i>
                    PlayStation 4 — Pilih Unit
                </div>
                <div class="numbers" id="ps4-numbers">
                    <button data-unit="1">1</button>
                    <button data-unit="2">2</button>
                    <button data-unit="3">3</button>
                    <button data-unit="4">4</button>
                    <button data-unit="5">5</button>
                    <button data-unit="6" class="active">6</button>
                    <button data-unit="7">7</button>
                    <button data-unit="8">8</button>
                    <button data-unit="9">9</button>
                    <button data-unit="10">10</button>
                    <button data-unit="11">11</button>
                    <button data-unit="12" class="active">12</button>
                    <button data-unit="13">13</button>
                    <button data-unit="14">14</button>
                    <button data-unit="15">15</button>
                    <button data-unit="16">16</button>
                    <button data-unit="17">17</button>
                </div>
                <div class="availability-legend">
                    <div class="legend-item">
                        <span class="legend-dot booked"></span>
                        <span>Sedang Disewa</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot free"></span>
                        <span>Tersedia</span>
                    </div>
                </div>
                <p style="margin-top:14px; font-size:0.8rem; color:#888;">
                    <i class="fas fa-info-circle"></i>
                    Klik nomor unit untuk toggle status ketersediaan (demo interaktif).
                </p>
            </div>
        </section>

        {{-- PS3 Section --}}
        <section class="device-section">
            <div class="device-image">
                <span class="device-badge">PS3</span>
                <img src="{{ asset('images/PS3.png') }}" alt="PlayStation 3" />
            </div>
            <div class="device-controls">
                <div class="device-label">
                    <i class="fab fa-playstation"></i>
                    PlayStation 3 — Pilih Unit
                </div>
                <div class="numbers" id="ps3-numbers">
                    <button data-unit="1" class="active">1</button>
                    <button data-unit="2" class="active">2</button>
                    <button data-unit="3">3</button>
                    <button data-unit="4">4</button>
                    <button data-unit="5">5</button>
                    <button data-unit="6">6</button>
                    <button data-unit="7">7</button>
                    <button data-unit="8">8</button>
                    <button data-unit="9">9</button>
                    <button data-unit="10">10</button>
                    <button data-unit="11">11</button>
                    <button data-unit="12">12</button>
                    <button data-unit="13">13</button>
                    <button data-unit="14">14</button>
                    <button data-unit="15">15</button>
                    <button data-unit="16">16</button>
                    <button data-unit="17">17</button>
                </div>
                <div class="availability-legend">
                    <div class="legend-item">
                        <span class="legend-dot booked"></span>
                        <span>Sedang Disewa</span>
                    </div>
                    <div class="legend-item">
                        <span class="legend-dot free"></span>
                        <span>Tersedia</span>
                    </div>
                </div>
                <p style="margin-top:14px; font-size:0.8rem; color:#888;">
                    <i class="fas fa-info-circle"></i>
                    Klik nomor unit untuk toggle status ketersediaan (demo interaktif).
                </p>
            </div>
        </section>
    </main>

    <script>
        // Toggle active (booked) saat klik nomor unit
        document.querySelectorAll('.numbers').forEach(function (grid) {
            grid.querySelectorAll('button').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    this.classList.toggle('active');
                });
            });
        });
    </script>

    @include('footer')
</body>
</html>
