<?php
// Konfigurasi URL API
$apiUrl = "http://localhost/rest/category.php";

// Ambil data kategori dari API
$categoriesJson = file_get_contents($apiUrl);
$categories = json_decode($categoriesJson, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori</title>
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
        .category {
            padding: 10px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            <?php if (!empty($categoryColor)): ?>
                background-color: #<?= htmlspecialchars($categoryColor) ?>;
            <?php endif; ?>
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            color: #000;
            border-radius: 4px;
        }
        .category:hover {
            background-color: #e0e0e0;
        }
        .category .label {
            font-size: 18px;
            font-weight: bold;
        }
        .category .arrow {
            font-size: 18px;
            font-weight: bold;
        }
        @media (max-width: 600px) {
            .category {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Kategori</h1>
        <ul>
            <?php foreach ($categories as $category): ?>
                <a href="word.php?catid=<?= htmlspecialchars($category['id']) ?>" class="category" style="background-color: #<?= htmlspecialchars($category['color']) ?>">
                    <span class="label"><?= htmlspecialchars($category['label']) ?></span>
                    <span class="arrow">→</span>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
