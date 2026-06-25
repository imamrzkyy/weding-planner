<?php

/* =========================
   API KEY
========================= */
// $env = parse_ini_file('.env');

$apiKey =  getenv('NVIDIA_API_KEY') ?: "sk-8fdae7c8015d5bcf-a222yt-7a3eb625";

if (!$apiKey) {
    echo "API key belum diatur.";
    exit;
}

/* =========================
   AMBIL PESAN USER
========================= */
$message = $_POST['message'] ?? '';

if (empty($message)) {
    echo "Pesan kosong.";
    exit;
}

/* =========================
   NVIDIA API
========================= */
$url = "https://router.denisetiya.site/v1/chat/completions";

/* =========================
   DATA PERUSAHAAN
========================= */
$companyInfo = "
Profil Perusahaan SYF Wedding Organizer:

SYF Wedding Organizer adalah jasa perencanaan dan penyelenggaraan pernikahan profesional.

Jam Operasional:
Senin - Sabtu
08.00 - 17.00 WIB

Lokasi:
Jl. Kampung Belakang, Tegal Alur, Kalideres, Jakarta Barat.

Layanan:
1. Wedding Organizer
2. Wedding Planner
3. Dekorasi
4. Tata Rias
5. Dokumentasi
6. Koordinasi Acara

Paket Wedding:
- Silver : 25 juta
- Gold : 27 juta
- Platinum : 30 juta

WhatsApp:
085704019914

Instagram:
@sfy_weddingplanners
";

/* =========================
   SYSTEM PROMPT
========================= */
$systemPrompt = "
Kamu adalah customer service AI untuk SYF Wedding Organizer.

Aturan menjawab:
- jawab dengan detail dan ramah
- jangan gunakan **
- Gunakan bahasa Indonesia
- Ramah dan profesional
- Singkat tapi jelas
- Berikan rekomendasi paket jika diminta
- Gunakan emoji seperlunya 😊
- Maksimal 5 kalimat

Informasi perusahaan:
$companyInfo
";

/* =========================
   REQUEST DATA
========================= */
$data = [
    "model" => "nvidia/deepseek-ai/deepseek-v4-flash",
    "messages" => [
        [
            "role" => "system",
            "content" => $systemPrompt
        ],
        [
            "role" => "user",
            "content" => $message
        ]
    ],
    "max_tokens" => 1000,
    "temperature" => 0.7,
    "top_p" => 0.95,
    "stream" => false,
    "chat_template_kwargs" => [
        "enable_thinking" => false
    ]
];

/* =========================
   CURL REQUEST
========================= */
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [

    "Authorization: Bearer " . $apiKey,
    "Content-Type: application/json",
    "Accept: application/json"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

/* =========================
   ERROR CURL
========================= */
if (curl_errno($ch)) {
    echo "Server chatbot bermasalah.";
    curl_close($ch);
    exit;
}

/* =========================
   HTTP CODE
========================= */
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

/* =========================
   DECODE JSON
========================= */
$result = json_decode($response, true);

/* =========================
   ERROR API
========================= */
if ($httpCode != 200 || isset($result['error'])) {
    echo "Chatbot sedang offline.";
    exit;
}

/* =========================
   HASIL AI
========================= */
if (isset($result['choices'][0]['message']['content'])) {
    $answer = $result['choices'][0]['message']['content'];

    $answer = trim($answer);
    $answer = nl2br($answer);

    echo $answer;
} else {
    echo "AI tidak merespon.";
}

?>