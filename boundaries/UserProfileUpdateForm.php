<?php
// boundaries/ProfileUpdateForm.php
require_once __DIR__ . '/../controllers/UpdateUserProfileController.php';

$pID = isset($_GET['pID']) ? intval($_GET['pID']) : 0;
$controller = new UpdateUserProfileController();
$profile = $controller->GetUserProfileByID($pID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
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
    </style>
</head>
<body>
    <h1>Update Profile</h1>

    <?php if ($profile): ?>
        <form method="post" action="UserProfileUpdateForm.php?pID=<?php echo $pID; ?>">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($profile['name']); ?>" required><br><br>

            <label>Description:</label>
            <textarea name="description" required><?php echo htmlspecialchars($profile['description']); ?></textarea><br><br>

            <label>Status:</label>
            <select name="status" required>
                <option value="Active" <?php if($profile['status']=='Active') echo 'selected'; ?>>Active</option>
                <option value="Suspended" <?php if($profile['status']=='Suspended') echo 'selected'; ?>>Suspended</option>
            </select><br><br>

            <button type="submit" name="updateProfile">Update Profile</button>
            <!-- Back button -->
            <button type="button" onclick="window.history.back();">Back</button>
        </form>
    <?php else: ?>
        <p>Profile not found.</p>
        <button type="button" onclick="window.history.back();">Back</button>
    <?php endif; ?>

    <?php
    // Handle form submission
    if (isset($_POST['updateProfile'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $updateResult = $controller->UpdateUserProfile($pID, $name, $description, $status);
        if ($updateResult) {
			session_start();
			$_SESSION['flash_msg'] = "Profile updated successfully!";
			header("Location: ../index.php?action=3_UserAdmin_Menu");
        } else {
			session_start();
			$_SESSION['flash_msg'] = "There was an error updating the profile.";
			header("Location: ../index.php?action=3_UserAdmin_Menu");
        }
		exit;
    }
    ?>
</body>
</html>
