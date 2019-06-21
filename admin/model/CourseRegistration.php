<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class CourseRegistration extends Database
{
    public function save_course_registration($course_id, $student_result_id, $student_id, $semester_id, $registration_type, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_course_registration(course_id, student_result_id, student_id, semester_id, registration_type, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$course_id', '$student_result_id', '$student_id', '$semester_id', '$registration_type', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_course()
    {
        $query_string = "select * from tbl_course";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_reg_by_student($student_id, $course_id)
    {
        $query_string = "select * from tbl_course_registration WHERE student_id = '$student_id' AND course_id = '$course_id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function get_all_reg_student_by_course($course_id)
    {
        $query_string = "select registration.student_id, student.full_name, registration.semester_id, registration.course_id from tbl_course_registration registration JOIN tbl_student student ON student.id = registration.student_id WHERE registration.course_id ='$course_id' ";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_batch()
    {
        $query_string = "select * from tbl_batch";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_department()
    {
        $query_string = "select * from tbl_department";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_semester()
    {
        $query_string = "select * from tbl_semester";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_all_course_registration()
    {
        $query_string = "select * from tbl_course_registration";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function getStudentByDeptIdAndBatchId($deptId, $batchId)
    {
        $query_string = "select * from tbl_student WHERE dept_id = '$deptId' AND batch_id = '$batchId'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function getCourseByStudentId($studentId)
    {
        $query_string = "select * from tbl_course join tbl_student on tbl_course.dept_id = tbl_student.dept_id WHERE id = '$studentId'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function getDepartmentByStudentIdAndSemId($studentId, $semId)
    {
        $query_string = "select * from tbl_department WHERE id = '$studentId' AND semester_id = '$semId'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function checkCourseReg($st_id, $semId, $courseId)
    {
        $query_string = "select * from tbl_course_registration WHERE course_id = '$courseId' AND semester_id = '$semId' AND student_id = '$st_id'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);

        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function get_single_course($id)
    {

    }

    public function delete_course_registration($id)
    {
        $query_string = "DELETE from tbl_course_registration where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_course_registration($id)
    {

    }

    /*public function increase_visit_count($id)
    {
        $query_string = "update class_routine set visit_counter = visit_counter+1 where id = $id";
        $this->query($query_string);
    }*/
}