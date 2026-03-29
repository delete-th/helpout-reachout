<?php
// boundaries/CategoryCreateForm.php
session_start();
require_once __DIR__ . '/../controllers/PlatformManagerCreateCategoryController.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $category = trim($_POST['category']);

        $controller = new PlatformManagerCreateCategoryController();
        $result = $controller->CreateCategory($category);

    if ($result) {
        $_SESSION['flash_msg'] = "Category created successfully!";
    } else {
        $_SESSION['flash_msg'] = "Failed to create category.";
    }
    header("Location: ../index.php?action=4_PlatformManager_Menu");
    exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        form {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ccc;
            padding: 25px;
            border-radius: 8px;
            background: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        .button-group {
            margin-top: 20px;
            text-align: center;
        }

        button {
            padding: 8px 16px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: white;
        }

        button[type="button"] {
            background-color: #6c757d;
            color: white;
        }

        button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <form method="post" action="">
        <h2>Create Category</h2>

        <label for="category">Category Name:</label>
        <input type="text" id="category" name="category" required>

        <div class="button-group">
            <button type="submit" name="submit">Submit</button>
            <button type="button" onclick="window.history.back()">Back</button>
        </div>
    </form>
</body>
</html>
