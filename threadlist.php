<?php include('partials/header.php') ?>
<?php include('partials/connection.php') ?>
<?php
$id = $_GET["catid"];
$query = "SELECT * FROM `categories` WHERE category_id = $id";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $catName = $row["category_name"];
  $Catdesc = $row["category_desc"];
}
?>

<?php
$method =  $_SERVER['REQUEST_METHOD'];
// echo $method;
if ($method == 'POST') {
  $th_title = $_POST['title'];
  $th_desc = $_POST['desc'];
  $ID = $_POST['ID'];

  $query = "INSERT INTO `threads` (`thread_sub`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$ID', CURRENT_TIMESTAMP)";
  $result = mysqli_query($connection, $query);
  $showAlert = true;
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> Please wait while community responds :)!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>Oops!</strong> Error occurred. Try Again!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
} ?>


<div class="container my-5">
  <div class="p-4 bg-body-tertiary rounded-3">
    <h1 class="text-body-emphasis lead" style="font-size: 38px; font-weight:400;"><?php echo $catName ?> Forums</h1>
    <p class="lead" style="font-size: 18px;"><?php echo $Catdesc; ?></p>
    <hr>
    <small>No Spam / Advertising / Self-promote in the forums.<br>Do not post copyright-infringing material.<br>Do not post “offensive” posts, links or images.<br>Do Not Bump Posts.<br>Do Not Offer to Pay for Help. Do Not Offer to Work For Hire.<br>Do Not Post About Commercial Products.</small><br>
    <a type="button" class="btn btn-md my-2 btn-primary">Learn More</a>
  </div>

  <div class="container">
    <?php
    if ($_SESSION['loggedIn'] && $_SESSION['loggedIn'] == true) {
      echo
      '<h1>Start a Discussion</h1>
      <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
      <div class="mb-3">
        <label for="problemTitle" class="form-label"><h6>Problem Title</h6></label>
        <input type="text" class="form-control" name="title" id="problemTitle">
        <div class="form-text">Keep your title crisp and as short as possible.</div>
        <input type="hidden" name="ID" value="'.$_SESSION["ID"].'">
      </div>
      <div class="mb-3">
        <label label for="problemDescription" class="form-label"><h6>Elaborate your Concern</h6></label>
        <textarea class="form-control" name="desc" id="problemDescription" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>';
    } else {
      echo '
      <div class="container-fluid my-4 p-4 bg-body-tertiary rounded-3">
      <h2>Start a Discussion</h2>
        <h1 class="text-body-emphasis lead">Please login to start interacting and participate in discussions.</h1>
      </div>';
    }
    ?>

    <h2 class="my-4">Browse Questions</h2>

    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE thread_cat_id = $id";
    $result = mysqli_query($connection, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      $ques = $row['thread_sub'];
      $desc = $row['thread_desc'];
      $tid = $row['thread_id'];
      $timeStamp = $row['timestamp'];
      $threadUID = $row['thread_user_id'];
      $query = "SELECT user_email FROM `users` WHERE user_id='$threadUID'";
      $result2 = mysqli_query($connection, $query);
      $row2 = mysqli_fetch_assoc($result2);

      echo '<div class="d-flex my-1">
        <!-- Image -->
        <img src="img/user.jpg" alt="John Doe" class="me-3 rounded-circle" style="width: 30px; height: 30px;" />
        <!-- Body -->
        <div>
        <h5 class="fw-bold my-0"><a href="thread.php?threadid=' . $tid . '" style="text-decoration: none;">' . $ques . '</a></h5>
        <p>' . $desc . '</p>
        <div class="justify-content-end">Asked by: <b>'.$row2["user_email"].'</b><small class="text-muted" style="display: inline-block">Posted on ' . $timeStamp . '</small></div>
        </div>
      </div>';
    }
    // echo  var_dump($noResult);
    if ($noResult) {
      echo '<div class="alert alert-warning" role="alert">
    <div class="display-6 p-3 text-center">
    No results? Be the <em class="fw-bold">first</em> curious one!
    </div>
</div>';
    }
    ?>


  </div>
  </div>



  <?php include('partials/footer.php') ?>