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
        require_once 'views/assets/header.php';
        require_once 'views/production/production_report.php';
        require_once 'views/assets/footer.php';
    }

    public function plotUnitsSoldsAndWarehousing(Type $var = null)
    {
        
        echo json_encode();
    }

    public function plotCostsAndIncome(Type $var = null)
    {
        echo json_encode();
    }

    public function plotProdcutsSold(Type $var = null)
    {
        echo json_encode();
    }
}
