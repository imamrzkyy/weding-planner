<?php

/* =========================
   API KEY
========================= */
$env = parse_ini_file('.env');

$apiKey = $_ENV['GEMINI_API_KEY'] ?? getenv('GEMINI_API_KEY') ?: null;
/* =========================
   AMBIL PESAN USER
========================= */
$message = $_POST['message'] ?? '';

if (empty($message)) {
    echo "Pesan kosong.";
    exit;
}

/* =========================
   MODEL GEMINI
========================= */
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent?key=" . $apiKey;

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
   PROMPT AI
========================= */
$prompt = "
Kamu adalah customer service AI untuk SYF Wedding Organizer.

Aturan menjawab:
- Gunakan bahasa Indonesia
- Ramah dan profesional
- Singkat tapi jelas
- Berikan rekomendasi paket jika diminta
- Gunakan emoji seperlunya 😊
- Maksimal 5 kalimat

Informasi perusahaan:
$companyInfo

Pertanyaan user:
$message
";

/* =========================
   REQUEST DATA
========================= */
$data = [
    "contents" => [
        [
            "parts" => [
                [
                    "text" => $prompt
                ]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7,
        "maxOutputTokens" => 1000
    ]
];

/* =========================
   CURL REQUEST
========================= */
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
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
if (isset($result['candidates'][0]['content']['parts'][0]['text'])) {

    $answer = $result['candidates'][0]['content']['parts'][0]['text'];

    // Rapikan output
    $answer = trim($answer);

    // Convert enter jadi <br>
    $answer = nl2br($answer);

    echo $answer;

} else {

    echo "AI tidak merespon.";
}

?>