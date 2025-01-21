<?php
session_start();

use Config\Connection;
use Models\Course;
require __DIR__.'/../../vendor/autoload.php';


if (isset($_SESSION['teacher_id']) && is_numeric($_SESSION['teacher_id']) && $_SESSION['teacher_id'] > 0) {
    $teacher_id = $_SESSION['teacher_id'];
} else {
    // Handle error if teacher_id is not set in the session or invalid
    $_SESSION['message'] = "You are not loged in! please log in";
    header('Location: ../../views/users/login.php');
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
                header('Location:../../views/users/register.php');
                exit;
            }

        } else {
            $_SESSION['message'] = "Video content is required for video courses.";
            header('Location: ../../views/users/create_course.php');
            exit;
        }
    } elseif ($_POST['course_type'] === "document") {
        if (isset($_POST['text_content']) && !empty($_POST['text_content'])) {
            $courseData["content"] = htmlspecialchars(trim($_POST['text_content']));
        } else {
            $_SESSION['message'] = "Text content is required for document courses.";
            header('Location: ../../views/users/create_course.php');
            exit;
        }
    } else {
        $_SESSION['message'] = "Invalid course type.";
        header('Location: ../../views/users/create_course.php');
        exit;
    }

    // Check if tags are provided and sanitize
    $tags = isset($_POST['tags']) ? array_map('htmlspecialchars', $_POST['tags']) : [];
    if (empty($tags)) {
        $_SESSION['message'] = "At least one tag is required.";
        header('Location: ../../views/users/create_course.php');
        exit;
    }

    // Create the course {because of applying the polymorphism (overload) you should add the third parametre to make the createByvideo work, other wise you keep only two parametres to make createByDocument work}
    if($_POST['course_type'] === "document"){
        $course = $courseObj->create($courseData, $tags);
    }elseif($_POST['course_type'] === "video"){
        $course = $courseObj->create($courseData, $tags,"video");

    }
    

    // Check if course creation was successful
    if ($course) {
        $_SESSION['message'] = "Course created successfully!";
        header('Location: ../../views/users/course_page.php?id=' . $course); //because when the creation process is finished, it returns the last id created (check the method in the course class)
    } else {
        $_SESSION['message'] = "Something went wrong, please try again!";
        header('Location: ../../views/users/create_course.php');
    }
} else {
    // Handle case when some required fields are not set
    $_SESSION['message'] = "All required fields must be filled out.";
    header('Location: ../../views/users/create_course.php');
    exit; 
}

?>
