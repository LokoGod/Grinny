<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    
</head>
<body>

    <form id="feed" action="feedback.php" method="post">
        <label for="feed">Enter Feedback:</label><br>
        <textarea class="form-control" id="feed" name="feed" rows="4" cols="50"></textarea><br>
        <input class='btn btn-primary' type="submit" value="Submit">
    </form>

    <?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the data from the textarea
        $feed = $_POST["feed"];

        // Validate and sanitize the data (optional but recommended)
        // htmlspecialchars() helps prevent XSS (Cross-Site Scripting) attacks
        $feed = htmlspecialchars($feed);

        // Include the database connection file
        require_once "db_connection.php";

        // Insert the data into the database
        try {
            // Prepare the SQL statement with a placeholder
            $stmt = $conn->prepare("INSERT INTO feedback (id, feedback) VALUES (:feed)");

            // Bind the data to the placeholder
            $stmt->bindParam(':feed', $feed);

            // Execute the SQL statement
            $stmt->execute();

            // Display a success message
            echo "Feedback recieved successfully.";
        } catch (PDOException $e) {
            // Display an error message if something went wrong
            echo "Error: " . $e->getMessage();
        }

        // Close the database connection
        $conn = null;
    }
    ?>
    
</body>
</html>