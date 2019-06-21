<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class Admin extends Database
{
    public function save_admin($full_name, $email, $user_id, $admin_role, $password, $mobile, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_admin(full_name, email, user_id, admin_role, password, mobile, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$full_name', '$email', '$user_id', '$admin_role', '$password', '$mobile', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_admin()
    {
        $query_string = "select * from tbl_admin";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function userLogin($email, $password)
    {
        $query_string = "select * from tbl_admin where email = '$email' and  password = '$password' and is_active = '1'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_admin($id)
    {
        $query_string = "select * from tbl_admin where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function delete_admin($id)
    {
        $query_string = "DELETE from tbl_admin where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_admin($id, $full_name, $email, $user_id, $admin_role, $password, $mobile, $modified_by, $modified_date)
    {
        $queryString = "UPDATE tbl_admin SET full_name = '$full_name', email = '$email', user_id = '$user_id', admin_role = '$admin_role', password = '$password', mobile = '$mobile', modified_by = '$modified_by', modified_date = '$modified_date' WHERE id = '$id' ";
        $this->query($queryString);
        return true;
    }

    /*public function increase_visit_count($id)
    {
        $query_string = "update class_routine set visit_counter = visit_counter+1 where id = $id";
        $this->query($query_string);
    }*/
}