<?php
session_start();
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us - Wedding Organizer</title>
  <link rel="icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
  <link rel="shortcut icon" type="image/jpeg" href="assets/img/profile%20foto%20syf%20wedding%20planners.jpeg?v=99">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      padding-top: 80px;
    }

    .about-section {
      background: #ffffff;
      color: #0D0F2B;
    }

    .about-title {
      color: #0D0F2B;
      font-weight: bold;
    }

    .about-description {
      text-align: justify;
      color: #0D0F2B;
    }

    .about-img {
      position: relative;
      width: 300px;
      height: 300px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #0D0F2B;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
      transition: transform 0.3s ease;
    }

    .about-img:hover {
      transform: scale(1.05);
    }

    .founder-name {
      font-size: 1.5rem;
      font-weight: 700;
      margin-top: 15px;
      color: #0D0F2B;
    }

    .founder-title {
      color: #6c757d;
      font-size: 1rem;
    }

    .vision-mission-section {
  background: linear-gradient(
    to bottom,
    #ffffff 0%,
    #fff8dc 100%
  );
  color: #0D0F2B;
  }

    .section-title {
      font-weight: bold;
      color: #f3c623;
    }

    .section-subtitle {
      color: #555;
      font-size: 1.1rem;
    }

    .vision-box, .mission-box {
      background-color: #ffffff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .vision-box:hover, .mission-box:hover {
      transform: translateY(-5px);
    }

    .card-title {
      color: #0D0F2B;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .card-text li {
      margin-bottom: 10px;
    }

    .wa-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 999;
    }

    .wa-button img {
      width: 160px;
    }
   
    /* ================= CHATBOT ================= */

#chatBubble{
  border:2px solid #F3C623;
  position:fixed;
  bottom:80px;
  right:20px;
  width:65px;
  height:65px;
  background:#0D0F2B;
  color:white;
  border-radius:50%;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:28px;
  cursor:pointer;
  box-shadow:0 4px 15px rgba(0,0,0,0.3);
  z-index:9999;
  transition:0.3s;
}

#chatBubble:hover{
  transform:scale(1.08);
  background:#F3C623;
  color:#0D0F2B;
}

#chatContainer{
  position:fixed;
  bottom:90px;
  right:20px;
  width:380px;
  height:540px;
  background:#fff8dc;
  border:2px solid #F3C623;
  border-radius:22px;
  box-shadow:0 12px 35px rgba(0,0,0,0.28);
  display:none;
  flex-direction:column;
  overflow:hidden;
  z-index:9999;
  font-family:'Poppins', sans-serif;
}

.chat-header{
  background:#0D0F2B;
  color:#F3C623;
  padding:16px;
  font-size:18px;
  font-weight:700;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

#chatClose{
  cursor:pointer;
  font-size:24px;
  color:white;
  transition:0.3s;
}

#chatClose:hover{
  color:#F3C623;
  transform:rotate(90deg);
}

#chatMessages{
  flex:1;
  padding:15px;
  overflow-y:auto;
  background:#fff8dc;
  display:flex;
  flex-direction:column;
  gap:12px;
  scroll-behavior:smooth;
}

#chatMessages::-webkit-scrollbar{
  width:6px;
}

#chatMessages::-webkit-scrollbar-thumb{
  background:#c7c7c7;
  border-radius:10px;
}

.user-message{
  background:#F3C623;
  color:#0D0F2B;
  padding:12px 15px;
  border-radius:16px 16px 0 16px;
  max-width:80%;
  align-self:flex-end;
  font-size:14px;
  line-height:1.6;
  box-shadow:0 2px 8px rgba(0,0,0,0.1);
  animation:fadeIn 0.3s ease;
}

.ai-message{
  background:white;
  color:#333;
  padding:13px 15px;
  border-radius:16px 16px 16px 0;
  max-width:85%;
  align-self:flex-start;
  font-size:14px;
  line-height:1.7;
  box-shadow:0 2px 10px rgba(0,0,0,0.1);
  animation:fadeIn 0.3s ease;
}

