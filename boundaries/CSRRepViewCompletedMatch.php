<?php
// boundaries/CSRRepViewCompletedMatch.php
require_once __DIR__ . '/../controllers/CSRRepViewCompletedHistoryMatchController.php';

$mID = isset($_GET['mID']) ? intval($_GET['mID']) : 0;
$CSRRepViewCompletedHistoryMatchController = new CSRRepViewCompletedHistoryMatchController();
$match = $CSRRepViewCompletedHistoryMatchController->CSRRepGetCompletedMatchByMID($mID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Completed Match</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin: 40px; }
        h1 { color: #222; margin-bottom: 20px; }
        .match-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 700px;
        }
        p { margin: 10px 0; }
        .back-button {
            margin-top: 20px;
            padding: 8px 16px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .back-button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <h1>View Completed Match</h1>

    <div class="match-container">
        <?php if ($match): ?>
            <p><strong>Match ID:</strong> <?= htmlspecialchars($match['mID']); ?></p>
            <p><strong>Request ID:</strong> <?= htmlspecialchars($match['rID']); ?></p>
            <p><strong>PIN ID:</strong> <?= htmlspecialchars($match['pinID']); ?></p>
            <p><strong>PIN Name:</strong> <?= htmlspecialchars($match['pinName']); ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($match['description']); ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($match['category']); ?></p>
            <p><strong>Date Booked:</strong> <?= htmlspecialchars($match['dateBooked']); ?></p>
            <p><strong>Date Requested:</strong> <?= htmlspecialchars($match['date']); ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($match['location']); ?></p>
            <p><strong>Priority:</strong> <?= htmlspecialchars($match['priority']); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($match['status']); ?></p>
        <?php else: ?>
            <p>Completed match not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=CSRRepCompletedMatchHistoryPage';">Back</button>
    </div>
</body>
</html>
