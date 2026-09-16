<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Cibel - Saber Game Bot</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Inter', Arial, sans-serif;
    }

    body, html {
      height: 100%;
      background: #f7f7f7;
    }

    /* Container utama */
    .chat-container {
      display: flex;
      flex-direction: column;
      height: 100vh;
      background: #ffffff;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
    }

    /* Header */
    .chat-header {
      background: linear-gradient(135deg, #8B0000 0%, #c40909 100%);
      color: white;
      display: flex;
      align-items: center;
      padding: 12px 16px;
      gap: 10px;
      position: relative;
      flex-shrink: 0;
    }

    .chat-header-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid rgba(255,255,255,0.4);
      flex-shrink: 0;
    }

    .chat-header-info {
      flex: 1;
    }

    .chat-header-name {
      font-weight: 700;
      font-size: 0.95rem;
      line-height: 1.2;
    }

    .chat-header-status {
      font-size: 0.72rem;
      opacity: 0.85;
      display: flex;
      align-items: center;
      gap: 5px;
      margin-top: 2px;
    }

    .status-dot {
      width: 8px;
      height: 8px;
      background: #4ade80;
      border-radius: 50%;
      border: 1.5px solid rgba(255,255,255,0.6);
      flex-shrink: 0;
    }

    /* Tombol tutup - kirim postMessage ke parent */
    .close-btn {
      background: rgba(255,255,255,0.18);
      color: white;
      border: 1.5px solid rgba(255,255,255,0.4);
      border-radius: 6px;
      padding: 5px 12px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s ease;
      flex-shrink: 0;
    }

    .close-btn:hover {
      background: rgba(255,255,255,0.32);
    }

    /* Area pesan */
    .chat-messages {
      flex: 1;
      padding: 16px 14px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 14px;
      background: #fafafa;
    }

    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }

    /* Bubble pesan */
    .message {
      max-width: 78%;
      display: flex;
      align-items: flex-end;
      gap: 8px;
    }

    .message.left {
      align-self: flex-start;
    }

    .message.right {
      align-self: flex-end;
      flex-direction: row-reverse;
    }

    .message-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      object-fit: cover;
      flex-shrink: 0;
    }

    .message-bubble {
      padding: 10px 14px;
      border-radius: 16px;
      font-size: 0.875rem;
      line-height: 1.5;
      word-break: break-word;
    }

    .message.left .message-bubble {
      background: #8B0000;
      color: #ffffff;
      border-bottom-left-radius: 4px;
    }

    .message.right .message-bubble {
      background: #e8e8e8;
      color: #222;
      border-bottom-right-radius: 4px;
    }

    /* Typing indicator */
    .message.typing .message-bubble {
      padding: 12px 18px;
    }

    .typing-dots {
      display: flex;
      gap: 4px;
      align-items: center;
    }

    .typing-dots span {
      width: 7px;
      height: 7px;
      background: rgba(255,255,255,0.7);
      border-radius: 50%;
      animation: bounce 1.3s infinite ease-in-out;
    }

    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes bounce {
      0%, 80%, 100% { transform: scale(0.75); opacity: 0.5; }
      40%            { transform: scale(1.1);  opacity: 1; }
    }

    /* Input area */
    .chat-input {
      padding: 12px 14px;
      background: #fff;
      border-top: 1px solid #eee;
      flex-shrink: 0;
    }

    .chat-input form {
      display: flex;
      gap: 10px;
      align-items: center;
    }

    .chat-input input[type="text"] {
      flex: 1;
      padding: 11px 16px;
      border-radius: 24px;
      border: 1.5px solid #e0e0e0;
      font-size: 0.875rem;
      outline: none;
      background: #f7f7f7;
      transition: border-color 0.2s ease;
    }

    .chat-input input[type="text"]:focus {
      border-color: #8B0000;
      background: #fff;
    }

    .chat-input input[type="text"]::placeholder {
      color: #bbb;
    }

    .chat-input button[type="submit"] {
      background: linear-gradient(135deg, #8B0000, #c40909);
      border: none;
      color: white;
      font-weight: 700;
      font-size: 13px;
      padding: 11px 20px;
      border-radius: 24px;
      cursor: pointer;
      transition: opacity 0.2s ease, transform 0.2s ease;
      flex-shrink: 0;
      white-space: nowrap;
    }

    .chat-input button[type="submit"]:hover:not(:disabled) {
      opacity: 0.88;
      transform: translateY(-1px);
    }

    .chat-input button[type="submit"]:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
  </style>
</head>
<body>
  <div class="chat-container">
    <!-- Header -->
    <div class="chat-header">
      <img src="{{ asset('images/Cibelatas.png') }}" alt="Cibel Avatar" class="chat-header-avatar" />
      <div class="chat-header-info">
        <div class="chat-header-name">Cibel</div>
        <div class="chat-header-status">
          <span class="status-dot"></span> Online
        </div>
      </div>
      <!-- Tutup chat via postMessage ke parent window -->
      <button class="close-btn" id="close-btn">✕ Tutup</button>
    </div>

    <!-- Messages -->
    <div class="chat-messages" id="chat-messages">
      <div class="message left">
        <img src="{{ asset('images/Cibel.png') }}" alt="Cibel" class="message-avatar" />
        <div class="message-bubble">
          Halooww aku Cibel 👋 Ada yang bisa aku bantu seputar Saber Game?
        </div>
      </div>
    </div>

    <!-- Input Form -->
    <div class="chat-input">
      <form id="chat-form" autocomplete="off">
        <input type="text" id="message" name="message" placeholder="Tanya Cibel..." required />
        <button type="submit" id="send-btn">Kirim</button>
      </form>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script>
    $(document).ready(function () {

      // ── Tutup chat: kirim postMessage ke parent window ──
      $('#close-btn').on('click', function () {
        if (window.parent && window.parent !== window) {
          window.parent.postMessage('closeChat', '*');
        }
      });

      // ── Sanitasi XSS ──
      function escapeHtml(text) {
        return String(text).replace(/[&<>"']/g, function (m) {
          return { '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m];
        });
      }

      // ── Scroll ke bawah ──
      function scrollToBottom() {
        var $msgs = $('#chat-messages');
        $msgs.scrollTop($msgs[0].scrollHeight);
      }

      // ── Append bubble ──
      function appendBubble(side, html, isTyping) {
        var avatarSrc = '{{ asset("images/Cibel.png") }}';
        var avatarHtml = side === 'left'
          ? '<img src="' + avatarSrc + '" alt="Cibel" class="message-avatar" />'
          : '';
        var cls = 'message ' + side + (isTyping ? ' typing' : '');
        var bubble = isTyping
          ? '<div class="message-bubble"><div class="typing-dots"><span></span><span></span><span></span></div></div>'
          : '<div class="message-bubble">' + html + '</div>';

        var row = side === 'left'
          ? '<div class="' + cls + '">' + avatarHtml + bubble + '</div>'
          : '<div class="' + cls + '">' + bubble + '</div>';

        $('#chat-messages').append(row);
        scrollToBottom();
      }

      // ── Submit form ──
      $('#chat-form').on('submit', function (e) {
        e.preventDefault();

        var $input = $('#message');
        var $btn   = $('#send-btn');
        var msg    = $input.val().trim();
        if (!msg) return;

        // Disable saat kirim
        $input.prop('disabled', true);
        $btn.prop('disabled', true);

        // Tampilkan pesan user
        appendBubble('right', escapeHtml(msg));

        // Tampilkan typing indicator
        appendBubble('left', '', true);

        // Kirim ke backend
        $.ajax({
          url:      '/chat',
          method:   'POST',
          dataType: 'json',
          headers:  { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          data:     { content: msg },
          success: function (res) {
            $('.message.typing').remove();
            var reply = (res && res.message) ? escapeHtml(res.message) : 'Maaf, format balasan tidak dikenali.';
            appendBubble('left', reply);
          },
          error: function (xhr) {
            $('.message.typing').remove();
            var msg = 'Maaf, terjadi kesalahan. Coba beberapa saat lagi.';
            try {
              if (xhr.responseJSON && xhr.responseJSON.error) msg = escapeHtml(xhr.responseJSON.error);
            } catch (ex) {}
            appendBubble('left', msg);
          },
          complete: function () {
            $input.val('').prop('disabled', false);
            $btn.prop('disabled', false);
            $input.focus();
          }
        });
      });

      scrollToBottom();
    });
  </script>
</body>
</html>
