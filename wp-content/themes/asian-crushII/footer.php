					<div id="footer">
						<a href="#" id="backtop"><img src="<?php echo PfBase::app()->themeUrl; ?>/_img/btn_backtop.png" width="51" height="51" alt="Back To Top" title="Back To Top" class="jquery-hover" style="opacity: 0.4;" /></a>
						<div class="footer-sidebar">
							<?php dynamic_sidebar('footer-1st'); ?>
							<?php dynamic_sidebar('footer-2nd'); ?>
							<?php dynamic_sidebar('footer-3rd'); ?>
						</div>
					    
					    <div id="footer-logo">
					    	<a href="#" id="logo_small"><img src="<?php echo PfBase::app()->themeUrl; ?>/_img/logo_small.png" alt="<?php bloginfo('name'); ?>" /></a>
					    	
					    	<?php echo PfBase::getBlock('blocks'.DS.'form_search_main.php') ?>
					    	
					    	
					    </div>
<br clear="all" />
<div class="copyright">
<?php
$numStartYear	=	2011;
$strYear	=	date('Y') > $numStartYear ? $numStartYear.' - '.date('Y') : $numStartYear;
?>
<p>Copyright &copy; <?php echo $strYear ?> by Digital Media Rights. All Rights Reserved.</p>
</div>

					</div>
				
				</div> <!-- end container -->
                </div> <!-- end body_container -->
			</div>
			<!--	/Browser	-->
			
		</div>
		<!--	/Device Platform	-->
		
	</body>
</html>