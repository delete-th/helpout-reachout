<?php
require_once __DIR__ . '/../controllers/PlatformManagerViewCategoryController.php';

$cID = isset($_GET['cID']) ? intval($_GET['cID']) : 0;
$controller = new PlatformManagerViewCategoryController();
$category = $controller->GetCategoryByCID($cID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Category</title>
<style>
body { font-family: Arial, sans-serif; margin: 40px; }
.container { max-width: 500px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; border: 1px solid #ccc; }
h2 { text-align: center; margin-bottom: 20px; }
label { font-weight: bold; }
p { margin-bottom: 15px; }
button { padding: 8px 16px; border: none; border-radius: 5px; cursor: pointer; background: #6c757d; color: white; }
button:hover { opacity: 0.9; }
</style>
</head>
<body>
<div class="container">
    <h2>View Category</h2>

    <?php if ($category): ?>
        <label>Category ID:</label>
        <p><?= htmlspecialchars($category['cID']) ?></p>

        <label>Category Name:</label>
        <p><?= htmlspecialchars($category['category']) ?></p>
    <?php else: ?>
        <p>Category not found.</p>
    <?php endif; ?>

    <button onclick="window.location.href='../index.php?action=4_PlatformManager_Menu'">Back</button>
</div>
</body>
</html>
