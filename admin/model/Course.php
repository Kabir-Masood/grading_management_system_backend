<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class Course extends Database
{
    public function save_course($course_name, $course_code, $course_credit, $teacher_id, $semester_id, $dept_id, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_course(course_name, course_code, course_credit, teacher_id, semester_id, dept_id, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$course_name', '$course_code', '$course_credit', '$teacher_id', '$semester_id', '$dept_id', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_course()
    {
        $query_string = "select * from tbl_course";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_course($id)
    {
        $query_string = "select * from tbl_course where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function get_course_by_teacher($teacher_id)
    {
        $query_string = "select * from tbl_course WHERE teacher_id = '$teacher_id'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function delete_course($id)
    {
        $query_string = "DELETE from tbl_course where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;

    }

    public function update_course($id, $course_name, $course_code, $course_credit, $teacher_id, $dept_id, $modified_by, $modified_date)
    {

        $queryString = "UPDATE tbl_course SET course_name = '$course_name', course_code = '$course_code', course_credit = '$course_credit', teacher_id = '$teacher_id', dept_id = '$dept_id', modified_by = '$modified_by', modified_date = '$modified_date' WHERE id = '$id' ";
        $this->query($queryString);
        return true;
    }

    public function getIDByCourseCode($course_code)
    {
        $query_string = "select id from tbl_course where course_code = '$course_code'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }
}