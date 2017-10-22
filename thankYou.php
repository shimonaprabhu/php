<?php
require_once 'core/init.php';
/*\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);
$token=$_POST['stripeToken'];*/
//get other post data
$full_name=sanitize($_POST['full_name']);
$email=sanitize($_POST['email']);
$street=sanitize($_POST['street']);
$street2=sanitize($_POST['street2']);
$city=sanitize($_POST['city']);
$state=sanitize($_POST['state']);
$zip_code=sanitize($_POST['zip_code']);
$country=sanitize($_POST['country']);
$gst=sanitize($_POST['gst']);
$sub_total=sanitize($_POST['sub_total']);
$grand_total=sanitize($_POST['grand_total']);
$cart_id=sanitize($_POST['cart_id']);
$description=sanitize($_POST['description']);
/*$charge_amount=number_format($grand_total,2)*100;*/
$metadata=array(
	"cart_id"=>$cart_id,
	"gst"=>$gst,
	"sub_total"=>$sub_total,
	);

/*try{
	$charge=\Stripe\Charge::create(array(
		"amount"=>$charge_amount,
		"currency"=>CURRENCY,
		"source"=>$token,
		"description"=>$description,
		"receipt_email"=>$email,
		"metadata"=>$metadata)
	);
*/
	//adjest invetory
	$itemQ=$db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
	$iresults=mysqli_fetch_assoc($itemQ);
	$items=json_decode($iresults['items'],true);
	foreach ($items as $item ) {
		$newSizes=array();
		$item_id=$item['id'];
		$productQ=$db->query("SELECT sizes FROM products WHERE id='{$item_id}'");
		$product=mysqli_fetch_assoc($productQ);
		$sizes=sizesToArray($product['sizes']);
		foreach ($sizes as $size) {
			if ($size['size']==$item['size']) {
				$q=$size['quantity']-$item['quantity'];
				$newSizes[]=array('size'=>$size['size'],'quantity'=>$q);
			}else{
				$newSizes[]=array('size'=>$size['size'],'quantity'=>$size['quantity']);
			}
		}
		$sizeString=sizesToString($newSizes);
		$db->query("UPDATE products SET sizes='{$sizeString}' WHERE id='{$item_id}'");
	}


	//update cart
	$db->query("UPDATE cart SET paid=1 WHERE id='{$cart_id}'");
	$db->query("INSERT INTO transactions 
		(cart_id,full_name,email,street,street2,city,state,zip_code,country,sub_total,gst,grand_total,description) VALUES 
		('$cart_id','$full_name','$email','$street','$street2','$city','$state','$zip_code','$country','$sub_total','$gst','$grand_total','$description')");
	$domain=($_SERVER['HTTP_HOST']!='localhost')?'.'.$_SERVER['HTTP_HOST']:false;
	setcookie(CART_COOKIE,'',1,"/",$domain,false);
	  include 'includes/head.php';
  include 'includes/navigation.php';
  include 'includes/headerfull.php';
  ?>
<h1 class="text-center text-success">Thank you for shopping with us!</h1>
<p>Your card has been successfully charged ₹<?=$grand_total;?>.<br>You have been emailed a copy of the receipt.</p>
<p>Your receipt number is: <strong><?=$cart_id;?></strong></p>
<p>Your order will be shipped to:</p>
<address>
	<?=$full_name;?><br>
	<?=$street;?><br>
	<?=(($street2!='')?$street2.'<br>':'')   ;?>
	<?=$city. ', '.$state;?><br>
	<?=$zip_code;?><br>
	<?=$country;?><br>
</address>
  <?php
    include 'includes/footer.php';
/*}catch(\Stripe\Error\Card $e){
	//card has been declined
	echo $e;
}*/



?>