<?php //echo "<pre>"; print_r($cartItems); die(); ?>
<!Doctype html>
<html lang="eng">

<head>
<!-- Basic page needs -->
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<?php include('common/head.php') ?>
    <style>
    .my-profile .toggle {
    position: relative;
    height: 14px;
    width: 50px;
    border-radius: 15px;
    background: #ddd;
    margin: 8px 0;
    float: right;
}
.user-cart .cart-box table h5 {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    line-height: 22px;
    font-weight: 400;
    text-align: left;
    color: #6c757d;
    margin-bottom: 0;
}
.my-profile p {
    margin: 0;
    color: #fff;
}
.my-profile .toggle input:nth-child(2):checked {
    z-index: 1;
}
.fa-trash:before {
    content: "\f1f8";
    color: #a62323;
    font-size: 19px;
}
.my-profile  .toggle input:nth-child(2):checked + .toggle__pointer {
  left: 22px;
  background-color: #fff;
}
.my-profile .toggle input:nth-child(2):checked + .toggle__pointer {
    left: 22px;
    background-color: #fff;
}
.my-profile .toggle__pointer {
    position: absolute;
    top: -6px;
    left: 0;
    width: 25px;
    height: 24px;
    border-radius: 15px;
    background-color: #ffffff;
    -webkit-transition: left .15s ease-out;
    transition: left .15s ease-out;
}
.my-profile .toggle input {
    opacity: 0;
    width: 100%;
    height: 200%;
    position: absolute;
    top: -7px;
    left: 0;
    z-index: 2;
    margin: 0;
}
.my-profile .toggle {
    position: relative;
    height: 14px;
    width: 50px;
    border-radius: 15px;
    background: #ddd;
    margin: 8px 0;
    float: right;
}
.my-profile .donate-footer {
    background: #e72d2e;
    padding: 5px 30px;
    border-radius: 0 0 8px 8px;
    margin-top: 0px;
    z-index: 2;
    position: relative;
}
        .change_passworded{
         text-align: end;
         padding: 20px;   
        }
        .activess{
background-color:green !important;
}
.user-cart .cart-box table p {
    font-family: 'Open Sans', sans-serif;
    font-size: 13px;
    font-weight: 600;
    margin: 0;
    margin-bottom: 5px;
    color: #ebebeb;
    margin: 0px;
    padding-top: 4px;
}
.change_passworded {
    text-align: end;
    padding: 10px 0px 20px;
}
.my-profile .btn:hover{
background: #e72d2e;
    color: #ffffff;
}
.my-profile .btn{
    background: #ffffff;
    border: 1px solid #e72d2e;
    padding: 4px 25px !important;
    border-radius: 8px;
    color: #e72d2e;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    font-weight: 400;
    margin-top: 0px;
}
    </style>
    </head>

<body>
<?php include('common/header.php') ?>
<!-- profile -->
<div class="my-profile">
	<div class="container">
		<div class="row">
			<?php include ('common/profile/menu.php') ?>
			<div class="col-md-9">
				<?php include ('common/profile/head.php') ?>
				<div class="users_form user-cart">
					<?php if ($this->session->flashdata('error')) { ?>
					<label class="alert alert-danger" style="width:100%;"><?=$this->session->flashdata('error')?></label>
					<?php } ?>
					<?php if ($this->session->flashdata('success')) { ?>
					<label class="alert alert-success" style="width:100%;"><?=$this->session->flashdata('success')?></label>
					<?php  } ?>
					<div class="profiles">
						<h4 class="information">My Cart</h4> 
					</div>
					<?php if(!empty($cartItems)){ ?>
					<div class="cart-box">
					    
					    
						<div class="table-responsive cart-table">
							<table class="table">
								<tbody>
									<?php  foreach($cartItems as $items) { ?>
									<tr>
										<td width="20%">
											<div class="cart-product">
												<img src="<?=strip_tags($items['other']->image)?>" class="img-fluid" alt="">
											</div>
										</td>
										<td width="50%">
											<div class="table-hd">
												<h3><?=$items['name']?></h3>
												<h5><?=strip_tags($items['other']->description)?></h5>
											</div>
											<ul>
												<li>
													<div class="number">
														<span data-id="<?=$items['other']->aed?>___<?=$items['rowid']?>___D" class="minus qtyA">-</span>
														<input type="number" id="qty" value="<?=$items['qty']?>">

														<span data-id="<?=$items['other']->aed?>___<?=$items['rowid']?>___I" class="plus qtyA">+</span>
													</div>
												</li>
												<li>
													<a href="<?=base_url('remove-item/').$items['rowid']?>"><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>
												
												</li>
											</ul>
										</td>
										<td width="20%">
											<div class="inquiry-and-buy">
												<?php 
												$total = $items['qty'] * $items['other']->aed;
												?>
												<p id="<?=$items['rowid']?>">AED <?=$total?>.00</p>
											</div>
										</td>
									</tr>
								
									<tr>
									   <td colspan="4" style="padding:0px 0px 10px !important">	<div class="donate-footer">
								<div class="row">
									<div class="col-lg-9 col-md-9 col-12">
										<p>Donate these product(s) to double ticket(s)</p>
									</div>
									<div class="col-lg-3 col-md-3 col-12">
										<div class="toggle">
											<input type="radio" value="on" name="radio">
											<input type="radio" value="off" name="radio">
											<div class="toggle__pointer"></div>
										  </div>
									</div>
								</div>
							</div>
							</td>
						
									</tr>
								
									<?php } ?>
								</tbody>
							</table>
						</div>
					
						<div class="col-md-12">
						<div class="change_passworded">
						
						 <!--<button class="btn">PayNow</button>-->
						 <a class="btn" href="<?php echo base_url();?>checkout">Paynow</a>
						 </div>
					</div>
					
					
					</div>
				<?php }else{ ?>
					<h4 style="text-align: center;">Your cart is empty.</h4>
				<?php } ?>
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
	$('.qtyA').click(function(){
		var data 	= $(this).data('id');
		var ur 		= '<?=base_url()?>';
		var totalID = data.split("___");
		//alert(totalID);
		$.ajax({
			url : ur+ "shopping_cart/addqty",
			method: "POST", 
			data: {data: data,},
			success: function(data1){
				var totalVAL = data1.split("__");
				//alert(data1);
				var A = 'AED'+totalVAL[0];
				//alert(A)
				//var B = '<b>AED'+totalVAL[3]+'<b> (Including 5% VAT.)';
				$('#'+totalID[1]).empty().append(A);
				//$('#subTOTAL').empty().append(B);
			}
		});
	});
});

</script>
<script>
    $('.toggle').on('click', function() {
  $('.donate-footer').toggleClass('activess');
});
</script>
</body>
</html>