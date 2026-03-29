<?php
// boundaries/CSRRepRequestList.php
require_once __DIR__ . '/../controllers/CSRRepViewRequestController.php';
require_once __DIR__ . '/../controllers/CSRRepViewShortlistedRequestController.php';
require_once __DIR__ . '/../controllers/CSRRepShortlistRequestController.php';
require_once __DIR__ . '/../controllers/CSRRepUnshortlistRequestController.php';


$csrID = $_SESSION['userID'] ?? 0;

// Handle shortlist/unshortlist actions (AJAX simulation done server-side)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['rID'])) {
    $rID = intval($_POST['rID']);
    $action = $_POST['action'];

    if ($action === 'shortlist') {
        $ctrl = new CSRRepShortlistRequestController();
        $ctrl->ShortlistRequest($rID, $csrID);
    } elseif ($action === 'unshortlist') {
        $ctrl = new CSRRepUnshortlistRequestController();
        $ctrl->UnshortlistRequest($rID, $csrID);
    }
    exit; // Stop further page rendering if it's AJAX
}

// Use parent array when not in search context
if (!isset($requests)) {
    $requestController = new CSRRepViewRequestController();
    $requests = $requestController->GetAllRequests();
}

// Controller for shortlisted requests
$shortlistController = new CSRRepViewShortlistedRequestController();
$shortlistedRequests = $shortlistController->GetShortlistedRequestsByCSR($csrID);
$shortlistedRIDs = array_column($shortlistedRequests, 'rID');

// --- FILTERS ---
$priorityFilter = $_POST['priorityFilter'] ?? 'all';
$statusFilter   = $_POST['statusFilter'] ?? 'all';
$categoryFilter = $_POST['categoryFilter'] ?? 'all';
$allCategories = array_unique(array_map(fn($r)=>$r['category'], $requests));

