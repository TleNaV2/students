<?php
include 'condb.php';

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    $student_id = $data['student_id'] ?? '';
    $first_name = $data['first_name'] ?? '';
    $last_name = $data['last_name'] ?? '';
    $phone = $data['phone'] ?? '';
    $email = $data['email'] ?? '';
    $faculty = $data['faculty'] ?? '';
    
    if (empty($student_id) || empty($first_name) || empty($last_name)) {
        echo json_encode(["error" => "กรุณากรอกข้อมูลที่จำเป็น"]);
        exit;
    }
    
    try {
        $stmt = $conn->prepare("INSERT INTO students (student_id, first_name, last_name, phone, email, faculty) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$student_id, $first_name, $last_name, $phone, $email, $faculty]);
        
        echo json_encode(["success" => "เพิ่มข้อมูลนักศึกษาสำเร็จ"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Method not allowed"]);
}
?>