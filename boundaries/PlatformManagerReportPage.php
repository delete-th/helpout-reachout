<?php
// boundaries/PlatformManagerReportPage.php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Platform Manager Reports</title>
    <style>
body {
    font-family: Arial, sans-serif;
	margin: 40px;
}

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


    </style>
</head>
<body>
    <h1>Platform Manager Reports</h1>

    <div class="navbar">
        <button 
            class="<?php echo ($_GET['action'] ?? '') === '4_PlatformManager_Menu' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=4_PlatformManager_Menu'">
            Categories
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'PlatformManagerReportPage' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=PlatformManagerReportPage'">
            Reports
        </button>

        <button 
            class="<?php echo ($_GET['action'] ?? '') === 'Logout' ? 'selected' : '' ?>" 
            onclick="window.location='index.php?action=Logout'">
            Logout
        </button>
    </div>

    <?php
    // Display flash message once
    if (isset($_SESSION['flash_msg'])) {
        echo '<p class="flash">' . htmlspecialchars($_SESSION['flash_msg']) . '</p>';
        unset($_SESSION['flash_msg']);
    }
    ?>

 
</body>
</html>
