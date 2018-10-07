<div class="container pt-70 pb-40">
  <div class="row border-bottom-black">
	<div class="col-sm-6 col-md-3">
	  <div class="widget dark">
		<img class="mt-10 mb-20" alt="" src="<?php echo base_url() ?>public/dist/images/logo-wide-white-footer.png">
		<p>203, Envato Labs, Behind Alis Steet, Melbourne, Australia.</p>
		<ul class="list-inline mt-5">
		  <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-colored mr-5"></i> <a class="text-gray" href="#">123-456-789</a> </li>
		  <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-colored mr-5"></i> <a class="text-gray" href="#">contact@yourdomain.com</a> </li>
		  <li class="m-0 pl-10 pr-10"> <i class="fa fa-globe text-theme-colored mr-5"></i> <a class="text-gray" href="#">www.yourdomain.com</a> </li>
		</ul>
		<ul class="social-icons icon-bordered icon-circled icon-sm mt-15">
		  <li><a href="#"><i class="fa fa-facebook"></i></a></li>
		  <li><a href="#"><i class="fa fa-twitter"></i></a></li>
		  <li><a href="#"><i class="fa fa-skype"></i></a></li>
		  <li><a href="#"><i class="fa fa-youtube"></i></a></li>
		  <li><a href="#"><i class="fa fa-instagram"></i></a></li>
		  <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
		</ul>
	  </div>
	</div>
	<div class="col-sm-6 col-md-3">
	  <div class="widget dark">
		<h5 class="widget-title line-bottom">Latest News</h5>
		<div class="latest-posts">
		  <article class="post media-post clearfix pb-0 mb-10">
			<a href="#" class="post-thumb"><img alt="" src="http://placehold.it/80x55"></a>
			<div class="post-right">
			  <h5 class="post-title mt-0 mb-5"><a href="#">Sustainable Construction</a></h5>
			  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
			</div>
		  </article>
		  <article class="post media-post clearfix pb-0 mb-10">
			<a href="#" class="post-thumb"><img alt="" src="http://placehold.it/80x55"></a>
			<div class="post-right">
			  <h5 class="post-title mt-0 mb-5"><a href="#">Industrial Coatings</a></h5>
			  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
			</div>
		  </article>
		  <article class="post media-post clearfix pb-0 mb-10">
			<a href="#" class="post-thumb"><img alt="" src="http://placehold.it/80x55"></a>
			<div class="post-right">
			  <h5 class="post-title mt-0 mb-5"><a href="#">Storefront Installations</a></h5>
			  <p class="post-date mb-0 font-12">Mar 08, 2015</p>
			</div>
		  </article>
		</div>
	  </div>
	</div>
	<div class="col-sm-6 col-md-3">
	  <div class="widget dark">
		<h5 class="widget-title line-bottom">Useful Links</h5>
		<ul class="list angle-double-right list-border">
		  <li><a href="#">Home</a></li>
		  <li><a href="#">About</a></li>
		  <li><a href="#">Services</a></li>
		  <li><a href="#">Latest News</a></li>
		  <li><a href="#">Gallery</a></li>              
		</ul>
	  </div>
	</div>
	<div class="col-sm-6 col-md-3">
	  <div class="widget dark">
		<h5 class="widget-title line-bottom">Quick Contact</h5>
		<form id="footer_quick_contact_form" name="footer_quick_contact_form" class="quick-contact-form" action="includes/quickcontact.php" method="post">
		  <div class="form-group">
			<input id="form_email" name="form_email" class="form-control" type="text" required="" placeholder="Enter Email">
		  </div>
		  <div class="form-group">
			<textarea id="form_message" name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>
		  </div>
		  <div class="form-group">
			<input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="" />
			<button type="submit" class="btn btn-default btn-transparent btn-xs btn-flat mt-0" data-loading-text="Please wait...">Send Message</button>
		  </div>
		</form>

		<!-- Quick Contact Form Validation-->
		<script type="text/javascript">
		  $("#footer_quick_contact_form").validate({
			submitHandler: function(form) {
			  var form_btn = $(form).find('button[type="submit"]');
			  var form_result_div = '#form-result';
			  $(form_result_div).remove();
			  form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
			  var form_btn_old_msg = form_btn.html();
			  form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
			  $(form).ajaxSubmit({
				dataType:  'json',
				success: function(data) {
				  if( data.status == 'true' ) {
					$(form).find('.form-control').val('');
				  }
				  form_btn.prop('disabled', false).html(form_btn_old_msg);
				  $(form_result_div).html(data.message).fadeIn('slow');
				  setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
				}
			  });
			}
		  });
		</script>
	  </div>
	</div>
  </div>
</div>
<div class="footer-bottom" data-bg-color="#001111">
  <div class="container pt-15 pb-10">
	<div class="row">
	  <div class="col-md-12">
		<p class="font-12 text-gray m-0 text-center">Copyright &copy;2016 <span class="text-theme-colored">ThemeMascot</span>. All Rights Reserved</p>
	  </div>
	</div>
  </div>
</div>