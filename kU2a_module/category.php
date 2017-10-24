<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url($id,"index.php");

	$data = theloai_sanpham ($conn,$id);
}
?>

<!-- Featured Products Starts -->
	<div class="clearfix">
	<!-- Product 1 Starts -->
		<?php
		 foreach ($data as $value) {
		 $dem = 0;
		?>
		<div class="products-box">
			<h3><a href="product-item.html"><?php echo $value["product_name"] ?></a></h3>
			<p class="clearfix">
				<img src="storage/product/<?php echo $value["image"] ?>" alt="product-img1" width="99" height="101" class="floatleft" />
				<?php echo $value["content"] ?>
			</p>
			<div class="clearfix">
				<span class="floatleft price"><?php echo format_price($value["price"]) ?> VNĐ</span>
				<a href="index.php?p=detail&id=<?php echo $value["id"] ?>" class="floatright details-btn">Details</a>
				<a href="index.php?p=add-cart&id=<?php echo $value["id"] ?>" class="floatright details-btn">Add to Cart</a>
			</div>
		</div>
		<?php } ?>
	<!-- Product 1 Ends -->
	</div>
<!-- Featured Products Ends -->