if ($priorityFilter !== 'all' || $statusFilter !== 'all' || $categoryFilter !== 'all') { 
    $requests = array_filter($requests, function($req) use ($priorityFilter, $statusFilter, $categoryFilter) {
        $priorityMatch = ($priorityFilter === 'all' || strcasecmp(trim($req['priority']), $priorityFilter) === 0);
        $statusMatch   = ($statusFilter === 'all'   || strcasecmp(trim($req['status']), $statusFilter) === 0);
        $categoryMatch = ($categoryFilter === 'all' || strcasecmp(trim($req['category']), $categoryFilter) === 0);
        return $priorityMatch && $statusMatch && $categoryMatch;
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
/* Filter bar container */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap; /* wrap on smaller screens */
    font-family: Arial, sans-serif;
}

/* Labels */
.filter-bar label {
    font-weight: 200;
    margin-right: 4px;
    color: #222;
}

/* Select dropdowns */
.filter-bar select {
    padding: 6px 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
    cursor: pointer;
}

/* Hover and focus effect for select */
.filter-bar select:hover,
.filter-bar select:focus {
    outline: none;
    box-shadow: 0 0 6px rgba(0,0,0,0.2);
    transform: translateY(-1px);
}

/* Apply button */
.filter-bar button {
    padding: 6px 16px;
    font-size: 14px;
    border: none;
    border-radius: 6px;
    background-color: #007bff;
    color: white;
    font-weight: 400;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* Hover effect for button */
.filter-bar button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}


/* Table styling */
table {
    width: 100%;
    border-collapse: separate;  /* gives nicer spacing */
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;           /* for rounded corners */
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    background: #ffffff;
}

th, td {
    padding: 12px 16px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
}

th {
    background: #f7f7f7;
    font-weight: 700;
    color: #333;
}

tr:nth-child(even) { background-color: #fafafa; }
tr:hover { background-color: #f1f8ff; }

/* Activity buttons */
.activity-button {
    background: none;
    border: none;
    cursor: pointer;
    margin-right: 6px;
    padding: 0;
    width: 32px;
    height: 32px;
}

.activity-button img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.2s, filter 0.2s;
}

.activity-button:hover img {
    filter: brightness(85%);
    transform: scale(1.1);
}

.activity-button.disabled {
    cursor: not-allowed;
    opacity: 0.5;
}
</style>

<script>
function viewRequest(id) {
    window.location.href = 'boundaries/CSRRepViewRequest.php?rID=' + id;
}

function toggleShortlist(button, csrID, rID) {
    const isSelected = button.classList.contains('selected');
    const newAction = isSelected ? 'unshortlist' : 'shortlist';
    const newIcon = isSelected ? 'boundaries/unselectedShortlistIcon.png' : 'boundaries/shortlistIcon.png';

    // Toggle state instantly (optimistic UI)
    button.classList.toggle('selected');
    button.querySelector('img').src = newIcon;

    // Send to same PHP boundary
    fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `action=${newAction}&rID=${rID}`
    })
    .then(res => res.text())
    .then(response => console.log(response))
    .catch(err => {
        console.error(err);
        // revert UI if request failed
        button.classList.toggle('selected');
        button.querySelector('img').src = isSelected
            ? 'boundaries/shortlistIcon.png'
            : 'boundaries/unselectedShortlistIcon.png';
    });
}
</script>
</head>

<body>
<form method="post" class="filter-bar">
    <label>Priority:</label>
    <select name="priorityFilter">
        <option value="all" <?= $priorityFilter=='all'?'selected':'' ?>>All</option>
        <option value="Low" <?= $priorityFilter=='Low'?'selected':'' ?>>Low</option>
        <option value="Medium" <?= $priorityFilter=='Medium'?'selected':'' ?>>Medium</option>
        <option value="High" <?= $priorityFilter=='High'?'selected':'' ?>>High</option>
    </select>
    <label>Status:</label>
    <select name="statusFilter">
        <option value="all" <?= $statusFilter=='all'?'selected':'' ?>>All</option>
        <option value="Pending" <?= $statusFilter=='Pending'?'selected':'' ?>>Pending</option>
        <option value="InProgress" <?= $statusFilter=='InProgress'?'selected':'' ?>>In Progress</option>
    </select>
	
	<label>Category:</label>
	<select name="categoryFilter">
		<option value="all" <?= $categoryFilter=='all'?'selected':'' ?>>All</option>
		<?php
		foreach ($allCategories as $cat) {
			echo "<option value=\"".htmlspecialchars($cat)."\" ".($categoryFilter==$cat?'selected':'').">".htmlspecialchars($cat)."</option>";
		}
		?>
	</select>
    <button type="submit">Apply Filters</button>
</form>

<table>
<thead>
<tr>
    <th>PIN ID</th>
    <th>PIN Name</th>
    <th>Request ID</th>
    <th>Description</th>
    <th>Category</th>
    <th>Date</th>
    <th>Location</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php if (!empty($requests)): ?>
    <?php foreach ($requests as $req): 
        $isSelected = in_array($req['rID'], $shortlistedRIDs);
        $icon = $isSelected 
            ? 'boundaries/shortlistIcon.png' 
            : 'boundaries/unselectedShortlistIcon.png';
    ?>
        <tr>
            <td><?= htmlspecialchars($req['pinID']) ?></td>
            <td><?= htmlspecialchars($req['pinName']) ?></td>
            <td><?= htmlspecialchars($req['rID']) ?></td>
            <td><?= htmlspecialchars($req['description']) ?></td>
            <td><?= htmlspecialchars($req['category']) ?></td>
            <td><?= htmlspecialchars($req['date']) ?></td>
            <td><?= htmlspecialchars($req['location']) ?></td>
            <td><?= htmlspecialchars($req['priority']) ?></td>
            <td><?= htmlspecialchars($req['status']) ?></td>
            <td>
                <button class="activity-button" onclick="viewRequest(<?= $req['rID'] ?>)">
                    <img src="boundaries/viewIcon.png" alt="View">
                </button>
                <button class="activity-button <?= $isSelected?'selected':'' ?>" 
                        onclick="toggleShortlist(this, <?= $csrID ?>, <?= $req['rID'] ?>)">
                    <img src="<?= $icon ?>" alt="Shortlist">
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="10" style="text-align:center;">No requests found.</td></tr>
<?php endif; ?>
</tbody>
</table>
</body>
</html>
