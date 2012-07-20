<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("body").css("background-color","#151515");
      $('.searchTxt').click(function(){
		$('.searchContent').slideToggle();
      });
  });
</script>
<div id='wrapper'>
	<!--Guage Section -->
	<div class='searchPanel'>
	  <div class='searchTxt'>Search<div class="search searchArrow"></div></div>
	  
	  <div class="searchContent">
	  <div class='searchSep'></div>
	  <?php
		echo $this->Form->create('Dashboard', array('controller' => 'Dashboard', 'action' => 'dashboard'));
		echo "<div class='sections'><div class='formdivider'>";
		echo "<label class='labelTxtSearch'>Date</label>";
		echo "<input type='text' class='inputTxtSearch' name='date' id='date'></input>";	
		echo "</div>";
		echo "<div class='formdivider'>";
		echo "<label class='labelTxtSearch'>City</label>";
		echo "<input type='text' class='inputTxtSearch' name='city' id='city'></input>";	
		echo "</div></div>";
		echo "<div class='sections'><div class='formdivider'>";
		echo "<label class='labelTxtSearch'>Zipcode</label>";
		echo "<input type='text' class='inputTxtSearch' name='zipcode' id='zipcode'></input>";	
		echo "</div>";
		echo "<div class='formdivider'>";
		echo "<label class='labelTxtSearch'>State</label>";
		echo "<input type='text' class='inputTxtSearch' name='state' id='state'></input>";	
		echo "</div></div>";
		echo $this->Form->submit('search_btn.png', array('onclick' => 'return CheckIfFileSelected()'));
		echo "<br>";
	?>
	</div>
	</div>
	<div id='guage-wrapper'>
		<div class='guage-div' style='margin-left:0px;'>
			<div id="jGaugeDemo1" class="jgauge"></div>
			<div>
				<div class='min-max-left'>Min - $70,208</div>
				<div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>
			  <span class='saleMedianZipValue'></span>
			</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy'>
			  <span class='strategyPercentageZip'></span>
			</div>
		</div>
		<div class='guage-div'>
		    <div id="jGaugeDemo2" class="jgauge"></div>
			  <div>
				  <div class='min-max-left'>Min - $70,208</div>
				  <div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>
			  <span class='saleMedianCityValue'></span>
			</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy'>
			  <span class='strategyPercentageCity'></span>
			</div>
		</div>
		
		<div class='guage_description' style='margin-left:0px;'>Median Sold Price Last 12 month Avg</div>
		<div class='guage_description_down'>Previous 12 mos. <span class='prev12MonStrategy'></span></div>
		<div class='guage_description'>Median SA Price</div>
		<div class='guage_description_down'></div>
	</div>
	
	<!--Statistics Section -->
	<div id='statistics-wrapper'>
		<div class='statistics-box' style='margin-left:0px;'>
		  <div class='upStrategyOuter'>
		    <span id='perFootLast12Months' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		  <div>
		    <span id='soldHomeInDate' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		    <div class='upStrategyOuter'>
			  <span id='soldDifferenceWithLastYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
		    <div>
			  <span id='avgDifferenceWithLastYearAndCurrentYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
			<div class='downStratergyOuter'>
			  <span id='avg_difference' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
			<div>
			  <span id='soldAvgSqft' class="strategyPercentage"></span>
			</div>
		</div>
	</div>
	
	<div id='video-wrapper'>
	    <div class='video-panel'></div>
		<div class='chart-panel'>
			<div id="chart-render" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
		</div>
	<div>
</div>