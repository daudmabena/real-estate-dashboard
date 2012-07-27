

<script type="text/javascript">
$(document).ready(function() {
	$("#state").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getState'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#city").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getCity'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#zipcode").autocomplete("<?php echo Router::url(array('controller' => 'DashboardImports','action' => 'getZipCode'));?>", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#state").result(function(event, data, formatted) {
		$("#state").val(data[0]);
	});
	
	$("#city").result(function(event, data, formatted) {
		$("#city").val(data[0]);
	});
	
	$("#zipcode").result(function(event, data, formatted) {
		$("#zipcode").val(data[0]);
	});
	
});
</script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("body").css("background-color","#151515");
      $('.searchContent').hide();
      var showOrHide;
      $('.searchTxt').click(function(){
	$('.searchContent').slideToggle(showOrHide);
	$('.searchUpArrow').toggleClass("searchDownArrow");
     });
      
      $('#submitForm').click(function(){
	getSearchData();
      });
  });
</script>
<div id='initialContainerMask'>
<div id='loader'><img src='../img/loading.gif'><span style='float:right;margin-right:40px;'>Loading</span></img></div>
</div>
<div id='wrapper'>
	<!--Guage Section -->
	
	<div class='searchPanel'>
	  <div class='searchTxt'>
	    Search
	    <div class="search searchUpArrow"></div>
	  </div>
	  
	  <div class="searchContent">
	  <div class='searchSep'></div>
	  <?php
		echo $this->Form->create('Dashboard', array('controller' => 'Dashboard', 'action' => 'dashboard'));
		echo "<div class='sections'>
		      <div class='formdivider'>";
		echo "<label class='labelTxtSearch'>Date</label>";
		echo "<div class='rangePicker futureRange'>
		      <label for='range1'>From:</label>
		      <input type='text' name='range1' id='range1' value='".$lastYear."' />
		      <label for='range1'>To:</label>
		      <input type='text' name='range2' name='range2' value='".date('m/d/Y')."' />
		      </div>";	
		echo "</div>";
		echo "<div class='formdivider'>";
		echo "<label class='labelTxtSearch'>City</label>";
		echo "<input type='text' class='inputTxtSearch' name='city' id='city' value='SAN ANTONIO'></input>";	
		echo "</div></div>";
		echo "<div class='sections'><div class='formdivider'>";
		echo "<label class='labelTxtSearch'>State</label>";
		echo "<input type='text' class='inputTxtSearch' name='state' id='state' value='TX'></input>";	
		echo "</div>";
		echo "<div class='formdivider'>";
		echo "<label class='labelTxtSearch'>Zipcode</label>";
		echo "<input type='text' class='inputTxtSearch' name='zipcode' id='zipcode' value='78253'></input>";	
		echo "</div></div>";
		echo "<a href='#' id='submitForm'></a>";
		echo "<br>";
	?>
	</div>
	</div>
	<div id='guage-wrapper'>
	  <div class="firstGuageGroup">
	    <div class="header" id="ZipLabel">
	      
	    </div>
		<div class='guage-div' style='margin-left:0px;'>
			<div id="jGaugeDemo1" class="jgauge"></div>
			<div class="min-max">
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
			<div class='upStrategy' id="firstgauageStrategy">
			  <span class='strategyPercentageZip'></span>
			</div>
		</div>
	  </div>
	  <div class="secondGuageGroup">
	    <div class="header" id="CityValue">
	      
	    </div>
		<div class='guage-div'>
		    <div id="jGaugeDemo2" class="jgauge"></div>
			  <div class="min-max">
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
			<div class='upStrategy' id="secondgauageStrategy">
			  <span class='strategyPercentageCity'></span>
			</div>
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
		  <div class='upStrategyOuter' id="firstStrategyOuter">
		    <span id='perFootLast12Months' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		  <div>
		    <span id='soldHomeInDate' class="strategyPercentage"></span>
		  </div>
		</div>
		<div class='statistics-box'>
		    <div class='upStrategyOuter' id="secondStrategyOuter">
			  <span id='soldDifferenceWithLastYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
		    <div>
			  <span id='avgDifferenceWithLastYearAndCurrentYear' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
			<div class='upStrategyOuter' id="thirdStrategyOuter">
			  <span id='avg_difference' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='statistics-box'>
			<div>
			  <span id='soldAvgSqft' class="strategyPercentage"></span>
			</div>
		</div>
		<div class='guage_description_panel2' style='margin-left:0px;'>Average $ Per Foot Last 12 Months</div>
		<div class='guage_description_panel2' id="guage_description_panel2">Number of Sold Homes in [Date]</div>
		<div class='guage_description_panel2'>Number of Sold Homes Same Period Last Yr</div>
		<div class='guage_description_panel2'>Average # Days on Market (Solds)</div>
		<div class='guage_description_panel2'>Same Period Last Year</div>
		<div class='guage_description_panel2'>Average Sq. Ft. Last 12 Months</div>
	</div>
	<div class="bottom-left-panel">
	  <div id='video-wrapper'>
	    
	      <div class='video-panel'>
		<?php
		echo $youtube_data[0]['tab_dashboard_content']['field_value'];
		?>
	      </div>
	      <div class='text-panel'>
		<?php
		  echo $dashboardData[0]['tab_dashboard_content']['field_value'];
		?>
	      </div>
	      <div class="rssReed">
		<div class='rssFeed1'>
		  <?php
		  //echo $rssFieldData_left[0]['tab_dashboard_content']['field_value'];
		  
		  $url = urlencode($rssFieldData_left[0]['tab_dashboard_content']['field_value']);
		  $this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
		<div class='rssFeed2'>
		  <?php
		  //echo $rssFieldData_right[0]['tab_dashboard_content']['field_value'];
		  
		  $url = urlencode($rssFieldData_right[0]['tab_dashboard_content']['field_value']);
		  $this->requestAction('/Dashboard/readingRss/'.$url);
		  ?>
		</div>
	      </div>
	    </div>
	</div>
	  <div class="bottom-right-panel">
	    <div class='chart-panel'>
	      <div id="chart-render" style="min-width: 400px; height: 500px; margin: 0 auto"></div>
	    </div>
	  </div>
	  <div class="bottomleft">
	    <a href="<?php
	 echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'dashboardAdd'));?>">Click to change youtube data</a>
	  </div>
<div class="bottomright">
  
	  <a href="<?php
	 echo  Router::url(array('controller' => 'DashboardImports', 'action' => 'dashboardimport'));?>">Click to Upload.XLS File</a>
	</div>
