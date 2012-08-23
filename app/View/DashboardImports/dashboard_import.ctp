<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("input.choose_file").filestyle({
          image: "<?php echo $this->webroot;?>img/choose_file_btn.png",
          imageheight : 24,
          imagewidth : 80,
          width : 170
      });            
  });
  
  function getSelectedFile()
  {
   $('span.errMsgChoose').hide();
   var filePath = $("#file_path").val();
   $(".selectfilename").html(filePath);
  }

  function getFileExtn(file){
    var fileParts = file.split('.');
    //alert(fileParts.length);
    return fileParts[fileParts.length-1]
  }
  
  function CheckIfFileSelected(){
    var field = $('.selectfilename').html();
    if(field == ""){
      $('span.errMsgChoose').show();
      return false;
    }else{
        var ext = getFileExtn(field);
        if(ext == 'xls' || ext == 'csv' || ext == 'XLS' || ext == 'CSV'){
            $('span.errMsgChoose').hide();
            $('#importAnimation').show();
            return true;
        }
        $('span.errMsgChoose').html('Upload valid xls/csv format files');
        $('span.errMsgChoose').show();
        return false;
    }
  }
</script>

<script type="text/javascript">
$(document).ready(function() {
  $("#state").autocomplete("getState", {
    width: 260,
    matchContains: true,
    //mustMatch: true,
    //minChars: 0,
    //multiple: true,
    //highlight: false,
    //multipleSeparator: ",",
    selectFirst: false
  });
  
  $("#city").autocomplete("getCity", {
    width: 260,
    matchContains: true,
    //mustMatch: true,
    //minChars: 0,
    //multiple: true,
    //highlight: false,
    //multipleSeparator: ",",
    selectFirst: false
  });
  
  $("#zipcode").autocomplete("getZipCode", {
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
  
  $('.zipcodeholder').hide();
  $('.cityholder').hide();
  $('.uploadfile').hide();
  $('#sbtbutton').hide();
  
  $("#uploadType").change(function () {
    $("select option:selected").each(function () {
      var options = $(this).val();
      if(options==1){
	$('.zipcodeholder').show();
	$('.uploadfile').show();
	$('.cityholder').hide();
	$('#sbtbutton').show();
      }
      else if(options==2){
	$('.cityholder').show();
	$('.uploadfile').show();
	$('.zipcodeholder').hide();
	$('#sbtbutton').show();
      }
    });
  });

});
</script>
<div class='header_txt'>Dashboard Import</div>
<div class='searchSep'></div>
<div id="content-import">
<?php
	echo $this->Form->create('DashboardImports', array('controller' => 'DashboardImports', 'action' => 'dataParser', 'type' => 'file', 'class' =>'choose_file'));
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>State</label>";
	echo "<select id='uploadType' name='uploadType'><option value='1'>By Zipcode</option><option value='2'>By City</option></select>";	
	echo "</div><div class='zipcodeholder'>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>Zipcode/Area</label>";
	echo "<input type='text' class='inputTxt' name='zipcodarea' id='zipcodarea'></input>";	
	echo "</div>";
	echo "</div><div class='cityholder'>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>State</label>";
	echo "<input type='text' class='inputTxt' name='state' id='state' value='TX'></input>";	
	echo "</div>";
	echo "<div class='formdivider'>";
	echo "<label class='labelTxt'>City</label>";
	echo "<input type='text' class='inputTxt' name='city' id='city' value='SAN ANTONIO'></input>";	
	echo "</div></div>";
	//echo "<div class='formdivider'>";
	//echo "<label class='labelTxt'>Zipcode</label>";
	//echo "<input type='text' class='inputTxt' name='zipcode' id='zipcode'></input>";	
	//echo "</div>";
	//echo "<div class='formdivider'>";
	//echo "<label class='labelTxt'>Area</label>";
	//echo "<input type='text' class='inputTxt' name='zipcodearea' id='zipcodearea'></input>";	
	//echo "</div>";
	echo "<div class='uploadfile formdivider'>";
	echo "<label class='labelTxt'>Select File</label>";
	echo $this->Form->file('File', array('name'=>'dashboardImport', 'id'=>'file_path','class'=>'choose_file', 'onchange'=>'getSelectedFile()'));
	echo "<span class='errMsgChoose' style='display:none;color:red;font-size:14px;margin-left:100px;'>Please upload the data for processing...</span>";
	echo "</div>";
	//echo "<div class='selectfilename'></div><br>";
	echo "<br>";
	echo $this->Form->submit('importnow_btn.png', array('onclick' => 'return CheckIfFileSelected()','id'=>'sbtbutton'));
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
<div class="bottomright" style="margin-right: 0px;">
	  <a href="<?php
	 echo  Router::url(array('controller' => 'dashboard', 'action' => 'dashboard'));?>">Back to Dashboard</a>
	</div>
			  