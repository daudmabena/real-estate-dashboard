<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {

  });
  
</script>
<div class='header_txt'>Dashboard Import</div>
<div class='searchSep'></div>
<div id="content-import">
<?php
	echo $this->Form->create('DashboardImports', array('controller' => 'DashboardImports', 'action' => 'insertDashboardData', 'class' =>'choose_file'));
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Youtube</label>";
	//ho "<input type='text' class='inputTxt' name='youtube_data' id='youtube_data'></input>";
        echo "<textarea class='inputTxt' name='youtube_data' id='youtube_data' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Left</label>";
	echo "<textarea class='inputTxt' name='rss_left' id='rss_left' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Rss Right</label>";
        echo "<textarea class='inputTxt' name='rss_right' id='rss_right' style='width: 267px; height: 84px;'></textarea>";
	echo "</div>";
	//echo "<div class='selectfilename'></div><br>";
	echo "<br>";
	echo $this->Form->submit('Change Data');
	echo "<br><br>";
?>
<!--
<div id="importAnimation" style='display:none;'>
<?php echo $this->Html->image('loading.gif', array('width' => 20, 'height' => 20));?>
</div>
-->
<?php echo $this->Form->end();
?>
</div>
<div class="topXLSUploaddiv" style="margin-right: 0px;">
  <a href="#" onclick="history.go(-1);">Back to Dashboard</a>
</div>