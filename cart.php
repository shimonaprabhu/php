<?php
require_once 'core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerpartial.php';
if ($cart_id!='') {
	$cartQ=$db->query("SELECT * FROM cart WHERE id='{$cart_id}'");
	$result=mysqli_fetch_assoc($cartQ);
	$items=json_decode($result['items'],true);
	$i=1;
	$sub_total=0;
	$item_count=0;
}
?>


<div class="col-md-12">
	<div class="row">
		<h2 class="text-center">My Shopping Cart</h2><hr>
		<?php if ($cart_id=='') :?>
			<div class="bg-danger">
				<p class="text-center text-danger">
					Your shopping cart is empty!
				</p>
			</div>
		<?php else:?>
			<table class="table table-bordered table-condensed table-striped">
				<thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Size</th><th>Sub Total</th></thead></thead>
				<tbody>
					<?php 
						foreach ($items as $item) {
							$product_id=$item['id'];
							$productQ=$db->query("SELECT * FROM products WHERE id='{$product_id}'");
							$product=mysqli_fetch_assoc($productQ);
							$sArray=explode(',', $product['sizes']);
							foreach ($sArray as $sizeString) {
							$s=explode(':', $sizeString);
							if ($s[0]==$item['size']) {
								$available=$s[1];
							}
						}
						?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$product['title'];?></td>
							<td>₹<?=$product['price'];?></td>
							<td><?=$item['quantity'];?></td>
							<td><?=$item['size'];?></td>
							<td>₹<?=$item['quantity']*$product['price'];?></td>

						</tr>
					<?php 
						$i++;
						$item_count +=$item['quantity'];
						$sub_total+=($product['price']*$item['quantity']);
						}

						$gst=GSTRATE*$sub_total;
						/*$gst=number_format($gst,2);*/
						$grand_total=$gst+$sub_total;

					 ?>

				</tbody>
			</table>
			<table class="table table-condensed table-bordered text-right">
				<thead class="totals-table-header"><th>Total Items</th><th>Sub Total</th><th>GST</th><th>Grand Total</th>
				<legend>Shopping Summary</legend>
				</thead>
				<tbody>
					<tr>
						<td><?= $item_count ;?></td>
						<td>₹<?= $sub_total ;?></td>
						<td>₹<?= $gst ;?></td>
						<td class="bg-success">₹<?= $grand_total ;?></td>
					</tr>
				</tbody>
			</table>

			<!-- Check out -->
<button type="button" class="btn btn-primary pull-right btn-success" data-toggle="modal" data-target="#checkoutModal">
  <span class="glyphicon glyphicon-shopping cart"></span> Check Out >>
</button>

