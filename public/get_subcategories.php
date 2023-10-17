<?php
// Connect to your database (update with your database connection details)
$db = new PDO('mysql:host=localhost;dbname=laraveldemo', 'root', '');

// Get the selected category from the AJAX request
$category_id = $_GET['category_id'];

// Query the database to fetch subcategories for the selected category
$query = $db->prepare("SELECT id, subcategory_name FROM sub_categories WHERE category_id = :category_id");
$query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
$query->execute();
$subcategories = $query->fetchAll(PDO::FETCH_ASSOC);

// Return the subcategories as JSON
header('Content-Type: application/json');
echo json_encode($subcategories);
?>