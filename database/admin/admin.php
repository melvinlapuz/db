<?php
include '../config/plugin.php';
require_once '../config/dbcon.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top mb-5">
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
                    session_start();
                    if(isset($_SESSION['username'])) {
                        // If logged in, show user-specific links

                        echo '<li class="nav-item">
                                <a class="nav-link" href="../config/logout.php">Logout</a>
                                </li>';
                    }else {
                        // If not logged in, show login/signup links
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#myModal" data-bs-toggle="modal" >Login</a>
                              </li>';
                        echo '<li class="nav-item">
                                <a class="nav-link" href="#myModal2" data-bs-toggle="modal">Sign Up</a>
                              </li>';
                    }
                    ?>

                    <!-- Dynamic Links Based on User Role -->
                    <?php
                    // Example: If the user is an admin
                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin123') {
                        echo '<li class="nav-item">
                                <a class="nav-link" href="../index.php">Admin Dashboard</a>
                              </li>';
                    }
                    ?>
                    
                    <li class="nav-item">
                    <input type="text" class="form-control w-50" style="display: inline-block;" placeholder="Search" name="search" id="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search'];}?>">
                    <button type="submit" class="btn btn-primary" style="display: inline-block;">Search</button>
                    </li>

                </ul>
            </div>
        </div>
    </nav>



<!-- Modal Structure -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-box-arrow-in-right"></i> Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container">
    <!-- Login Form -->
    <form method="POST" action="../config/loginAuth.php">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password">
        </div>
        
        <div style="color: red;">
            <?php
            if (isset($_SESSION["invalid"])){
                echo $_SESSION["invalid"];
                unset($_SESSION["invalid"]);
            }
            ?>
        </div>
    
</div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary w-100">Login</button>
      </form>
      </div>
    </div>
  </div>
</div>


<!-- Modal Structure -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sign-Up</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container">
                <!-- Registration Form -->
    <form method="POST" action="../config/addUser.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="username" class="form-label">Fullname:</label>
            <input type="text" class="form-control" id="username" name="fullname" required>
        </div>
        
        <div class="mb-3">
            <label for="email" class="form-label">Username:</label>
            <input type="text" class="form-control" id="email" name="username" required>
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <div style="color: green;">
            <?php
            if (isset($_SESSION["sign_up"])){
                echo $_SESSION["sign_up"];
                unset($_SESSION["sign_up"]);
            }
            ?>
        </div>
</div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary w-100">Register</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="container mt-5">
<div class="row">
<?php
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '
    
      <!-- Card 1 -->
      <div class="col-md-3 mb-4">
        <div class="card">
          <img src="../images/'.$row['images'].'" class="card-img-top" alt="Card image">
          <div class="card-body">
            <h5 class="card-title">'.$row['item_name'].'</h5>
            <p class="card-text">'.$row['brand'].'</p>
            <p class="card-text">Price: '.$row['price'].'</p><a href="" class="btn btn-primary">Buy now</a>
          </div>
        </div>
      </div>
    ';
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</div>
</div>