<?php
	// boundaries/PINMatchHistoryList.php
	require_once __DIR__ . '/../controllers/PINViewMatchHistoryController.php';
	//require_once __DIR__ . '/../controllers/ViewCategoryController.php';

	$controller = new PINViewMatchHistoryController();
	//$categoryController = new ViewCategoryController();

	if (session_status() === PHP_SESSION_NONE) {
		session_start();
	}
	$pinID = $_SESSION['userID'];

	// fetch all matches of a particular PIN
	if (!isset($matches)) {
		$matches = $controller->GetPINMatchHistory($pinID); 
	}
	

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <style>
/* Filter buttons */
.filter-buttons {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.filter-buttons button {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    color: #fff;
    transition: all 0.2s ease;
}

.filter-buttons button[name="filter"][value="all"] { background-color: #007bff; }
.filter-buttons button[name="filter"][value="active"] { background-color: #28a745; }
.filter-buttons button[name="filter"][value="suspended"] { background-color: #dc3545; }

.filter-buttons button:hover {
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
	
        function viewMatch(rid) {
			window.location.href = 'boundaries/PINViewCompletedMatchHistory.php?rID=' + rid;
        }
       
    </script>
</head>
<body>
	
	<!-- Filter Buttons -->
    <form method="post" class="filter-buttons">
		<!--<button type="submit" name="filter" value="all" <?php //if($filter=='all') echo 'style="opacity:0.7"'; ?>>All</button>
        <button type="submit" name="filter" value="completed" <?php if($filter=='completed') echo 'style="opacity:0.7"'; ?>>Completed</button>-->
        <!--<button type="submit" name="filter" value="incomplete" <?php //if($filter=='incomplete') echo 'style="opacity:0.7"'; ?>>Incomplete</button>-->
	

        <!-- Retain search state if SearchRequests form submitted -->
        <?php if (!empty($_POST['searchBy'])): ?>
            <input type="hidden" name="searchBy" value="<?php echo htmlspecialchars($_POST['searchBy']); ?>">
        <?php endif; ?>
        <?php if (!empty($_POST['searchInput'])): ?>
            <input type="hidden" name="searchInput" value="<?php echo htmlspecialchars($_POST['searchInput']); ?>">
        <?php endif; ?>
        <?php if (isset($_POST['searchButton'])): ?>
            <input type="hidden" name="searchButton" value="1">
        <?php endif; ?>
    </form>
	
    <table>
        <thead>
            <tr>
				<th>Match ID</th>
				<th>Request ID</th>				
				<th>CSR Rep ID</th>
				<th>CSR Rep Name</th>
                <th>Description</th>
				<th>Category</th>
				<th>Date Booked</th>
                <th>Date Requested</th>
				<th>Location</th>
				<th>Priority</th>
				<th>Views</th>
				<th>Saved</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($matches)) : ?>
                <?php foreach ($matches as $match) :
				   //$category = $categoryController->getCategoryByID($request['category']);
                ?>
                    <tr>
						<td><?php echo htmlspecialchars($match['matchID']); ?></td>
						<td><?php echo htmlspecialchars($match['rID']); ?></td>	
						<td><?php echo htmlspecialchars($match['csrID']); ?></td>						
						<td><?php echo htmlspecialchars($match['csrName']); ?></td>
                        <td class="description-cell"><?php echo htmlspecialchars($match['description']); ?></td>
                        <td><?php echo htmlspecialchars($match['category']); ?></td>
						<td><?php echo htmlspecialchars($match['dateBooked']); ?></td>                        
                        <td class="date-cell"><?php echo htmlspecialchars($match['date']); ?></td>
						<td><?php echo htmlspecialchars($match['location']); ?></td>
						<td><?php echo htmlspecialchars($match['priority']); ?></td>
						<td><?php echo htmlspecialchars($match['viewCount']); ?></td>
						<td><?php echo htmlspecialchars($match['savedCount']); ?></td>
                        <td class="activities-cell">
                            <button class="activity-button" onclick="viewMatch(<?php echo $match['rID']; ?>)">
                                <img src="boundaries/viewIcon.png" alt="View">
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5">No Matches found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<!--<td><?php //echo htmlspecialchars($match['rID']); ?></td>-->