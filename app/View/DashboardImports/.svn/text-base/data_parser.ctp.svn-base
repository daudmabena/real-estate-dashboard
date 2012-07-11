<?php
    //TODO 
    //    1) move this validation scripts to js file
    //    2) Move the css part to css file
?>
<script type="text/javascript">
    parent.window.document.getElementById('importAnimation').style.display='none';
    //$('#importAnimation').hide();
function validate_email()
{
    valid = true;
    if ($("#AtsImportsContactEmailAddr").val() == "")
    {   
        $("#emailInvalidError").hide();
        $("#emailBlankError").show();
        valid = false;
    }
    else if ($("#AtsImportsContactEmailAddr").val() != "" ){
	var mailSplit = Array();
	mailSplit = $("#AtsImportsContactEmailAddr").val().split(",");
	for(i=0;i<mailSplit.length;i++)
	{
	    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	    var email = mailSplit[i];
	    if(reg.test(email) == false) {
		$("#emailBlankError").hide();
		$("#emailInvalidError").show();
		valid = false;
	    }
	}
    }
    return valid;
}
function limitExceed(){ 
    $("#results").hide();
    $("#addEmailValid").show();
    $("#beginCont").show();
}
function cancelBtn(){
    $("#results").show();
    $("#addEmailValid").hide();
    $("#beginCont").hide();
    $("#emailBlankError").hide();
    $("#emailInvalidError").hide();
    return false;
}
</script>
<style type="text/css">
.text{
    float: left !important;
    width: 375px !important;
}
.submit{
    float: left !important;
}
#beginCont{
    font-size: 12px; display:none;
}
</style>
<?php if($scheduled){?>
<div id="successmessage">
     <h2>Your file exceeds the <?=$maxLimit?> record limit. It will be processed on next batch scheduled at 11:00 AM PST.</h2>    	
     <?php if($contactEmailAddr!=""){?>
     <div id="results">
	Results will be sent to <?php echo $contactEmailAddr; ?> <a href='javascript:limitExceed();'>Click Here</a> to add notification addresses.
     </div>
     <?php } ?>
     
     <?php if($contactEmailAddr==""){?>
     <?php
        echo $form->create('AtsImports', array( 'controller' => 'AtsImports', 'action' => 'confirmContactEmail', 'target'=>'_parent', 'name'=>'AtsImports', 'onsubmit'=>'return validate_email();' ));
     ?>
     <div id="addEmail">
	<div class="additionalEmails">
	   <p>Add Email Notification for selectedfilename.csv</p>
	   <p><strong>Enter additional email addresses to be notified on this import</strong>
	   <p>Separate unique email addresses with a comma (',')</p>
	   <p>
		<input type="hidden" id="AtsImportsSchedulerId" value="<?php echo $id;?>" name="data[AtsImports][schedulerId]">
		<input type="text" id="AtsImportsContactEmailAddr" name="data[AtsImports][contactEmailAddr]" class="input" value='<?php echo $contactEmailAddr; ?>'/>
	        <input type="submit" value="" class="okbtn" />
	   </p>
	</div>
	<div id="beginCont">- Begin your data import by selecting your import files and click on the Import Now button.</div>
     </div>
     <?php        
        echo "<div id='emailBlankError' style='display:none;font-size:12px;color:#ff0000'>&nbsp;&nbsp;Email should not be blank</div>";
        echo "<div id='emailInvalidError' style='display:none;font-size:12px;color:#ff0000'>&nbsp;&nbsp;Invalid Email Address</div>";
        echo $form->end();
     ?>
     <?php }?>
     
     <?php
        echo $form->create('AtsImports', array( 'controller' => 'AtsImports', 'action' => 'confirmContactEmail', 'target'=>'_parent', 'name'=>'AtsImports', 'onsubmit'=>'return validate_email();' ));
     ?>
     <div id="addEmailValid" style='display:none;'>
	<div class="additionalEmails">
	   <p>Add Email Notification for selectedfilename.csv</p>
	   <p><strong>Enter additional email addresses to be notified on this import</strong>
	   <p>Separate unique email addresses with a comma (',')</p>
	   <p>
		<input type="hidden" id="AtsImportsSchedulerId" value="<?php echo $id;?>" name="data[AtsImports][schedulerId]">
		<input type="text" id="AtsImportsContactEmailAddr" name="data[AtsImports][contactEmailAddr]" class="input" value='<?php echo $contactEmailAddr; ?>'/>
	        <input type="button" value="" class="cancelbtn" onclick="javascript:cancelBtn();"/>
	        <input type="submit" value="" class="okbtn" />
	   </p>
	</div>
	<div style="font-size: 12px; display:none;" id="beginCont">- Begin your data import by selecting your import files and click on the Import Now button.</div>
     </div>
     <?php        
        echo "<div id='emailBlankError' style='display:none;font-size:12px;color:#ff0000'>&nbsp;&nbsp;Email should not be blank</div>";
        echo "<div id='emailInvalidError' style='display:none;font-size:12px;color:#ff0000'>&nbsp;&nbsp;Invalid Email Address</div>";
        echo $form->end();
     ?>
 
    <br></div>
<?php } else if ($allRecordsSuccess==1){?>
<div id="successmessage">
<h1 style='float:left;'>You have successfully imported your data into TRAK24.</h1>
<?php
    echo $form->create('AtsImports', array( 'controller' => 'AtsImports', 'action' => 'downloadReport' ));
    echo $form->input('reportFile', array('type'=>'hidden', 'value'=>$reportFile));
    echo $this->Form->submit('download_records_btn_succ.png');
    echo $form->end();
?><br>
</div>
<?php }else{?>
<div id="successmessage">
<h3 style='float:left;'><?php echo $successRows;?> Records Successfully imported. <?php echo $failedRows;?> Records could not be imported.&nbsp;&nbsp;
</h3>
<?php
    echo $form->create('AtsImports', array( 'controller' => 'AtsImports', 'action' => 'downloadReport' ));
    echo $form->input('reportFile', array('type'=>'hidden', 'value'=>$reportFile));
    echo $this->Form->submit('download_records_btn.png');
    echo $form->end();
?><br>
</div> 
<?php } ?>