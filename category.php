
<?php
  require_once "core/init.php";
  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerpartial.php';
  include 'includes/leftbar.php';

  if (isset($_GET['cat'])) {
  	$cat_id=sanitize($_GET['cat']);
  }else{
  	$cat_id='';
  }


  $sql = "SELECT * FROM products WHERE categories='$cat_id'";
  $productQ = $db -> query($sql);
  $category=get_category($cat_id);
  ?>


	<!--Main-->

	<div class="col-md-8">
		<div class="row">
			<h2 class="text-center"><?=$category['parent'].' '.$category['child'];?></h2>

				<?php while($product = mysqli_fetch_assoc($productQ)) : ?>

				<div class="col-md-3">
				<h4 class="text-center"><?=$product['title'];?></h4><br>
					<img src="<?=$product['image'];?>" alt="<?=$product['title'];?>" class="img-thumb" style="height:200px ;width:200px ;"/>
					<br>
					<br>
          <br>
					<p class="list-price text-danger text-center">List Price<s>₹<?=$product['list_price'];?></s></p>

					<p class="price text-center"> Our Price: ₹<?=$product['price'];?></p>
					<button type="button" class="btn btn-sm btn-success center-block" onclick="detailsmodal(<?=$product['id'];?>)">Details</button>
          <br>
          <br>
          <br>
				</div>
				<?php endwhile;?>
			</div>
		</div>
    <?php
      include 'includes/rightbar.php';
      include 'includes/footer.php';
     ?>
