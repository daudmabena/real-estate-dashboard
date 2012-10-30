<?php
//requires for reading the excel file.
require_once 'Component/reader.php';
App::uses('File', 'Utility'); 

class DashboardImportsController extends AppController {
   // {{{ Properties
   /**
    * Controller access name
    *
    * @access public
    * @var string
    */
   var $name = 'DashboardImports';
   // {{{ Properties
   /**
    * Controller access uses
    *
    * @access public
    * @var string
    */
   var $uses = array('AppModel','Dashboard','Calculation');
   
   // {{{ method
   /**
    * Controller method dashboardImport()
    *
    */
   public function dashboardImport(){
     $this->render('dashboardImport');
   }
   
   // {{{ method
   /**
    * Controller method dataParser()
    *
    * Method for fetching the data from the excel sheet and inserted into the splited tables
    *
    */
   public function dataParser(){
     
     $zipcodearea = 0;
     $city = 0;
     $state = 0;
     
     $uploadType = $_REQUEST['uploadType'];
     $fileName   = $_FILES['dashboardImport']['name'];

     if(($uploadType == 1) || ($uploadType == 3)){
          $zipcodearea   = $_REQUEST['zipcodarea'];
         // $fileName = 'data';
     }
     else if($uploadType == 2){
          $city          = $_REQUEST['city'];
          $state         = $_REQUEST['state'];
        ///  $fileName      = 'data_city';
     }

     //$zipcode       = $_REQUEST['zipcode'];
     //$zipcodearea   = $_REQUEST['zipcodearea'];
     
     $file     = new File($fileName);
     $fileExt  = $file->ext();
     //$fileName = 'data';
     
     // Example of accessing data for a newly uploaded file
    // $fileName = $_FILES["dashboardImport"]["name"]; 
     $fileTmpLoc = $_FILES["dashboardImport"]["tmp_name"];
     // Path and file name
     //$pathAndName = "uploads/".$fileName;
     $sourcePath =  TMP . 'files' . DS  .$fileName;
     
     // Run the move_uploaded_file() function here
     $moveResult = move_uploaded_file($fileTmpLoc, $sourcePath);
     // Evaluate the value returned from the function if needed
     if ($moveResult == true) {
          echo "File has been moved from " . $fileTmpLoc . " to" . $pathAndName;
     } else {
          echo "ERROR: File not moved correctly";
     }

     
     //location for Tmp file uploaded into the db
    // $sourcePath =  TMP . 'files' . DS  .$fileName.'.'.'xls';
     
     $data = new Spreadsheet_Excel_Reader();
     $data->read($sourcePath);
     
     //Excel import
     
     //print_r($data->sheets);
     //exit;
     
     for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
          
          $medianPrice2Yrs        = '';
          $medianNoPrice2Yrs      = '';
          $median1Price2Yrs       = '';
          $medianForSalePriceSqft = '';
          $medianForSoldPriceDate = '';
          $medianForSoldPriceSqft = '';
          
          for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
              if(isset($data->sheets[0]['cells'][$i][$j])){
                    // $j represents the column for appropriate tables splitted the $j into the tables.     
                    if($j>=1 && $j<=5){
                         $medianPrice2Yrs[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j>=6 && $j<=8){
                         $medianForSoldPriceSqft[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    /*if($j>=7 && $j<=10){
                         $medianNoPrice2Yrs[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j>=11 && $j<=14){
                         $median1Price2Yrs[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j>=15 && $j<=19){
                         $medianForSalePriceSqft[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j==15){
                         $medianForSoldPriceDate = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j>=20 && $j<=23){
                         $medianForSoldPriceSqft[] = $data->sheets[0]['cells'][$i][$j];
                    }*/
              }else{
                    $datas[] = '';
              }
          }

          array_unshift($medianForSoldPriceSqft, $medianForSoldPriceDate);

          if($uploadType == 3){
               if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
                    //$impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_median_price_2years', $medianPrice2Yrs, $city, $state, $zipcodearea,$uploadType);
                    print_r($medianPrice2Yrs);
                    echo "<br/>";
                    exit;
               }
               
               if(isset($medianForSoldPriceSqft) && $medianForSoldPriceSqft!=''){
                   // print_r($medianForSoldPriceSqft);
                    //exit;
                   // $impMedianForSoldPriceSqft = $this->Dashboard->importMedianForSoldPriceSqft('tab_media_sold_sqft', $medianForSoldPriceSqft, $city, $state, $zipcodearea, $uploadType);
               } 
          }

          /*if(isset($medianNoPrice2Yrs) && $medianNoPrice2Yrs!=''){
               $impMedianNoPrice2Yrs = $this->Dashboard->importMedianNoPrice2Yrs('tab_median_noprice_2years', $medianNoPrice2Yrs, $city, $state, $zipcode,$zipcodearea);
          }
          if(isset($median1Price2Yrs) && $median1Price2Yrs!=''){
               $impMedian1Price2Yrs = $this->Dashboard->importMedian1Price2Yrs('tab_median_1price_2years', $median1Price2Yrs, $city, $state, $zipcode,$zipcodearea);
          }
          if(isset($medianForSalePriceSqft) && $medianForSalePriceSqft!=''){
               $impMedianForSalePriceSqft = $this->Dashboard->importMedianForSalePriceSqft('tab_media_forsale_sqft', $medianForSalePriceSqft, $city, $state, $zipcode,$zipcodearea);
          }
          if(isset($medianForSoldPriceSqft) && $medianForSoldPriceSqft!=''){
               $impMedianForSoldPriceSqft = $this->Dashboard->importMedianForSoldPriceSqft('tab_media_sold_sqft', $medianForSoldPriceSqft, $city, $state, $zipcode,$zipcodearea);
          }*/
     }
          //print_r($medianPrice2Yrs);
          //exit;
     if($uploadType == 1){
               if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
                    $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_tmp_dashboard_fields', $medianPrice2Yrs, $city, $state, $zipcodearea,$uploadType);
               }
               
               /*if(isset($medianForSoldPriceSqft) && $medianForSoldPriceSqft!=''){
                    $impMedianForSoldPriceSqft = $this->Dashboard->importMedianForSoldPriceSqft('tab_media_sold_sqft', $medianForSoldPriceSqft, $city, $state, $zipcodearea, $uploadType);
               } */
     }
     else if($uploadType == 2){
               if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
                    $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2YrsForCty('tab_median_price_2years', $medianPrice2Yrs, $city, $state, $zipcodearea,$uploadType);
               }
     }
     
     
     $data = array();
     $status = "";
     
     if($uploadType == 1){
          $data['zipcode_or_city'] = $zipcodearea;
     }
     else if($uploadType == 2){
         $data['zipcode_or_city'] = $city; 
     }
     
     //print_r($_REQUEST);
     
     //Dashboard youtube abd text insertion
     if($_REQUEST['youtube_data'] != ""){
          $data['selectedFieldValue']  = 'youtube_data';
          $data['fieldValue']    = mysql_escape_string($_REQUEST['youtube_data']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     if($_REQUEST['rss_left'] != ""){
          $data['selectedFieldValue']  = 'rss_field_left';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rss_left']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     if($_REQUEST['rss_right'] != ""){
          $data['selectedFieldValue']  = 'rss_feed_right';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rss_right']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     if($_REQUEST['dashboard_text'] != ""){
          $data['selectedFieldValue']  = 'text_message';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['dashboard_text']); 
          $status = $this->Dashboard->insertDashboardData($data);
     }
     echo "Data Inserted";
     exit;
   }
   
   public function getState(){
        Controller::loadModel('Dashboard');
        $q = strtoupper($_REQUEST["q"]);
        if (!$q) return;

        $stateCode = $this->Dashboard->getStateCode($q);

        for($i=0;$i<count($stateCode);$i++){
            echo $stateCode[$i]."\n";
        }
        exit;
   }
   
    public function getCity(){
          $selectedStateCode = $_REQUEST['stateVal'];
          Controller::loadModel('Dashboard');
          
          $q = strtoupper($_REQUEST["q"]);
          if (!$q) return;
          
          $cityCode = $this->Dashboard->getCityCode($q, $selectedStateCode);
     
          for($i=0;$i<count($cityCode);$i++){
               echo $cityCode[$i]."\n";
          }
          exit;
   }
   
    public function getZipCode(){
            $selectedCity = $_REQUEST['cityVal'];
            Controller::loadModel('Dashboard');

            $q = (string)$_REQUEST["q"];

            if (!isset($q)) return;

            $zipCode = $this->Dashboard->getZipCodes($q, $selectedCity);

            for($i=0;$i<count($zipCode);$i++){
                echo $zipCode[$i]."\n";
            }
            exit;
    }
    
    public function dashboardAdd(){
          $youtube = $this->Dashboard->getFieldDatas('youtube_data');
          $rss_feed_right = $this->Dashboard->getFieldDatas('rss_feed_right');
          $text_message = $this->Dashboard->getFieldDatas('text_message');
          $rss_field_left = $this->Dashboard->getFieldDatas('rss_field_left');
          
          $this->set('youtube',$youtube);
          $this->set('rss_feed_right',$rss_feed_right);
          $this->set('text_message',$text_message);
          $this->set('rss_field_left',$rss_field_left);
          $this->render('dashboardAdd');
    }
    
    public function updatesDashboardData(){
     
     //echo $_REQUEST['youtube'];
     //echo $_REQUEST['rssleft'];
     //echo $_REQUEST['rssright'];
     
     $data = array();
     $status = "";
     if($_REQUEST['youtube'] != ""){
          $data['selectedFieldValue']  = 'youtube_data';
          $data['fieldValue']    = mysql_escape_string($_REQUEST['youtube']);
          $status = $this->Dashboard->updateDashboardData($data);
     }
     
     
     if($_REQUEST['rssleft'] != ""){
          $data['selectedFieldValue']  = 'rss_field_left';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rssleft']);
          $status = $this->Dashboard->updateDashboardData($data);
     }
     
     
     if($_REQUEST['rssright'] != ""){
          $data['selectedFieldValue']  = 'rss_feed_right';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rssright']);
          $status = $this->Dashboard->updateDashboardData($data);
     }
     
     if($_REQUEST['dashboarddata'] != ""){
          $data['selectedFieldValue']  = 'text_message';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['dashboarddata']); 
          $status = $this->Dashboard->updateDashboardData($data);
     }
     
     if($status == 1){
          echo "success";
     }
     else{
          echo "Error";
     }
     
     $this->autoRender = false;
     //exit;
    }

}
?>

