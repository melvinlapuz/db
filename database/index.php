<?php
SESSION_START();
include 'config/plugin.php';
require_once 'config/dbcon.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-tools"></i> Handy Money</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Static Menu Items -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Home</a>
                    </li>

                    <!-- Dynamic Menu Items (PHP) -->
                    <?php
                    // Check if the user is logged in
                    if(isset($_SESSION['username'])) {
                        // If logged in, show user-specific links

                        echo '<li class="nav-item">
                                <a class="nav-link" href="admin/admin.php">Back</a>
                                </li>';
                    }
                    ?>

                    <!-- Dynamic Links Based on User Role -->
                    <?php
                    // Example: If the user is an admin
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="admin.php">Admin Dashboard</a>
                              </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Images Table -->
    <div class="card">
        <div class="card-header">Uploaded Data</div>
        <div class="card-body  overflow-auto">
                <h2 class="mt-3" style="display: inline-block;">Items Data:</h2>
                <?php
                if (isset($_SESSION['Itemexisted'])){
                    echo '<div style="color: red;"> <p>'.$_SESSION["Itemexisted"].'</div>';
                    unset($_SESSION['Itemexisted']);
                }else if (isset($_SESSION['sign_up'])){
                    echo '<div style="color: green;"> <p>'.$_SESSION["sign_up"].'</div>';
                    unset($_SESSION['sign_up']);
                }
                
                ?>
                <div style="display: inline-block; margin-left:700px;" class="mb-1">
                <form action=""method="GET">
                <input type="text" class="form-control w-50" style="display: inline-block;" placeholder="Search" name="search" id="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>">
                <button type="submit" class="btn btn-primary" style="display: inline-block;">Search</button>
                </form>
                </div>
                <a href="#myModal" data-bs-toggle="modal"  class="btn btn-primary mt-4" style="float: right; display: inline-block;">Upload Data</a>
            <table class="table table-bordered mt-1 table-hover">
                <thead class="table-info">

                    <tr>
                        <th>Images</th>
                        <th>Item_id</th>
                        <th>Item_name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Sales</th>
                        <th>Stocks</th>
                        <th>Supplier</th>
                        <th>Arrival_date</th>
                        <th>Warranty</th>
                        <th>Description</th>
                        <th>Config</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
