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
     
     $fileName      = $_FILES['dashboardImport']['name'];
     $city          = $_REQUEST['city'];
     $state         = $_REQUEST['state'];
     $zipcode       = $_REQUEST['zipcode'];
     $zipcodearea   = $_REQUEST['zipcodearea'];
     
     $file     = new File($fileName);
     $fileExt  = $file->ext();
     $fileName = 'data';
     
     //location for Tmp file uploaded into the db
     $sourcePath =  TMP . 'files' . DS  .$fileName.'.'.$fileExt;
     
     $data = new Spreadsheet_Excel_Reader();
     $data->read($sourcePath);
     
     //Excel import
     
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
                    if($j>=1 && $j<=6){
                         $medianPrice2Yrs[] = $data->sheets[0]['cells'][$i][$j];
                    }
                    if($j>=7 && $j<=10){
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
                    }
              }else{
                    $datas[] = '';
              }
          }

          array_unshift($medianForSoldPriceSqft, $medianForSoldPriceDate);

          if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
               $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_median_price_2years', $medianPrice2Yrs, $city, $state, $zipcode,$zipcodearea);
          }
          if(isset($medianNoPrice2Yrs) && $medianNoPrice2Yrs!=''){
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
          }
          
          
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
    
    public function insertDashboardData(){
     
     //echo $_REQUEST['youtube'];
     //echo $_REQUEST['rssleft'];
     //echo $_REQUEST['rssright'];
     
     Controller::loadModel('Dashboard');
     $data = array();
     $status = "";
     if($_REQUEST['youtube'] != ""){
          $data['selectedFieldValue']  = 'youtube_data';
          $data['fieldValue']    = mysql_escape_string($_REQUEST['youtube']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     
     
     if($_REQUEST['rssleft'] != ""){
          $data['selectedFieldValue']  = 'rss_field_left';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rssleft']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     
     
     if($_REQUEST['rssright'] != ""){
          $data['selectedFieldValue']  = 'rss_feed_right';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['rssright']);
          $status = $this->Dashboard->insertDashboardData($data);
     }
     
     if($_REQUEST['dashboarddata'] != ""){
          $data['selectedFieldValue']  = 'text_message';
          $data['fieldValue']    = str_replace("'", "&#39;", $_REQUEST['dashboarddata']); 
          $status = $this->Dashboard->insertDashboardData($data);
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

