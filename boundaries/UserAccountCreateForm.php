<?php
// boundaries/UserAccountCreateForm.php
require_once __DIR__ . '/../controllers/CreateUserAccountController.php';
require_once __DIR__ . '/../controllers/ViewUserProfileController.php';

$profileController = new ViewUserProfileController();
$profiles = $profileController->GetUserProfiles();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $name = trim($_POST['name']);
        $password = trim($_POST['password']);
        $phoneNumber = trim($_POST['phoneNumber']);
        $address = trim($_POST['address']);
        $dob = trim($_POST['dob']);
        $userProfile = intval($_POST['userProfile']);
        $status = isset($_POST['status']) ? $_POST['status'] : 'Suspended';

        $controller = new CreateUserAccountController();
        $result = $controller->CreateUserAccount($name, $password, $phoneNumber, $address, $dob, $userProfile, $status);
		
        if ($result) {
			session_start();
			$_SESSION['flash_msg'] = "Account created successfully!";
			header("Location: ../index.php?action=UserAccountMenuPage");
        } else {
			session_start();
			$_SESSION['flash_msg'] = "There was an error creating the account.";
			header("Location: ../index.php?action=UserAccountMenuPage");
        }
		exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User Account</title>
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

        input[type="text"], input[type="password"], input[type="date"], textarea, select {
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

        option[disabled] {
            color: gray;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Create User Account</h2>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="phoneNumber">Phone Number:</label>
        <input type="text" id="phoneNumber" name="phoneNumber" required>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="3" required></textarea>

        <label for="dob">Date of Birth:</label>
        <input type="date" id="dob" name="dob" required>

        <label for="userProfile">Select User Profile:</label>
        <select id="userProfile" name="userProfile" required>
            <option value="">-- Select Profile --</option>
            <?php foreach ($profiles as $profile): ?>
                <?php if ($profile['status'] === 'Active'): ?>
                    <option value="<?php echo htmlspecialchars($profile['pID']); ?>">
                        <?php echo htmlspecialchars($profile['name']); ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label>Status:</label>
        <div class="radio-group">
            <label><input type="radio" name="status" value="Active" checked> Active</label>
            <label><input type="radio" name="status" value="Suspended"> Suspended</label>
        </div>

        <div class="button-group">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</body>
</html>
