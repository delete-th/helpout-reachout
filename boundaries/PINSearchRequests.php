
<?php
	// boundaries/PINSearchRequests.php
	require_once __DIR__ . '/../controllers/PINSearchRequestsController.php';


	$controller = new PINSearchRequestsController();

	$pinID = $_SESSION['userID'];
	$autoSubmit = false;

	$searchBy = $_POST['searchBy'] ?? 'category';
	$searchInput = $_POST['searchInput'] ?? '';
	$requests = [];
	

	// If "Clear Search" clicked → show all profiles again
	if (isset($_POST['clearButton'])) {
		$requests = $controller->GetAllRequests($pinID);
		$searchInput = '';
	} 
	
	// If search submitted
	elseif (isset($_POST['searchButton']) && !empty(trim($searchInput))) {
		$requests = $controller->SearchRequestsForPIN($pinID, $searchBy, $searchInput);
	} 
	
	// Default → show all
	else {
		$requests = $controller->GetAllRequests($pinID);
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Search Requests</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: url('boundaries/background1.png') no-repeat center center/cover;
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
<h1>Search Requests</h1>

<form method="post" class="searchContainer">
    <label for="searchBy">Search by:</label>
    <select name="searchBy" id="searchBy">
		<option value="rID" <?php if($searchBy=='rID') echo 'selected'; ?>>Request ID</option>
        <option value="category" <?php if($searchBy=='category') echo 'selected'; ?>>Category</option>
        <option value="description" <?php if($searchBy=='description') echo 'selected'; ?>>Description</option>
		<option value="date" <?php if($searchBy=='date') echo 'selected'; ?>>Date</option>
		<option value="location" <?php if($searchBy=='location') echo 'selected'; ?>>Location</option>
    </select>

    <input type="text" name="searchInput" placeholder="Enter search term..." 
           value="<?php echo htmlspecialchars($searchInput); ?>">

    <button type="submit" name="searchButton">Search</button>
    <button type="submit" name="clearButton">Clear</button>
</form>

<!-- Include the shared profile list -->
<?php include __DIR__ . '/PINRequestList.php'; ?>

</body>
</html>