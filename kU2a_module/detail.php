<?php 
if (isset($_GET["id"])) {
	$id = $_GET["id"];
	secure_url($id,"index.php");

	$data = chitietsanpham ($conn,$id);
}
?>


<div class="products-box-detail">
	<h3><a href="#"><?php echo $data["product_name"] ?></a></h3>
	<p class="clearfix">
		<img src="storage/product/<?php echo $data["image"] ?>" alt="product-img1" width="99" height="101" class="floatleft" />
		<?php echo $data["content"] ?>
	</p>
	<div class="clearfix">
		<span class="floatleft price">$ 85.99</span>
		<a href="product-item.html" class="floatright addtocart">Add to Cart</a>
	</div>
</div>