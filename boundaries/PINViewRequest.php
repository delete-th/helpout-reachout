
<?php
// boundaries/PINViewRequest.php
require_once __DIR__ . '/../controllers/PINViewRequestController.php';
//require_once __DIR__ . '/../controllers/ViewCategoryController.php';

$rID = isset($_GET['rID']) ? intval($_GET['rID']) : 0;

$requestController = new PINViewRequestController();
$request = $requestController->GetRequestByID($rID);

//$categoryController = new ViewCategoryController();
//$category = $categoryController->GetCategoryByID($request['category']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Request</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin: 40px; }
        h1 { color: #222; margin-bottom: 20px; }
        .request-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; }
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
            <p><strong>Request ID:</strong> <?php echo htmlspecialchars($request['rID']); ?></p>
			<p><strong>Category:</strong> <?php echo htmlspecialchars($request['category']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($request['description']); ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($request['date']); ?></p>
			<p><strong>Location:</strong> <?php echo htmlspecialchars($request['location']); ?></p>
			<p><strong>Priority:</strong> <?php echo htmlspecialchars($request['priority']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($request['status']); ?></p>
			<p><strong>Number of Views:</strong> <?php echo htmlspecialchars($request['viewCount']); ?></p>
			<p><strong>Number of saves:</strong> <?php echo htmlspecialchars($request['savedCount']); ?></p>
        <?php else: ?>
            <p>Request not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=<?php 
        echo ($request['status'] === 'Incomplete') ? 'PIN_History' : '1_PIN_Menu'; ?>';">Back</button>
    </div>
</body>
</html>

<!-- "window.location.href='../index.php?action=1_PIN_Menu';" -->