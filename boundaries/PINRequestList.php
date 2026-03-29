
<?php
// boundaries/PINRequestList.php
require_once __DIR__ . '/../controllers/PINViewRequestController.php';


$requestController = new PINViewRequestController();


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pinID = $_SESSION['userID'];

// Use requests from parent if available, otherwise fetch all
if (!isset($requests)) {
    $requests = $requestController->GetAllRequests($pinID); 
}

$currentDate = new DateTime("now"); //today's Date
$activeRequests = [];

foreach ($requests as $request) {
    $effectiveStatus = $request['status'];
    $requestDate = strtotime($request['date']);
    $today = strtotime($currentDate->format("Y-m-d"));

    if ($today < $requestDate) {
        if ($request['savedCount'] > 0) {
            $effectiveStatus = 'InProgress';
            $updated = $requestController->UpdateStatus($request['rID'], $effectiveStatus);
            $request['status'] = $effectiveStatus;
        } else {
            $effectiveStatus = 'Pending';
            $updated = $requestController->UpdateStatus($request['rID'], $effectiveStatus);
            $request['status'] = $effectiveStatus;
        }
    } 
	elseif ($today > $requestDate) {
        if ($request['savedCount'] > 0) {
            $effectiveStatus = 'Completed';
            $updated = $requestController->UpdateStatus($request['rID'], $effectiveStatus);
            $request['status'] = $effectiveStatus;
        } 
		else {
			$effectiveStatus = 'Incomplete';
            $updated = $requestController->UpdateStatus($request['rID'], $effectiveStatus);
            $request['status'] = $effectiveStatus;
		}
	}
	else { // if ($today == $requestDate)
		$effectiveStatus = 'InProgress';
		$updated = $requestController->UpdateStatus($request['rID'], $effectiveStatus);
		$request['status'] = $effectiveStatus;
	}
    

    if ($effectiveStatus === 'Pending' || $effectiveStatus === 'InProgress') {
        $activeRequests[] = $request;
    }
}


// Handle filtering
$filter = $_POST['filter'] ?? 'All';
if ($filter !== 'All') {
    $activeRequests = array_filter($activeRequests, function($request) use ($filter) {
        return strtolower($request['status']) === strtolower($filter);
    });
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

.filter-buttons button[name="filter"][value="All"] { background-color: #007bff; }
.filter-buttons button[name="filter"][value="Pending"] { background-color: #28a745; }
.filter-buttons button[name="filter"][value="InProgress"] { background-color: #dc3545; }


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
	
        function goToRequestUpdate(rid) {
            window.location.href = 'boundaries/PINUpdateRequestForm.php?rID=' + rid;
        } 

        function viewRequest(rid) {
            window.location.href = 'boundaries/PINViewRequest.php?rID=' + rid;
        }
       
		
        function deleteRequest(rid) {
            window.location.href = 'boundaries/PINDeleteRequestConfirmationPopup.php?rID=' + rid;
        } 
    </script>
</head>
<body>
	
	<!-- Filter Buttons -->
    <form method="post" class="filter-buttons">
        <button type="submit" name="filter" value="All" <?php if($filter=='All') ; ?>>All</button>
        <button type="submit" name="filter" value="Pending" <?php if($filter=='Pending') ; ?>>Pending</button>
        <button type="submit" name="filter" value="InProgress" <?php if($filter=='InProgress') ; ?>>In Progress</button>

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
                <th>ID</th>
				<th>Category</th>
                <th>Description</th>
                <th>Date</th>
				<th>Location</th>
				<th>Priority</th>
                <th>Status</th>
				<th>Views</th>
				<th>Saved</th>
                <th>Activities</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($activeRequests)) : ?>
                <?php foreach ($activeRequests as $request) :
				  // $category = $categoryController->getCategoryByID($request['category']);
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($request['rID']); ?></td>
                        <td><?php echo htmlspecialchars($request['category']); ?></td>
                        <td class="description-cell"><?php echo htmlspecialchars($request['description']); ?></td>
                        <td class="date-cell"><?php echo htmlspecialchars($request['date']); ?></td>
						<td><?php echo htmlspecialchars($request['location']); ?></td>
						<td><?php echo htmlspecialchars($request['priority']); ?></td>
						<td><?php echo htmlspecialchars($request['status']); ?></td>
						<td><?php echo htmlspecialchars($request['viewCount']); ?></td>
						<td><?php echo htmlspecialchars($request['savedCount']); ?></td>
                        <td class="activities-cell">
                            <button class="activity-button" onclick="viewRequest(<?php echo $request['rID']; ?>)">
                                <img src="boundaries/viewIcon.png" alt="View">
                            </button>
                            <button class="activity-button" onclick="goToRequestUpdate(<?php echo $request['rID']; ?>)">
                                <img src="boundaries/updateIcon.png" alt="Update">
                            </button>
                            <button class="activity-button" onclick="deleteRequest(<?php echo $request['rID']; ?>)">
                                <img src="boundaries/suspendIcon.png" alt="Delete">
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="5">No requests found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
