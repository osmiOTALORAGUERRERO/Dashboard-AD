<?php
require_once 'SalesReportInterface.php';
class Sales implements SalesReportInterface
{
    private $db;
    public function __construct()
    {
        $this->db = Connection::schemaSales();
    }

    public function salesPerCustomer($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {

    }

    public function salesRevenuePerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {

    }

    public function sellingExpensesPerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {

    }

    public function totalSales($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {

    }

    public function totalProductosSold($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {
        
    }
}
