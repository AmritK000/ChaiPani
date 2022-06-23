<?php echo""; ?>
<!Doctype html>
<html lang="eng">
<head>
<style>
	.error{
	color: red;
}
.activess{
background-color:green !important;
}
</style>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dealz Arabia || Cart-Items</title>
    <meta name="description" content="">
	<!-- Mobile specific metas -->		
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<!-- Favicon -->
	<link rel="icon" href="<?=base_url('assets/')?>img/h-1.png" type="image/x-icon"/>
	<!--All Fonts  Here -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.11.1/css/all.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
	<!-- style CSS -->			
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/style.css">
	<!-- responsive CSS -->			
    <link rel="stylesheet" href="<?=base_url('assets/')?>css/responsive.css">
    <style>
         .box .chart {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: 12px;
    line-height: 108px;
    height: 160px;
    color: #300808;
    top: 13px;
    left: 36px;
}
.explore-product-box .action-block .coupen-img {
    max-width: 100%;
    position: relative;
    margin-top: -13px;
    float: right;
    left: -27px;
}
.outside-cart-block .toggle__pointer {
    position: absolute;
    top: -6px;
    left: 0;
    width: 23px;
    height: 25px;
    border-radius: 15px;
    background-color: #ffffff;
    -webkit-transition: left .15s ease-out;
    transition: left .15s ease-out;
}
.box .chart1 {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: 12px;
    line-height: 108px;
    height: 160px;
    color: #300808;
    top: -13px;
}

.box canvas {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  width: 100%;
}
.coupen-img h2 {
    font-size: 14px;
    font-weight: 600;
    color: #031b26;
    font-family: 'Open Sans', sans-serif;
    position: relative;
    left: 9px;
    /* top: 9px; */
    top: -13px;
}
    </style>
