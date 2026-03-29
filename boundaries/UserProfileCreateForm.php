<?php
// boundaries/ProfileCreateForm.php
require_once __DIR__ . '/../controllers/CreateUserProfileController.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name = trim($_POST['profileName']);
        $description = trim($_POST['profileDesc']);
        $status = isset($_POST['profileStatus']) ? $_POST['profileStatus'] : 'Suspended';

        $controller = new CreateUserProfileController();
        $result = $controller->CreateUserProfile($name, $description, $status);
		
        if ($result) {
			session_start();
			$_SESSION['flash_msg'] = "Profile created successfully!";
			header("Location: ../index.php?action=3_UserAdmin_Menu");
        } else {
			session_start();
			$_SESSION['flash_msg'] = "There was an error creating the profile.";
			header("Location: ../index.php?action=3_UserAdmin_Menu");
        }
		exit;
		
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Profile</title>
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
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Create Profile</h2>

        <label for="profileName">Profile Name:</label>
        <input type="text" id="profileName" name="profileName" required>

        <label for="profileDesc">Description:</label>
        <textarea id="profileDesc" name="profileDesc" rows="3" required></textarea>

        <label>Status:</label>
        <div class="radio-group">
            <label><input type="radio" name="profileStatus" value="Active" checked> Active</label>
            <label><input type="radio" name="profileStatus" value="Suspended"> Suspended</label>
        </div>

        <div class="button-group">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</body>
</html>
