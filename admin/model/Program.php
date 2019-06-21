<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class Program extends Database
{
    public function save_program($name, $program_code, $started_on, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_program(program_name, program_code, started_on, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$name', '$program_code', '$started_on', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_program()
    {
        $query_string = "select * from tbl_program";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_program($id)
    {

    }

    public function delete_program($id)
    {
        $query_string = "DELETE from tbl_program where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_program($id)
    {

    }

    /*public function increase_visit_count($id)
    {
        $query_string = "update class_routine set visit_counter = visit_counter+1 where id = $id";
        $this->query($query_string);
    }*/
}