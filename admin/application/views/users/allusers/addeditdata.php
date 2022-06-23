<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
$(function(){
   $("#date").datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true,yearRange:"1970:<?php echo date('Y')?>"});
});
</script>
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <?php /* ?>
                            <h5 class="m-b-10">Welcome <?=sessionData('HCAP_ADMIN_FIRST_NAME')?></h5>
                            <?php */ ?>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo getCurrentDashboardPath('dashboard/index'); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo correctLink('ALLSALESDATA',getCurrentControllerPath('index')); ?>"> User</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><?=$EDITDATA?'Edit':'Add'?> User</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5><?=$EDITDATA?'Edit':'Add'?> User</h5>
                        <a href="<?php echo correctLink('ALLSALESDATA',getCurrentControllerPath('index')); ?>" class="btn btn-sm btn-primary pull-right">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="basic-login-inner">
                            <form id="currentPageForm" name="currentPageForm" class="form-auth-small" method="post" action="" enctype="multipart/form-data">
                                <input type="hidden" name="CurrentFieldForUnique" id="CurrentFieldForUnique" value="users_id"/>
                                <input type="hidden" name="CurrentIdForUnique" id="CurrentIdForUnique" value="<?=$EDITDATA['users_id']?>"/>
                                <input type="hidden" name="CurrentDataID" id="CurrentDataID" value="<?=$EDITDATA['users_id']?>"/>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                <div class="row">
                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('users_name')): ?>error<?php endif; ?>">
                                        <label>Name<span class="required">*</span></label>
                                        <input type="text" name="users_name" id="users_name" class="form-control required" value="<?php if(set_value('users_name')): echo set_value('users_name'); else: echo stripslashes($EDITDATA['users_name']);endif; ?>" placeholder="Name">
                                        <?php if(form_error('users_name')): ?>
                                        <span for="name" generated="true" class="help-inline"><?php echo form_error('users_name'); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('category_id')): ?>error<?php endif; ?>">
                                    <label>User Type<span class="required">*</span></label>
                                    <select name="user_type" id="user_type" class="form-control required">
                                        <option >Select user type</option>
                                        
                                        <option value="Sales Person" <?php if ($EDITDATA['users_type'] == 'Sales Person') {?> selected <?php } ?>>Sales Person</option>
                                        
                                        <option value="Retailer" <?php if ($EDITDATA['users_type'] == 'Retailer') {?> selected <?php } ?>>Retailer</option>

                                        <option value="Users" <?php if ($EDITDATA['users_type'] == 'Users') {?> selected <?php } ?>>Users</option>
                                    </select>
                                    <?php if(form_error('user_type')): ?>
                                      <span for="user_type" generated="true" class="help-inline"><?php echo form_error('user_type'); ?></span>
                                    <?php endif; ?>
                                  </div>
                                </div>
                                <div class="row" id="store">
                                    <div class="form-group-inner col-lg-12 col-md-12 col-sm-12 col-xs-12 <?php if(form_error('store_name')): ?>error<?php endif; ?>">
                                        <label>Store Name<span class="required">*</span></label>
                                        <input type="text" name="store_name" id="store_name" class="form-control required" value="<?php if(set_value('store_name')): echo set_value('store_name'); else: echo stripslashes($EDITDATA['store_name']);endif; ?>" placeholder="Name">
                                        <?php if(form_error('store_name')): ?>
                                        <span for="name" generated="true" class="help-inline"><?php echo form_error('store_name'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                    
                                <div class="row">

                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('users_email')): ?>error<?php endif; ?>">
                                        <label>Email<span class="required">*</span></label>
                                        <input type="users_email" name="users_email" id="users_email" class="form-control required" value="<?php if(set_value('users_email')): echo set_value('users_email'); else: echo stripslashes($EDITDATA['users_email']);endif; ?>" placeholder="Email">
                                        <span style="color: red;" id="validationError"></span>
                                        <?php if(form_error('users_email')): ?>
                                        <span for="users_email" generated="true" class="help-inline"><?php echo form_error('users_email'); ?></span>
                                        <?php endif; ?>
                                    </div>


                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('users_mobile')): ?>error<?php endif; ?>">
                                        <label>Mobile<span class="required">*</span></label>
                                        <input type="number" min="0" name="users_mobile" id="users_mobile" class="form-control required" value="<?php if(set_value('users_mobile')): echo set_value('users_mobile'); else: echo stripslashes($EDITDATA['users_mobile']);endif; ?>" placeholder="Mobile No.">
                                        <span style="color: red;" id="m_validationError"></span>
                                        <?php if(form_error('users_mobile')): ?>
                                        <span for="users_mobile" generated="true" class="help-inline"><?php echo form_error('users_mobile'); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('totalArabianPoints')): ?>error<?php endif; ?>">
                                        <label>Total Arabian Points<span class="required">*</span></label>
                                        <input type="number" min="0" name="totalArabianPoints" id="totalArabianPoints" class="form-control required" value="<?php if(set_value('totalArabianPoints')): echo set_value('totalArabianPoints'); else: echo stripslashes($EDITDATA['totalArabianPoints']);endif; ?>" placeholder="Total Arabian Points" <?php 
                                        if($EDITDATA['totalArabianPoints']){ ?>
                                            readonly
                                        <?php } ?> >
                                        <?php if(form_error('totalArabianPoints')): ?>
                                        <span for="totalArabianPoints" generated="true" class="help-inline"><?php echo form_error('totalArabianPoints'); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('availableArabianPoints')): ?>error<?php endif; ?>">
                                        <label>Available Arabian Points<span class="required">*</span></label>
                                        <input type="number" min="0" name="availableArabianPoints" id="availableArabianPoints" class="form-control required" value="<?php if(set_value('availableArabianPoints')): echo set_value('availableArabianPoints'); else: echo stripslashes($EDITDATA['availableArabianPoints']);endif; ?>" placeholder="Available Arabian Points" <?php 
                                        if($EDITDATA['availableArabianPoints']){ ?>
                                            readonly
                                        <?php } ?> >
                                        <?php if(form_error('availableArabianPoints')): ?>
                                        <span for="availableArabianPoints" generated="true" class="help-inline"><?php echo form_error('availableArabianPoints'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(empty($EDITDATA['password'])){ ?>
                                    <div class="row">
                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('password')): ?>error<?php endif; ?>">
                                        <label>Password<span class="required">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control required" value="<?php if(set_value('password')): echo set_value('password'); else: echo stripslashes($EDITDATA['password']);endif; ?>" placeholder="Password">
                                        <?php if(form_error('password')): ?>
                                        <span for="password" generated="true" class="help-inline"><?php echo form_error('password'); ?></span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group-inner col-lg-6 col-md-6 col-sm-6 col-xs-12 <?php if(form_error('cpassword')): ?>error<?php endif; ?>">
                                        <label>Confirm Password<span class="required">*</span></label>
                                        <input type="password" name="cpassword" id="cpassword" class="form-control required" value="<?php if(set_value('cpassword')): echo set_value('cpassword'); else: echo stripslashes($EDITDATA['cpassword']);endif; ?>" placeholder="Confirm Password">
                                        <?php if(form_error('cpassword')): ?>
                                        <span for="cpassword" generated="true" class="help-inline"><?php echo form_error('cpassword'); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php } ?>
                                
                    
                                <div class="row">
                                    <div class="login-btn-inner col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="inline-remember-me mt-4">
                                            <input type="hidden" name="SaveChanges" id="SaveChanges" value="Yes">
                                            <button class="btn btn-primary mb-4">Submit</button>
                                            <a href="<?php echo correctLink('ALLSALESDATA',getCurrentControllerPath('index')); ?>" class="btn btn-danger has-ripple mb-4">Cancel</a>
                                            <span class="tools pull-right">Note:- <strong><span style="color:#FF0000;">*</span> Indicates Required Fields</strong> </span> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>

<script>
$(document).ready(function(){
var b = $('#user_type'). val();
if(b == 'Retailer'){ $("#store").show();}
else{ $("#store").hide(); }
$("#user_type").change(function(){
var a = $(this).val();
//alert(a);
if(a == 'Retailer'){ $("#store").show();}
else{ $("#store").hide(); }
});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
$('#users_email').change(function(){
var user = $(this).val();
var ur      = '<?=base_url().'/users/allusers/checkDeplicacy'?>';
$.ajax({
url : ur,
method: "POST", 
data: {user: user},
success: function(data){
$('#validationError').empty().append(data);
}
});
});

$('#users_mobile').change(function(){
var user = $(this).val();
var ur      = '<?=base_url().'/users/allusers/checkDeplicacy'?>';
$.ajax({
url : ur,
method: "POST", 
data: {user: user},
success: function(data){
$('#m_validationError').empty().append(data);
}
});
});

});


</script>


<script type="text/javascript">
//  $(function(){create_editor_for_textarea('description')});
//  $(function(){create_editor_for_textarea('image')});
</script>