<!-- Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="row">
	       <form action="thankYou.php" method="post" id="payment-form">
	       <span class="bg-danger" id="payment-errors"></span>
	       <input type="hidden" name="gst" value="<?=$gst;?>">
	       <input type="hidden" name="sub_total" value="<?=$sub_total;?>">
	       <input type="hidden" name="grand_total" value="<?=$grand_total;?>">
	       <input type="hidden" name="cart_id" value="<?=$cart_id;?>">
	       <input type="hidden" name="description" value="<?=$item_count.' item'.(($item_count>1)?'s':'').' from Shauntas Boutique.';?>">

	       		<div id="step1" style="display: block;">
	       			<div class="form-group col-md-6">
	       				<label for="full_name">Full Name:</label>
	       				<input class="form-control" name="full_name" id="full_name" type="text">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="email">Email:</label>
	       				<input class="form-control" name="email" id="email" type="email">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="street">Street Adress:</label>
	       				<input class="form-control" name="street" id="street" type="text" data-stripe="address_line1">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="street2">Street Adress 2:</label>
	       				<input class="form-control" name="street2" id="street2" type="text" data-stripe="address_line2">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="city">City:</label>
	       				<input class="form-control" name="city" id="city" type="text" data-stripe="address_city">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="state">State:</label>
	       				<input class="form-control" name="state" id="state" type="text" data-stripe="address_state">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="zip_code">Zip Code:</label>
	       				<input class="form-control" name="zip_code" id="zip_code" type="text" data-stripe="address_zip">
	       			</div>
	       			<div class="form-group col-md-6">
	       				<label for="country">Country:</label>
	       				<input class="form-control" name="country" id="country" type="text" data-stripe="address_country">
	       			</div>
	       		</div>
	       		<div id="step2" style="display: none;">
	       			<div class="form-group col-md-3">
	       				<label for="name">Name on card:</label>
	       				<input type="text" id="name" class="form-control" data-stripe="name">
	       			</div>
	       			<div class="form-group col-md-3">
	       				<label for="number">Card Number:</label>
	       				<input type="text" id="number" class="form-control" data-stripe="number">
	       			</div>
	       			<div class="form-group col-md-3">
	       				<label for="cvc">CVC:</label>
	       				<input type="text" id="cvc" class="form-control" data-stripe="cvc">
	       			</div>
	       			<div class="form-group col-md-2">
	       				<label for="exp-month">Expire Month:</label>
	       				<select id="exp-month" class="form-control" data-stripe="exp_month">
	       					<option value=""></option>
	       					<?php for($i=1;$i<13;$i++):?>
	       						<option value="<?=$i;?>"><?=$i;?></option>
	       					<?php endfor;?>
	       				</select>
	       			</div>
	       			
	       			<div class="form-group col-md-2">
	       				<label for="exp-years">Expire Year:</label>
	       				<select id="exp-year" class="form-control" data-stripe="exp_year">
	       					<option value=""></option>
	       					<?php $yr=date("Y");?>
	       					<?php for($i=0;$i<11;$i++):?>
	       						<option value="<?=$yr+$i;?>"><?=$yr+$i;?></option>
	       					<?php endfor;?>
	       				</select>
	       			</div>
	       		</div>
	       
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-success" onclick="check_address();" id="next_button">Next >></button>
        <button type="button" class="btn btn-primary" onclick="back_address();" id="back_button" style="display: none;"><< Back</button>
        <button type="submit" class="btn btn-primary" id="checkout_button" style="display: none;">Check Out</button>
        </form>
      </div>
    </div>
  </div>
</div>


		<?php endif;?>
	</div>
</div>
<script>
function back_address(){
	jQuery('#payment-errors').html("");
					jQuery('#step1').css("display","block");
					jQuery('#step2').css("display","none");					
					jQuery('#next_button').css("display","inline-block");					
					jQuery('#back_button').css("display","none");
					jQuery('#checkout_button').css("display","none");
					jQuery('#checkoutModalLabel').html("Shipping Address:");
}
	function check_address(){
		var data={
			'full_name':jQuery('#full_name').val(),
			'email':jQuery('#email').val(),
			'street':jQuery('#street').val(),
			'street2':jQuery('#street2').val(),
			'city':jQuery('#city').val(),
			'state':jQuery('#state').val(),
			'zip_code':jQuery('#zip_code').val(),
			'country':jQuery('#country').val(),

		};
		jQuery.ajax({
			url:'/E-Commerce/admin/parsers/check_address.php',
			method:'POST',
			data:data,
			success:function(data){
				if (data.trim()!='passed') {
					jQuery('#payment-errors').html(data);
					
				}
				if (data.trim()=='passed') {
					jQuery('#payment-errors').html("");
					jQuery('#step1').css("display","none");
					jQuery('#step2').css("display","block");					
					jQuery('#next_button').css("display","none");					
					jQuery('#back_button').css("display","inline-block");
					jQuery('#checkout_button').css("display","inline-block");
					jQuery('#checkoutModalLabel').html("Enter your card details:");

				}
			},
			error:function(){
				alert("Somwthing went wrong");
			},
		});
	}

	/*Stripe.setPublishableKey('<?=STRIPE_PUBLIC;?>');

	function stripeResponseHandler(status,response){
		var $form=$('#payment-form');
		if (response.error) {
			$form.find('#payment-errors').text(response.error.message);
			$form.find('button').prop('disabled',false);
		}else{
			var token=response.id;
			$form.append($('<input type="hidden" name="stripeToken"/>').val(token));
			$form.get(0).submit();
		}

	};

	jQuery(function($){
		$('#payment-form').submit(function(event){
			var $form =$(this);
			$form.find('button').prop('disabled',true);
			$form.card.createToken($form,stripeResponseHandler);
			return false;
		});
	});*/
</script>
<?php include 'includes/footer.php'; ?>
