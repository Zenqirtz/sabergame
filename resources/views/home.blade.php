<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Saber Game - Rental PlayStation PS3 & PS4 terpercaya se Malang Raya. Harga terjangkau, siap kirim kapan saja." />
    <title>Saber Game - Rental PS Malang</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
</head>
<body>
    @include('nav')

    {{-- Hero Banner --}}
    <section class="hero-banner">
        <div class="banner-content">
            <img id="hero-img" src="{{ asset('images/banner-ps.png') }}" alt="Saber Game - Rental PlayStation Malang" />
        </div>
        <div class="carousel-dots">
            <span class="dot active" data-index="0"></span>
            <span class="dot" data-index="1"></span>
            <span class="dot" data-index="2"></span>
        </div>
    </section>

    {{-- Kenapa Saber Game --}}
    <section class="why-saber container">
        <h2>Kenapa harus Saber Game?</h2>
        <div class="cards">
            <div class="card">
                <i class="fab fa-playstation icon"></i>
                <h3>Penyedia Device PlayStation Terpercaya Se Malang Raya</h3>
                <p>Koleksi PS3 & PS4 lengkap, siap kirim kapan saja ke lokasi Anda.</p>
            </div>
            <div class="card">
                <i class="fas fa-thumbs-up icon"></i>
                <h3>Testimoni Baik dari Pelanggan</h3>
                <p>Ribuan pelanggan puas mempercayai Saber Game untuk pengalaman gaming terbaik.</p>
            </div>
            <div class="card">
                <i class="fas fa-gamepad icon"></i>
                <h3>List Game yang Banyak</h3>
                <p>Ratusan judul game populer tersedia untuk menambah pengalaman bermain Anda.</p>
            </div>
        </div>
    </section>

    {{-- Penawaran --}}
    <section class="offer container">
        <h2>Penawaran</h2>
        <p class="subheading">Promo, deals, dan penawaran spesial untuk Anda</p>

        <div class="offer-cards">
            <div class="offer-card">
                <div class="offer-text">
                    <p class="offer-title">Year End Gamefest</p>
                    <p>Hemat 20% dengan promo Year End Gamefest. Berlaku hingga akhir tahun!</p>
                    <button class="btn-explore" onclick="document.querySelector('.why-saber').scrollIntoView({behavior:'smooth'})">
                        Explore Deals
                    </button>
                </div>
                <img src="{{ asset('images/promo.png') }}" alt="Promo Year End Gamefest" />
            </div>

            <div class="offer-card">
                <div class="offer-text">
                    <p class="offer-title">Weekend Special</p>
                    <p>Sewa PS di akhir pekan dan dapatkan bonus 1 jam gratis setiap sesinya.</p>
                    <button class="btn-explore" onclick="window.location.href='{{ url('/device') }}'">
                        Lihat Device
                    </button>
                </div>
                <img src="{{ asset('images/promo.png') }}" alt="Promo Weekend Special" />
            </div>
        </div>
    </section>

    {{-- Tombol Chatbot --}}
    <button class="btn-help" id="btn-open-chat" type="button" title="Hubungi Kami / Chat AI">
        <i class="fas fa-headset"></i>
        <span>Hubungi Kami</span>
    </button>

    {{-- Modal Chatbot --}}
    <div id="chat-modal" class="chat-modal" role="dialog" aria-modal="true" aria-label="Chatbot Cibel">
        <div class="chat-modal-backdrop" id="chat-backdrop"></div>
        <div class="chat-modal-content">
            <button class="chat-modal-close" id="btn-close-chat" aria-label="Tutup chatbot">&#x2715; Tutup</button>
            <iframe src="{{ url('/chatbot') }}" title="Chatbot Cibel" class="chat-modal-iframe" id="chatbot-iframe"></iframe>
        </div>
    </div>

    <script>
        // ── Carousel Dots ──
        (function () {
            var dots = document.querySelectorAll('.carousel-dots .dot');
            var heroImg = document.getElementById('hero-img');
            // Semua pakai banner yang sama (1 gambar); dots hanya sebagai dekorasi interaktif
            var currentDot = 0;

            function setActive(idx) {
                dots.forEach(function (d) { d.classList.remove('active'); });
                dots[idx].classList.add('active');
                currentDot = idx;
            }

            dots.forEach(function (dot) {
                dot.addEventListener('click', function () {
                    setActive(parseInt(this.dataset.index));
                });
            });

            // Auto-rotate setiap 4 detik
            setInterval(function () {
                var next = (currentDot + 1) % dots.length;
                setActive(next);
            }, 4000);
        })();

        // ── Modal Chatbot ──
        (function () {
            var modal    = document.getElementById('chat-modal');
            var openBtn  = document.getElementById('btn-open-chat');
            var closeBtn = document.getElementById('btn-close-chat');
            var backdrop = document.getElementById('chat-backdrop');

            function openModal() {
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('open');
                document.body.style.overflow = '';
            }

            if (openBtn)  openBtn.addEventListener('click', openModal);
            if (closeBtn) closeBtn.addEventListener('click', closeModal);
            if (backdrop) backdrop.addEventListener('click', closeModal);

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeModal();
            });

            // Terima pesan "closeChat" dari iframe chatbot
            window.addEventListener('message', function (e) {
                if (e.data === 'closeChat') closeModal();
            });
        })();
    </script>

    @include('footer')
</body>
</html>