.ai-message strong{
  color:#0D0F2B;
  font-weight:700;
}

.typing-message{
  background:white;
  color:#777;
  padding:12px 15px;
  border-radius:16px 16px 16px 0;
  max-width:85%;
  align-self:flex-start;
  font-size:14px;
  font-style:italic;
}

#quickQuestions{
  padding:10px;
  display:flex;
  gap:8px;
  overflow-x:auto;
  overflow-y:hidden;
  white-space:nowrap;
  background:#fff8dc;
  border-top:1px solid #eee;
  scrollbar-width:none;
}

#quickQuestions::-webkit-scrollbar{
  display:none;
}

.quick-btn{
  flex:0 0 auto;
  border:none;
  background:#F3C623;
  color:#0D0F2B;
  border-radius:20px;
  padding:10px 15px;
  font-size:12px;
  font-weight:600;
  cursor:pointer;
  transition:.3s;
}

.quick-btn:hover{
  background:#0D0F2B;
  color:white;
}

#chatForm{
  display:flex;
  border-top:1px solid #e0d8a8;
  background:white;
  padding:10px;
  gap:8px;
}

#chatInput{
  flex:1;
  border:none;
  outline:none;
  padding:12px;
  font-size:14px;
  font-family:'Poppins', sans-serif;
  border-radius:12px;
  background:#f3f3f3;
}

#chatForm button{
  background:#0D0F2B;
  color:white;
  border:none;
  width:52px;
  border-radius:12px;
  font-size:18px;
  cursor:pointer;
  transition:0.3s;
}

#chatForm button:hover{
  background:#F3C623;
  color:#0D0F2B;
}

/* ANIMATION */
@keyframes fadeIn{
from{
opacity:0;
transform:translateY(8px);
}
to{
opacity:1;
transform:translateY(0);
}
}

  </style>
</head>
<body>

<?php 
  include 'header.php';
?>
  <!-- About Section -->
  <section class="about-section py-5 section-bg" >
    <div class="container">
      <div class="row align-items-center">
        <!-- Left: Text -->
        <div class="col-md-6 mb-4 mb-md-0">
          <h2 class="about-title mb-3">Tentang Kami</h2>
          <p class="about-description">
            Kami adalah wedding organizer profesional yang berdedikasi membantu Anda merencanakan pernikahan impian dengan penuh kehangatan dan ketelitian.
            Dengan pengalaman bertahun-tahun dan tim kreatif, kami memastikan setiap detail berjalan sempurna. Dari konsep hingga hari-H, kami siap menjadi mitra Anda.
          </p>
          <p class="about-description">
            Visi kami adalah menciptakan momen pernikahan yang tak terlupakan dan penuh kebahagiaan bagi setiap pasangan.
          </p>
        </div>

        <!-- Right: Founder Photo & Name -->
        <div class="col-md-6 text-center">
          <img src="assets/img/photo-8.jpg" alt="Founder Photo" class="about-img">
          <div class="founder-name"> -- </div>
          <div class="founder-title">Founder & Lead Planner</div>
        </div>
      </div>
    </div>
    <!-- Visi dan Misi Section -->
<section class="vision-mission-section py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col">
        <h2 class="section-title">Visi & Misi Kami</h2>
        <p class="section-subtitle">Mewujudkan momen terbaik dalam hidup Anda dengan penuh cinta dan profesionalisme.</p>
      </div>
    </div>
    <div class="row">
      <!-- Visi -->
      <div class="col-md-6 mb-4">
        <div class="card h-100 vision-box">
          <div class="card-body">
            <h3 class="card-title">Visi</h3>
            <p class="card-text">
              Menjadi wedding organizer terkemuka yang dipercaya menciptakan pernikahan impian yang elegan, berkesan, dan penuh kebahagiaan di setiap langkahnya.
            </p>
          </div>
        </div>
      </div>
      <!-- Misi -->
      <div class="col-md-6 mb-4">
        <div class="card h-100 mission-box">
          <div class="card-body">
            <h3 class="card-title">Misi</h3>
            <ul class="card-text text-start">
              <li>Mendengarkan dan memahami keinginan setiap pasangan.</li>
              <li>Menghadirkan konsep kreatif dan inovatif sesuai tema impian.</li>
              <li>Memberikan layanan terbaik dengan tim profesional dan ramah.</li>
              <li>Menjaga kualitas dan detail agar hari pernikahan berjalan sempurna.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

 <!-- Bubble Icon -->
