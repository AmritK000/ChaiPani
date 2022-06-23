<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php include('common/head.php') ?> </head>

<body>
	<?php include('common/header.php') ?>
	<!-- profile -->
	<div class="coupen-block">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-12 pd-zero"></div>
				<div class="col-lg-6 col-md-6 col-12 pd-zero">
					<div class="coupen-box">
						<img src="img/right.png" class="img-fluid d-block mx-auto" alt="">
						<h3 class="default-heading">Thank You</h3>
						<p>Please find below your Invoice and order details.</p>
						<ul class="nav nav-tabs justify-content-center">
							<li><a data-toggle="tab" class="active" href="#Invoice">Invoice</a></li>
							<li><a data-toggle="tab" href="#Coupons">Coupons</a></li>
						</ul>
						<div class="tab-content">
							<div id="Invoice" class="tab-pane fade show active">
								<div class="invoice-details">
									<p>Tax Invoice</p>
									<p>Order Id <span>#<?php echo $order_id;?></span></p>
									<p>Purchase Date : <span><?php echo date('d-M-Y h:i A' ,strtotime($orderData['created_at']))?></span></p>
									<div class="table-responsive">
										<table class="table">
											<tr>
												<th>Product</th>	
												<th>Quantity</th>	
												<th>Subtotal</th>	
											</tr>
											<?php foreach($orderDetails as $OD):?>
											<tr>
												<td><?php echo $OD['product_name'][0];?></td>	
												<td><?=$OD['quantity']?></td>	
												<td><?php echo $OD['subtotal'];?></td>
											</tr>
											<?php endforeach;?>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<!-- <tr>
												<td>Total Before VAT</td>	
												<td class="text-right">AED19.05</td>	
											</tr> -->
											<tr>
												<td>Subtotal</td>	
												<td class="text-right"><?=$finalPrice?></td>	
											</tr>
										</table>
									</div>
									<div class="table-responsive">
										<table class="table">
											<!--<tr>
												<td>Paid Using Card</td>	
												<td class="text-right">0</td>	
											</tr>-->
											<tr>
												<td>Cashback</td>	
												<td class="text-right"><?=@$cashback?></td>	
											</tr>
											<tr>
												<td>Paid Using Arabian Point</td>	
												<td class="text-right"><?=@$finalPrice?></td>	
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div id="Coupons" class="tab-pane fade">
								<?php foreach ($couponDetails as $coupon) { ?>
								<div class="coupon">
									<div class="about-coupen">
										<div class="coupen-img">
											<img src="img/cart-img.png" class="img-fluid" alt="">
										</div>
										<div class="coupen-info">
											<h4>One Campaign, Three Winners</h4>
											<p>Products: <span><?=$coupon['product_title']?></span></p>
											<p>Purchased on: <span><?=date('d-M-Y h:i A' ,strtotime($coupon['created_at']))?></span></p>
										</div>
									</div>
									<div class="coupen-footer">
										<p>Coupon No: <?=$coupon['coupon_code']?></p>
									</div>
								</div>
								<?php } ?>
							</div>
							<div class="promo-code">
								<a href="<?=base_url()?>" class="color-default-btn float-right">Shop More</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('common/footer.php') ?>
<?php include('common/footer_script.php') ?>
	<script>
	/* TOP Menu Stick
			--------------------- */
	var s = $("#sticker");
	var pos = s.position();
	$(window).scroll(function() {
		var windowpos = $(window).scrollTop();
		if(windowpos > pos.top) {
			s.addClass("stick");
		} else {
			s.removeClass("stick");
		}
	});
	</script>
	<script>
		$('.minus').click(function () {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
		$('.plus').click(function () {
			var $input = $(this).parent().find('input');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
		});
	</script>
	<!-- Header Dropdown -->
	<script>
	$('.dropdown > .caption').on('click', function() {
		$(this).parent().toggleClass('open');
	});
	// $('.price').attr('data-currency', 'RUB');
	$('.dropdown > .list > .item').on('click', function() {
		$('.dropdown > .list > .item').removeClass('selected');
		$(this).addClass('selected').parent().parent().removeClass('open').children('.caption').html($(this).html());
		if($(this).data("item") == "RUB") {
			console.log('RUB');
		} else if($(this).data("item") == "UAH") {
			console.log('UAH');
		} else {
			console.log('USD');
		}
		//         if ($(this).data("item") == "RUB") {
		//             $('.price').attr('data-currency', 'RUB');
		//             $('.currency').text('руб.');
		//         } else if ($(this).data("item") == "UAH") {
		//             $('.price').attr('data-currency', 'UAH');
		//             $('.currency').text('грн.');
		//         } else {
		//             $('.price').attr('data-currency', 'USD');
		//             $('.currency').text('долл.');
		//         }
	});
	$(document).on('keyup', function(evt) {
		if((evt.keyCode || evt.which) === 27) {
			$('.dropdown').removeClass('open');
		}
	});
	$(document).on('click', function(evt) {
		if($(evt.target).closest(".dropdown > .caption").length === 0) {
			$('.dropdown').removeClass('open');
		}
	});
	</script>
	
</body>

</html>
