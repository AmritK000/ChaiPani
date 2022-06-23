<?php //print_r($products); die(); ?>

<!Doctype html>
<html lang="eng">
<head>
	<!-- Basic page needs -->	
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php include('common/head.php') ?>
    <style>
    .slide-product-box .product-des p{
	font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
	text-align:center;
	color: #6c757d;
	margin-bottom:5px;
	 white-space: nowrap !important;
    overflow: hidden !important;
    text-overflow: initial !important;
}
.product_list .default-heading {
    font-family: Gadugi Bold;
    text-align: center;
    font-size: 30px;
    color: #031b26;
   padding-bottom: 26px;
}
.explore-product-box .product-des p {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    line-height: 22px;
    font-weight: 400;
    text-align: left;
   	color: #6c757d;
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
.heading_product{
   padding-bottom: 5px !important;
    padding-top: 23px !important; 
}
.fa-share:hover{
  color: #d12a2b !important;   
}
.share i:hover {
    color: #d12a2b !important;
}
.hearts a:hover{
    color: #d12a2b !important;
}
.fa-share:hover{
  color: #d12a2b !important;   
}
.share i:hover {
    color: #d12a2b !important;
}
.heart_icon{
   color: rgb(209 209 209);
   font-size: 20px;
}
.fa-heart:hover {
    color: #d12a2b !important;
}
.explore-product-box {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    margin-top: 25px;
    height: 284px;
}
.product_list {
    padding-top: 115px;
    padding-bottom: 50px;
}
.box {
    width: 8%;
    position: relative;
    top: -30px;
}

 .box h2 {
  display: block;
  text-align: center;
  color: black;
  position: relative;
    top: -23px;
    left: 13px;

}
.slide-product-box .h2{
    left: 13px !important;
}
.explore-product-box .action-block .coupen-img .textes {
   position: relative;
    top: -17px;
    left: 41px !important;
    font-size: 14px;
    font-weight: 600;
    color: #031b26;
    font-family: 'Open Sans', sans-serif;
}
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
.box .chart1 {
    position: relative;
    width: 100%;
    height: 100%;
    text-align: center;
    font-size: 12px;
    line-height: 108px;
    height: 160px;
    color: #300808;
    top: 18px;
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
	.edit_cart {
   background: #c42828;
    border: 1px solid #ec2d2f;
    padding: 6px 25px;
    border-radius: 8px;
    color: #fff;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    margin-top: 0px;
    width: 100%;
}
.edit_cart:hover {
    background: #ffffff;
    color: #e70909;
}
.white-btn:hover{
    background: #d12a2b !important;
     color: #fff !important;
}
.white-btn {
    padding: 6px 15px;
    border: 1px solid #e0e0e0 !important;
    background: #fff !important;
    color: #363636;
    border-radius: 8px;
    color: #363636;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
}
.default-btn {
    background: #e72d2e00 !important;
    border: 1px solid #d12a2b !important;
    padding: 4px 25px !important;
    border-radius: 8px;
    color: #d12a2b !important;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
}
.default-btn:hover{
 background:#d12a2b !important;
    color:#fff !important;  
}
.share {
    content: "\f1e0";
    color: rgb(209 209 209 / 53%);
    font-size: 18px;
    padding-left: 5px;
}
.fa-heart:before {
    content: "\f004";
    font-size: 26px;
}
.explore-product-box .product-des {
    text-align: left;
    width: 542px;
}
.heart{
  display:flex;  
}
.product{
    width:100%;
    padding-bottom: 40px;
    padding-top: 13px;
}
.fa-heart.active {
  color: #d12a2b !important;
}
    </style>
</head>
<body>
<?php include('common/header.php') ?>
<div class="product_list">
	<div class="container">
	     <div class="row">
			<div class="col-lg-12 col-md-12 col-12">
			<img src="assets/img/Product-banner.jpg" class="product">
			</div>
		</div>
	    	<div class="row">
			<div class="col-lg-12 col-md-12 col-12">
				<h3 class="default-heading">Our Products</h3>
			</div>
		</div>
	   
	
		<div class="row">
		<?php foreach ($closing_soon as $key => $items) { ?>
		<div class="col-lg-3 col-md-6 col-12">
		<div class="item">
			<div class="slide-product-box">
				<a href="<?=base_url('product-details/'.base64_encode($items['products_id']))?>">
				<div class="coupen-img">
					<div class="">
						<?php
					    $avlstock = $items['stock'] * 100 / $items['totalStock'];
					    $remStick = 100 - $avlstock;
						?>
					    <div class="box">
                            <div class="chart1" data-percent="<?=number_format($remStick,0)?>" ><?=number_format($remStick,0)?>%</div>
                        </div>
					</div>
					<h2 class="textes">Sold Out</h2>
				</div>
				<div class="product-img">
					<img src="<?=base_url().$items['product_image']?>" class="img-fluid" alt="">
				</div>
				</a>
				<div class="product-des">
					<p>Get a chance to win:</p>
					<h4><?=$items['title']?></h4>
					<h5>AED <?=number_format($items['adepoints'],2)?></h5>
					<?php
				if($this->session->userdata('DZL_USERID')){
					$wcon1['where'] = [	
						'user_id' 	=> 	(int)$this->session->userdata('DZL_USERID'),
						'id' =>	(int)$items['products_id'] 
					];
					$check = $this->geneal_model->getData2('count','da_cartItems',$wcon1);
					if($check == 0){ ?>
						<button class="default-btn addremove add_cart" data-id='<?=$items['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
					<?php }else{ ?>
						<button class=" addremove edit_cart" data-id='<?=$items['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
					<?php }
				}else{ 
					if(!empty($this->cart->contents())){
						$check = $this->geneal_model->checkCartItems($items['products_id']);	
					}else{
						$check = 0;
					}
					if($check == 1){ //echo $check; ?>
						<button class=" addremove edit_cart" data-id='<?=$items['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button> 
					<?php }else{ //echo $check; ?>
						<button class="default-btn addremove add_cart" data-id='<?=$items['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
				<?php } }	?>

				</div>
			</div>
		</div>
		</div>
		<?php } ?>
		
		</div> 
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12">
				<h3 class="default-heading heading_product">Our Campaigns</h3>
			</div>
		</div>
		
		<div class="row">
			<?php foreach ($products as $key => $item) { ?>
			<div class="col-lg-6 col-md-6 col-12">
				<div class="explore-product-box">
					<div class="row">
						<div class="col-lg-5 col-md-5 col-12">
							<div class="product-img">
								<img src="<?=base_url().$item['product_image']?>" class="img-fluid" alt="">
							</div>
						</div>
						<div class="col-lg-7 col-md-7 col-12 heart">
							<div class="product-des">
								<p>Get a chance to win:</p>
								<h4><?=$item['title']?></h4>
							<p><?=substr(strip_tags($item['description']),0,150)?>...</p>
								<h5>AED <?=$item['adepoints']?>.00</h5>
							</div>
							<div class="heaarts">
								<a href="javascript:void();" name="wishlist" data-id="<?=$item['products_id']?>" class="heart_icon">
									<?php 
										$prowhere['where']				=	array('users_id'=>(int)$this->session->userdata('DZL_USERID'),'product_id'=>(int)$item['products_id']);
										$prodData						=	$this->common_model->getData('single','da_wishlist',$prowhere);
										if($prodData):if($prodData['wishlist_product'] <> 'Y'):?>
											<i class="far fa-heart heart_icon" title="Mark Favourite"></i>
										<?php else:?>
											<i class="far fa-heart heart_icon active" title="Remove from Favourite"></i>
										<?php endif;?>
									<?php else:?>
										<i class="far fa-heart heart_icon" title="Mark Favourite"></i>
									<?php endif;?>
								</a>
								<?php 
									if($this->session->userdata('DZL_USERID')): 
									   if($this->session->userdata('DZL_USERSTYPE') == 'Users' && $this->session->userdata('DZL_USERS_REFERRAL_CODE')):
										$productShareUrl  = generateProductShareUrl($item['products_id'],$this->session->userdata('DZL_USERID'),$this->session->userdata('DZL_USERS_REFERRAL_CODE'));
									?>
										<a href="javascript:void(0);" class="share" data-toggle="modal" data-target="#shareModal<?php echo $item['products_id']; ?>"><i class="fas fa-share" title="Share Campaigns" ></i></a>
										<!-- Modal -->
										<div class="modal fade" id="shareModal<?php echo $item['products_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999;margin-top: 10%;">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel"><?php echo lang('SHARE_POPUP_HEADING'); ?></h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body">
										        <input type="text" id="copyShareInput<?php echo $item['products_id']; ?>" class="copyShareUrlInput" value="<?php echo $productShareUrl; ?>" style="width:100%">
										        <br>
												<button class="copyShareUralToClipBoard">Copy url</button>
										      </div>
										    </div>
										  </div>
										</div>
									<?php else: ?>
										<a href="javascript:void(0);" class="share"><i class="fas fa-share" title="Share Campaigns" ></i></a>
									<?php endif; ?>
								<?php else: ?>
									<a href="javascript:void(0);" class="share userLoginError"><i class="fas fa-share" title="Share Campaigns" ></i></a>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
						
					<div class="action-block">
						<div class="row">
							<div class="col-lg-9 col-md-9 col-12">
								<ul>
									<li>
										<!-- <a href="#" class="default-btn">Add To Cart</a> -->
										<?php
									if($this->session->userdata('DZL_USERID')){
										$wcon1['where'] = [	
											'user_id' 	=> 	(int)$this->session->userdata('DZL_USERID'),
											'id' =>	(int)$item['products_id'] 
										];
										$check = $this->geneal_model->getData2('count','da_cartItems',$wcon1);
										if($check == 0){ ?>
											<button class="default-btn addremove add_cart" data-id='<?=$item['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
										<?php }else{ ?>
											<button class=" addremove edit_cart" data-id='<?=$item['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
										<?php }
									}else{ 
										if(!empty($this->cart->contents())){
											$check = $this->geneal_model->checkCartItems($item['products_id']);	
										}else{
											$check = 0;
										}
										if($check == 1){ //echo $check; ?>
											<button class=" addremove edit_cart" data-id='<?=$item['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button> 
										<?php }else{ //echo $check; ?>
											<button class="default-btn addremove add_cart" data-id='<?=$item['products_id']?>' id="add_cart">Add <i class="fas fa-shopping-cart" aria-hidden="true"></i></button>
									<?php } }	?>
									</li>
									<li>
										<a href="<?=base_url('product-details/'.base64_encode($item['products_id']))?>" class=" white-btn">Prize Details</a>
									</li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-3 col-12">
								<div class="coupen-img">
									<div class="">
									<?php
								    $avlstock = $item['stock'] * 100 / $item['totalStock'];
								    $remStick = 100 - $avlstock;
									?>
								    <div class="box">
    									<div class="chart" data-percent="<?=number_format($remStick,0)?>" ><?=number_format($remStick,0)?>%</div>
  									</div>
								</div>
								<h2 class="textes">Sold Out </h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php include('common/footer.php') ?>
<?php include('common/footer_script.php') ?>
<!-- Animation Js -->
<script>
AOS.init({
duration: 1200,
})
</script>
<script>
/* TOP Menu Stick
--------------------- */
var s = $("#sticker");
var pos = s.position();					   
$(window).scroll(function() {
var windowpos = $(window).scrollTop();
if (windowpos > pos.top) {
s.addClass("stick");
} else {
s.removeClass("stick");	
}
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
$(document).ready(function(){
$(document).on("click", "button[id='add_cart']", function () {
var product_id = $(this).attr('data-id');
var curobj = $(this);
curobj.html("Added To Cart");

curobj.addClass('edit_cart');
curobj.removeClass('add_cart');

var ur = '<?=base_url()?>';
$.ajax({
url : ur+ "shopping_cart/add",
method: "POST", 
data: {product_id: product_id},
success: function(data){
//alert(data);
var A = '<b><i class="fas fa-shopping-cart"></i>('+data+')</b>'
//var B = '<button class="default-btn white-btn">Added to cart </button>'
$('#cartA').empty().append(A)
//$('#'+product_id).empty().append(B)
}
});
});
});
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
<script>
	$(document).on('click','.copyShareUralToClipBoard',function(){
	 	/* Get the text field */
	  	var copyText = $(this).parent('.modal-body').find('.copyShareUrlInput');

	  	/* Select the text field */
		copyText.select();
		//copyText.setSelectionRange(0, 99999); /* For mobile devices */

		/* Copy the text inside the text field */
		navigator.clipboard.writeText(copyText.val());

		/* Alert the copied text */
	  	//alert("Copied the text: " + copyText.val());
	});
	$(document).on('click','.userLoginError',function(){
		alert('<?php echo lang('SHARE_LOGIN_ERROR'); ?>');
	});
</script>
<script>
	$(document).ready(function () {
		$(document).on("click", "a[name='wishlist']", function () {
			var userId = '<?php echo $this->session->userdata('DZL_USERID')?>';
			if(userId == '')
			{
				alert('Please login in order to add to wishlist');
			}
			var product_id = $(this).attr('data-id');
			var curobj = $(this);
			var ur = '<?=base_url()?>';
			$.ajax({
				url: ur + 'add-to-wishlist',
				type: "POST",
				data: {
					'product_id': product_id
				},
				cache: false,
				success: function (result) {
					if (result == 'addedtowishlist') {
						curobj.html('<i class="far fa-heart heart_icon active" title="Remove from Favourite"></i>');
					} else if (result == 'removedfromwishlist') {
						curobj.html('<i class="far fa-heart heart_icon" title="Mark Favourite"></i>');
					}
				}
			});
		});
	});
</script>
</body>
</html>
