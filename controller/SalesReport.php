<?php
class SalesReport
{
    private $saleData;

    public function __construct() 
    {
        require_once 'model/sales/Sales.php';
        $this->saleData = new Sales();
    }

    public function index()
    {   
        if (isset($_SESSION['user'])) {
            require_once 'views/assets/header.php';
            require_once 'views/sales/sales_report.php';
            require_once 'views/assets/footer.php';
        }else{
            header('location: .');
        }
    }

    public function plotSalesPerCustomer()
    {
        if (isset($_SESSION['user'])) {
            // $date = $_POST['date'];
            // $data = $this->saleData->salesPerCustomer($date->year, $date->month, $date->week, $date->day);
            // echo json_encode($data);

            $example = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
            echo json_encode($example);
            
            return;
        }else{
            header('location: .');
        }
    }

    public function plotSalesPerDate() 
    {
        if (isset($_SESSION['user'])) {
            // $date = $_POST['date'];
            // $data1 = $this->saleData->salesRevenuePerDate($date->year, $date->month, $date->week, $date->day);
            // $data2 = $this->saleData->sellingExpensesPerDate($date->year, $date->month, $date->week, $date->day);
            // echo json_encode(array("salesRevenue"=>$data1, "sellingExpenses"=>$data2));

            $example = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
            echo json_encode($example);
            return;
        }else{
            header('location: .');
        }
    }

    public function plotSalesProducts() 
    {
        if (isset($_SESSION['user'])) {
            // $date = $_POST['date'];
            // $data = $this->saleData->totalProductosSold($date->year, $date->month, $date->week, $date->day);
            // echo json_encode($data);
            
            $example = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
            echo json_encode($example);
            return;
        }else{
            header('location: .');
        }
    }
}
