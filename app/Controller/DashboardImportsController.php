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
    * Controller method Index()
    *
    */
   public function index(){
     
    $parameters = array();
     
     $this->set('countries', $this->AppModel->bind_country());
     
     //Current Year Date
     $currentYear = date('Y-m-d');
     
     // $date = date('Y-m-d',strtotime('2010-01-01 -1 year'));
     $lastyear = strtotime("-1 year", strtotime($currentYear));
     
     // format and display the computed date
     $lastYear = date("Y-m-d", $lastyear);
     
     // ZipCode of city
     $zipCode = '12207';
     $city = 'Albany';
     $lastYearTotalSum = "";
     $lastYearTotalDivider = "";
     
     $previouslastyear = strtotime("-1 year", strtotime($lastYear));
     
     $previousLastYear = date("Y-m-d", $previouslastyear);
     
     $lastYears = array($lastYear, $previousLastYear);
     
     $countYears = count($lastYears);
     
     //Array Value for Parameters of tableNAme, fieldName, zipCode, fromDate and toDate
          
     $parameters['fieldName'] = 'zip_code';
     $parameters['selectFieldName'] = 'for_sale_median';
     $parameters['tableName'] = 'tab_median_price_2years';
     
     if($parameters['fieldName'] == "zip_code"){
          $parameters['fieldValue'] = $zipCode;
     }
     else if($parameters['fieldName'] == "city"){
          $parameters['fieldValue'] = $city;
     }
     
     for($i=0; $i<$countYears; $i++){
          if($i == 0){
               $parameters['fromDate'] = $lastYears[0];
               $parameters['toDate'] = $currentYear;
          }
          else{
               $parameters['fromDate'] = $lastYears[1];
               $parameters['toDate'] = $lastYears[0];
          }
          $this->Calculation->setData($parameters);
          $lastYearValue = $this->Calculation->calculateMedian12months();
          if($i == 1){
               //Getting Divider here
               $lastYearTotalDivider = $lastYearValue;
          }
          //Getting Sum of total year with last Two Years
          echo $lastYearValue."</br>";
          $lastYearTotalSum += $lastYearValue;
          //$countYears--;
     }
     echo $lastYearTotalSum/$lastYearTotalDivider;
   }
   
   
   // {{{ method
   /**
    * Controller method dataParser()
    *
    * Method for fetching the data from the excel sheet and inserted into the splited tables
    *
    */
   public function dataParser(){
     
     $fileName = $_FILES['dashboardImport']['name'];
     $city     = $_REQUEST['city'];
     $state    = $_REQUEST['state'];
     $zipcode  = $_REQUEST['zipcode'];
     
     $file     = new File($fileName);
     $fileExt  = $file->ext();
     $fileName = 'data';
     
     //location for Tmp file uploaded into the db
     $sourcePath =  TMP . 'files' . DS  .$fileName.'.'.$fileExt;
     
     $data = new Spreadsheet_Excel_Reader();
     $data->read($sourcePath);
     
     for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
          
          $medianPrice2Yrs        = '';
          $medianNoPrice2Yrs      = '';
          $median1Price2Yrs       = '';
          $medianForSalePriceSqft = '';
          
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
              }else{
                    $datas[] = '';
              }
          }
          if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
               $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_median_price_2years', $medianPrice2Yrs, $city, $state, $zipcode);
          }
          if(isset($medianNoPrice2Yrs) && $medianNoPrice2Yrs!=''){
               $impMedianNoPrice2Yrs = $this->Dashboard->importMedianNoPrice2Yrs('tab_median_noprice_2years', $medianNoPrice2Yrs, $city, $state, $zipcode);
          }
          if(isset($median1Price2Yrs) && $median1Price2Yrs!=''){
               $impMedian1Price2Yrs = $this->Dashboard->importMedian1Price2Yrs('tab_median_1price_2years', $median1Price2Yrs, $city, $state, $zipcode);
          }
          if(isset($medianForSalePriceSqft) && $medianForSalePriceSqft!=''){
               $impMedianForSalePriceSqft = $this->Dashboard->importMedianForSalePriceSqft('tab_media_forsale_sqft', $medianForSalePriceSqft, $city, $state, $zipcode);
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
}
?>

