<?php get_header() ?>

	<?php echo PfBase::getBlock('blocks'.DS.'slideshow_main.php', array('limit' => 4)) ?>
	<?php echo PfBase::getBlock('blocks'.DS.'form_search_operator.php') ?>	
	
    <div class="main_content">