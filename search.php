<?php include('partials/header.php')?>
<?php include('partials/connection.php') ?>


<!-- Search results start here -->
<div class="container">
    <h1>Search results for "<em><?php echo $_GET["search"] ;?></em>"</h1>
        <?php 
        $noresult = true;
        $search = $_GET["search"];
        $query = "SELECT * FROM `threads` WHERE MATCH (thread_sub, thread_desc) against ('$search')";
        $result = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
        $noresult = false;
        $title = $row["thread_sub"];
        $description = $row["thread_desc"];
        $thread_id = $row["thread_id"];
        $url = "thread.php?threadid=".$thread_id;
        
        // Display search results
        echo '<div class="result">
                <h3><a href="'.$url.'" class="text-dark">'.$title.'</a></h3>
                <p>'.$description.'</p>
              </div>';
        }

        if ($noresult) {
            echo  '
            <div class="p-4 my-4 bg-body-tertiary rounded-3">
                <h1 class="text-body-emphasis lead" style="font-size: 30px; font-weight:350;">Your search - <em>'.$search.'</em> did not match any query.</h1>
                <hr>
                <p class="lead">Suggestions:

                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>

                </p>
                <br>
            </div>';
        }
        ?>
</div>

<?php include('partials/footer.php') ?>