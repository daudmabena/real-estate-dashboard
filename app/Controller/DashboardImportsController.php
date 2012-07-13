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
   var $uses = array('AppModel','Dashboard');
   
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
     
     $this->set('countries', $this->AppModel->bind_country());
     
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
               $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_median_price_2years', $medianPrice2Yrs);
          }
          if(isset($medianNoPrice2Yrs) && $medianNoPrice2Yrs!=''){
               $impMedianNoPrice2Yrs = $this->Dashboard->importMedianNoPrice2Yrs('tab_median_noprice_2years', $medianNoPrice2Yrs);
          }
          if(isset($median1Price2Yrs) && $median1Price2Yrs!=''){
               $impMedian1Price2Yrs = $this->Dashboard->importMedian1Price2Yrs('tab_median_1price_2years', $median1Price2Yrs);
          }
          if(isset($medianForSalePriceSqft) && $medianForSalePriceSqft!=''){
               $impMedianForSalePriceSqft = $this->Dashboard->importMedianForSalePriceSqft('tab_media_forsale_sqft', $medianForSalePriceSqft);
          }
          
     }
     echo "Data Inserted";
     exit;
   }
}
?>
