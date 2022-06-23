<style>
footer p img {
    width: 100px;
    margin-bottom: 10px;
}
footer ul li a:hover {
    font-family: 'Open Sans', sans-serif;
    font-size: 14px;
    font-weight: 400;
    color: #d12a2b;
}
</style>
<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-12">
					<h4>Quick Links</h4>
					<ul>
					    <li><a href="<?=base_url()?>">Home</a></li>
					    <li><a href="<?=base_url('our-products')?>">Our Products</a></li>
						<li><a href="<?=base_url('about-us')?>">About</a></li>
						<li><a href="<?=base_url('login')?>">My Account</a></li>
						<li><a href="<?=base_url('winners-list')?>">Winners</a></li>
						<!--<li><a href="#">Active Tickets</a></li>-->
						
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-12">
					<h4>Customer Services</h4>
					<ul>
						<li><a href="<?=base_url('contact-us')?>">Contact Us</a></li>
						<li><a href="<?=base_url('faqs')?>">FAQs</a></li>
						<li><a href="<?=base_url('how-it-works')?>">How it Works</a></li>
						<li><a href="<?=base_url('charities')?>">Charities</a></li>
						<li><a href="<?=base_url('terms-condition')?>"> Terms & Conditions</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-12">
					<h4>Policies</h4>
					<ul>
						
						
						<li><a href="<?=base_url('privacy-policy')?>">Privacy Policy</a></li>
						<li><a href="<?=base_url('delivery-policy')?>">Delivery Policy</a></li>
						<li><a href="<?=base_url('cancellation-policy')?>">Cancellation Policy</a></li>
						<li><a href="<?=base_url('refund-policy')?>">Refund Policy</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-3 col-12">
					<h4>Download Our App </h4>
					<p><a href="#" class"app_icon"><img src="<?=base_url('assets')?>/img/gplay.png" class="img-fluid"></a> &nbsp; <br> <a class"app_icon" href="#"><img src="<?=base_url('assets')?>/img/ios.png" class="img-fluid"></a></p>
				</div>
			</div>
		</div>
	</footer>
	<div class="page-ending">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-12">
					<img src="<?=base_url('assets')?>/img/white-logo.png" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 col-md-6 col-12">
					<ul>
						<li><a href="#">Copyright© <?php echo date('Y') ?>. All Rights Reserved. </a></li>
						<li><a href="<?=base_url('user-agreement')?>"> User Agreement. </a></li>
						<li><a href="<?=base_url('privacy-policy')?>">Privacy Policy </a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>