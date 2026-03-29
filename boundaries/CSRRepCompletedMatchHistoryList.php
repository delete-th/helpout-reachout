<?php
// boundaries/CSRRepCompletedMatchHistoryList.php
require_once __DIR__ . '/../controllers/CSRRepViewCompletedHistoryMatchController.php';

$csrID = $_SESSION['userID'] ?? 0;

// Get all completed matches for this CSR
$volunteerMatchController = new CSRRepViewCompletedHistoryMatchController();

// --- FILTERS ---
$priorityFilter = $_POST['priorityFilter'] ?? 'all';
$categoryFilter = $_POST['categoryFilter'] ?? 'all';

$allCategories = array_unique(array_map(fn($r)=>$r['category'], $matches));

if ($priorityFilter !== 'all' || $categoryFilter !== 'all') {
    $matches = array_filter($matches, function($req) use ($priorityFilter, $categoryFilter) {
        $priorityMatch = ($priorityFilter === 'all' || strcasecmp($req['priority'], $priorityFilter) === 0);
        $categoryMatch = ($categoryFilter === 'all' || strcasecmp($req['category'], $categoryFilter) === 0);
        return $priorityMatch && $categoryMatch;
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

    <label>Category:</label>
    <select name="categoryFilter">
        <option value="all" <?= $categoryFilter=='all'?'selected':'' ?>>All</option>
        <?php foreach ($allCategories as $cat): ?>
            <option value="<?= htmlspecialchars($cat) ?>" <?= $categoryFilter==$cat?'selected':'' ?>>
                <?= htmlspecialchars($cat) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Apply Filters</button>
</form>

<table>
<thead>
<tr>
    <th>Match ID</th>
    <th>Request ID</th>
    <th>PIN ID</th>
    <th>PIN Name</th>
    <th>Description</th>
    <th>Category</th>
    <th>Date Booked</th>
    <th>Date Requested</th>
    <th>Location</th>
    <th>Priority</th>
    <th>Actions</th>
</tr>
</thead>
<tbody>
<?php if (!empty($matches)): ?>
    <?php foreach ($matches as $req): ?>
    <tr>
        <td><?= htmlspecialchars($req['mID']) ?></td>
        <td><?= htmlspecialchars($req['rID']) ?></td>
        <td><?= htmlspecialchars($req['pinID']) ?></td>
        <td><?= htmlspecialchars($req['pinName']) ?></td>
        <td><?= htmlspecialchars($req['description']) ?></td>
        <td><?= htmlspecialchars($req['category']) ?></td>
        <td><?= htmlspecialchars($req['dateBooked']) ?></td>
        <td><?= htmlspecialchars($req['date']) ?></td>
        <td><?= htmlspecialchars($req['location']) ?></td>
        <td><?= htmlspecialchars($req['priority']) ?></td>
        <td>
            <button class="activity-button" onclick="viewCompletedMatch(<?= $req['mID'] ?>)">
                <img src="boundaries/viewIcon.png" alt="View">
            </button>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="11" style="text-align:center;">No completed matches found.</td></tr>
<?php endif; ?>
</tbody>
</table>

<script>
function viewCompletedMatch(id) {
    window.location.href = 'boundaries/CSRRepViewCompletedMatch.php?mID=' + id;
}
</script>
</body>
</html>