<div id="chatBubble">💬</div>

<!-- Chatbox -->
<div id="chatContainer">

    <div class="chat-header">
      SYF Wedding Planner
      <span id="chatClose">✖</span>
    </div>

    <div id="chatMessages"></div>

    <div id="quickQuestions">
        <button class="quick-btn">Apa saja paket yang tersedia?</button>
        <button class="quick-btn">Berapa harga Paket Silver?</button>
        <button class="quick-btn">Berapa harga Paket Gold?</button>
        <button class="quick-btn">Berapa harga Paket Platinum?</button>
        <button class="quick-btn">Bagaimana cara pemesanan?</button>
        <button class="quick-btn">Apakah bisa pembayaran DP?</button>
        <button class="quick-btn">Layanan tambahan apa saja?</button>
        <button class="quick-btn">Bagaimana cara menghubungi admin?</button>
    </div>

    <form id="chatForm">
        <input type="text" id="chatInput" placeholder="Ketik pesan..." required>
        <button type="submit">➤</button>
    </form>

</div>

  <!-- WhatsApp Button -->
  <div class="wa-button">
    <a href="https://wa.me/6289506112503" target="_blank">
      <img src="assets/img/whatsapp-icon.png" alt="Hubungi Kami via WhatsApp">
    </a>
  </div>
  
  <?php
    include 'footer.php';
?>
</section>

  </section>
<!-- Chatbot JS -->
<script>
const chatBubble = document.getElementById("chatBubble");
const chatContainer = document.getElementById("chatContainer");
const chatForm = document.getElementById("chatForm");
const chatInput = document.getElementById("chatInput");
const chatMessages = document.getElementById("chatMessages");
const chatClose = document.getElementById("chatClose");

chatBubble.addEventListener("click", () => {
    chatContainer.style.display = "flex";
});

chatClose.addEventListener("click", () => {
    chatContainer.style.display = "none";
});

chatForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const msg = chatInput.value.trim();
    if (!msg) return;

    const userMsg = document.createElement("div");
    userMsg.textContent = msg;
    userMsg.classList.add("user-message");
    chatMessages.appendChild(userMsg);

    chatInput.value = "";

    const typingMsg = document.createElement("div");
    typingMsg.classList.add("typing-message");
    typingMsg.id = "typingMessage";
    typingMsg.innerHTML = "SYF Wedding Planner sedang mengetik...";
    chatMessages.appendChild(typingMsg);

    chatMessages.scrollTop = chatMessages.scrollHeight;

    try {
        const response = await fetch("chat.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "message=" + encodeURIComponent(msg)
        });

        const answer = await response.text();

        const typingElement = document.getElementById("typingMessage");
        if (typingElement) typingElement.remove();

        const aiMsg = document.createElement("div");
        aiMsg.classList.add("ai-message");
        aiMsg.innerHTML = "<strong>SYF Wedding Planner:</strong><br><br>" + answer;

        chatMessages.appendChild(aiMsg);
        chatMessages.scrollTop = chatMessages.scrollHeight;

    } catch (error) {
        const typingElement = document.getElementById("typingMessage");
        if (typingElement) typingElement.remove();

        const errorMsg = document.createElement("div");
        errorMsg.classList.add("ai-message");
        errorMsg.innerHTML = "<strong>SYF Wedding Planner:</strong><br><br>Maaf, terjadi kesalahan. Silakan coba lagi.";

        chatMessages.appendChild(errorMsg);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
});

document.querySelectorAll(".quick-btn").forEach(function(btn) {
    btn.addEventListener("click", function() {
        chatInput.value = this.innerText;
        chatForm.dispatchEvent(new Event("submit"));
    });
});
</script>
</body>
</html>
