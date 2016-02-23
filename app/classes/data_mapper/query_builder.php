<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of query_builder
 *
 * @author vasilyevab
 */

namespace app\classes\data_mapper;


class query_builder 
{
    private $query = null;
    
//    public function __construct($pdo = null)
//    {
//        $this->pdo = $pdo;
//    }

    public static function create()
    {
        return new static();
    }
    
    public function select($records = [])
    {
        $select = 'SELECT ';
        foreach($records as $record)
        {
            $select .= $record.', ';
        }
        $select = trim($select);
        $select = rtrim($select, ',');
        $this->query = $select;
        return $this;
    }

    public function from($tables = [])
    {
        $from = ' FROM ';
        foreach($tables as $table)
        {
            $from .= $table.', ';
        }
        $from = trim($from);
        $from = rtrim($from, ',');
        $this->query .= ' '.$from;
        //var_dump($this->query);
        return $this;
    }

    public function where($condition = [])
    {
        $where = ' WHERE ';
        foreach ($condition as $cond)
        {
            foreach($cond as $key => $val)
            $where .= $key.$val. ' and ';
        }
        $where = trim($where);
        $where = rtrim($where, 'and');
        $this->query .= ' ' . $where;
        return $this;
    }

    public function order_by($col, $cond = 'asc')
    {
        $ord = ' ORDER BY '.$col.' '.$cond;
        $this->query .= $ord;
        return $this;
    }

    public function limit($quantity, $start_row = 0)
    {
        if($start_row == null)
        {
            $start_row = 0;
        }
        $limit = ' LIMIT '.$start_row.','.$quantity;
        $this->query .= $limit;
        return $this;
    }

    public function insert($table, $columns = [])
    {
        $insert = 'INSERT INTO ';
        $this->query .= $insert.$table;
        $col = '(';
        foreach($columns as $column)
        {
            $col .= $column.', ';
        }
        $col = trim($col);
        $col = rtrim($col, ',');
        $col .= ')';
        $this->query .= $col.' ';
        return $this;
    }

    public function  values($values = [])
    {        
        $v = 'VALUES';
        $this->query .= $v;
        $val = '(';
        foreach($values as $value)
        {
            $val .= $value.', ';
        }
        $val = trim($val);
        $val = rtrim($val, ',');
        $val .= ')';
        $this->query .= $val;
        return $this;
    }
    
    public function delete()
    {
        $this->query .= 'DELETE ';
        return $this;
    }
    public function update($table)
    {
        $this->query .= 'UPDATE '.$table;
        return $this;
    }
    
    public function set($data = [])
    {
        $set = ' SET ';
        foreach ($data as $d)
        {
            foreach($d as $key => $val)
            $set .= $key.$val. ' , ';
        }
        $set = trim($set);
        $set = rtrim($set, ',');
        $this->query .= ' ' . $set;
        return $this;
    }

    public function get_query()
    {
        return $this->query;
    }
    
    public function clear_query()
    {
        $this->query = null;
    }
}
