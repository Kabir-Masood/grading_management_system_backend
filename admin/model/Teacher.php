<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

/*, `full_name`, `user_id`, `password`, `mobile`, `email`, `user_type`, `batch`, `shift`, `dept`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`SELECT * FROM `tbl_student` WHERE 1*/

class Teacher extends Database
{
    public function save_teacher($full_name, $email, $user_id, $password, $mobile, $dept_id, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_teacher(full_name, email, user_id, password, mobile, dept_id, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$full_name', '$email', '$user_id', '$password', '$mobile', '$dept_id', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_teacher()
    {
        $query_string = "select * from tbl_teacher";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_teacher_by_deptID($dept_id)
    {
        $query_string = "select * from tbl_teacher WHERE dept_id = '$dept_id'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_teacher($id)
    {
        $query_string = "select * from tbl_teacher WHERE id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function delete_teacher($id)
    {
        $query_string = "DELETE from tbl_teacher where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_teacher($id)
    {

    }

    public function getIDByUserName($teacher_name)
    {
        $query_string = "select id from tbl_teacher where full_name = '$teacher_name'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    /*public function increase_visit_count($id)
    {
        $query_string = "update class_routine set visit_counter = visit_counter+1 where id = $id";
        $this->query($query_string);
    }*/
}