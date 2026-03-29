<?php
// boundaries/UserAccountMenuPage.php
session_start();
?>
<html>
<head>
    <style>
h1 {
    margin-bottom: 20px;
}

/* Navbar container */
.navbar {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 20px;
}

/* Navbar buttons (completely invisible) */
.navbar button {
    all: unset;
    padding: 8px 12px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 8px; /* rounded edges */
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}

.navbar button:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.2); /* subtle lift shadow */
    transform: translateY(-1px);           /* slight hover lift */
}

/* Selected button styling */
.navbar button.selected {
    font-size: 18px;
    text-decoration: underline;
    font-weight: bold;
}

/* Spacer to push Logout right */
.navbar .spacer {
    flex-grow: 1;
}

/* Create button styling */
.create-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 8px; /* rounded edges */
    transition: background-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
}

.create-btn:hover {
    background-color: #45a049;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2); /* subtle hover shadow */
    transform: translateY(-1px);           /* slight lift */
}
    </style>
    <script>
        function goToAccountCreate() {
            window.location.href = 'boundaries/UserAccountCreateForm.php';
        }
    </script>

    <title>Admin Menu - User Accounts</title>
</head>
<body>

    <h1> Admin Menu </h1>

    <div class="navbar">
        <button 
            class="<?php echo ($_GET['action'] ?? '') === '3_UserAdmin_Menu' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=3_UserAdmin_Menu'">
            User Profiles
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'UserAccountMenuPage' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=UserAccountMenuPage'">
            User Accounts
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'Logout' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=Logout'">
            Logout
        </button>
    </div>

    <!-- Create new account button -->
    <a onclick="goToAccountCreate()" class="create-btn">+ Create New Account</a>

	<?php if (isset($_SESSION['flash_msg'])): ?>
		<p id="flash-msg" style="color: green; font-weight: bold;">
			<?php 
				echo htmlspecialchars($_SESSION['flash_msg']); 
				unset($_SESSION['flash_msg']); // Remove session immediately
			?>
		</p>

		<script>
			// Hide the message after 5 seconds (5000 milliseconds)
			setTimeout(function() {
				var msg = document.getElementById('flash-msg');
				if (msg) {
					msg.style.display = 'none';
				}
			}, 5000);
		</script>
	<?php endif; ?>

</body>
</html>
