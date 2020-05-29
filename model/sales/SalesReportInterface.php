<?php
interface SalesReportInterface {
    public function salesPerCustomer($year=NULL, $month=NULL, $week=NULL, $day=NULL);
    public function salesRevenuePerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL);
    public function sellingExpensesPerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL);
    public function totalSales($year=NULL, $month=NULL, $week=NULL, $day=NULL);
    public function totalProductsSold($year=NULL, $month=NULL, $week=NULL, $day=NULL);
}