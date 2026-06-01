<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Saber Game</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        /* CSS untuk modal popup chatbot */
        .chat-modal{position:fixed;inset:0;display:none;z-index:1000}
        .chat-modal.open{display:block}
        .chat-modal-backdrop{position:absolute;inset:0;background:rgba(0,0,0,.35);-webkit-backdrop-filter:blur(6px);backdrop-filter:blur(6px)}
        .chat-modal-content{position:relative;width:100%;max-width:420px;height:80vh;margin:40px auto;background:#fff;border-radius:8px;box-shadow:0 10px 30px rgba(0,0,0,.2);overflow:hidden;display:flex;flex-direction:column}
        .chat-modal-close{position:absolute;top:8px;right:10px;background:#8B0000;color:#fff;border:none;border-radius:4px;padding:6px 10px;cursor:pointer;z-index:10}
        .chat-modal-iframe{border:0;flex:1;width:100%;height:100%}
    </style>
</head>
<body>
    @include('nav')
    <section class="hero-banner">
        <div class="banner-content">
            <img src="{{ asset('images/banner-ps.png') }}" alt="Year End Gaming Fest" />
            <div class="banner-text">
                <!-- You can add text or content here -->
            </div>
        </div>
        <div class="carousel-dots">
            <span class="dot active"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </section>

    <section class="why-saber container">
        <h2>Kenapa harus Saber Game?</h2>
        <div class="cards">
            <div class="card">
                <i class="fab fa-playstation icon"></i>
                <h3>Penyedia Device Playstation Terpercaya Se Malang Raya</h3>
                <p>Siap kirim kapan saja</p>
            </div>

            <div class="card">
                <i class="fas fa-thumbs-up icon"></i>
                <h3>Testimoni baik dari pelanggan</h3>
                <p>Menambah kepercayaan anda dalam menyewa device</p>
            </div>

            <div class="card">
                <i class="fas fa-gamepad icon"></i>
                <h3>List Game yang banyak</h3>
                <p>Menambah pengalaman bermain kalian</p>
            </div>
        </div>
    </section>

    <section class="offer container">
        <h2>Penawaran</h2>
        <p class="subheading">Promotion, deals, and special offers for you</p>

        <div class="offer-cards">
            <div class="offer-card">
                <div class="offer-text">
                    <p class="offer-title">Year End Gamefest</p>
                    <p>Hemat 20% dengan promo Year End Gamefest</p>
                    <button class="btn-explore">Explore Deals</button>
                </div>
                <img src="{{ asset('images/promo.png') }}" alt="Year End Gamefest" />
            </div>

            <div class="offer-card">
                <div class="offer-text">
                    <p class="offer-title">Year End Gamefest</p>
                    <p>Hemat 20% dengan promo Year End Gamefest</p>
                    <button class="btn-explore">Explore Deals</button>
                </div>
                <img src="{{ asset('images/promo.png') }}" alt="Year End Gamefest" />
            </div>
        </div>
    </section>
    <!-- Tombol pembuka modal chatbot -->
    <button class="btn-help" type="button" title="Hubungi Kami">
        <i class="fas fa-headset"></i>
        <span>Hubungi Kami</span>
    </button>
    <!-- Struktur modal: backdrop + konten berisi iframe chatbot -->
    <div id="chat-modal" class="chat-modal">
        <div class="chat-modal-backdrop"></div>
        <div class="chat-modal-content">
            <button class="chat-modal-close">Tutup</button>
            <iframe src="/chatbot" title="Chatbot" class="chat-modal-iframe"></iframe>
        </div>
    </div>
    <script>
        // Script kontrol modal: buka dengan tombol, tutup dengan tombol/backdrop/Escape
        document.addEventListener('DOMContentLoaded',function(){
            var modal = document.getElementById('chat-modal');
            var btn = document.querySelector('.btn-help');
            var closeBtn = document.querySelector('.chat-modal-close');
            var backdrop = document.querySelector('.chat-modal-backdrop');
            function openModal(){
                modal.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            function closeModal(){
                modal.classList.remove('open');
                document.body.style.overflow = '';
            }
            if (btn) { btn.addEventListener('click', function(e){ e.preventDefault(); openModal(); }); }
            if (closeBtn) { closeBtn.addEventListener('click', closeModal); }
            if (backdrop) { backdrop.addEventListener('click', closeModal); }
            document.addEventListener('keydown', function(e){ if (e.key === 'Escape') { closeModal(); } });
            window.addEventListener('unload', function(){ document.body.style.overflow = ''; });
        });
    </script>
    @include('footer')
</body>
</html>
