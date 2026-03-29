<?php
// boundaries/SearchUserAccounts.php
require_once __DIR__ . '/../controllers/SearchUserAccountsController.php';
require_once __DIR__ . '/../controllers/ViewUserAccountController.php';

$SearchUserAccountsController = new SearchUserAccountsController();
$ViewUserAccountController = new ViewUserAccountController();

$searchBy = $_POST['searchBy'] ?? 'name';
$searchInput = $_POST['searchInput'] ?? '';
$accounts = [];

// If "Clear Search" clicked → show all accounts again
if (isset($_POST['clearButton'])) {
    $accounts = $ViewUserAccountController->getUserAccounts();
    $searchInput = '';
} 
// If search submitted
elseif (isset($_POST['searchButton']) && !empty(trim($searchInput))) {
    $accounts = $SearchUserAccountsController->searchUserAccounts($searchBy, $searchInput);
} 
// Default → show all
else {
    $accounts = $ViewUserAccountController->getUserAccounts();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search User Accounts</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 40px;
}

h1 {
    color: #222;
    margin-bottom: 20px;
}

/* Search container */
.searchContainer {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Rounded inputs and dropdowns */
.searchContainer select,
.searchContainer input {
    padding: 5px 10px;
    font-size: 14px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
}

.searchContainer select:focus,
.searchContainer input:focus {
    outline: none;
    box-shadow: 0 0 6px rgba(0,0,0,0.3);
    transform: translateY(-1px);
}

/* Buttons */
.searchContainer button {
    padding: 5px 12px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    border-radius: 8px;
    transition: 0.2s;
}

.searchContainer button[name="searchButton"] {
    background: #007bff;
    color: white;
}

.searchContainer button[name="clearButton"] {
    background: #999;
    color: white;
}

.searchContainer button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}
</style>
</head>
<body>
<h1>Search User Accounts</h1>

<form method="post" class="searchContainer">
    <label for="searchBy">Search by:</label>
    <select name="searchBy" id="searchBy">
        <option value="name" <?php if($searchBy=='name') echo 'selected'; ?>>Name</option>
        <option value="id" <?php if($searchBy=='id') echo 'selected'; ?>>ID</option>
        <option value="phone" <?php if($searchBy=='phone') echo 'selected'; ?>>Phone Number</option>
        <option value="address" <?php if($searchBy=='address') echo 'selected'; ?>>Address</option>
        <option value="status" <?php if($searchBy=='status') echo 'selected'; ?>>Status</option>
    </select>

    <input type="text" name="searchInput" placeholder="Enter search term..." 
           value="<?php echo htmlspecialchars($searchInput); ?>">

    <button type="submit" name="searchButton">Search</button>
    <button type="submit" name="clearButton">Clear</button>
</form>

<!-- Include the shared account list -->
<?php include __DIR__ . '/UserAccountList.php'; ?>

</body>
</html>