</head>
<body>
<?php include('common/header.php') ?>
<div class="outside-cart-block">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-9 col-12">
				<?php $totalAED=0; foreach ($this->cart->contents() as $items) { 
					
					$totalAED = $totalAED + (int)$items['qty'] * (int)$items['other']['aed'];
					?>
				<div class="user-cart">
					<div class="cart-box">
						<div class="table-responsive cart-table">
							<table class="table">
								<tbody>
									<tr>
										<td width="20%">
											<div class="cart-product">
												<img src="<?=base_url().$items['other']['image']?>" class="img-fluid" alt="">
											</div>
										</td>
										<td width="50%">
											<div class="table-hd">
												<h3><?=$items['name']?></h3>
												<h5><?=strip_tags($items['other']['description'])?></h5>
											</div>
											<ul>
												<li>
													<div class="number">
													<span data-id='<?=$items['other']['aed']?>___<?=$items['rowid']?>___D' class="minus qtyA">-</span>
														<input type="number" min="1" id="qty" name="qty" value="<?=$items['qty']?>">
													<span data-id='<?=$items['other']['aed']?>___<?=$items['rowid']?>___I' class="plus qtyA">+</span>
													</div>
												</li>
												<li>
													<a href="<?=base_url('remove-item/').$items['rowid']?>" class="remove-item"> Remove </a>
												</li>
											</ul>
										</td>
										<td>
											<div class="inquiry-and-buy">
												<?php $total = $items['other']['aed'] * $items['qty']	?>
												<p id="<?=$items['rowid']?>">AED<?=$total?>.00</p>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="donate-footer" id="toggles">
							<div class="row">
								<div class="col-lg-9 col-md-9 col-12">
									<p>Donate these product(s) to double ticket(s)</p>
								</div>
								<div class="col-lg-3 col-md-3 col-12">
									<div class="toggle" id="toggle">
										<input type="radio" value="on" name="radio">
										<input type="radio" value="off" name="radio">
										<div class="toggle__pointer"></div>
									</div>
									<!-- <input type="hidden" name="rowid" id="rowid" value="<?=$items['rowid']?>"> -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="related-product">
					<h3 class="default-heading">People have also bought this together</h3>
					<div class="row">
						<?php foreach ($products as $key => $value) { ?>
						<div class="col-lg-4 col-md-4 col-12">
							<a href="<?=base_url('product-details/').base64_encode($value['products_id'])?>">
							<div class="slide-product-box">
								<div class="coupen-img">
									<div class="box">
                                        <div class="chart1 easyPieChart" data-percent="72" style="width: 70px; height: 70px; line-height: 70px;">72%<canvas width="70" height="70"></canvas></div>
                                        	
                                      </div>
                                      <h2 class="textes">Sold Out </h2>
								</div>
								<div class="product-img">
									<img src="<?=base_url().$value['product_image']?>" class="img-fluid" alt="">
								</div>
								<div class="product-des">
									<p>Get a chance to win:</p>
									<h4><?=$value['title']?></h4>
									<h5>AED<?=number_format($value['adepoints'], 2)?></h5>
									<!-- <a href="#" class="default-btn">Add To Cart</a> -->
								</div>
							</div>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-12">
				<div class="coupen-box">
					<div class="table-responsive">
						<table class="table">
							<tbody><tr>
								<td>Total Before VAT</td>	
								<td class="text-right" id="subTotal">AED<?=$totalAED?>.00</td>	
							</tr>
							<tr>
								<td>VAT 5 %</td>	
								<td class="text-right" id="vat">AED<?php $disc = $totalAED * 5/100; echo $disc ?></td>	
							</tr>
							<tr>
								<td>Subtotal</td>	
								<td class="text-right" id="subTotalAmt">AED<?=$totalAED+$disc?></td>	
							</tr>
						</tbody></table>
					</div>
				</div>
				<div class="promo-code">
					<!-- <h5>Promo code</h5>
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Enter Promo Code">
					</div> -->
					<a href="<?=base_url('sign-up')?>" class="color-default-btn float-right">Pay Now</a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('common/footer.php') ?>
<?php include('common/footer_script.php') ?>

<!-- Animation Js -->
<script>
$(document).ready(function() {
$("#mobile").inputFilter(function(value) {
return /^\d*$/.test(value);    // Allow digits only, using a RegExp
});

$("#name").inputFilter(function(value) {
return /^[a-zA-Z-'. ]*$/.test(value);    // Allow digits only, using a RegExp
});
$("#message").inputFilter(function(value) {
return /^[a-zA-Z-'.@,()/^\d ]*$/.test(value);    // Allow digits only, using a RegExp
});
});
</script>
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
<script>
	var boxes = document.querySelectorAll('input[type="radio"]');
	boxes = Array.prototype.slice.call(boxes);

	boxes.forEach(function(box) {
	  box.addEventListener('change', function(e) {
		 //alert(e.currentTarget.value);
	  });
	});
</script>
<script>
$(document).ready(function(){
	$('.qtyA').click(function(){
		var data 	= $(this).data('id');
		var ur = '<?=base_url()?>';
		var totalID = data.split("___");
		$.ajax({
			url : ur+ "shopping_cart/addqty",
			method: "POST", 
			data: {data: data},
			success: function(data1){
				//alert(data1)
				var totalVAL = data1.split("__");
				var A = 'AED'+totalVAL[0]
				var B = 'AED'+totalVAL[1]
				var C = 'AED'+totalVAL[2]
				var D = 'AED'+totalVAL[3]
				//alert(VAT);
				$('#'+totalID[1]).empty().append(A);
				$('#subTotal').empty().append(B);
				$('#vat').empty().append(C);
				$('#subTotalAmt').empty().append(D);
				

				
			}
		});
	});
});
</script>
<script>
   
$("#toggle").val("on").change(background-color:green);
</script>
<script>
$(function() {
  $('.chart').easyPieChart({
    size: 70,
   barColor: "#c02728",
    
    lineWidth: 6,
    trackColor: "#98fb987d",
    lineCap: "circle",
    animate: 2000,
  });
});
    $(function() {
  $('.chart1').easyPieChart({
    size: 70,
    barColor: "#c02728",
    
    lineWidth: 6,
    trackColor: "#98fb987d",
    lineCap: "circle",
    animate: 2000,
  });
});
</script>
</body>
</html>
