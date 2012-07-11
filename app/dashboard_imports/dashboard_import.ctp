<?php echo $this->Html->script('simpletreemenu'); ?>

<script>
  $(document).ready(function() {	
     $('.layerBtn').click(function(e) {
	 e.preventDefault();
 
	 var id = $(this).attr('href');
	 var maskHeight = $(document).height();
	 var maskWidth = $(window).width();
 
	 $('#mask').css({'width':maskWidth,'height':maskHeight});
	 $('#mask').fadeIn(1000);	
	 $('#mask').fadeTo("slow",0.8);	
 
	 var winH = $(window).height();
	 var winW = $(window).width();
 
	 $(id).css('top',  winH/2-$(id).height()/2);
	 $(id).css('left', winW/2-$(id).width()/2);
	 $(id).fadeIn(2000); 
     });
     
     $('.window .close').click(function (e) {
	 e.preventDefault();
	 $('#mask').hide();
	 $('.window').hide();
     });		
     
     
     $('#mask').click(function () {
	 $(this).hide();
	 $('.window').hide();
     });			
 });
</script>

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

<div id="boxes">
   <?php echo $this->element('filterdialogue'); ?>

    <div id="divTicker"   class="window">       
        <a href="#" id="closeTicker" class="close"/><?php echo $html->image('close.png');?></a>
        <iframe id="ifTicker" src="" frameborder="0" style="height:350px;width:725px;"></iframe>
    </div>
</div>

<!--Wrapper-->
<div id="wrapper" style="padding: 6px 0 0 !important;">
    <form id="frmFilters" method="POST">
	       <input type="hidden" name="viewByPosting" id="viewByPosting" value="<?php echo $viewByPosting?>">
    </form>
    <!--Content-->
    	<div class="content">
	  <h1>APPLICANTS AND HIRES DATA IMPORT</h1>
	    <div class="atsMain">
            <div class="containerats">
                <p>Make the most out of TRAQ24 by importing your applicants and hires data:</p>
                <ul>
                    <li>- Import Microsoft Excel or CSV formats.</li>
                    <li>- Data files with 2,000 records or less will import automatically.</li>
                    <li>- <?php echo $html->link('Click here', array('controller'=>'AtsImports', 'action'=>'downloadTemplate'));?>
                        to download and view the data and formatting guidelines for your data import.
                    </li>
                </ul>
                <br>
                <ul>
                    <li>Options for Uploading:</li>
                    <li>- Send your file as an email attachment to
                        <a href="mailto:<?php echo $importEmailId.'?subject='.$username;?>">
                            <?php echo $importEmailId;?></a>
                       using your eQuest ID in the subject line.
                    </li>
                </ul>
                <br>
                <ul>
                    <li>OR</li>
                </ul>
                <br>
                <ul>
                     <li>- Begin your data import by selecting your import files and click on the Import Now button.</li>
                </ul>
                               
                <?php
                    echo $form->create('AtsImports', array('controller' => 'AtsImports', 'action' => 'dataParser', 'type' => 'file', 'target'=>'fileUpload', 'class' =>'choose_file'));
                    echo "<div class='uploadfile'>";
                    echo $form->file('File', array('name'=>'atsImport', 'id'=>'file_path','class'=>'choose_file', 'onchange'=>'getSelectedFile()'));
		    echo "<span class='errMsgChoose' style='display:none;color:red;font-size:14px;margin-left:100px;'>Please upload the ATS import file for processing</span>";
                    echo "</div>";
                    echo "<div class='selectfilename'></div>";
                    echo $form->submit('importnow_btn.png', array('onclick' => 'return CheckIfFileSelected()'));
                ?>
                    <div id="importAnimation">
                    <?php echo $html->image('loading.gif', array('width' => 20, 'height' => 20));?>
                    </div>
                <?php echo $form->end();
                ?>
                <iframe name="fileUpload" id="fileUpload"  width="750px" height="300px" frameborder="0" scrolling="no"></iframe>
            </div>
	    </div>
        </div>
    <!--Content-->
    &laquo;<?php echo $html->link('Back to Dashboard', array('controller'=>'dashboard', 'action'=>'dashboard'));?>  
</div>
<!--Wrapper-->
<?php echo $this->Html->script('atsImport'); ?>