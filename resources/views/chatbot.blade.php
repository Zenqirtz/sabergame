<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- CSRF token untuk proteksi request AJAX ke Laravel -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SABER BOT</title>
  <style>
    /* Reset dan styling dasar */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
    }
    body, html {
      height: 100%;
      background: #fff;
    }

    /* Kontainer utama chatbot */
    .chat-container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      max-width: 420px;
      margin: 0 auto;
      border: 1px solid #eee;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    }

    /* Header */
    /* Header chatbot: judul + tombol tutup */
    .chat-header {
      background: linear-gradient(180deg, #8B0000 0%, #9b0000 100%);
      color: white;
      display: flex;
      align-items: center;
      padding: 10px 15px;
      position: relative;
      user-select: none;
    }
    .chat-header img {
      background: linear-gradient(180deg, #8B0000 0%, #9b0000 100%);
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin-right: 10px;
      padding: 5px;
    }
    .chat-header .title {
      font-weight: bold;
      font-size: 1.1em;
      flex-grow: 1;
    }
    .chat-header .close-btn { display: none; }
    .status-dot { width: 10px; height: 10px; background: #32CD32; border: 2px solid #fff; border-radius: 50%; margin-left: 8px; }

    /* Messages area */
    /* Area pesan: menampilkan bubble kiri (bot) dan kanan (user) */
    .chat-messages {
      flex-grow: 1;
      padding: 15px;
      overflow-y: auto;
      background: #fff;
      display: flex;
      flex-direction: column;
    }
    .message {
      max-width: 75%;
      margin-bottom: 15px;
      padding: 10px 15px;
      border-radius: 15px;
      font-size: 0.9em;
      display: flex;
      align-items: center;
    }
    /* Bubble kiri untuk balasan bot */
    .message.left {
      background-color: #8B0000;
      color: white;
      align-self: flex-start;
      gap: 10px;
    }
    /* Bubble kanan untuk pesan user */
    .message.right {
      background-color: #ccc;
      color: black;
      align-self: flex-end;
      gap: 10px;
      justify-content: flex-end;
      flex-direction: row-reverse;
    }
    .message img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      object-fit: cover;
    }
    .message p {
      margin: 0;
      line-height: 1.3;
      word-wrap: break-word;
    }

    /* Form input section */
    /* Form input: kolom teks + tombol kirim */
    .chat-input {
      padding: 15px;
      background: #f0f0f0;
    }
    .chat-input form {
      display: flex;
    }
    .chat-input input[type="text"] {
      flex: 1;
      padding: 12px 15px;
      border-radius: 20px;
      border: 1px solid #ccc;
      font-size: 1em;
      outline: none;
    }
    .chat-input button {
      background-color: #8B0000;
      border: none;
      color: white;
      font-weight: bold;
      padding: 0 20px;
      margin-left: 10px;
      border-radius: 20px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .chat-input button:hover {
      background-color: #a00000;
    }
  </style>
  <style>
    /* Penyesuaian tampilan bubble agar mendekati mockup */
    .chat-messages { gap: 14px; }
    .message.left { border-top-left-radius: 6px; }
    .message.right { background-color: #bdbdbd; border-top-right-radius: 6px; }
    .message.typing p { letter-spacing: 2px; }
  </style>
</head>
<body>
  <div class="chat-container">
    <!-- Header -->
    <div class="chat-header">
      <img src="{{ asset('images/Cibelatas.png') }}" alt="Bot Avatar" />
      <div class="title">Cibel</div><span class="status-dot" title="Online"></span>
      <div class="close-btn" onclick="closeChat()">Close</div>
    </div>

    <!-- Messages -->
    <div class="chat-messages">
      <div class="message left">
        <img src="{{ asset('images/Cibel.png') }}" alt="Bot Avatar" />
        <p>Halooww aku Cibel, ada yang bisa aku bantu?</p>
      </div>
    </div>

    <!-- Input Form -->
    <div class="chat-input">
      <form id="chat-form" autocomplete="off">
        <input type="text" id="message" name="message" placeholder="Tanya Cibel...." required />
        <button type="submit">Kirim</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
  // Inisialisasi interaksi chatbot
  $(document).ready(function() {
    // Fungsi menutup chat (opsional)
    // Handler tombol Close (opsional, karena kita pakai modal di Home)
    function closeChat() {
      alert('Fungsi Close Chat belum diimplementasikan.');
    }
    $('.close-btn').click(closeChat);

    // Fungsi escape HTML untuk keamanan pesan agar tidak menyebabkan XSS
    // Sanitasi teks untuk mencegah XSS saat menampilkan pesan
    function escapeHtml(text) {
      return text.replace(/[&<>"']/g, function(m) {
        return {
          '&': '&amp;',
          '<': '&lt;',
          '>': '&gt;',
          '"': '&quot;',
          "'": '&#39;'
        }[m];
      });
    }

    // Scroll otomatis ke pesan terakhir
    // Scroll ke pesan terbaru agar UI selalu fokus di bawah
    function scrollToBottom() {
      var chat = $('.chat-messages');
      chat.scrollTop(chat[0].scrollHeight);
    }

    // Event submit form chat
    // Saat user mengirim pesan: tampilkan bubble kanan lalu kirim ke backend
    $('#chat-form').submit(function(event) {
      event.preventDefault();

      var input = $('#message');
      var message = input.val().trim();
      if (!message) return;

      // Disable input & button saat pengiriman
      input.prop('disabled', true);
      $('#chat-form button').prop('disabled', true);

      // Tampilkan pesan user (bubble kanan)
      $('.chat-messages').append(
        '<div class="message right">' +
          '<p>' + escapeHtml(message) + '</p>' +
        '</div>'
      );
      scrollToBottom();

      // Kirim pesan ke backend API
      // Kirim pesan ke endpoint Laravel, sertakan CSRF
      $.ajax({
        url: '/chat',
        method: 'POST',
        dataType: 'json',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: { content: message },
        beforeSend: function() {
          $('.chat-messages').append(
            '<div class="message left typing">' +
              '<img src="{{ asset('images/Cibel.png') }}" alt="Bot Avatar" />' +
              '<p>...</p>' +
            '</div>'
          );
          scrollToBottom();
        },
        success: function(res) {
          // Pastikan response ada properti message
          if (res.message) {
            // Hapus indikator mengetik lalu tampilkan balasan bot (bubble kiri)
            $('.message.typing').remove();
            $('.chat-messages').append(
              '<div class="message left">' +
                '<img src="{{ asset('images/Cibel.png') }}" alt="Bot Avatar" />' +
                '<p>' + escapeHtml(res.message) + '</p>' +
              '</div>'
            );
            scrollToBottom();
          } else {
            $('.message.typing').remove();
            $('.chat-messages').append(
              '<div class="message left">' +
                '<img src="{{ asset('images/Cibel.png') }}" alt="Bot Avatar" />' +
                '<p>Maaf, terjadi kesalahan pada format balasan.</p>' +
              '</div>'
            );
            scrollToBottom();
          }
          // Enable input dan button kembali
          input.val('');
          input.prop('disabled', false);
          $('#chat-form button').prop('disabled', false);
          input.focus();
        },
        error: function(xhr, status, error) {
          // Tampilkan pesan error ramah pengguna jika backend gagal
          var msg = 'Maaf, terjadi kesalahan saat memproses permintaan.';
          var detail = '';
          try {
            if (xhr.responseJSON) {
              if (xhr.responseJSON.error) msg = xhr.responseJSON.error;
              var d = xhr.responseJSON.details;
              if (typeof d === 'string') {
                detail = d;
              } else if (d && d.error && d.error.message) {
                detail = d.error.message;
              }
            }
          } catch (e) {}
          $('.message.typing').remove();
          var html = '<div class="message left">' +
              '<img src="{{ asset('images/Cibel.png') }}" alt="Bot Avatar" />' +
              '<p>' + escapeHtml(msg + (detail ? ' (' + detail + ')' : '')) + '</p>' +
            '</div>';
          $('.chat-messages').append(html);
          scrollToBottom();
          input.prop('disabled', false);
          $('#chat-form button').prop('disabled', false);
          input.focus();
        }
      });
    });
  });
</script>
</body>
</html>
