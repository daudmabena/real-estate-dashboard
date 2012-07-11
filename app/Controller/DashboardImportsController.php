<?php
//requires for reading the excel file.
require_once 'Component/reader.php';

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
      echo "hai";exit;
   }
}
?>