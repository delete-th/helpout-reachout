<?php
// boundaries/CSRRepSearchCompletedMatchesHistory.php
require_once __DIR__ . '/../controllers/CSRRepSearchCompletedMatchesHistoryController.php';
require_once __DIR__ . '/../controllers/CSRRepViewCompletedHistoryMatchController.php';


// Instantiate controllers
$CSRRepSearchCompletedMatchesHistoryController = new CSRRepSearchCompletedMatchesHistoryController();
$CSRRepViewCompletedHistoryMatchController = new CSRRepViewCompletedHistoryMatchController();

// CSR ID
$csrID = $_SESSION['userID'] ?? 0;

// --- Get all completed matches for this CSR ---
$completedMatchesData = $CSRRepViewCompletedHistoryMatchController->CSRRepGetAllCompletedMatchesByCSRID($csrID);
$completedMatchesMIDs = array_column($completedMatchesData, 'mID');

// --- Determine search criteria ---
$searchBy = $_POST['searchBy'] ?? 'description';
$searchInput = $_POST['searchInput'] ?? '';

// Default: all completed matches
$matches = [];
foreach ($completedMatchesMIDs as $mID) {
    $req = $CSRRepViewCompletedHistoryMatchController->CSRRepGetCompletedMatchByMID($mID, $csrID);
    if ($req) $matches[] = $req;
}

// If Search is clicked and input is not empty
if (isset($_POST['searchButton']) && !empty(trim($searchInput))) {
    $matches = $CSRRepSearchCompletedMatchesHistoryController->CSRRepSearchHistoryMatches($csrID, $searchBy, $searchInput);
}


// If Clear is clicked, reset search input
if (isset($_POST['clearButton'])) {
    $searchInput = '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
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

<h2>Search Completed Matches</h2>

<form method="post" class="searchContainer">
    <label for="searchBy">Search by:</label>
    <select name="searchBy" id="searchBy">
        <option value="mID" <?= ($searchBy=='mID')?'selected':'' ?>>Match ID</option>
        <option value="rID" <?= ($searchBy=='rID')?'selected':'' ?>>Request ID</option>
        <option value="pinID" <?= ($searchBy=='pinID')?'selected':'' ?>>PIN ID</option>
        <option value="pinName" <?= ($searchBy=='pinName')?'selected':'' ?>>PIN Name</option>
        <option value="description" <?= ($searchBy=='description')?'selected':'' ?>>Description</option>
        <option value="dateBooked" <?= ($searchBy=='dateBooked')?'selected':'' ?>>Date Booked</option>
        <option value="date" <?= ($searchBy=='date')?'selected':'' ?>>Request Date</option>
        <option value="location" <?= ($searchBy=='location')?'selected':'' ?>>Location</option>
    </select>

    <input type="text" name="searchInput" placeholder="Enter search term..." 
           value="<?= htmlspecialchars($searchInput) ?>">

    <button type="submit" name="searchButton">Search</button>
    <button type="submit" name="clearButton">Clear</button>
</form>


<!-- Include the main completed matches list -->
<?php 
include __DIR__ . '/CSRRepCompletedMatchHistoryList.php'; 
?>

</body>
</html>
