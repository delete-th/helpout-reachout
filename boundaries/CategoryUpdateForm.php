<?php
// boundaries/CategoryUpdateForm.php.php
session_start();
require_once __DIR__ . '/../controllers/PlatformManagerUpdateCategoryController.php';

$cID = isset($_GET['cID']) ? intval($_GET['cID']) : 0;
$controller = new PlatformManagerUpdateCategoryController();
$category = $controller->GetCategoryByCID($cID);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 8px 16px;
            margin-right: 10px;
            cursor: pointer;
        }

        p {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <h1>Update Category</h1>

    <?php if ($category): ?>
        <form method="post" action="CategoryUpdateForm.php?cID=<?php echo $cID; ?>">
            <label>Category Name:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($category['category']); ?>" required>

            <button type="submit" name="updateCategory">Update Category</button>
            <button type="button" onclick="window.location.href='../index.php?action=4_PlatformManager_Menu'">Back</button>
        </form>
    <?php else: ?>
        <p>Category not found.</p>
        <button type="button" onclick="window.location.href='../index.php?action=4_PlatformManager_Menu'">Back</button>
    <?php endif; ?>

    <?php
    // Handle form submission
    if (isset($_POST['updateCategory'])) {
        $category = trim($_POST['category']);
        $updateResult = $controller->UpdateCategory($cID, $category);

		if ($updateResult) {
			$_SESSION['flash_msg'] = "Category updated successfully!";
		} else {
			$_SESSION['flash_msg'] = "Failed to update category.";
		}
		header("Location: ../index.php?action=4_PlatformManager_Menu");
		exit;
    }
    ?>
</body>
</html>
