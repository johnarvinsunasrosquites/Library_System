<?php
include 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and Sanitize Input
    $name = isset($_POST['name']) ? $conn->real_escape_string($_POST['name']) : '';
    $type_of_document = isset($_POST['type_of_document']) ? $conn->real_escape_string($_POST['type_of_document']) : '';
    $legislative_award = isset($_POST['legislative_award']) ? 1 : 0;
    $committee = isset($_POST['committee']) ? $conn->real_escape_string($_POST['committee']) : '';
    $year = isset($_POST['year']) ? intval($_POST['year']) : 0;

    // File Upload Handling
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Create directory if not exists
    }
    
    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    
    // Validate File Type
    $allowedTypes = ['pdf', 'doc', 'docx'];
    if (!in_array($fileType, $allowedTypes)) {
        die("Invalid file type. Only PDF, DOC, or DOCX files are allowed.");
    }

    // Move Uploaded File
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
        // Insert Data into Database
        $stmt = $conn->prepare("INSERT INTO Documents (name, type_of_document, legislative_award, committee, year, file_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiss", $name, $type_of_document, $legislative_award, $committee, $year, $targetFilePath);

        if ($stmt->execute()) {
            echo "Document uploaded and saved successfully!";
            echo "<a href='index.php'>Go to Dashboard</a>";
        } else {
            echo "Database Error: " . $stmt->error;
        }
    } else {
        echo "Error uploading file.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
