<?php
// boundaries/UserAccountList.php
require_once __DIR__ . '/../controllers/ViewUserAccountController.php';
require_once __DIR__ . '/../controllers/ViewUserProfileController.php';
require_once __DIR__ . '/../controllers/SuspendUserAccountController.php';

$ViewUserAccountController = new ViewUserAccountController();
$ViewUserProfileController = new ViewUserProfileController();

// Use accounts from parent if available, otherwise fetch all
if (!isset($accounts)) {
    $accounts = $ViewUserAccountController->getUserAccounts();
}

// Handle filtering
$filter = $_POST['filter'] ?? 'all';
if ($filter !== 'all') {
    $accounts = array_filter($accounts, function($acc) use ($filter) {
        return strtolower($acc['status']) === strtolower($filter);
    });
}
?>

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
        function goToAccountUpdate(id) {
            window.location.href = 'boundaries/UserAccountUpdateForm.php?aID=' + id;
        }
        function viewUserAccount(id) {
            window.location.href = 'boundaries/ViewUserAccount.php?aID=' + id;
        }
        function suspendUserAccount(id) {
            window.location.href = 'boundaries/SuspendUserAccountConfirmationPopup.php?aID=' + id;
        }
    </script>
</head>
<body>

    <!-- Filter Buttons -->
    <form method="post" class="filter-buttons">
        <button type="submit" name="filter" value="all" <?php if($filter=='all') echo 'style="opacity:0.7"'; ?>>All</button>
        <button type="submit" name="filter" value="active" <?php if($filter=='active') echo 'style="opacity:0.7"'; ?>>Active</button>
        <button type="submit" name="filter" value="suspended" <?php if($filter=='suspended') echo 'style="opacity:0.7"'; ?>>Suspended</button>

        <!-- Retain search state if SearchAccounts form submitted -->
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
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>DOB</th>
                <th>User Profile</th>
                <th>Status</th>
                <th>Activities</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($accounts)) : ?>
                <?php foreach ($accounts as $acc): 
					$profile = $ViewUserProfileController->GetUserProfileByID($acc['userProfile']);?>
                    <tr>
                        <td><?php echo htmlspecialchars($acc['aID']); ?></td>
                        <td><?php echo htmlspecialchars($acc['name']); ?></td>
                        <td><?php echo htmlspecialchars($acc['phoneNumber']); ?></td>
                        <td><?php echo htmlspecialchars($acc['address']); ?></td>
                        <td><?php echo htmlspecialchars($acc['dob']); ?></td>
						<!-- To display profile name instead of profile ID. -->
                        <td><?php echo htmlspecialchars($profile['name']);?></td>
                        <td><?php echo htmlspecialchars($acc['status']); ?></td>
                        <td>
                            <button class="activity-button" onclick="viewUserAccount(<?php echo $acc['aID']; ?>)">
                                <img src="boundaries/viewIcon.png" alt="View">
                            </button>
                            <button class="activity-button" onclick="goToAccountUpdate(<?php echo $acc['aID']; ?>)">
                                <img src="boundaries/updateIcon.png" alt="Update">
                            </button>
                            <button class="activity-button"
                                    onclick="suspendUserAccount(<?php echo $acc['aID']; ?>)">
                                <img src="boundaries/suspendIcon.png" alt="Suspend">
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="8">No accounts found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

