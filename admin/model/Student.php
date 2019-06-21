<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

/*, `full_name`, `user_id`, `password`, `mobile`, `email`, `user_type`, `batch`, `shift`, `dept`, `created_by`, `created_date`, `modified_by`, `modified_date`, `remarks`, `is_active`SELECT * FROM `tbl_student` WHERE 1*/

class Student extends Database
{
    public function save_student($full_name, $user_id, $email, $user_password, $user_phone, $batch, $dept, $semester_id, $program_id, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_student(full_name, user_id, email, password, mobile, batch_id, dept_id, semester_id, program_id, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$full_name', '$user_id', '$email', '$user_password', '$user_phone', '$batch', '$dept', '$semester_id', '$program_id', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_student()
    {
        $query_string = "select * from tbl_student student join tbl_batch batch on student.batch_id = batch.id join tbl_department department on student.dept_id = department.id";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_student_for_add_result()
    {
        $query_string = "select *  from tbl_student ";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }


    public function getBatch()
    {
        $query_string = "SELECT DISTINCT batch FROM tbl_student";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_student($id)
    {
        $query_string = "select * from tbl_student where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function delete_student($id)
    {
        $query_string = "DELETE from tbl_student where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_student($id)
    {

    }

    public function getStudentCount()
    {
        $query_string = "SELECT COUNT(*) FROM tbl_student";
        $q = $this->query($query_string);
        return $q;
    }

    public function getIDByUserID($user_id)
    {
        $query_string = "select id from tbl_student where user_id = '$user_id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    /*public function increase_visit_count($id)
    {
        $query_string = "update bg_post set visit_counter = visit_counter+1 where id = $id";
        $this->query($query_string);
    }*/
}