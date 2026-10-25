<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the text entered in your form
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));
    $date    = date("Y-m-d H:i:s");

    // Format how the message will look inside your Notepad file
    $entry  = "========================================\n";
    $entry .= "Date: $date\n";
    $entry .= "Name: $name\n";
    $entry .= "Email: $email\n";
    $entry .= "Message:\n$message\n";
    $entry .= "========================================\n\n";

    // Name of the text file to create/update
    $file = 'messages.txt';

    // Save directly to the file (FILE_APPEND ensures previous messages aren't deleted)
    if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX)) {
        echo "<script>
                alert('Message saved successfully!');
                window.location.href = 'index.html#contact';
              </script>";
    } else {
        echo "<script>
                alert('Could not write to file. Please check folder permissions.');
                window.location.href = 'index.html#contact';
              </script>";
    }
} else {
    header("Location: index.html");
    exit();
}
?>