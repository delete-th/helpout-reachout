<!-- boundaries/Login.php -->
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Show logout success popup
$showLogoutPopup = false;
if (!empty($_SESSION['logout_success'])) {
    $showLogoutPopup = true;
    unset($_SESSION['logout_success']);
}

require_once __DIR__ . '/../controllers/LoginController.php';

$errorMessage = '';

// Handle form submission
if (isset($_POST['Login'])) {
    if (!empty(trim($_POST['name'])) && !empty(trim($_POST['pwd']))
        && !empty(trim($_POST['login_as']))) {

        $name = trim($_POST['name']);
        $password = trim($_POST['pwd']);
        $loginAs = trim($_POST['login_as']);

        $loginController = new LoginController();
        $result = $loginController->loginUser($name, $password, $loginAs);

        $action = $result[0];
        $userID = $result[1];
        $_SESSION['userID'] = $userID;

        // Redirect BEFORE printing any HTML
        if (strpos($action, 'Menu') !== false) {
            header("Location: index.php?action={$action}");
            exit();
        } else {
            $errorMessage = $action;
        }
    } else {
        $errorMessage = "Please enter your username and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
	/* Fullscreen layout with blurred background */
	body {
		margin: 0;
		padding: 0;
		height: 100vh;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;

		background: url('boundaries/background.png') no-repeat center center/cover;
		backdrop-filter: blur(1px);
		font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
	}

	/* Soft overlay */
	.overlay {
		position: fixed;
		inset: 0;
		background: rgba(0, 0, 0, 0.25);
		backdrop-filter: blur(2px);
		z-index: 0;
	}

	/* BIG glowing title */
	h1 {
		z-index: 2;
		color: #ffffff;
		font-size: 55px;
		font-weight: 700;
		text-align: center;

		margin-bottom: 40px;

		text-shadow:
			0 0 12px rgba(255,255,255,0.6),
			0 0 32px rgba(255,255,255,0.45),
			0 0 60px rgba(255,255,255,0.35);
	}

	/* Login card */
	.login-card {
		z-index: 2;
		width: 360px;
		padding: 40px 32px;           /* slightly bigger padding so the box looks fuller */
		border-radius: 18px;

		background: rgba(0, 0, 0, 0.45);   /* darker glass instead of light white */
		backdrop-filter: blur(14px);

		box-shadow: 0 12px 45px rgba(0,0,0,0.45); /* deeper shadow to define the box */
	}

        .login-card label {
            color: #fff;
            font-weight: 500;
            margin-bottom: 5px;
            display: inline-block;
        }

	/***** INPUT + ICON FIXED WIDTH *****/
	.input-icon {
		position: relative;
		margin-bottom: 20px;
	}

	.input-icon img {
		position: absolute;
		left: 12px;
		top: 50%;
		transform: translateY(-50%);
		width: 20px;
		//opacity: 0.85;
	}

	.input-icon input {
		width: 100%;
		padding: 12px 12px 12px 45px; /* spacing for icon */
		border: none;
		border-radius: 10px;

		background: rgba(255, 255, 255, 0.28);
		backdrop-filter: blur(1px);
		color: #fff;
		font-size: 15px;

		box-sizing: border-box; /* prevents overflow */
	}

	.input-icon input:focus {
		outline: none;
		box-shadow: 0 0 7px rgba(255,255,255,0.8);
	}

	/***** UPDATED DROPDOWN TO MATCH GLASS STYLE *****/
	select {
		width: 100%;
		padding: 12px;
		margin-bottom: 20px;
		border-radius: 10px;
		border: none;
		box-sizing: border-box;

		background: rgba(255,255,255,0.28);
		backdrop-filter: blur(4px);
		color: #fff;
		font-size: 15px;
	}

	/* Style dropdown text color */
	select option {
		background: #f0f0f0;
		color: #000;
	}

	/* Button */
	.login-btn {
		width: 100%;
		padding: 12px;
		background: rgba(255,255,255,0.75);
		color: #222;
		font-weight: 600;
		font-size: 15px;
		border: none;
		border-radius: 10px;
		cursor: pointer;
		transition: 0.3s;
	}

	.login-btn:hover {
		background: rgba(255,255,255,0.92);
	}

	.error {
		color: #ff2617;              
		font-size: 16px;          
		margin-bottom: 10px;
		text-shadow: 0 0 6px rgba(0,0,0,0.5); 
	}

/* Logout modal */ 
#logoutModal { 
display: none; 
position: fixed; 
z-index: 1000; left:0; top:0; width:100%; height:100%; background: rgba(0,0,0,0.5); } 

#logoutModalContent { 
background: #fff; margin: 15% auto; padding: 25px; width: 300px; text-align: center; border-radius:10px; /* colored shadow to stand out over login box */ box-shadow: 0 5px 20px rgba(9, 132, 227, 0.5), 0 10px 40px rgba(9, 132, 227, 0.3); } 

#logoutModalContent button { background:#0984e3; color:#fff; border:none; padding:8px 16px; border-radius:5px; cursor:pointer; transition: background 0.3s, box-shadow 0.3s; } 

#logoutModalContent button:hover { background:#74b9ff; box-shadow: 0 3px 10px rgba(9, 132, 227, 0.4); } /* Make the login form dimmer when popup is visible */ 

#logoutModal[style*="display: block"] ~ form { filter: brightness(0.7); transition: filter 0.3s ease; } /* So the login box shadow is less overpowering */ form { box-shadow: 0 5px 15px rgba(9, 132, 227, 0.15), 0 10px 30px rgba(9, 132, 227, 0.1); } /* Make popup shadow stronger to stand out */ 

#logoutModalContent { box-shadow: 0 5px 20px rgba(9, 132, 227, 0.7), 0 10px 40px rgba(9, 132, 227, 0.5); }

    </style>
</head>
<body>

<div class="overlay"></div>

<h1>Reach Out, Help Out</h1>

<?php if (!empty($errorMessage)): ?>
    <p class="error"><?php echo htmlspecialchars($errorMessage); ?></p>
<?php endif; ?>

<div class="login-card">
    <form method="post" action="index.php?action=Login">

        <label>Name:</label>
        <div class="input-icon">
            <img src="boundaries/userIcon.png" alt="User">
            <input type="text" name="name" required>
        </div>

        <label>Password:</label>
        <div class="input-icon">
            <img src="boundaries/lockIcon.png" alt="Lock">
            <input type="password" name="pwd" required>
        </div>

        <label>Login As:</label>
        <select name="login_as" required>
            <option value="User Admin">User Admin</option>
            <option value="PIN">PIN</option>
            <option value="CSR Rep">CSR Rep</option>
            <option value="Platform Manager">Platform Manager</option>
        </select>

        <button type="submit" name="Login" class="login-btn">Login</button>

    </form>
</div>

<!-- Logout popup -->
<?php if ($showLogoutPopup): ?>
    <div id="logoutModal">
        <div id="logoutModalContent">
            <p>Logged out successfully</p>
            <button onclick="document.getElementById('logoutModal').style.display='none';">OK</button>
        </div>
    </div>
    <script>
        document.getElementById('logoutModal').style.display = 'block';
    </script>
<?php endif; ?>
</body>
</html>
