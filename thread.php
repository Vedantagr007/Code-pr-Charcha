<?php include('partials/header.php') ?>
<?php include('partials/connection.php') ?>
<?php
$id = $_GET["threadid"];
$query = "SELECT * FROM `threads` WHERE thread_id = $id";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
  $title = $row["thread_sub"];
  $description = $row["thread_desc"];
  $time = $row['timestamp'];
  $commented_by = $row['thread_user_id'];

  $query = "SELECT username FROM `users` WHERE user_id='$commented_by'";
  $result2 = mysqli_query($connection, $query);
  $row2 = mysqli_fetch_assoc($result2);
  $posted_by = $row2['username'];
}
?>

<?php
$showAlert = false;
$method =  $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
  $comment = $_POST['comment'];
  $comment = str_replace("<", "&lt;", $comment);
  $comment = str_replace(">", "&gt;", $comment);
  $ID = $_POST['ID'];

  $query = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_user`, `comment_time`) VALUES ('$comment', '$id', '$ID', CURRENT_TIMESTAMP)";
  $result = mysqli_query($connection, $query);
  $showAlert = true;
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong>!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
} ?>


<div class="container my-5">
  <div class="p-4 bg-body-tertiary rounded-3">
    <h1 class="text-body-emphasis lead" style="font-size: 42px;"><?php echo $title ?></h1>
    <p class="lead" style="font-size: 18px;"><?php echo $description; ?></p>
    <hr>
    <small>Posted by: <b><?php echo $posted_by;?></b><em> on</em> <?php echo $time ?></small><br>
  </div>

  <h3 class="my-4">Post your Comment</h3>

  <?php
    if ($_SESSION['loggedIn'] && $_SESSION['loggedIn'] == true) {
      echo '
  <form action="'. $_SERVER['REQUEST_URI'].'" method="post">
    <div class="mb-3">
      <label for="comment" class="form-label lead" style="font-weight: 350;">Your view over topic</label>
      <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
      <input type="hidden" name="ID" value="'.$_SESSION["ID"].'">
    </div>
    <button type="submit" class="btn btn-primary">Comment</button>
  </form> '; 
}
  else {
    echo '<div class="container-fluid my-4 p-4 bg-body-tertiary rounded-3">
        <h2>Know the answer?</h2>
          <h1 class="text-body-emphasis lead">Please login to start providing solutions!</h1>
        </div>';
  }
?>

  <div class="my-3">
    <h3 class="my-4">Discussions</h3>
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comments` WHERE thread_id = $id";
    $result = mysqli_query($connection, $sql);
    $noResult = true;

    while ($row = mysqli_fetch_assoc($result)) {
      $noResult = false;
      // $commentUser = $row['comment_user'];
      $commentID = $row['comment_id'];
      $content = $row['comment_content'];
      $timeStamp = $row['comment_time'];
      $threadUID = $row['comment_user'];

      $query = "SELECT user_email FROM `users` WHERE user_id='$threadUID'";
      $result2 = mysqli_query($connection, $query);
      $row2 = mysqli_fetch_assoc($result2);

      echo '<div class="d-flex ">
    
    <img src="img/user.jpg" alt="user-img" class="me-3 rounded-circle" style="width: 30px; height: 30px;" />
    
  <div>
      <h5 style="display: inline-block" >'.$row2["user_email"].'</h5>
      <small class="text-muted" style="display: inline-block">Posted on ' . $timeStamp . '</small>
      <p>
        ' . $content . '
      </p>
    </div>
  </div>';
    }
    // echo  var_dump($noResult);
    if ($noResult) {
      echo '<div class="alert alert-dark text-center" role="alert">
    <div class="display-6">
    Be the first to comment!
    </div>
</div>';
    }
    ?>

  </div>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>


<?php include('partials/footer.php') ?>