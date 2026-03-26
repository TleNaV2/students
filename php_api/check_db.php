<?php
include 'condb.php';

try {
    // ตรวจสอบว่าดาต้าเบสมีอยู่หรือไม่
    $stmt = $conn->query("SELECT DATABASE() as current_db");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Current Database: " . $result['current_db'] . "\n";

    // ตรวจสอบตาราง students
    $stmt = $conn->query("SHOW TABLES LIKE 'students'");
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($tables) > 0) {
        echo "Table 'students' exists.\n";

        // นับจำนวนแถว
        $stmt = $conn->query("SELECT COUNT(*) as count FROM students");
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Number of students: " . $count['count'] . "\n";

        // แสดงข้อมูลตัวอย่าง
        $stmt = $conn->query("SELECT * FROM students LIMIT 3");
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "\nSample data:\n";
        foreach ($students as $student) {
            echo "- ID: {$student['student_id']}, Name: {$student['first_name']} {$student['last_name']}, Faculty: {$student['faculty']}\n";
        }
    } else {
        echo "Table 'students' does not exist.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>