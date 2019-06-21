<?php


class DB_Functions
{

    private $conn;

    // constructor
    function __construct()
    {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct()
    {

    }

    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password)
    {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt

        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at) VALUES(?, ?, ?, ?, ?, NOW())");
        $stmt->bind_param("sssss", $uuid, $name, $email, $encrypted_password, $salt);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    /**
     * Get user by email and password
     */
    public function getStudentByIdAndPassword($user_id, $password)
    {

        $stmt = $this->conn->prepare("SELECT * FROM tbl_student WHERE user_id = '$user_id' AND password = '$password'");
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            return $user;
        } else {
            return NULL;
        }

        $stmt->close();

        /*$stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }*/
    }

    public function getTeacherByIdAndPassword($user_id, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_teacher WHERE user_id = '$user_id' AND password = '$password'");
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            return $user;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getUserByAndPassword($user_id, $old_password)
    {
        if (strlen($user_id) <= 6) {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_teacher WHERE user_id = '$user_id' AND password = '$old_password'");
        } else if (strlen($user_id) >= 10) {
            $stmt = $this->conn->prepare("SELECT * FROM tbl_student WHERE user_id = '$user_id' AND password = '$old_password'");
        }

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            return $user;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function changeStudentPassword($user_id, $old_password, $new_password)
    {

        //  $sql = "UPDATE data SET Age='28' WHERE id=201";
        $stmt = $this->conn->prepare("UPDATE tbl_student SET password = '$new_password' WHERE user_id = '$user_id'");

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public function changeTeacherPassword($user_id, $old_password, $new_password)
    {
        //  $sql = "UPDATE data SET Age='28' WHERE id=201";
        $stmt = $this->conn->prepare("UPDATE tbl_teacher SET password = '$new_password' WHERE user_id = '$user_id'");

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
        $stmt->close();
    }

    public function getCourseByTeacherId($t_id)
    {
        $stmt = $this->conn->prepare("SELECT * from tbl_course WHERE teacher_id = '$t_id'");

        if ($stmt->execute()) {
            $courses = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
//            $courses = $stmt->get_result()->fetch_row();
            return $courses;
        } else {
            return NULL;
        }
        $stmt->close();
    }


    public function getCourseByStudentId($t_id, $semester_id)
    {
        $stmt = $this->conn->prepare("SELECT * from tbl_course_registration registration JOIN  tbl_course course ON registration.course_id = course.id WHERE registration.student_id = '$t_id' AND registration.semester_id = '$semester_id'");

        if ($stmt->execute()) {
            $courses = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $courses[] = $row;
            }
//            $courses = $stmt->get_result()->fetch_row();
            return $courses;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getStudentSemester($t_id)
    {


        $stmt = $this->conn->prepare("SELECT * from tbl_semester  ORDER BY id desc limit 1");

        if ($stmt->execute()) {
            $semester = array();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $semester[] = $row;
            }
            return $semester;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getAllStudent()
    {
        $stmt = $this->conn->prepare("SELECT * from tbl_student");

        if ($stmt->execute()) {
            $students = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
//            $courses = $stmt->get_result()->fetch_row();
            return $students;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    /*int id = studentObject.optInt(USER_ID);
                String sName = studentObject.optString(REST_USER_FULL_NAME);
                String sID = studentObject.optString(REST_USER_ID);
                String sEmail = studentObject.optString(REST_USER_EMAIL);
                String sMobile = studentObject.optString(REST_USER_MOBILE);
                String sBatch = studentObject.optString(REST_USER_BATCH);
                String sDept = studentObject.optString(REST_USER_DEPT);
                String sSemester = studentObject.optString(USER_COURSE_SEMESTER_ID);
                String sProgram = studentObject.optString(REST_USER_PROGRAM_ID);*/

    public function getStudentListByCourseId($course_id)
    {
        $stmt = $this->conn->prepare("SELECT a.id, a.full_name, a.user_id, a.email, a.mobile, a.batch_id, a.dept_id, a.program_id, b.semester_id FROM tbl_student a JOIN tbl_course_registration b ON b.student_id = a.id WHERE b.course_id = '$course_id'");
        if ($stmt->execute()) {
            $studentArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentArray[] = $row;
            }
            return $studentArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getStudentResultsForTeacher($course_id, $teacher_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_student_result WHERE course_id = '$course_id' AND teacher_id = '$teacher_id'");
        if ($stmt->execute()) {
            $studentResultArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentResultArray[] = $row;
            }
            return $studentResultArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }


    public function getAllStudentResultsForTeacher($course_id, $teacher_id)
    {
        $stmt = $this->conn->prepare("SELECT result.id, student.full_name, student.user_id, result.class_test_marks, result.mid_term_marks, result.final_term_marks, result.attendance_marks FROM tbl_student_result result JOIN tbl_student student ON student.id = result.student_id  WHERE result.course_id = '$course_id' AND result.teacher_id = '$teacher_id'");
        if ($stmt->execute()) {
            $studentResultArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentResultArray[] = $row;
            }
            return $studentResultArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getStudentResult($course_id, $student_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_student_result WHERE course_id = '$course_id' AND student_id = '$student_id'");
        if ($stmt->execute()) {
            $studentResultArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentResultArray[] = $row;
            }
            return $studentResultArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getStudentAllCourseResult($student_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_student_result a JOIN tbl_course b ON a.course_id = b.id WHERE student_id = '$student_id'");
        if ($stmt->execute()) {
            $studentResultArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentResultArray[] = $row;
            }
            return $studentResultArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getStudentAllCourseResultBySemester($student_id, $semester_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_student_result a JOIN tbl_course b ON a.course_id = b.id WHERE a.student_id = '$student_id' AND a.semester_id = '$semester_id'");
        if ($stmt->execute()) {
            $studentResultArray = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $studentResultArray[] = $row;
            }
            return $studentResultArray;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function getPreviousResult($student_id, $course_id, $teacher_id, $is_active)
    {
        $stmt = $this->conn->prepare("SELECT * FROM tbl_student_result WHERE student_id = '$student_id' AND teacher_id = '$teacher_id' AND course_id = '$course_id'");
        if ($stmt->execute()) {
            $markArr = array();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $markArr[] = $row;
            }
            return $markArr;
        } else {
            return NULL;
        }
        $stmt->close();
    }

    public function saveStudentMarks($exam_type, $student_id, $semester_id, $course_id, $teacher_id, $class_test_marks, $mid_term_marks, $final_term_marks, $attendance_marks, $is_class_test_finally_submitted, $is_mid_finally_submitted, $is_final_finally_submitted, $is_attandance_finally_submitted, $created_by, $created_date, $modified_by, $modified_date, $remarks, $is_active)
    {
        $stmt = $this->conn->prepare("INSERT INTO tbl_student_result(student_id, course_id, teacher_id, semester_id, class_test_marks, mid_term_marks, final_term_marks, attendance_marks, is_class_test_finally_submitted, is_mid_finally_submitted, is_final_finally_submitted, is_attandance_finally_submitted, created_by, created_date, modified_by, modified_date, remarks, is_active) VALUES('$student_id', '$course_id', '$teacher_id', '$semester_id','$class_test_marks', '$mid_term_marks', '$final_term_marks', '$attendance_marks', '$is_class_test_finally_submitted', '$is_mid_finally_submitted', '$is_final_finally_submitted', '$is_attandance_finally_submitted',  '$created_by', '$created_date', '$modified_by', '$modified_date', '$remarks', '$is_active')");
        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function updateStudentMarks($exam_type, $student_id, $course_id, $teacher_id, $marks, $is_result_submitted)
    {
        if ($exam_type === 'mid') {
            $stmt = $this->conn->prepare("UPDATE tbl_student_result SET mid_term_marks = '$marks', is_mid_finally_submitted = '$is_result_submitted' where student_id = '$student_id' and course_id = '$course_id' and teacher_id = '$teacher_id'");
        } elseif ($exam_type === 'final') {
            $stmt = $this->conn->prepare("UPDATE tbl_student_result SET final_term_marks = '$marks', is_final_finally_submitted = '$is_result_submitted' where student_id = '$student_id' and course_id = '$course_id' and teacher_id = '$teacher_id'");
        } elseif ($exam_type === 'attendance') {
            $stmt = $this->conn->prepare("UPDATE tbl_student_result SET attendance_marks = '$marks', is_attandance_finally_submitted = '$is_result_submitted' where student_id = '$student_id' and course_id = '$course_id' and teacher_id = '$teacher_id'");
        } elseif ($exam_type === 'test') {
            $stmt = $this->conn->prepare("UPDATE tbl_student_result SET class_test_marks = '$marks', is_class_test_finally_submitted = '$is_result_submitted' where student_id = '$student_id' and course_id = '$course_id' and teacher_id = '$teacher_id'");
        }

        $result = $stmt->execute();
        $stmt->close();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check user is existed or not
     */
    public function isUserExisted($email)
    {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password)
    {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password)
    {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

}

?>