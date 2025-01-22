<?php
session_start();

use Config\Connection;
use Models\Course;
require __DIR__.'/../../vendor/autoload.php';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $conditions = ["id" => $courseId];  
} else {
    $_SESSION['message'] = "No ID provided.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
}


if (isset($_SESSION['teacher_id']) && is_numeric($_SESSION['teacher_id']) && $_SESSION['teacher_id'] > 0) {
    $teacher_id = $_SESSION['teacher_id'];
} else {
    // Handle error if teacher_id is not set in the session or invalid
    $_SESSION['message'] = "You are not allowed in this page!";
    
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit;
}

// Initialize the database connection
$database = new Connection();
$db = $database->getConnection();

// Initialize the course object
$courseObj = new Course($db);

// Error message initialization
$Message = '';

// Check if necessary fields are set and not empty
if (isset($_POST['title'], $_POST['description'], $_POST['featured_image'], $_POST['course_type'], $_POST['tags'])
    && !empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['featured_image']) && !empty($_POST['course_type']) && !empty($_POST['tags'])
) {
    // Sanitize inputs
    $courseData = [
        "title" => htmlspecialchars(trim($_POST['title'])),
        "description" => htmlspecialchars(trim($_POST['description'])),
        "featured_image" => htmlspecialchars(trim($_POST['featured_image'])),
        "category_id" => htmlspecialchars(trim($_POST['category'])),  
        "teacher_id" => $teacher_id,
        "course_type" => htmlspecialchars(trim($_POST['course_type']))
    ];

    // Check if course_type either 'video' or 'document'
    if ($_POST['course_type'] === "video") {
        if (isset($_POST['video_content']) && !empty($_POST['video_content'])) {
            $courseData["video_content"] = htmlspecialchars(trim($_POST['video_content']));

            if (!filter_var($_POST['video_content'], FILTER_VALIDATE_URL)) {
                $_SESSION['message'] = "Invalid photo URL!";
                echo '<script type="text/javascript"> window.history.back(); </script>';
                exit;
            }

        } else {
            $_SESSION['message'] = "Video content is required for video courses.";
            echo '<script type="text/javascript"> window.history.back(); </script>';
            exit;
        }
    } elseif ($_POST['course_type'] === "document") {
        if (isset($_POST['text_content']) && !empty($_POST['text_content'])) {
            $courseData["content"] = htmlspecialchars(trim($_POST['text_content']));
        } else {
            $_SESSION['message'] = "Text content is required for document courses.";
            echo '<script type="text/javascript"> window.history.back(); </script>';
            exit;
        }
    } else {
        $_SESSION['message'] = "Invalid course type.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
    }

    // Check if tags are provided and sanitize
    $tags = isset($_POST['tags']) ? array_map('htmlspecialchars', $_POST['tags']) : [];
    if (empty($tags)) {
        $_SESSION['message'] = "At least one tag is required.";
        echo '<script type="text/javascript"> window.history.back(); </script>';
        exit;
    }

    $course = $courseObj->update($courseData, $conditions, $tags);
    
    

    // Check if course creation was successful
    if ($course) {
        $_SESSION['message'] = "Course updated successfully!";
        header("Location: ../../views/users/course_page.php?id= $courseId"); 
    } else {
        $_SESSION['message'] = "Something went wrong, please try again!";
        echo '<script type="text/javascript"> window.history.back(); </script>';
    }
} else {
    // Handle case when some required fields are not set
    $_SESSION['message'] = "All required fields must be filled out.";
    echo '<script type="text/javascript"> window.history.back(); </script>';
    exit; 
}

?>
