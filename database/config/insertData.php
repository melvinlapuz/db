<?php
SESSION_START();
require_once 'dbcon.php';

$item_name = $_POST['item_name'];
$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

    if ($row['item_name'] == $item_name){
        Header('Location: ../index.php');
        $_SESSION['Itemexisted'] = 'Item is already exited please try again';
    }else{
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $image_name = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
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
            
            $sql = "INSERT INTO items (item_name, brand, images, price, category, sub_category, stocks, supplier, arrival_date, warranty, description)
            VALUES ('$item_name','$brand', '$image_name', '₱$price', '$category', '$subcategory', '$stocks', '$supplier', '$arrival_date', '$warranty', '$description')";
            
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['sign_up'] = "Sign-up successfully";
                    Header('Location: ../index.php');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }
    }
  }
} else {
  echo "0 results";
}
$conn->close();
?>

