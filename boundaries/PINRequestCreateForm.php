
<?php
	// boundaries/PINRequestCreateForm.php
	require_once __DIR__ . '/../controllers/PINCreateRequestController.php';
	require_once __DIR__ . '/../controllers/ViewCategoryController.php';
	
	session_start();
	$pinID = $_SESSION['userID'];
	
	$categoryController = new ViewCategoryController();
	if (!isset($categories)) {
    $categories = $categoryController->GetCategories();
	}

	// Check if form is submitted
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['submit'])) {
			$category = trim($_POST['serviceType']);
			$description = trim($_POST['description']);
			
			$inputDate = trim($_POST['date']);
			$formattedDate = date('Y-m-d', strtotime($inputDate)); //to make it compatible with date column in SQL db
			
			$location = trim($_POST['location']);
			$status = trim($_POST['status']) ?? "Pending";
			$priority = trim($_POST['priority']);

			$controller = new PINCreateRequestController();
			$result = $controller->CreateRequest($pinID, $category, $description, $formattedDate, $location, $status, $priority);

			   if ($result) {
				   $_SESSION['flash_msg'] = "Request Created Successfully!";
			   } else {
				   $_SESSION['flash_msg'] = "Request could not be created!";
			   }
			   header("Location: ../index.php?action=1_PIN_Menu");
			   exit;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        form {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 25px;
            border-radius: 8px;
            background: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        .radio-group {
            margin-top: 8px;
        }

        .radio-group label {
            font-weight: normal;
            margin-right: 15px;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 8px 16px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: white;
        }

        button[type="button"] {
            background-color: #6c757d;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }
		
		#serviceType {
			length: 700px;
			height: 30px;
			padding: 5px;
			margin-top: 12px;
		}
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Create Request</h2>

        <label for="serviceType">Request Category:</label>
		<select name="serviceType" id="serviceType" required>
		<?php if (!empty($categories)) : ?>
                <?php foreach ($categories as $category) : ?>
					<option value="<?php echo htmlspecialchars($category['cID']); ?>" ><?php echo htmlspecialchars($category['category']); ?></option>
				<?php endforeach; ?>
		<?php endif; ?>
        </select><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="3" placeholder="short description/ title of the request" required></textarea>
		
		<label for="date">Date of Task/Event:</label>
        <input type="date" id="date" name="date" required min="<?= date('Y-m-d') ?>">
		
		<label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label>Status:</label>
        <div class="radio-group">
            <label><input type="radio" name="status" value="Pending" checked> Pending</label>
        </div>
		
		<label>Priority:</label>
        <div class="radio-group">
            <label><input type="radio" name="priority" value="Low"> Low</label>
			<label><input type="radio" name="priority" value="Medium"> Medium</label>
			<label><input type="radio" name="priority" value="High"> High</label>
        </div>

        <div class="button-group">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</body>
</html>
