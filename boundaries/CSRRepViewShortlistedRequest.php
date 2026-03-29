<?php
// boundaries/CSRRepViewShortlistedRequest.php
require_once __DIR__ . '/../controllers/CSRRepViewShortlistedRequestController.php';

$rID = isset($_GET['rID']) ? intval($_GET['rID']) : 0;
$CSRRepViewShortlistedRequestController = new CSRRepViewShortlistedRequestController();
$request = $CSRRepViewShortlistedRequestController->GetShortlistedRequestByRID($rID);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Shortlisted Request</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin: 40px; }
        h1 { color: #222; margin-bottom: 20px; }
        .request-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
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
    <h1>View Request</h1>

    <div class="request-container">
        <?php if ($request): ?>
            <p><strong>Request ID:</strong> <?= htmlspecialchars($request['rID']); ?></p>
            <p><strong>PIN ID:</strong> <?= htmlspecialchars($request['pinID']); ?></p>
            <p><strong>PIN Name:</strong> <?= htmlspecialchars($request['pinName']); ?></p>
            <p><strong>Description:</strong> <?= htmlspecialchars($request['description']); ?></p>
            <p><strong>Category:</strong> <?= htmlspecialchars($request['category']); ?></p>
            <p><strong>Date:</strong> <?= htmlspecialchars($request['date']); ?></p>
            <p><strong>Location:</strong> <?= htmlspecialchars($request['location']); ?></p>
            <p><strong>Priority:</strong> <?= htmlspecialchars($request['priority']); ?></p>
            <p><strong>Status:</strong> <?= htmlspecialchars($request['status']); ?></p>
        <?php else: ?>
            <p>Request not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=CSRRepShortlistedRequestsPage';">Back</button>
    </div>
</body>
</html>
