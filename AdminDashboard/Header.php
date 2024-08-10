<?php
  session_start();

  if(!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../Entry/login.php");
    exit();
}
if($_SESSION['role'] != "Admin") {
    header("Location: ../UserPanel");
    exit();
  }
  
  include "../connection.php";
  $sql = "SELECT * FROM user_tb WHERE username = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("s",$_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
  $image = $row['photo'];
?>
<link rel="stylesheet" href="./style.css">

<style>
  .btn-outline-success {
    border: 1px solid #484128;
    color: black;
  }
  .btn-outline-success:hover {
    background-color: #484128;
    border: 1px solid #d4ccb1;
  }
  @media(max-width:1000px) {
    .myin, .btn-outline-success {
      display: none;
    }
  }
</style>

<div class="container-fluid myhead">
  <div class="d-flex flex-wrap align-items-center justify-content-between">
    <a class="navbar-brand" href="#">
      <h2>Easy<span class="logoHead">Tour</span></h2>
    </a>

    <div class="d-flex align-items-center ml-auto">
      <!-- Search Bar -->
      <form class="d-flex me-3" role="search">
        <input class="form-control me-2 myin" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

      <ul class="nav mb-2 mb-md-0">
      <li class="nav-item"><a href="./Dashboard.php" class="nav-link px-2">Home</a></li>
      <!-- <li class="nav-item"><a href="./City/AddExplore.php" class="nav-link px-2">Add City</a></li> -->
      <li class="nav-item"><a href="./Explore.php" class="nav-link px-2">Explore</a></li>
        <li class="nav-item"><a href="./pages/contact.php" class="nav-link px-2">Contact us</a></li>
        <li class="nav-item"><a href="./Testimonial.php" class="nav-link px-2">Testimonials</a></li>
      </ul>

      <div class="dropdown text-end ms-3">
        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo $image ?>" alt="mdo" width="32" height="32" class="rounded-circle">
        </a>
        <ul class="dropdown-menu text-small mybg">
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li>
            <hr class="dropdown-divider">
          </li>
          <li><a class="dropdown-item" href="../Entry/logout.php">Sign out</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
  window.addEventListener('scroll', function() {
    const searchButton = document.querySelector(".btn-outline-success");
    if (window.scrollY > 0) {
      searchButton.classList.add('scrolly');
    } else {
      searchButton.classList.remove('scrolly');
    }
  });
</script>
