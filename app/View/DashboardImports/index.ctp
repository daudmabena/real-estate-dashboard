<script type="text/javascript">
	
	jQuery(document).ready(function($){
		
		/*The country onchange starts here*/
		var orig_html;
		var orig_value;
		var state_value;

		var us_states = {AL: 'Alabama', AK: 'Alaska', AZ: 'Arizona', AR: 'Arkansas', CA: 'California', CO: 'Colorado', CT: 'Connecticut', DE: 'Delaware', DC: 'District of Columbia', FL: 'Florida', GA: 'Georgia', HI: 'Hawaii', ID: 'Idaho', IL: 'Illinois', IN: 'Indiana', IA: 'Iowa', KS: 'Kansas', KY: 'Kentucky', LA: 'Louisiana', ME: 'Maine', MD: 'Maryland', MA: 'Massachusetts', MI: 'Michigan', MN: 'Minnesota', MS: 'Mississippi', MO: 'Missouri', MT: 'Montana', NE: 'Nebraska', NV: 'Nevada', NH: 'New Hampshire', NJ: 'New Jersey', NM: 'New Mexico', NY: 'New York', NC: 'North Carolina', ND: 'North Dakota', OH: 'Ohio', OK: 'Oklahoma', OR: 'Oregon', PA: 'Pennsylvania', RI: 'Rhode Island', SC: 'South Carolina', SD: 'South Dakota', TN: 'Tennessee', TX: 'Texas', UT: 'Utah', VT: 'Vermont', VA: 'Virginia', WA: 'Washington', WV: 'West Virginia', WI: 'Wisconsin', WY: 'Wyoming'};
		var $el = $("#location-country");
		$el.data('oldval', $el.val());
		$el.change(function(){
			var $this = $(this);
			if(this.value=="US" && $this.data('oldval')!="US"){
				var str = '<select name="location-state" id="location-state">';
				orig_html = $("#location-state-div").html();
				orig_value = $("#location-state").val();
				for(var st in us_states){
					if(st == state_value)
						str += '<option value="'+st+'" selected="selected">'+us_states[st]+'</option>';
					else
						str += '<option value="'+st+'">'+us_states[st]+'</option>';
				}
				str += "</select>";
				$("#location-state-div").html(str);
				$this.data('oldval', $this.val());
			}
			else if($this.data('oldval')=="US" && $this.val()!="US"){
				state_value = $("#location-state").val();
				$("#location-state-div").html(orig_html);
				$("#location-state").val(orig_value);
				$this.data('oldval', $this.val());
			}
		});
		
	});
	
	
</script>


<div id="location-country-div">
	<select id="location-country" name="location_country">
		<option value="0">None</option>
		<?php foreach($countries as $country_key => $country_name): ?>
			<option value="<?php echo $country_key; ?>"><?php echo $country_name; ?></option>
		<?php endforeach; ?>
	</select>
</div>


<div id="location-state-div">
	<!--<input id="location-state" type="text" name="location_state" />-->
</div>