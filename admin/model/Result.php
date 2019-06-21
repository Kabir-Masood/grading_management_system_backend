<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/28/18
 * Time: 12:20 PM
 */

include_once __DIR__ . '/../Database.php';

class Result extends Database
{
    public function save_result($student_id, $course_id, $teacher_id, $semester_id, $class_test_marks, $mid_term_marks, $final_term_marks, $attendance_marks, $is_class_test_finally_submitted, $is_mid_finally_submitted, $is_final_finally_submitted, $is_attendance_finally_submitted, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_student_result(student_id, course_id, teacher_id, semester_id, class_test_marks, mid_term_marks, final_term_marks, attendance_marks, is_class_test_finally_submitted, is_mid_finally_submitted, is_final_finally_submitted, is_attandance_finally_submitted, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$student_id', '$course_id', '$teacher_id', '$semester_id', '$class_test_marks', '$mid_term_marks', '$final_term_marks', '$attendance_marks', '$is_class_test_finally_submitted', '$is_mid_finally_submitted', '$is_final_finally_submitted', '$is_attendance_finally_submitted', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function save_result1($student_id, $semester_id, $course_id, $teacher_id, $class_test_marks, $mid_term_marks, $final_term_marks, $attendance_marks, $is_class_test_finally_submitted, $is_mid_finally_submitted, $is_final_finally_submitted, $is_attendance_finally_submitted, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $queryString = "insert into tbl_student_result(student_id, semester_id, course_id, teacher_id, class_test_marks, mid_term_marks, final_term_marks, attendance_marks, is_class_test_finally_submitted, is_mid_finally_submitted, is_final_finally_submitted, is_attandance_finally_submitted, created_by, created_date, modified_by, modified_date, remarks, is_active) values('$student_id', '$semester_id', '$course_id', '$teacher_id', '$class_test_marks', '$mid_term_marks', '$final_term_marks', '$attendance_marks', '$is_class_test_finally_submitted', '$is_mid_finally_submitted', '$is_final_finally_submitted', '$is_attendance_finally_submitted', '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active');";
        $this->query($queryString);
    }

    public function get_all_registered_course()
    {
        $query_string = "select * from tbl_course course JOIN tbl_course_registration registration On registration.course_id = course.id";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function checkResult($st_id, $semId, $courseId)
    {
        $query_string = "select * from tbl_student_result WHERE student_id = '$st_id' AND semester_id = '$semId' AND course_id = '$courseId'";
        $q = $this->query($query_string);
        $data = $this->fetch($q);

        if ($data) {
            return true;
        } else {
            return false;
        }
    }


    public function get_all_result()
    {
        $query_string = "select * from tbl_student_result";
        $q = $this->query($query_string);
        $data = $this->fetch($q);
        return $data;
    }

    public function get_single_result($id)
    {
        $query_string = "select * from tbl_student_result where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function delete_student_result($id)
    {
        $query_string = "DELETE from tbl_student_result where id = '$id'";
        $q = $this->query($query_string);
        $data = $this->fetch_assoc($q);
        return $data;
    }

    public function update_student_result($id, $class_test, $mid_term, $final, $attendance, $modified_by, $modified_date)
    {
        $queryString = "UPDATE tbl_student_result SET class_test_marks = '$class_test', mid_term_marks = '$mid_term', final_term_marks = '$final', attendance_marks = '$attendance', modified_by = '$modified_by', modified_date = '$modified_date' WHERE id = '$id' ";
        $this->query($queryString);
        return true;
    }

    public function get_registered_course_by_teacher($id)
    {
        $query_string = "select * from tbl_course /* course JOIN tbl_course course ON teacher.dept_id = course.dept_id where tbl_course_registration.course_id*/ WHERE teacher_id= '$id'";
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