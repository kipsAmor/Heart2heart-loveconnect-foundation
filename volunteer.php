<?php
session_start();

// Validate CSRF token
if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Invalid CSRF token.");
}

// Database connection
$host = "localhost";
$db = "your_db_name";
$user = "your_db_user";
$pass = "your_db_password";
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Sanitize inputs
$first_name = $conn->real_escape_string($_POST['first_name']);
$last_name = $conn->real_escape_string($_POST['last_name']);
$phone = $conn->real_escape_string($_POST['phone']);
$email = $conn->real_escape_string($_POST['email']);
$organisation = $conn->real_escape_string($_POST['Organisation']);
$address = $conn->real_escape_string($_POST['address']);
$source = $conn->real_escape_string($_POST['source']);
$available_days = isset($_POST['available_days']) ? implode(",", $_POST['available_days']) : '';
$country = $conn->real_escape_string($_POST['Country']);
$county = $conn->real_escape_string($_POST['County']);
$sub_county = $conn->real_escape_string($_POST['SubCounty']);
$ward = $conn->real_escape_string($_POST['Ward']);
$work_duration = $conn->real_escape_string($_POST['work_duration']);
$signature = $conn->real_escape_string($_POST['signature']);

// Handle file upload
$upload_dir = "uploads/";
if (!file_exists($upload_dir)) mkdir($upload_dir, 0755, true);

$filename = '';
if (isset($_FILES['id_document']) && $_FILES['id_document']['error'] === 0) {
    $ext = pathinfo($_FILES['id_document']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . "." . strtolower($ext);
    move_uploaded_file($_FILES['id_document']['tmp_name'], $upload_dir . $filename);
}

// Insert into DB
$stmt = $conn->prepare("INSERT INTO volunteer_applications 
  (first_name, last_name, phone, email, organisation, address, source, available_days, country, county, sub_county, ward, work_duration, id_document, signature)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("sssssssssssssss", $first_name, $last_name, $phone, $email, $organisation, $address, $source, $available_days, $country, $county, $sub_county, $ward, $work_duration, $filename, $signature);

if ($stmt->execute()) {
    echo "Thank you for volunteering! Your application has been submitted.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();

?>

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Volunteer Application</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #ff6b6b;      /* lively coral */
      --primary-dark: #e85050;
      --secondary: #ffd166;    /* warm yellow */
      --accent: #06d6a0;       /* mint */
      --bg: #f9fbfd;           /* page background */
      --card-bg: #ffffff;
      --text: #333;
      --shadow: 0 8px 20px rgba(0,0,0,.05);
    }

    * { box-sizing: border-box; }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, var(--secondary) 0%, var(--bg) 35%, var(--bg) 65%, var(--accent) 100%);
      margin: 0; padding: 0;
      color: var(--text);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
    }

    header {
      width: 100%;
      padding: 40px 0 20px;
      text-align: center;
      color: var(--primary);
    }
    header h1 {
      margin: 0;
      font-size: 2.2rem;
      font-weight: 600;
    }
    header p {
      margin: 8px 0 0;
      font-size: 1rem;
      color: #555;
    }

    form {
      width: 90%;
      max-width: 760px;
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: var(--shadow);
      padding: 32px 28px 40px;
      margin-bottom: 60px;
      animation: rise 0.6s ease-out;
    }

    @keyframes rise {
      from {opacity: 0; transform: translateY(30px);} to {opacity: 1; transform: translateY(0);} }

    label {
      display: block;
      margin-top: 18px;
      font-weight: 600;
      color: var(--primary-dark);
    }

    input, select, textarea {
      width: 100%;
      padding: 12px 14px;
      border: 2px solid #e0e4e8;
      border-radius: 8px;
      font-size: 15px;
      margin-top: 6px;
      transition: border-color .25s, box-shadow .25s;
    }

    input:focus, select:focus, textarea:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(255,107,107,.15);
      outline: none;
    }

    .inline-fields {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    .inline-fields > div { flex: 1 1 240px; }

    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 12px;
    }
    .checkbox-group label {
      background: var(--bg);
      padding: 8px 12px;
      border-radius: 8px;
      font-weight: 500;
      color: #555;
      cursor: pointer;
      transition: background .2s ease;
    }
    .checkbox-group input { margin-right: 6px; }
    .checkbox-group label:hover { background: var(--secondary); }

    input[type='file'] { background: #fafafa; }

    button {
      margin-top: 32px;
      padding: 14px 22px;
      font-size: 17px;
      background: var(--primary);
      color: #fff;
      border: none;
      border-radius: 10px;
      width: 100%;
      cursor: pointer;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(0,0,0,.12);
      transition: background .3s, transform .2s;
    }
    button:hover { background: var(--primary-dark); transform: translateY(-2px); }
    button:active { transform: translateY(0); }

    .note { font-size: 13px; color: #666; }

    @media (max-width: 600px) {
      header h1 { font-size: 1.8rem; }
      form { padding: 26px 20px 32px; }
    }
  </style>
</head>
<body>

<header>
  <h1>Become a Volunteer</h1>
  <p>Your time &amp; skills can change lives—join us today!</p>
</header>

<form method="POST" action="process_volunteer.php" enctype="multipart/form-data" novalidate>
  <label>First Name* <input type="text" name="first_name" required></label>
  <label>Last Name* <input type="text" name="last_name" required></label>

  <div class="inline-fields">
    <div>
      <label>Phone*
        <input type="tel" name="phone" pattern="^\+?\d{7,15}$" placeholder="+254712345678" required>
      </label>
    </div>
    <div>
      <label>Email* <input type="email" name="email" required></label>
    </div>
  </div>

  <label>Organisation / Institution
    <input type="text" name="Organisation">
  </label>

  <label>Address
    <textarea name="address" rows="2"></textarea>
  </label>

  <label>How did you hear about us?
    <select name="source">
      <option value="">--Select--</option>
      <option value="Friend">Friend</option>
      <option value="Social Media">Social Media</option>
      <option value="Event">Event</option>
      <option value="Other">Other</option>
    </select>
  </label>

  <label>Available Days <span class="note">(select all that apply)</span></label>
  <div class="checkbox-group">
    <?php
      $days = ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'];
      foreach ($days as $d) {
        echo "<label><input type='checkbox' name='available_days[]' value='$d'> $d</label>";
      }
    ?>
  </div>

  <label>Country <input type="text" name="Country"></label>
  <label>County <input type="text" name="County"></label>
  <label>Sub‑County <input type="text" name="SubCounty"></label>
  <label>Ward <input type="text" name="Ward"></label>

  <label>Preferred Duration of Service
    <select name="work_duration">
      <option value="">--Select--</option>
      <option value="One Day">One Day</option>
      <option value="One Week">One Week</option>
      <option value="One Month">One Month</option>
      <option value="Ongoing">Ongoing</option>
    </select>
  </label>

  <label>National ID / Passport <span class="note">(PDF, JPG, PNG | max 5 MB)</span>
    <input type="file" name="id_document" accept=".pdf,image/*">
  </label>

  <label>Signature <span class="note">(type your full name as e‑signature)</span>
    <input type="text" name="signature" required>
  </label>

  <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

  <button type="submit">Submit Application</button>
</form>

</body>
</html>
