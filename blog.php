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
					
					if(isset($_GET["page"])) {
						$page = $_GET["page"];
					}else{
						$page = "";
					}
					 if($page == "" || $page == 1) {
						  $starter_post =0;
					 }else {
						  $starter_post = ($page *4)-4;
					 }


					$sql_query2 = "SELECT * FROM posts";
					$look_all_post =mysqli_query($conn,$sql_query2);
					$all_post_count = mysqli_num_rows($look_all_post);
					 $page_number =ceil($all_post_count / 4);




					 
					$sql_query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $starter_post,4";
						$select_all_posts = mysqli_query($conn,$sql_query);

						   while($row = mysqli_fetch_assoc($select_all_posts  )){
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
							
						 <?php  }       ?>

					
					       
					
                        
					</div>
					<div class="row">
					<nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">
                     <li class="page-item "><a class="page-link" href="blog.php?page=<?php    
				        if($page > 1) {
							echo $page-1;
						}else{
							echo 1;
						}
				     ?>" >Previous</a></li>

                     	<?php 
						  
						  for($i=1; $i<= $page_number;$i++) {
							  echo "<li class='page-item'><a class='page-link' href='blog.php?page={$i}'>{$i}</a></li>";

						  }
						 ?>

                     <li class="page-item "><a class="page-link" href="blog.php?page=<?php    
				        if($page_number > $page ) {
							echo $page+1;
						}else{
							echo $page;
						}
				     ?>" >Next</a></li>
                     </ul>
                      </nav>
					</div>
				</main>
				
			<?php include "includes/sidebar.php"; ?>
				
				
				
			</div>

		</div>
	</section>

	<?php include "includes/footer.php";  ?>

