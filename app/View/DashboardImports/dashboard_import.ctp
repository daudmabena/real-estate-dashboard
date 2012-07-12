<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
      $("input.choose_file").filestyle({
          image: "<?php echo $this->webroot;?>img/choose_file_btn.png",
          imageheight : 24,
          imagewidth : 80,
          width : 215
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

<div class='header_txt'>Dashboard Import</div><br>
<?php
	echo $this->Form->create('DashboardImports', array('controller' => 'DashboardImports', 'action' => 'dataParser', 'type' => 'file', 'class' =>'choose_file'));
	echo "<div class='uploadfile'>";
	echo $this->Form->file('File', array('name'=>'dashboardImport', 'id'=>'file_path','class'=>'choose_file', 'onchange'=>'getSelectedFile()'));
	echo "<span class='errMsgChoose' style='display:none;color:red;font-size:14px;margin-left:100px;'>Please upload the data for processing...</span>";
	echo "</div>";
	echo "<div class='selectfilename'></div><br>";
	echo $this->Form->submit('importnow_btn.png', array('onclick' => 'return CheckIfFileSelected()'));
?>
<!--
<div id="importAnimation" style='display:none;'>
<?php echo $this->Html->image('loading.gif', array('width' => 20, 'height' => 20));?>
</div>
-->
<?php echo $this->Form->end();
?>
			  