<?php
session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate</title>
    <style>
        form {
            max-width: 400px;
            margin: auto;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
    </style>
</head>
<body>
    <h2>Make a Donation</h2>
    <form method="POST" action="process_donation.php">
        <label for="name">Full Name</label>
        <input type="text" name="name" required>

        <label for="email">Email (optional)</label>
        <input type="email" name="email">

        <label for="amount">Donation Amount (KES)</label>
        <input type="number" name="amount" step="0.01" required>

        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <button type="submit">Donate</button>
    </form>
</body>
</html>
