<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 12/18/2018
 * Time: 7:37 PM
 */

require_once 'DB_Functions.php';

$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

// Take student marks and id in json array.
if (isset($_POST['data'])) {

    // receiving the post params
    $data = $_POST['data'];

//    print_r($_POST);

    $encodedData = json_decode($data);

    $course_id = $encodedData->course_id;
    $teacher_id = $encodedData->teacher_id;
    $exam_type = $encodedData->exam_type;
    $is_result_submitted = $encodedData->is_final_submission;
    /*$is_class_test_finally_submitted = $encodedData->is_class_test_finally_submitted;
    $is_mid_finally_submitted = $encodedData->is_mid_finally_submitted;
    $is_final_finally_submitted = $encodedData->is_final_finally_submitted;
    $is_attandance_finally_submitted = $encodedData->is_attandance_finally_submitted;*/

    $marksArr = array();
    $marksArr = $encodedData->mark_data;
    $result = FALSE;

//    print_r($marksArr);

    foreach ($marksArr as $singleStudentMark) {
        $created_date = date("Y-m-d h:i:sa", time());
        $previousSaveData = $db->getPreviousResult($singleStudentMark->student_id,  $course_id, $teacher_id, 1);

        if($previousSaveData){

            $result = $db->updateStudentMarks($exam_type, $singleStudentMark->student_id, $course_id, $teacher_id, $singleStudentMark->marks, $is_result_submitted);


            /*if($exam_type === 'mid'){
            }elseif ($exam_type === 'final'){
                $result = $db->updateStudentMarks($exam_type, $previousSaveData['student_id'], $previousSaveData['course_id'], $previousSaveData['teacher_id'], $previousSaveData['class_test_marks'], $previousSaveData['mid_term_marks'], $singleStudentMark->marks, $previousSaveData['attendance_marks'], $previousSaveData['create_by'], $previousSaveData['created_date'], "Admin", $created_date, "Remarks", 1);
            }elseif ($exam_type === 'attendance'){
                $result = $db->updateStudentMarks($exam_type, $previousSaveData['student_id'], $previousSaveData['course_id'], $previousSaveData['teacher_id'], $previousSaveData['class_test_marks'], $previousSaveData['mid_term_marks'], $previousSaveData['final_term_marks'], $singleStudentMark->marks, $previousSaveData['create_by'], $previousSaveData['created_date'], "Admin", $created_date, "Remarks", 1);
            }elseif ($exam_type === 'test'){
                $result = $db->updateStudentMarks($exam_type, $previousSaveData['student_id'], $previousSaveData['course_id'], $previousSaveData['teacher_id'], $singleStudentMark->marks, $previousSaveData['mid_term_marks'], $previousSaveData['final_term_marks'], $singleStudentMark->marks, $previousSaveData['create_by'], $previousSaveData['created_date'], "Admin", $created_date, "Remarks", 1);
            }*/
        }else{
            if($exam_type === 'mid'){
                $result = $db->saveStudentMarks($exam_type, $singleStudentMark->student_id, $singleStudentMark->semester_id, $course_id, $teacher_id, 0, $singleStudentMark->marks, 0, 0, 0, $is_result_submitted, 0, 0, "Admin", $created_date, "", null, "Remarks", 1);
            }elseif ($exam_type === 'final'){
                $result = $db->saveStudentMarks($exam_type, $singleStudentMark->student_id, $singleStudentMark->semester_id, $course_id, $teacher_id, 0, 0, $singleStudentMark->marks, 0,0, 0, $is_result_submitted, 0,  "Admin", $created_date, "", null, "Remarks", 1);
            }elseif ($exam_type === 'attendance'){
                $result = $db->saveStudentMarks($exam_type, $singleStudentMark->student_id, $singleStudentMark->semester_id, $course_id, $teacher_id, 0, 0, 0, $singleStudentMark->marks, 0, 0, 0, $is_result_submitted, "Admin", $created_date, "", null, "Remarks", 1);
            }elseif ($exam_type === 'test'){
                $result = $db->saveStudentMarks($exam_type, $singleStudentMark->student_id, $singleStudentMark->semester_id, $course_id, $teacher_id, $singleStudentMark->marks, 0, 0, 0, $is_result_submitted, 0, 0, 0, "Admin", $created_date, "", null, "Remarks", 1);
            }

        }

//        echo "Course ID: ". $course_id. " Teacher ID: ". $teacher_id. " Exam Type: ". $exam_type. " <br> Student data: ". $singleStudentMark->student_id. " ". $singleStudentMark->marks. "<br><br>";
    }

    if ($result) {
        $response["error"] = FALSE;
        $response["message"] = "Marks Saved Successfully.";
    } else {
        $response["error"] = TRUE;
        $response["message"] = "Marks Save Failed.";
    }

    echo json_encode($response);

    // check if user is already existed with the same email
    /*if ($db->isUserExisted($email)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $email;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($name, $email, $password);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }*/
} else {
    $response["error"] = TRUE;
    $response["message"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>
