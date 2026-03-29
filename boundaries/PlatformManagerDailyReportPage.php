<?php
// boundaries/PlatformManagerDailyReportPage.php
date_default_timezone_set('Asia/Singapore');
session_start();
require_once __DIR__ . '/../controllers/PlatformManagerGenerateReportsControllers.php';

$controller = new GenerateDailyReportController();
$reportData = $controller->PlatformManagerGetDailyReport();

$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #fafafa;
        }

        h1 { margin-bottom: 5px; }

        .container {
            max-height: 85vh;
            overflow-y: auto;
            padding-right: 10px;
        }

        .category-block {
            margin-bottom: 40px;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 10px;
            text-align: left;
        }

        th {
            background: #eaeaea;
        }

        .total {
            margin-top: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Daily Report</h1>
<p><strong>Date Today:</strong> <?= htmlspecialchars($today) ?></p>

<div class="container">

<?php if (empty($reportData)) : ?>
    <p>No requests found for today.</p>
<?php else : ?>

    <?php foreach ($reportData as $cat): ?>
        <div class="category-block">
            <h2>Category: <?= htmlspecialchars($cat['category']) ?></h2>

            <table>
                <tr>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Priority</th>
                </tr>

                <?php foreach ($cat['requests'] as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['description']) ?></td>
                    <td><?= htmlspecialchars($r['date']) ?></td>
                    <td><?= htmlspecialchars($r['priority']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <p class="total">
                Total requests made in this category: <?= count($cat['requests']) ?>
            </p>
        </div>
    <?php endforeach; ?>

<?php endif; ?>
<button 
    onclick="window.location='../index.php?action=PlatformManagerReportPage'" 
    style="padding: 8px 12px; margin-bottom: 20px; cursor: pointer;">
    ← Back to Reports Menu
</button>
</div>



</body>
</html>
