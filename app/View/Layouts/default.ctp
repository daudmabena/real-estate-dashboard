<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Dashboard');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} 
		else 
		{
		    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}

		echo $this->Html->meta('icon');
		//echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
		echo $this->Html->css('jquery.autocomplete');
		echo $this->Html->css('jgauge');
		echo $this->Html->css('demoPages');		
		echo $this->Html->css('screen');
		
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery.formatCurrency');

		$pageInnerURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
		

		$pageInnerURL .= $_SERVER["SERVER_NAME"];
			
		if($pageURL == $pageInnerURL.'/dashboard/dashboard'){
			echo $this->Html->script('ui.datepicker');
			echo $this->Html->script('demoScripts');
		}
		else if($pageInnerURL){
			echo $this->Html->script('ui.datepicker');
			echo $this->Html->script('demoScripts');
		}
		else {
			$pageInnerURL .= $_SERVER["SERVER_NAME"].'/real-estate-dashboard';
			
			if($pageURL == $pageInnerURL.'/dashboard/dashboard'){
				echo $this->Html->script('ui.datepicker');
				echo $this->Html->script('demoScripts');
			}
		}
	
		//echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquery.filestyle');
		echo $this->Html->script('jquery.autocomplete');
			
		echo $this->Html->script('excanvas.min');
		echo $this->Html->script('jQueryRotate.min');
		echo $this->Html->script('jgauge-0.3.0.a3');
		echo $this->Html->script('highcharts');
		echo $this->Html->script('exporting');
		
		$pageInnerURL = "";
		
		$pageInnerURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

		$pageInnerURL .= $_SERVER["SERVER_NAME"]."/";

		if($pageURL == $pageInnerURL.'/dashboard/dashboard'){
			echo $this->Html->script('dashboard');
			?>
			<script>
			getSearchData("<?php echo Router::url(array('controller' => 'dashboard', 'action' => 'getJsonFormat'));?>");
			</script>
			<?php
		}
		else if($pageURL == $pageInnerURL){
			echo $this->Html->script('dashboard');
			?>
			<script>
			getSearchData("<?php echo Router::url(array('controller' => 'dashboard', 'action' => 'getJsonFormat'));?>");
			</script>
			<?php
		}
		else{
			$pageInnerURL .= $_SERVER["SERVER_NAME"].'/real-estate-dashboard';
			
			if($pageURL == $pageInnerURL.'/dashboard/dashboard'){
				echo $this->Html->script('dashboard');
			?>
			<script>
			getSearchData("<?php echo Router::url(array('controller' => 'dashboard', 'action' => 'getJsonFormat'));?>");
			</script>
			<?php
			}
		}
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		
		<!--<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>-->
		<br><br>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		
		<!--<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>-->
		
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>