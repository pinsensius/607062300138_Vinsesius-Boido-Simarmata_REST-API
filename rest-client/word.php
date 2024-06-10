<?php
// Konfigurasi URL API
$apiUrl = "http://localhost/rest/word.php";

// Ambil ID kategori dari query string
$catid = isset($_GET['catid']) ? intval($_GET['catid']) : 0;

// Periksa apakah ID kategori valid
if ($catid <= 0) {
    die("Invalid category ID.");
}

// Ambil data kata dari API berdasarkan kategori
$wordsJson = file_get_contents($apiUrl . "?catid=" . $catid);
$words = json_decode($wordsJson, true);

// Ambil data kategori dari API untuk mendapatkan warna background
$categoryApiUrl = "http://localhost/rest/category.php";
$categoryJson = file_get_contents($categoryApiUrl);
$categories = json_decode($categoryJson, true);
$categoryColor = '';
foreach ($categories as $category) {
    if ($category['id'] == $catid) {
        $categoryColor = $category['color'];
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata dalam Kategori</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .word {
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            display: flex;
            align-items: center;
            <?php if (!empty($categoryColor)): ?>
                background-color: #<?= htmlspecialchars($categoryColor) ?>;
            <?php endif; ?>
        }
        .word img {
            max-width: 50px;
            max-height: 50px;
            margin-right: 10px;
        }
        .word .label {
            font-size: 18px;
            font-weight: bold;
        }
        .word .sunda {
            font-size: 16px;
            color: #666;
        }
        a {
            display: inline-block;
            margin-bottom: 20px;
            color: #16AFCA;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .word {
                flex-direction: column;
                align-items: flex-start;
            }
            .word img {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Kata</h1>
        <a href="index.php">Kembali ke Daftar Kategori</a>
        <ul>
            <?php if (!empty($words)): ?>
                <?php foreach ($words as $word): ?>
                    <li class="word">
                        <?php if ($catid != 4): ?>
                            <img src="http://localhost/rest/getImage.php?name=<?= htmlspecialchars($word['image']) ?>&size=mdpi" alt="<?= htmlspecialchars($word['label']) ?>">
                        <?php endif; ?>
                        <div>
                            <div class="label"><?= htmlspecialchars($word['label']) ?></div>
                            <div class="sunda"><?= htmlspecialchars($word['sunda']) ?></div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="word">Tidak ada kata dalam kategori ini.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