if(isset($_GET['search'])){
$filterValues = $_GET['search'];
$sql = "SELECT * FROM items Where CONCAT(item_id, item_name, brand, images, price, category, sub_category, sales, stocks, supplier, arrival_date, warranty, description) LIKE '%$filterValues%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $counter = $row['item_id'] + 1;
?>                  
                <form action="config/updateData.php" method="POST" enctype="multipart/form-data">
                  <tr>
                  <input type="hidden" name="item_id" value="<?=$row["item_id"]?>">

                    <td><img src="images/<?=$row['images']?>" height="60px" width="100px"><input class="form-control" type="file" id="fileToUpload" name="fileToUpload" >
                    </td>
                    <td><?=$row["item_id"]?></td> 
                    <td><input type="text" name="item_name"  class="form-control" value="<?=$row["item_name"]?>"></td>
                    <td><input type="text" name="brand"  class="form-control" value="<?=$row["brand"]?>"></td>
                    <td><input type="text" name="price"  class="form-control" value="<?=$row["price"]?>"></td>
                    <td><input type="text" name="category"  class="form-control" value="<?=$row["category"]?>"></td>
                    <td><input type="text" name="subcategory"  class="form-control" value="<?=$row["sub_category"]?>"></td>
                    <td><?=$row["sales"]?></td>
                    <td><input type="text" name="stocks"  class="form-control" value="<?=$row["stocks"]?>"></td>
                    <td><input type="text" name="supplier"  class="form-control" value="<?=$row["supplier"]?>"></td>
                    <td><input type="text" name="arrival_date"  class="form-control" value="<?=$row["arrival_date"]?>"></td>
                    <td><input type="text" name="warranty"  class="form-control" value="<?=$row["warranty"]?>"></td>
                    <td class="overflow-auto"><input name="description"  type="text" class="form-control" value="<?=$row["description"]?>"></td>
                    <td><button class="btn btn-warning mb-2 " style="display: inline-block;"><i class="bi bi-pencil-square"></i></button></td>
                    <td> <button style="display: inline-block;" type="submit" class="btn btn-danger " formaction="config/deleteData.php"><i class="bi bi-trash3-fill"></i></button></td>   
                    </form>
                  </tr>
<?php
                }
} else {
  echo "0 results";
}
}else{
    $sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $counter = $row['item_id'] + 1;
?>                  
                <form action="config/updateData.php" method="POST" enctype="multipart/form-data">
                  <tr>
                  <input type="hidden" name="item_id" value="<?=$row["item_id"]?>">

                    <td><img src="images/<?=$row['images']?>" height="60px" width="100px"><input class="form-control w-100" type="file" id="fileToUpload" name="fileToUpload" ></td>
                    <td><?=$row["item_id"]?></td> 
                    <td><input type="text" name="item_name"  class="form-control" value="<?=$row["item_name"]?>"></td>
                    <td><input type="text" name="brand"  class="form-control" value="<?=$row["brand"]?>"></td>
                    <td><input type="text" name="price"  class="form-control" value="<?=$row["price"]?>"></td>
                    <td><input type="text" name="category"  class="form-control" value="<?=$row["category"]?>"></td>
                    <td><input type="text" name="subcategory"  class="form-control" value="<?=$row["sub_category"]?>"></td>
                    <td><?=$row["sales"]?></td>
                    <td><input type="text" name="stocks"  class="form-control" value="<?=$row["stocks"]?>"></td>
                    <td><input type="text" name="supplier"  class="form-control" value="<?=$row["supplier"]?>"></td>
                    <td><input type="text" name="arrival_date"  class="form-control" value="<?=$row["arrival_date"]?>"></td>
                    <td><input type="text" name="warranty"  class="form-control" value="<?=$row["warranty"]?>"></td>
                    <td class="overflow-auto"><input name="description"  type="text" class="form-control" value="<?=$row["description"]?>"></td>
                    <td><button class="btn btn-warning mb-2 " style="display: inline-block;"><i class="bi bi-pencil-square"></i></button></td>
                    <td> <button style="display: inline-block;" type="submit" class="btn btn-danger " formaction="config/deleteData.php"><i class="bi bi-trash3-fill"></i></button></td>   
                    </form>
                  </tr>
<?php
                }
} else {
  echo "0 results";
}
}

mysqli_close($conn);
?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-file-earmark-arrow-up"></i> Upload Data</h5>
      </div>
      <div class="modal-body">
        <form action="config/insertData.php" method="POST" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Item Name:</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Enter item name" name="item_name" required>
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Brand:</label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Enter brand" name="brand" required> 
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label">Price:</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="₱(how much?)" name="price" required>
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Category:</label>
            <select id="inputState" class="form-select" name="category" required>
            <option selected>Choose...</option>
            <option>Tools</option>
            <option>Furniture</option>
            <option>Paint</option>
            <option>others</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="inputState" class="form-label">Subcategory:</label>
            <select id="inputState" class="form-select" name="subcategory" required>
            <option selected>Choose...</option>
            <option>Construction</option>
            <option>Living room</option>
            <option>kitchen</option>
            <option>Materials</option>
            <option>Bedroom</option>
            <option>colors</option>
            <option>others</option>
            </select>
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label">Stocks:</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Enter Stocks" name="stocks" required>
        </div>
        <div class="col-md-4">
            <label for="inputEmail4" class="form-label">Supplier:</label>
            <input type="text" class="form-control" id="inputEmail4" placeholder="Enter Supplier" name="supplier" required>
        </div>
        <div class="col-md-4">
            <label for="inputPassword4" class="form-label">Arrival Date:</label>
            <input type="Date" class="form-control" id="inputPassword4" name="arrival_date" required> 
        </div>
        <div class="col-4">
            <label for="inputAddress" class="form-label">Warranty:</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="Enter Warranty" name="warranty" required>
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Description:</label>
            <textarea type="text" class="form-control" id="inputAddress2" placeholder="Enter Description" name="description" required></textarea>
        </div>
        <div class="col-12">
            <label for="formFileMultiple" class="form-label">Item Image:</label>
            <input class="form-control" type="file" id="fileToUpload" name="fileToUpload" required>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>