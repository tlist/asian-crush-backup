<?php
if (!isset($cssClass)) $cssClass = '';
?>
<div class="breadcrumb <?php echo $cssClass ?>">
		<ul>
        	<li class="parent"><a href="http://www.pluslabs.net/clients/amr/movie">Movies<span class="arrow"></span></a></li>
            <li class="child1"><a href="#" class="active"><?php echo get_the_title(); ?><span></span></a></li>
        </ul> 
</div> <!-- end breadcrumb -->