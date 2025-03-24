<?php include('connection.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>We's-cuss - Coding Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">We's&dash;cuss</a>
        <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
            </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Popular
          </a>
          <ul class="dropdown-menu">
            <?php
            $query = "SELECT category_name, category_id FROM `categories` LIMIT 4 ";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result))
             echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row["category_id"].'">'.$row["category_name"].'</a></li>';
            ?>
          </ul>
        </li>
      </ul>
      <?php
        session_start();
        if ($_SESSION['loggedIn'] && $_SESSION['loggedIn'] == true) {
          echo '<form class="d-flex" role="search" method="get" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form><p class = "text-light my-0 px-1">Welcome <b>'.$_SESSION['loggedUser'].'</b> !</p>
        <a role="button" href="partials/logout.php" class="btn btn-success" type="submit">Log Out</a>'; 
        }else {
          echo '
        <form class="d-flex" role="search" method="get" action="search.php">
          <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <div class="mx-1">
          <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
          <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupmodal">SignUp</button>
        </div>'; }
          ?>
      </div>
    </div>
  </nav>
  
  <?php 
        include('partials/signupmodal.php');
        include('partials/loginmodal.php');
        if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=='true') {
          echo '<div class="alert alert-success my-0" role="alert">
          <strong>Success!</strong> Signed up successfully!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if (isset($_GET['loginsuccess']) && $_GET['loginsuccess']=='false') {
          echo '<div class="alert alert-danger my-0" role="alert">
          <strong>Wrong Password!</strong> Try Again.
            <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    ?>