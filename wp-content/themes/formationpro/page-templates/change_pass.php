<?php

/*
Template Name: AutonomyWorks Change pass
*/


get_header('autonomyworks'); 
$changed = NULL ;


?>

		<div id="primary_home" class="content-area">
        <?php
		if($changed) {
					echo 'changed !!';
		}
		?>
			<form method="post" action="#">
                <input type="text" name="pass" />
                <input type="hidden" name="change" value="1" />
                <input type="submit" value="change"/>
            </form>
		</div><!-- #primary .content-area -->
        
<?php get_footer('centro'); ?>