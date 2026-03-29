<?php
// boundaries/PlatformManagerSearchCategories.php
require_once __DIR__ . '/../controllers/PlatformManagerSearchCategoriesController.php';
require_once __DIR__ . '/../controllers/PlatformManagerViewCategoryController.php';

$PlatformManagerSearchCategoriesController = new PlatformManagerSearchCategoriesController();
$PlatformManagerViewCategoryController = new PlatformManagerViewCategoryController();

$searchBy = $_POST['searchBy'] ?? 'category';
$searchInput = $_POST['searchInput'] ?? '';

$categories = [];

if (isset($_POST['clearButton'])) {
    $categories = $PlatformManagerViewCategoryController->GetAllCategories();
    $searchInput = '';
} 
elseif (isset($_POST['searchButton']) && !empty(trim($searchInput))) {
    $categories = $PlatformManagerSearchCategoriesController->SearchCategories($searchBy, $searchInput);
} 
else {
    $categories = $PlatformManagerViewCategoryController->GetAllCategories();
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
<h2>Search Categories</h2>

<form method="post" class="searchContainer">
    <label for="searchBy">Search by:</label>
    <select name="searchBy" id="searchBy">
        <option value="cID" <?php if($searchBy=='cID') echo 'selected'; ?>>Category ID</option>
        <option value="category" <?php if($searchBy=='category') echo 'selected'; ?>>Category Name</option>
    </select>

    <input type="text" name="searchInput" placeholder="Enter search term..." 
           value="<?php echo htmlspecialchars($searchInput); ?>">

    <button type="submit" name="searchButton">Search</button>
    <button type="submit" name="clearButton">Clear</button>
</form>

<!-- Include the category list -->
<?php include __DIR__ . '/PlatformManagerCategoryList.php'; ?>

</body>
</html>
