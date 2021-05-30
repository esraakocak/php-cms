<aside id="aside" class="col-md-4">
                    
                    <div class="widget">
						<div class="widget-search">
						<form action = "./search.php" method = "post" >
							<input name = "search" class="search-input form-control" type="text" placeholder="Search">
							<button name="searchbtn" class="search-btn" type="submit"><i class="fas fa-search"></i></button>
						</form>
						</div>
					</div>
					<!-- /Search -->
                    
                    
					<!-- Category -->
					<div class="widget">
						<h3 class="mb-3">Categories</h3>
						<div class="widget-category">

						<?php 
						

						$sql_query = "SELECT * FROM categories";
						$select_all_categories = mysqli_query($conn,$sql_query);

						   while($row = mysqli_fetch_assoc($select_all_categories )){
                                    $category_name =  $row["category_name"];

								$query2 = "SELECT * FROM posts WHERE post_category = '$category_name' ";
								$send_category_query = mysqli_query($conn ,$query2);
								$count_category_posts = mysqli_num_rows($send_category_query);	
						        
									

									echo "<a href='category.php?category=$category_name'>{$category_name}<span>({$count_category_posts})</span></a> " ;
						   }   
						 
						?>

						<!--
							
							<a href="#">Marketing<span>(142)</span></a>
							<a href="#">Web Development<span>(74)</span></a>
							<a href="#">Branding<span>(60)</span></a>
							<a href="#">Photography<span>(5)</span></a>

							-->
						</div>
					</div>
					<!-- /Category -->

					<!-- Posts sidebar -->
					<div class="widget">
						<h3 class="mb-3">Latest Posts</h3>

						<!-- single post -->
						<div class="widget-post">
							<a href="#">
								<img class="img-fluid" src="./img/post1.jpg" alt="">Lorem Ipsum
							</a>
							<ul class="blog-meta">
								<li>Oct 18, 2017</li>
							</ul>
						</div>
						<!-- /single post -->

						<!-- single post -->
						<div class="widget-post">
							<a href="#">
								<img src="./img/post2.jpg" alt="">Lorem Ipsum
							</a>
							<ul class="blog-meta">
								<li>Oct 18, 2017</li>
							</ul>
						</div>
						<!-- /single post -->


						<!-- single post -->
						<div class="widget-post">
							<a href="#">
								<img src="./img/post3.jpg" alt="">Lorem Ipsum
							</a>
							<ul class="blog-meta">
								<li>Oct 18, 2017</li>
							</ul>
						</div>
						<!-- /single post -->

					</div>
					<!-- /Posts sidebar -->

				</aside>