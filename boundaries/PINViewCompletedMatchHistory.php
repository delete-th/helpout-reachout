<?php
	// boundaries/PINViewCompletedRequestHistory.php
	//require_once __DIR__ . '/../controllers/PINViewRequestController.php';
	//require_once __DIR__ . '/../controllers/ViewCategoryController.php';
	require_once __DIR__ . '/../controllers/PINViewVolunteerMatchController.php';
	
	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	$pinID = $_SESSION['userID'];

	$rID = isset($_GET['rID']) ? intval($_GET['rID']) : 0;
	
	$controller = new PINViewVolunteerMatchController();
	$match = $controller->GetMatch($pinID,$rID);

	//$requestController = new PINViewRequestController();
	//$request = $controller->GetRequestByID($rID);

	//$categoryController = new ViewCategoryController();
	//$category = $categoryController->GetCategoryByID($request['category']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Match</title>
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
		table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 10px 12px; text-align: left; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h1>View Match</h1>

    <div class="request-container">
        <?php if ($match): ?>
			<h3>Match Details:</h3>
			<p><strong>&nbsp;Match ID:</strong> <?php echo htmlspecialchars($match['matchID']); ?></p>
			<p><strong>&nbsp;CSR ID:</strong> <?php echo htmlspecialchars($match['csrID']); ?></p>
			<p><strong>&nbsp;CSR Rep Name:</strong> <?php echo htmlspecialchars($match['csrName']); ?></p><br>
			
			<h3>Request Details:</h3>
            <p><strong>&nbsp;Request ID:</strong> <?php echo htmlspecialchars($match['rID']); ?></p>
			<p><strong>&nbsp;Category:</strong> <?php echo htmlspecialchars($match['category']); ?></p>
            <p><strong>&nbsp;Description:</strong> <?php echo htmlspecialchars($match['description']); ?></p>
            <p><strong>&nbsp;Date:</strong> <?php echo htmlspecialchars($match['date']); ?></p>
			<p><strong>&nbsp;Location:</strong> <?php echo htmlspecialchars($match['location']); ?></p>
			<p><strong>&nbsp;Priority:</strong> <?php echo htmlspecialchars($match['priority']); ?></p>
            <p><strong>&nbsp;Status:</strong> <?php echo htmlspecialchars($match['status']); ?></p>
			<p><strong>&nbsp;Number of Views:</strong> <?php echo htmlspecialchars($match['viewCount']); ?></p>
			<p><strong>&nbsp;Number of saves:</strong> <?php echo htmlspecialchars($match['savedCount']); ?></p>
			
			
        <?php else: ?>
            <p>Match not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=PIN_History';">Back</button>
    </div>
</body>
</html>