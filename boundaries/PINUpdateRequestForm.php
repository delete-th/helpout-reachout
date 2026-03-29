
<?php
// boundaries/PINUpdateRequestForm.php
	require_once __DIR__ . '/../controllers/PINUpdateRequestController.php';
	//require_once __DIR__ . '/../controllers/ViewCategoryController.php';
	
	session_start();
	$pinID = $_SESSION['userID'];

	$rID = isset($_GET['rID']) ? intval($_GET['rID']) : 0;
	
	$requestController = new PINUpdateRequestController();
	
    // Handle form submission
    if (isset($_POST['updateRequest'])) {
        $cID = $_POST['serviceType'];
        $description = $_POST['description'];
        $inputDate = $_POST['date'];
		$formattedDate = date('Y-m-d', strtotime($inputDate));
		$location = $_POST['location'];
		$priority = $_POST['priority'];
		$status = $_POST['status'];
		
		//$category = $categoryController->GetCategoryByType($serviceType);
		//$cID = $category['cID'];
		
        $updateResult = $requestController->UpdateRequest($rID, $pinID, $cID, $description, $formattedDate, $location, $priority, $status);
		
		if ($updateResult) {
			$_SESSION['flash_msg'] = "Request updated successfully!";
		} else {
			$_SESSION['flash_msg'] = "Failed to update request.";
		}
		header("Location: ../index.php?action=1_PIN_Menu");
		exit;
		
    }
	
	$request = $requestController->GetRequestByID($rID);
	
	//$categoryController = new ViewCategoryController();
	$categories = $requestController->GetCategories();
	
	//$viewCount = intval($request['viewCount']);
	$savedCount = intval($request['savedCount']);
	$currentStatus = $request['status'];

	if ($savedCount > 0) {   //$viewCount > 0 || 
		$effectiveStatus = 'In Progress';
	} else {
		$effectiveStatus = $currentStatus;
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        button {
            padding: 8px 16px;
            margin-right: 10px;
            cursor: pointer;
        }

        p {
            margin-top: 15px;
        }
		
		.radio-group {
            margin-top: 8px;
        }

        .radio-group label {
            font-weight: normal;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <h1>Update Request</h1>

    <?php if ($request): ?>
        <form method="post" action="PINUpdateRequestForm.php?rID=<?php echo $rID; ?>">
            <label for="serviceType">Request Category:</label>
			<select name="serviceType" id="serviceType" required>
			<?php if (!empty($categories)) : ?>
					<?php foreach ($categories as $category) : ?>
						<option value="<?php echo htmlspecialchars($category['cID']); ?>" 
						<?php if ($request['category'] === $category['category']) echo 'selected'; ?>>
						<?php echo htmlspecialchars($category['category']); ?></option>
					<?php endforeach; ?>
			<?php endif; ?>
			</select><br><br>

            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($request['description']); ?></textarea><br><br>
			
			<label for="date">Date of Task/Event:</label>
			<input type="date" id="date" name="date" value="<?php echo htmlspecialchars(date('Y-m-d', strtotime($request['date']))); ?>" required><br><br>
			
			<label>Location:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($request['location']); ?>" required><br><br>

            <label>Priority:</label>
            <select name="priority" required>
                <option value="Low" <?php if($request['priority']=='Low') echo 'selected'; ?>>Low</option>
                <option value="Medium" <?php if($request['priority']=='Medium') echo 'selected'; ?>>Medium</option>
				<option value="High" <?php if($request['priority']=='High') echo 'selected'; ?>>High</option>
            </select><br><br>
			
			<label>Status:</label>
			<div class="radio-group">
				<label> <input type="radio" name="status" value="<?php echo $effectiveStatus;?>"  checked>
					<?php echo $effectiveStatus; ?>
				</label>
			</div>

            <button type="submit" name="updateRequest">Update Request</button>
            <!-- Back button -->
            <button type="button" onclick="window.location.href='../index.php?action=1_PIN_Menu';">Back</button>
        </form>
    <?php else: ?>
        <p>Request not found.</p>
        <button type="button" onclick="window.location.href='../index.php?action=1_PIN_Menu';">Back</button>
    <?php endif; ?>
	
</body>
</html>
