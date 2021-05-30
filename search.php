<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

	<!--==========================
    INSIDE HERO SECTION Section
============================-->
	<section class="page-image page-image-blog md-padding">
		<h1 class="text-white text-center">BLOG</h1>
	</section>

	<!--==========================
    Contact Section
============================-->
	<section id="blog" class="md-padding">
		<div class="container">
			<div class="row">
				<main id="main" class="col-md-8">
					<div class="row">
						
					<?php 
					

                     if(isset($_POST["searchbtn"])) {
                          $search = $_POST["search"];

                          $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ORDER BY post_id DESC";
                          $search_query = mysqli_query($conn, $query);
                          if(!$search_query) {
                              die("query failed:" .mysqli_error($conn));
                          }
                          $search_count = mysqli_num_rows($search_query);

                          if($search_count == 0) {
                               echo "<h3>there in no result for selected words !</h3>";
                          }else {
                        
                               while($row = mysqli_fetch_assoc($search_query)){
                                           $post_id =$row["post_id"];
                                           $post_author = $row["post_author"];
                                           $post_date = $row["post_date"];
                                           $post_hits = $row["post_hits"];
                                           $post_title = $row["post_title"];
                                           $post_text = substr($row["post_text"],0,100);
                                           $post_image = $row["post_image"];
                                ?>
    
                                <div class="col-md-6">
                                <div class="blog">
                                    <div class="blog-img">
                                        <img src="img/<?php echo $post_image; ?>" class="img-fluid">
                                    </div>
                                    <div class="blog-content">
                                        <ul class="blog-meta">
                                            <li><i class="fas fa-users"></i><span class="writer"><?php echo $post_author;  ?></span></li>
                                            <li><i class="fas fa-clock"></i><span class="writer"> <?php echo  $post_date; ?></span></li>
                                            <li><i class="fas fa-eye"></i><span class="writer"><?php echo  $post_hits; ?></span></li>
                                        </ul>
                                        <h3><?php echo $post_title ; ?></h3>
                                        <p><?php echo  $post_text; ?></p>
                                        <a href="blog-single.php?look=<?php echo $post_id; ?>">Read More</a>
                                    </div>
                                </div>
                            </div>   
                                
                             <?php  }      

                          }
                     }  ?>
					
                        
					</div>
				
				</main>
				
			<?php include "includes/sidebar.php"; ?>
				
				
				
			</div>

		</div>
	</section>

	<?php include "includes/footer.php";  ?>

