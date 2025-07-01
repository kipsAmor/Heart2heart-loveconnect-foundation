<?php
$msg = $_GET['msg'] ?? "Thank you for your donation.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You</title>
</head>
<body>
    <h2><?php echo htmlspecialchars($msg); ?></h2>
    <a href="index.php">Return to Home</a>
</body>
</html>
