<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class Batch extends Database
{
    public function save_batch($batch_name, $dept_id, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_batch(batch_name, dept_id, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$batch_name', '$dept_id', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_batch()
    {
        $query_string = "select * from tbl_batch";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_batch($id)
    {
        $query_string = "select * from tbl_batch where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function get_all_batch_by_deptID($dept_id)
    {
        $query_string = "select * from tbl_batch WHERE dept_id = '$dept_id'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function delete_batch($id)
    {
        $query_string = "DELETE from tbl_batch where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_batch($id, $batch_name, $modified_by, $modified_date)
    {
        $queryString = "UPDATE tbl_batch SET batch_name = '$batch_name', modified_by = '$modified_by', modified_date = '$modified_date' WHERE id = '$id' ";
        $this->query($queryString);
        return true;
    }

}