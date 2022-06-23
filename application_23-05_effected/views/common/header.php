<style>
.login {
    border-color: #d5d4d4;
    border-width: 2px;
    font-weight: 700;
    border: 1px solid rgb(209 209 209);
    padding: 4px 43px 2px !important;
    border-radius: 22px;
    height: 36px;
    color: #e22c2d;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    /* color: #020202; */
    font-weight: 700;
    margin-top: 3px;
    margin-left: 13px;
}
.head-nav-third {
    background: #fff;
    padding: 9px 15px 9px;
    border-bottom: 1px solid #d4d4d4;
    border-radius: 10px;
}
.login:hover{
    border-color: #d5d4d4;
    border-width: 2px;
    font-weight: 700;
    border: 2px solid #e22c2d;
    padding: 4px 43px 2px !important;
    border-radius: 22px;
    height: 36px;
    color: #f8f9fa;
    font-family: 'Open Sans', sans-serif;
    font-size: 15px;
    /* color: #020202; */
    font-weight: 700;
    margin-top: 3px;
    margin-left: 13px;
    background-color: #e22c2d;
}
.linkes {
    background-color: #d0464600;
    color: #d04646;
    width: 89px;
    text-align: center;
    line-height: 12px;
    border: 1px solid gray;
    border-radius: 50px;
    height: 28px;
    /* top: 24px; */
    padding-top: 6px;
    position: relative;
    top: 8px;
    margin-left: 11px;
}
.head-nav-third ul li:hover a {
    color: #d42a2b;
}
.linkes:hover{
 color: #d42a2b;   
}
.big_cart{
    color: transparent;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: #45454575;
    font-size: 13px;
}
</style>
<div class="top-header" id="sticker">
	<div class="container">
		<header>
			<div class="head-nav-third">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-md-12 col-12">
						<nav class="navbar navbar-expand-lg">
							<a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url('assets')?>/img/logo.png" class="img-fluid" alt=""/></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
								<i class="fal fa-bars"></i>
							</button>
							<div class="collapse navbar-collapse" id="collapsibleNavbar">
								<ul class="navbar-nav mr-auto">
									<li class="nav-item">
										<a class="nav-link" href="<?=base_url('our-products')?>">Our Product</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="<?=base_url('winners-list')?>"> Winners</a>
									</li>
								</ul>
								<ul class="navbar-nav ml-auto">
									<li class="nav-item headerneed-help">
										<a class="nav-link" href="<?=base_url('contact-us')?>">Need Help? <!-- Contact us: <span>Call 0800-IDEALZ </span> --></a>
									</li>
									
									<li class="nav-item dropdown">
										<div class="currency-switcher">
											<div class="dropdown">
												<div class="caption">
												  <img src="<?=base_url('assets')?>/img/flags.png" class="img-fluid" alt="">
												  <span>UAE</span>
												</div>
												<!--<div class="list">
												  <div class="item selected" data-item="RUB">
													<img src="<?=base_url('assets')?>/img/flags.png" class="img-fluid" alt="">
													<span>AED</span>
												  </div>
												  <div class="item" data-item="UAH">
													<img src="<?=base_url('assets')?>/img/flags.png" class="img-fluid" alt="">
													<span>UAH</span>
												  </div>
												  <div class="item" data-item="USD">
													<img src="<?=base_url('assets')?>/img/flags.png" class="img-fluid" alt="">
											     <span>AED</span>
												  </div>
												</div>-->
											</div>
										</div>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="#"><b> العربية  </b></a>
									</li> 
									<li class="nav-item">
										<a class="nav-link" id="cartA" href="<?=base_url('shopping-cart')?>"><b><i class="fas fa-shopping-cart"></i>(<?=@count($this->cart->contents())?>)</b></a>
									</li> 
									<?php if($this->session->userdata('DZL_USERID')){ ?>
									<li class="nav-item dropdown">
										<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
											<?=@$this->session->userdata('DZL_USERNAME')?> <i class="fas fa-user-circle"></i>
										</a>
									  <div class="dropdown-menu">
										<a class="dropdown-item" href="<?=base_url('my-profile')?>">My Profile</a>
										<!-- <a class="dropdown-item" href="<?=base_url('my-profile')?>">Account</a> -->
										<a class="dropdown-item" href="<?=base_url('logout')?>" onClick="return confirm('Want to Logout!');" >Logout</a>
									  </div>
									</li>  
									<?php }else{ ?> 
										<a class="nav-link linkes" href="<?=base_url('login')?>">
											Login </a>
									<?php } ?>
								</ul>
							</div>  
						</nav>
					</div>
				</div>
			</div>
		</header>
	</div>
</div>
