<?php
class ProductionReport
{
    private $productionReport;

    public function __construct(Type $var = null)
    {
        require_once 'model/production/Production.php';
        $this->productionReport = new Production();
    }

    public function index(Type $var = null)
    {
        if (isset($_SESSION['user'])) {
            require_once 'views/assets/header.php';
            require_once 'views/production/production_report.php';
            require_once 'views/assets/footer.php';
        } else {
            header('location: .');
        }
    }

    public function plotUnitsSoldsAndWarehousing()
    {
        if (isset($_SESSION['user'])) {
            
            echo json_encode();
        } else {
            header('location: .');
        }
    }

    public function plotCostsAndIncome()
    {
        if (isset($_SESSION['user'])) {
            
            echo json_encode();
        } else {
            header('location: .');
        }
    }

    public function plotProdcutsSold()
    {
        if (isset($_SESSION['user'])) {
            
            echo json_encode();
        } else {
            header('location: .');
        }
    }
}
