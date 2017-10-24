<div id="left-col">
			<!-- Search Block Starts -->
				<div class="block">
				<!-- Heading Starts -->
					<div class="block-top">Search</div>
				<!-- Heading Ends -->
				<!-- Content Starts -->
					<div class="block-bottom">
					<!-- Search Form Starts -->
						<form action="#" method="get">
							<input type="text" class="search-text" />
							<input type="submit" value="Search Now" class="search-btn" />
							<p>
							Use keywords to find the product you are looking for.<br /><a href="#">Advanced Search</a>
							</p>
						</form>
					<!-- Search Form Ends -->
					</div>
				<!-- Content Ends -->
				</div>
			<!-- Search Block Ends -->
			<!-- Categories Block Starts -->
				<div class="block">
				<!-- Heading Starts -->
					<div class="block-top">Categories</div>
				<!-- Heading Ends -->
				<!-- Content Starts -->
					<div class="block-bottom">
					<!-- Items Starts -->
						<ul>

							<?php 
							$data = theloai ($conn,19);
							foreach ($data as $item) { 
							?>
							<li><a href="index.php?p=the-loai&id=<?php echo $item["id"] ?>"><?php echo $item["category_name"] ?></a></li>
							<?php } ?>
													
						</ul>
					<!-- Items Ends -->
					</div>
				<!-- Content Ends -->
				</div>
			<!-- Categories BLock Ends -->
			<!-- Bestsellers Block Starts -->
				<div class="block">
				<!-- Heading Starts -->
					<div class="block-top">Bestsellers</div>
				<!-- Heading Ends -->
				<!-- Content Starts -->
					<div class="block-bottom">
					<!-- Items Starts -->
						<ul>
							<li><a href="#">Bestsellers Item 1</a></li>
							<li><a href="#">Bestsellers Item 2</a></li>
							<li><a href="#">Bestsellers Item 3</a></li>							
							<li><a href="#">Bestsellers Item 4</a></li>
							<li><a href="#">Bestsellers Item 5</a></li>
							<li><a href="#">Bestsellers Item 6</a></li>
							<li class="noborder"><a href="#">Bestsellers Item 7</a></li>							
						</ul>
					<!-- Items Ends -->
					</div>
				<!-- Content Ends -->
				</div>
			<!-- Bestsellers BLock Ends -->
			</div>