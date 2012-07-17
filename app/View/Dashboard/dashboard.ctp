<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("body").css("background-color","#151515");
  });
</script>
<div id='wrapper'>
	<!--Guage Section -->
	<div class='searchPanel'>
	  <div class='searchTxt'>Search</div>
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
	<div id='guage-wrapper'>
		<div class='guage-div' style='margin-left:0px;'>
			<div id="jGaugeDemo1" class="jgauge"></div>
			<div>
				<div class='min-max-left'>Min - $70,208</div>
				<div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>$198,208</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy'>
			  <span class='strategyPercentage'>-1.1%</span>
			</div>
		</div>
		<div class='guage-div'>
		    <div id="jGaugeDemo2" class="jgauge"></div>
			  <div>
				  <div class='min-max-left'>Min - $70,208</div>
				  <div class='min-max-right'>Max - $270,208</div>
			</div>
			<div class='guage_calculation'>$111,208</div>
		</div>
		<div class='downstrategy'>
		    <div class='downTxt'>Down</div>
			<div class='seperator'></div>
			<div class='upStrategy'>
			  <span class='strategyPercentage'>-1.1%</span>
			</div>
		</div>
		
		<div class='guage_description' style='margin-left:0px;'>Median Sold Price Last 12 month Avg (do a dial that shows this zip and SA zip $147,212)</div>
		<div class='guage_description_down'>Previous 12 mos. $200,364</div>
		<div class='guage_description'>Median SA Price</div>
		<div class='guage_description_down'></div>
	</div>
	
	<!--Statistics Section -->
	<div id='statistics-wrapper'>
		<div class='statistics-box' style='margin-left:0px;'></div>
		<div class='statistics-box'></div>
		<div class='statistics-box'></div>
		<div class='statistics-box'></div>
		<div class='statistics-box'></div>
		<div class='statistics-box'></div>
	</div>
</div>
<script type="text/javascript">
  
	  // DEMOGAUGE1 - A very basic 'bare-bones' example...
	  var demoGauge1 = new jGauge(); // Create a new jGauge.
	  demoGauge1.id = 'jGaugeDemo1'; // Link the new jGauge to the placeholder DIV.
	  
	  
	  // DEMOGAUGE2 - Using the new binary prefixing...
	  var demoGauge2 = new jGauge(); // Create a new jGauge.
	  demoGauge2.id = 'jGaugeDemo2'; // Link the new jGauge to the placeholder DIV.
	  //demoGauge2.label.suffix = 'B'; // Make the value label bytes.
	  //demoGauge2.autoPrefix = autoPrefix.binary; // Use binary prefixing (i.e. 1k = 1024).
	  //demoGauge2.ticks.count = 5;
	  //demoGauge2.ticks.end = 8;
	  
	  
	  /*
	  // DEMOGAUGE3 - This gauge is more complex to show a completely different style and is updated with random values...
	  var demoGauge3 = new jGauge(); // Create a new jGauge.
	  demoGauge3.id = 'jGaugeDemo3'; // Link the new jGauge to the placeholder DIV.
	  demoGauge3.autoPrefix = autoPrefix.si; // Use SI prefixing (i.e. 1k = 1000).
	  demoGauge3.imagePath = '../img/jgauge_face_taco.png';
	  demoGauge3.segmentStart = -225
	  demoGauge3.segmentEnd = 45
	  demoGauge3.width = 170;
	  demoGauge3.height = 170;
	  demoGauge3.needle.imagePath = '../img/jgauge_needle_taco.png';
	  demoGauge3.needle.xOffset = 0;
	  demoGauge3.needle.yOffset = 0;
	  demoGauge3.label.yOffset = 55;
	  demoGauge3.label.color = '#fff';
	  demoGauge3.label.precision = 0; // 0 decimals (whole numbers).
	  demoGauge3.label.suffix = 'W'; // Make the value label watts.
	  demoGauge3.ticks.labelRadius = 45;
	  demoGauge3.ticks.labelColor = '#0ce';
	  demoGauge3.ticks.start = 200;
	  demoGauge3.ticks.end = 800;
	  demoGauge3.ticks.count = 7;
	  demoGauge3.ticks.color = 'rgba(0, 0, 0, 0)';
	  demoGauge3.range.color = 'rgba(0, 0, 0, 0)';
	  */
					  
	  // This function is called by jQuery once the page has finished loading.
	  $(document).ready(function()
	  {
		  demoGauge1.init(); // Put the jGauge on the page by initializing it.
		  demoGauge2.init(); // Put the jGauge on the page by initializing it.
		  //demoGauge3.init(); // Put the jGauge on the page by initializing it.
		  
		  // Configure demoGauge3 for random value updates.
		  demoGauge1.setValue(198208);
		  demoGauge2.setValue(556);
		  setInterval('randVal()', 100);
	  });
	  
	  // That's all folks! We've created a jGauge and put it on the page! :-D
	  // The following JavaScript functions are for the demonstration.
	  // ----------------------------------------------------------------------

	  // This is a test function that changes the gauge value.
	  function setVal(value)
	  {
		  demoGauge1.setValue(value);
		  demoGauge2.setValue(value);
	  }
	  
	  /*
	  // This is another test function that changes the gauge value.
	  function bumpVal(value)
	  {
		  demoGauge1.setValue(demoGauge1.value + value);
		  demoGauge2.setValue(demoGauge2.value + value);
	  }
	  */
	  
	  // This is a test function that changes the number of ticks.
	  function setTickCount(value)
	  {
		  demoGauge1.ticks.count = value;
		  demoGauge1.updateTicks();
		  
		  demoGauge2.ticks.count = value;
		  demoGauge2.updateTicks();
	  }
	  
	  // This is a test function that changes the range styling.
	  function setRange(radius, thickness, start, end, color)
	  {
		  demoGauge1.range.radius = radius;
		  demoGauge1.range.thickness = thickness;
		  demoGauge1.range.start = start;
		  demoGauge1.range.end = end;
		  demoGauge1.range.color = color;
		  demoGauge1.updateRange();
		  
		  demoGauge2.range.radius = radius;
		  demoGauge2.range.thickness = thickness;
		  demoGauge2.range.start = start;
		  demoGauge2.range.end = end;
		  demoGauge2.range.color = color;
		  demoGauge2.updateRange();
	  }
	  
	  // This is our random value function for gauge 3.
	  function randVal()
	  {
			  var newValue;
			  
			  if (Math.random() > 0.8) // Allow needle to randomly pause.
			  {
					  newValue = demoGauge1.value + (Math.random() * 10000 - 5000);
					  
					  if (newValue >= demoGauge1.ticks.start && newValue <= demoGauge1.ticks.end)
					  {
							  // newValue is within range, so update.
							  demoGauge1.setValue(newValue);
					  }
			  }
	  }
	  
</script>