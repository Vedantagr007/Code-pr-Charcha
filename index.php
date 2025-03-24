<?php include('partials/header.php') ?>
<?php include('partials/connection.php') ?>

<!-- Carousel -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/carousel-1.jpg" class="d-block w-100" style="height: 25rem; width: fit-content;" alt="carousel-image">
    </div>
    <div class="carousel-item">
      <img src="img/carousel-2.jpg" class="d-block w-100" style="height: 25rem; width: fit-content;" alt="carousel-image">
    </div>
    <div class="carousel-item">
      <img src="img/carousel-3.jpg" class="d-block w-100" style="height: 25rem; width: fit-content;" alt="carousel-image">
    </div>
    <div class="carousel-item">
      <img src="img/carousel-4.jpg" class="d-block w-100" style="height: 25rem; width: fit-content;" alt="carousel-image">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


<!-- Cards -->
<div class="container my-3">
  <h1 class="text-center">Browse Categories</h1>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <!-- fetch categories -->
    <?php 
      $query = "SELECT * FROM `categories`";
      $result = mysqli_query($connection, $query);

      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['category_id'];
        $categoryName = $row['category_name'];
        $categoryDesc = $row['category_desc'];
        // $timestamp = $row['created'];

        echo '<div class="col">
          <div class="card my-2 h-100">
            <img src="img/card-'.$id.'.jpg" style="aspect-ratio: 15 / 11;" class="card-img-top" alt="card-image">
            <div class="card-body">
              <h5 class="card-title"><a href="threadlist.php?catid='.$id.'" class="nav-link">'.$categoryName.'</a></h5>
              <p class="card-text">'.substr($categoryDesc, 0, 120).'...</p>
              </div>
              <div class="card-footer" style="background: none;border-top: none; text-align: center;">
              <a href="threadlist.php?catid='.$id.'" class="btn btn-primary">View Threads</a>
              </div>
          </div>
        </div>';

      }
    ?>

  </div>
</div>



<?php include('partials/footer.php') ?>

<!-- src="https://source.unsplash.com/random/1200x420/?java,coding" -->