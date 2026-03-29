<?php
// boundaries/ViewProfile.php
require_once __DIR__ . '/../controllers/ViewUserProfileController.php';

$pID = isset($_GET['pID']) ? intval($_GET['pID']) : 0;
$controller = new ViewUserProfileController();
$profile = $controller->GetUserProfileByID($pID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fafafa; margin: 40px; }
        h1 { color: #222; margin-bottom: 20px; }
        .profile-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 500px; }
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
    <h1>View Profile</h1>

    <div class="profile-container">
        <?php if ($profile): ?>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($profile['pID']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($profile['name']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($profile['description']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($profile['status']); ?></p>
        <?php else: ?>
            <p>Profile not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=3_UserAdmin_Menu'">Back</button>
    </div>
</body>
</html>
