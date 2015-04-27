					<div id="footer">
						
						<div class="footer-sidebar">
							<?php dynamic_sidebar('footer-1st'); ?>
							<?php dynamic_sidebar('footer-2nd'); ?>
							<?php dynamic_sidebar('footer-3rd'); ?>
						</div>
					    
					   
<br clear="all" />
<div id="footer-bar">
 <div id="copyrightwrapper">
  <img src="<?php echo PfBase::app()->themeUrl; ?>/_img/logo_small.png" alt="<?php bloginfo('name'); ?>" />
 <div class="copyrightspan">
    <?php
          $numStartYear	=	2011;
          $strYear	=	date('Y') > $numStartYear ? $numStartYear.' - '.date('Y') : $numStartYear;
    ?><p>Copyright &copy; <?php echo $strYear ?> by Digital Media Rights. All Rights Reserved.</p></div>
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