<?php
// boundaries/ViewUserAccount.php
require_once __DIR__ . '/../controllers/ViewUserAccountController.php';

$uID = isset($_GET['aID']) ? intval($_GET['aID']) : 0;
$controller = new ViewUserAccountController();
$account = $controller->GetUserAccountByID($uID);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User Account</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background: #fafafa; 
            margin: 40px; 
        }
        h1 { 
            color: #222; 
            margin-bottom: 20px; 
        }
        .account-container { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            max-width: 500px; 
        }
        p { 
            margin: 10px 0; 
        }
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
        .back-button:hover { 
            background: #0056b3; 
        }
    </style>
</head>
<body>
    <h1>View User Account</h1>

    <div class="account-container">
        <?php if ($account): ?>
            <p><strong>ID:</strong> <?php echo htmlspecialchars($account['aID']); ?></p>
            <p><strong>Name:</strong> <?php echo htmlspecialchars($account['name']); ?></p>
            <p><strong>Password:</strong> <?php echo htmlspecialchars($account['password']); ?></p>
            <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($account['phoneNumber']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($account['address']); ?></p>
            <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($account['dob']); ?></p>
            <p><strong>User Profile:</strong> <?php echo htmlspecialchars($account['profile_name']); ?></p>
            <p><strong>Status:</strong> <?php echo htmlspecialchars($account['status']); ?></p>
        <?php else: ?>
            <p>User account not found.</p>
        <?php endif; ?>

        <button class="back-button" onclick="window.location.href='../index.php?action=UserAccountMenuPage'">Back</button>
    </div>
</body>
</html>
