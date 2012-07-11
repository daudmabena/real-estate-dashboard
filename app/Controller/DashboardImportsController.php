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

   public function dashboardImport(){
        $this->render('dashboardImport');
   }
   
   public function dataParser(){
     
     $fileName = $_FILES['dashboardImport']['name'];
     $file     = new File($fileName);
     $fileExt  = $file->ext();
     $fileName = 'data';
     
     $sourcePath =  TMP . 'files' . DS  .$fileName.'.'.$fileExt;
     
     $data = new Spreadsheet_Excel_Reader();
     $data->read($sourcePath);
     Controller::loadModel('Dashboard');
     
     for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
          $medianPrice2Yrs='';
          for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
              if(isset($data->sheets[0]['cells'][$i][$j])){
                    if($j>=1 && $j<=6){
                         $medianPrice2Yrs[] = $data->sheets[0]['cells'][$i][$j];
                    }
              }else{
                    $datas[] = '';
              }
          }
          if(isset($medianPrice2Yrs) && $medianPrice2Yrs!=''){
               $impMedianPrice2Yrs = $this->Dashboard->importMedianPrice2Yrs('tab_median_price_2years', $medianPrice2Yrs);
          }
     }
     echo "Data Inserted";
     exit;
   }
}
?>
