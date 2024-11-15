<?php
require_once 'dbcon.php';

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $image_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
        $item_id = $_POST['item_id'];
        $item_name = $_POST['item_name'];
        $brand = $_POST['brand'];
        $price = $_POST['price']; 
        $category = $_POST['category']; 
        $subcategory = $_POST['subcategory']; 
        $stocks = $_POST['stocks']; 
        $supplier = $_POST['supplier']; 
        $arrival_date = $_POST['arrival_date']; 
        $warranty = $_POST['warranty']; 
        $description = $_POST['description']; 

        $sql = "UPDATE items SET item_name = '$item_name', brand = '$brand', images= '$image_name', price = '$price',category = '$category'
        ,sub_category = '$subcategory', stocks = '$stocks', supplier = '$supplier', arrival_date = '$arrival_date'
        ,warranty = '$warranty', description = '$description' WHERE item_id = '$item_id' ";
        if ($conn->query($sql) === TRUE) {
        header('Location: ../index.php');
        } else {
        echo "Error updating record: " . $conn->error;
        }
}else{
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $brand = $_POST['brand'];
    $price = $_POST['price']; 
    $category = $_POST['category']; 
    $subcategory = $_POST['subcategory']; 
    $stocks = $_POST['stocks']; 
    $supplier = $_POST['supplier']; 
    $arrival_date = $_POST['arrival_date']; 
    $warranty = $_POST['warranty']; 
    $description = $_POST['description']; 

    $sql = "UPDATE items SET item_name = '$item_name', brand = '$brand', price = '$price',category = '$category'
    ,sub_category = '$subcategory', stocks = '$stocks', supplier = '$supplier', arrival_date = '$arrival_date'
    ,warranty = '$warranty', description = '$description' WHERE item_id = '$item_id' ";
    if ($conn->query($sql) === TRUE) {
    header('Location: ../index.php');
    } else {
    echo "Error updating record: " . $conn->error;
    }
}
$conn->close();
?>
