<?php
Class TableProcessing {
    protected $search;
    protected $query_search;
    protected $length;
    protected $start;
    protected $pStart;
    protected $limit;
    protected $column_sort;
    protected $orderBY;
    protected $column;
    protected $dir;
    protected $draw;
    protected $dataCol;
    protected $dataSearch;
    public function __construct($dataGet)
    {
        $this->pStart     = $dataGet['start'];
        $this->length     = $dataGet['length'];
        $this->search     = $dataGet['search'];
        $this->dir        = $dataGet['dir'];
        $this->draw       = $dataGet['draw'];
        $this->dataCol    = $dataGet['dataCol'];
        $this->dataSearch = $dataGet['dataSearch'];

        $this->query_search = $this->getQuery_search($dataGet['search']);
        $this->length = $this->getLength($dataGet['start']);
        $this->start = $this->getStart($dataGet['start']);
        $this->limit = $this->getLimit();
        $this->column = $this->getColumn($dataGet['column']);
        $this->column_sort = $this->getColumn_sort();
        $this->orderBY = $this->getOrderBY();
    }

    public function getQuery_search($search){
        $query_search = "";
        if (!empty($search)) {
            $query_search = $this->getStringSearch($search);
        } else {
            $query_search = "";
        }
        return $query_search;
    }

    public function getStringSearch($search) {
        $arrSearch = $this->dataSearch;
        
        // Initialize an empty array to store individual search conditions
        $conditions = [];
    
        // Loop through the array of search fields
        foreach ($arrSearch as $value) {
            // Add each search condition to the array
            $conditions[] = "`$value` LIKE '%" . $search . "%'";
        }
    
        // Join the individual conditions with "OR" to create the final condition
        $finalCondition = implode(" OR ", $conditions);
    
        // Construct the SQL query string
        $sql = "AND ($finalCondition)";
    
        return $sql;
    }

    public function getLength($start){
        if ($start == 0) {
            $length = $this->length;
        } else {
            $length = $this->length;
        }
        return $length;
    }

    public function getStart($start){
        // if($start == 0) 
        //     return 0;
        $start = ($start - 1) * $this->length;
        return $start;
    }

    public function getLimit(){
        $limit = "LIMIT " . $this->pStart . ", " . $this->length . "";
        $this->length == -1 ? $limit = "" : '';
        return $limit;
    }

    public function getColumn($column){
        empty($column) ? $column = 0 : $column;
        return $column;
    }

    public function getColumn_sort(){
        $column_sort = $this->dataCol;
        return $column_sort;
    }

    public function getOrderBY(){
        $column_sort = $this->column_sort;
        $orderBY = $column_sort[$this->column];
        return $orderBY;
    }
}