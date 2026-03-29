<?php
// boundaries/UserAccountUpdateForm.php
session_start();
require_once __DIR__ . '/../controllers/UpdateUserAccountController.php';
require_once __DIR__ . '/../controllers/ViewUserProfileController.php';

$aID = isset($_GET['aID']) ? intval($_GET['aID']) : 0;
$UpdateUserAccountController = new UpdateUserAccountController();
$ViewUserProfileController = new ViewUserProfileController();

$account = $UpdateUserAccountController->GetUserAccountByID($aID);
$profiles = $ViewUserProfileController->GetUserProfiles(); 

// Handle form submission
	if (isset($_POST['updateAccount'])) {
       $name = $_POST['name'];
       $password = $_POST['password'];
       $phoneNumber = $_POST['phoneNumber'];
       $address = $_POST['address'];
       $dob = $_POST['dob'];
       $userProfile = $_POST['userProfile'];
       $status = $_POST['status'];

       $updateResult = $UpdateUserAccountController->UpdateUserAccount($aID, $name, $password, $phoneNumber, $address, $dob, $userProfile, $status);

       if ($updateResult) {
           $_SESSION['flash_msg'] = "User account updated successfully!";
       } else {
           $_SESSION['flash_msg'] = "There was an error updating the account.";
       }
       header("Location: ../index.php?action=UserAccountMenuPage");
       exit;
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User Account</title>
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
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
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
    <h1>Update User Account</h1>

    <?php if ($account): ?>
        <form method="post" action="UserAccountUpdateForm.php?aID=<?php echo $aID; ?>">

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($account['name']); ?>" required>

            <label>Password:</label>
            <input type="text" name="password" value="<?php echo htmlspecialchars($account['password']); ?>" required>

            <label>Phone Number:</label>
            <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($account['phoneNumber']); ?>" required>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($account['address']); ?>" required>

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="<?php echo htmlspecialchars($account['dob']); ?>" required>

            <label>User Profile:</label>
            <select name="userProfile" required>
                <?php foreach ($profiles as $p): ?>
                    <?php if ($p['status'] != 'Suspended'): // skip suspended profiles ?>
                        <option value="<?php echo $p['pID']; ?>" 
                            <?php if ($account['userProfile'] == $p['pID']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($p['name']); ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>

            <label>Status:</label>
            <select name="status" required>
                <option value="Active" <?php if ($account['status'] == 'Active') echo 'selected'; ?>>Active</option>
                <option value="Suspended" <?php if ($account['status'] == 'Suspended') echo 'selected'; ?>>Suspended</option>
            </select>

            <button type="submit" name="updateAccount">Update Account</button>
            <button type="button" onclick="window.location.href='../index.php?action=UserAccountMenuPage'">Back</button>
        </form>
    <?php else: ?>
        <p>Account not found.</p>
        <button type="button" onclick="window.location.href='../index.php?action=UserAccountMenuPage'">Back</button>
    <?php endif; ?>

</body>
</html>
