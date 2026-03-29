<?php
// boundaries/SuspendConfirmationPopUp.php
require_once __DIR__ . '/../controllers/SuspendUserProfileController.php';

$pID = $_GET['pID'] ?? 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SuspendUserProfileController();

    if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
        $result = $controller->suspendUserProfile($pID);
    } else {
        // user cancelled -> redirect back to menu (no message or you can add one)
        header("Location: ../index.php?action=3_UserAdmin_Menu");
        exit;
    }
    
	if ($result) {
		session_start();
		$_SESSION['flash_msg'] = "Profile suspended successfully!";
		header("Location: ../index.php?action=3_UserAdmin_Menu");
		exit;
    } else {
		session_start();
		$_SESSION['flash_msg'] = "Failed to suspend profile.";
		header("Location: ../index.php?action=3_UserAdmin_Menu");
		exit;
    }
	
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Confirm Suspension</title>
<style>
    /* Full-screen overlay */
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: Arial, sans-serif;
    }
    .overlay {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(0,0,0,0.5); /* semi-transparent background */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .popup-container {
        background: white;
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0,0,0,0.3);
        text-align: center;
        max-width: 400px;
        width: 90%;
        animation: fadeIn 0.3s ease-out;
    }

    h2 { margin-bottom: 25px; color: #222; }

    .btn {
        padding: 10px 25px;
        margin: 0 10px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.2s;
    }
    .btn-yes { background: #d9534f; color: white; }
    .btn-yes:hover { background: #c9302c; }
    .btn-no { background: #6c757d; color: white; }
    .btn-no:hover { background: #5a6268; }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }
</style>
</head>
<body>
    <div class="overlay">
        <div class="popup-container">
            <h2>Are you sure you want to suspend this profile?</h2>
            <form method="post">
                <button type="submit" name="confirm" value="yes" class="btn btn-yes">Yes</button>
                <button type="submit" name="confirm" value="no" class="btn btn-no">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
