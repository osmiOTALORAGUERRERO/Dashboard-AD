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
        $query = 'SELECT customer_dim.c_name AS customer_name, SUM(sales_fact.sales_units) AS units_buyed
        FROM customer_dim, sales_fact, date_dim
        WHERE sales_fact.customer_id = customer_dim.customer_nit 
            AND sales_fact.date_id = date_dim.date_id';
       
        $options = array();
        if (!empty($year)) {
            $query .= " AND year=:year";
            $options = array_merge($options, array(':year' => $year));
            if (!empty($month)) {
                $query .= ' AND month=:month';
                $options = array_merge($options, array(':month' => $month));
                if (!empty($day)) {
                    $query .= ' AND day=:day';
                    $options = array_merge($options, array(':day' => $day));
                } else if(!empty($week)){
                    $query .= ' AND week=:week';
                    $options = array_merge($options, array(':week' => $week));
                }
            } 
        } 
        $query .= ' GROUP BY customer_dim.c_name';
        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function salesRevenuePerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {
        $select = 'SELECT date_dim.year';
        $groupby = 'date_dim.year';
        $where = '';
        $options = array();
        if (!empty($year)) {
            $select = 'SELECT date_dim.month';
            $groupby = 'date_dim.month';
            $where = 'AND date_dim.year = :year';
            $options = array_merge($options, array(':year'=>$year));
            if (!empty($month)) {
                $select = 'SELECT date_dim.week';
                $groupby = 'date_dim.week';
                $where = 'AND date_dim.year = :year AND date_dim.month = :month';
                $options = array_merge($options, array(':year'=>$year, ':month'=>$month));
                if(!empty($week)){
                    $select = 'SELECT date_dim.day';
                    $groupby = 'date_dim.day';
                    $where = 'AND date_dim.year = :year AND date_dim.month = :month AND date_dim.week = :week';
                    $options = array_merge($options, array(':year'=>$year, ':month'=>$month, ':week'=>$week));                    
                }
            }
        }
        $query = $select.', SUM(sales_fact.sales_units * product_dim.p_price) AS sales_revenue
            FROM sales_fact, product_dim, date_dim
            WHERE sales_fact.product_id = product_dim.product_id
            AND sales_fact.date_id = date_dim.date_id '. $where. 
            ' GROUP BY '.$groupby.
            ' ORDER BY '.$groupby;
        
        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data = $statement -> fetchAll(PDO::FETCH_BOTH);
        
        return $data;
    }

    public function sellingExpensesPerDate($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {
        $select = 'SELECT date_dim.year';
        $groupby = 'date_dim.year';
        $where = '';
        $options = array();
        if (!empty($year)) {
            $select = 'SELECT date_dim.month';
            $groupby = 'date_dim.month';
            $where = 'AND date_dim.year = :year';
            $options = array_merge($options, array(':year'=>$year));
            if (!empty($month)) {
                $select = 'SELECT date_dim.week';
                $groupby = 'date_dim.week';
                $where = 'AND date_dim.year = :year AND date_dim.month = :month';
                $options = array_merge($options, array(':year'=>$year, ':month'=>$month));
                if(!empty($week)){
                    $select = 'SELECT date_dim.day';
                    $groupby = 'date_dim.day';
                    $where = 'AND date_dim.year = :year AND date_dim.month = :month AND date_dim.week = :week';
                    $options = array_merge($options, array(':year'=>$year, ':month'=>$month, ':week'=>$week));                    
                }
            }
        }
        $query = $select.', SUM(sales_fact.sales_units * product_dim.p_cost_production) AS selling_expenses
            FROM sales_fact, product_dim, date_dim
            WHERE sales_fact.product_id = product_dim.product_id
            AND sales_fact.date_id = date_dim.date_id '. $where. 
            ' GROUP BY '.$groupby.
            ' ORDER BY '.$groupby;

        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data = $statement -> fetchAll(PDO::FETCH_BOTH);
        
        return $data;
    }

    public function totalSales($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {
        $where = '';
        $options = array();
        if (!empty($year)) {
            $where = 'AND date_dim.year = :year';
            $options = array_merge($options, array(':year'=>$year));
            if (!empty($month)) {
                $where = 'AND date_dim.year = :year AND date_dim.month = :month';
                $options = array_merge($options, array(':year'=>$year, ':month'=>$month));
                if(!empty($week)){
                    $where = 'AND date_dim.year = :year AND date_dim.month = :month AND date_dim.week = :week';
                    $options = array_merge($options, array(':year'=>$year, ':month'=>$month, ':week'=>$week));                    
                }
            }
        }
        $query = 'SELECT count(*) AS sales_number FROM sales.sales_fact, sales.date_dim
                    WHERE sales_fact.date_id = date_dim.date_id '.$where;
        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data1 = $statement -> fetchAll(PDO::FETCH_ASSOC);

        $query = 'SELECT sum(sales_units) AS units_number FROM sales.sales_fact, sales.date_dim
                    WHERE sales_fact.date_id = date_dim.date_id '.$where;
        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data2 = $statement -> fetchAll(PDO::FETCH_ASSOC);

        return array($data1, $data2);
    }

    public function totalProductsSold($year=NULL, $month=NULL, $week=NULL, $day=NULL)
    {
        $query = 'SELECT product_dim.p_name AS name, sum(sales_fact.sales_units) AS units
            FROM sales_fact, product_dim, date_dim
            WHERE sales_fact.product_id = product_dim.product_id
            AND sales_fact.date_id = date_dim.date_id';
        $options = array();
        if (!empty($year)) {
            $query .= ' AND date_dim.year = :year';
            $options = array_merge($options, array(':year' => $year));
            if (!empty($month)) {
                $query .= ' AND date_dim.month = :month';
                $options = array_merge($options, array(':month' => $month));
                if (!empty($day)) {
                    $query .= ' AND date_dim.day = :day';
                    $options = array_merge($options, array(':day' => $day));
                } else if (!empty($week)) {
                    $query .= ' AND date_dim.week = :week';
                    $options = array_merge($options, array(':week' => $week));
                }
            } 
        }
        $query .= ' GROUP BY product_dim.p_name';
        $statement = $this->db->prepare($query);
        $statement->execute($options);
        $data = $statement -> fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
