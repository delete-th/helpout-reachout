<?php
// boundaries/PlatformManagerCategoryList.php
require_once __DIR__ . '/../controllers/PlatformManagerViewCategoryController.php';



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
function goToViewCategory(id) {
	window.location.href = 'boundaries/ViewCategory.php?cID=' + id;
}

function goToUpdateCategoryForm(id) {
	window.location.href = 'boundaries/CategoryUpdateForm.php?cID=' + id;
}

function goToDeleteCategoryPopup(id) {
	window.location.href = 'boundaries/DeleteCategoryConfirmationPopup.php?cID=' + id;
}

</script>
</head>

<body>




<table>
	<thead>
		<tr>
			<th>Category ID</th>
			<th>Category Name</th>
			<th class="action-col">Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($categories)): ?>
			<?php foreach ($categories as $cat): ?>
				<tr>
					<td><?= htmlspecialchars($cat['cID']) ?></td>
					<td><?= htmlspecialchars($cat['category']) ?></td>
					<td>
						<button class="activity-button" onclick="goToViewCategory(<?= $cat['cID'] ?>)">
							<img src="boundaries/viewIcon.png" alt="View">
						</button>
						<button class="activity-button" onclick="goToUpdateCategoryForm(<?= $cat['cID'] ?>)">
							<img src="boundaries/updateIcon.png" alt="Update">
						</button>
						<button class="activity-button" onclick="goToDeleteCategoryPopup(<?= $cat['cID'] ?>)">
							<img src="boundaries/suspendIcon.png" alt="Delete">
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr><td colspan="3" style="text-align:center;">No categories found.</td></tr>
		<?php endif; ?>
	</tbody>
</table>
</body>
</html>
