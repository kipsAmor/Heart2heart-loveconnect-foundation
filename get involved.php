<?php
// ============================================================
//  Heart to Heart & Love Connect  –  Donate & Volunteer (One File)
// ============================================================
include 'header.php';
include 'dbconnect.php';     // must set $conn  (mysqli)

              // PHPMailer + Dotenv


/* ───────────────────────── HELPERS ───────────────────────── */



function sanitize(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

/* ───────────────────────── FLASH VARS ────────────────────── */
$flashDonate    = '';
$flashVolunteer = '';

//* ───────────────────────── DONATION HANDLER ──────────────── */
if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['amount'], $_POST['name'])        // donation form fields
    && !isset($_POST['first_name'])                   // NOT the volunteer form
    && isset($_POST['csrf_token'])                    // CSRF token from hidden field
    && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    // 1. Sanitize / validate input
    $name   = sanitize($_POST['name']);                             // your custom helper
    $email  = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $amount = filter_var($_POST['amount'], FILTER_VALIDATE_FLOAT);

    // 2. Basic validations
    if (!$email || $amount <= 0) {
        $flashDonate = "<p style='color:#c00;'>Enter a valid email and donation amount.</p>";
    } else {
        /* 3. Insert into DB with prepared statement */
        $stmt = $conn->prepare(
            "INSERT INTO donations (name, email, amount, donated_at)
             VALUES (?, ?, ?, NOW())"
        );

        if ($stmt) {
            $stmt->bind_param('ssd', $name, $email, $amount); // s = string, s = string, d = double

            if ($stmt->execute()) {
                // 4. Success – set flash and optionally redirect
                $flashDonate = "<p style='color:#090;'>Thank you, <strong>" .
                               htmlspecialchars($name) .
                               "</strong>! Your gift of $" .
                               number_format($amount, 2) .
                               " has been received. 💖</p>";

                // Optionally: mail a receipt, trigger a webhook, etc.
                // mailReceipt($name, $email, $amount);

            } else {
                // 5. Execution error
                $flashDonate = "<p style='color:#c00;'>Sorry, we couldn't process your donation. " .
                               "Please try again later.</p>";
                error_log("Donation insert error: " . $stmt->error); // keep details out of UI
            }
            $stmt->close();
        } else {
            // 6. Prepare failed
            $flashDonate = "<p style='color:#c00;'>Unexpected error (prep). Please try again.</p>";
            error_log("Prepare failed: " . $conn->error);
        }
    }
}
/* ───────────────────────── END DONATION HANDLER ──────────── */


/* ──────────────────────── VOLUNTEER HANDLER ──────────────── */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first_name'])) {

    /* ─ upload (allow only pdf/jpeg/png) ─ */
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

    $idFileName = '';
    if (!empty($_FILES['id_document']['name']) && $_FILES['id_document']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['application/pdf','image/jpeg','image/png'];
        if (in_array($_FILES['id_document']['type'], $allowed, true)) {
            $idFileName = time() . '_' . basename($_FILES['id_document']['name']);
            move_uploaded_file($_FILES['id_document']['tmp_name'], $uploadDir . $idFileName);
        }
    }

    /* collect & sanitize */
    $first_name     = sanitize($_POST['first_name']);
    $last_name      = sanitize($_POST['last_name']);
    $phone          = sanitize($_POST['phone']);
    $emailV         = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $organisation   = sanitize($_POST['Organisation']);
    $address        = sanitize($_POST['address']);
    $source         = sanitize($_POST['source']);
    $available_days = !empty($_POST['available_days']) ? implode(',', $_POST['available_days']) : '';
    $country        = sanitize($_POST['Country']);
    $county         = sanitize($_POST['County']);
    $sub_county     = sanitize($_POST['SubCounty']);
    $ward           = sanitize($_POST['Ward']);
    $work_duration  = sanitize($_POST['work_duration']);
    $signature      = sanitize($_POST['signature']);

    $stmt = $conn->prepare(
        "INSERT INTO volunteer_applications
         (first_name,last_name,phone,email,organisation,address,source,available_days,
          country,county,sub_county,ward,work_duration,id_document,signature)
         VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "sssssssssssssss",
        $first_name,$last_name,$phone,$emailV,$organisation,$address,$source,$available_days,
        $country,$county,$sub_county,$ward,$work_duration,$idFileName,$signature);

    
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Partner & Volunteer | Heart2Heart</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#f5f7fa;padding:20px;margin:0;color:#333}
h1,h2{color:#c0392b}
.container{max-width:800px;margin:auto;background:#fff;padding:30px;border-radius:10px;box-shadow:0 0 15px rgba(0,0,0,.05)}
.donate form{display:flex;flex-direction:column;gap:10px;margin-top:20px}
.donate input,.donate button{padding:10px;font-size:15px;border:1px solid #ccc;border-radius:5px}
.donate button{background:#c0392b;color:#fff;border:none;cursor:pointer}
.donate button:hover{background:#a93226}
.join-container{max-width:900px;margin:40px auto;background:#ffffffdd;border-radius:12px;padding:30px;box-shadow:0 8px 20px rgba(0,0,0,.1);text-align:center}
form.volunteer input,form.volunteer select{width:100%;padding:14px;margin:8px 0 22px;border:1px solid #ccc;border-radius:8px}
.checkbox-group{margin-bottom:25px;display:flex;flex-wrap:wrap;gap:15px;justify-content:center}
button[type=submit]{background:#b23a48;color:#fff;border:none;padding:14px 32px;font-size:17px;border-radius:8px;cursor:pointer}
button[type=submit]:hover{background:#932a39}
</style>
</head>
<body>

<div class="container">
  <h1>Partner with Us: Bring Hope, Dignity & Love</h1>
  <p>At <strong>Heart to Heart & Love Connect Foundation</strong> we meet pressing needs every day—girls missing school for lack of sanitary towels, families sleeping hungry, and people with disabilities needing mobility aids.</p>
  <p><strong>You can help change that.</strong></p>

  <h2>How You Can Help</h2>
  <ul>
    <li><strong>Sanitary Towels</strong> – Empower girls to stay in school.</li>
    <li><strong>Food Hampers</strong> – Feed families facing hunger.</li>
    <li><strong>Wheelchairs & Mobility Aids</strong> – Restore independence.</li>
    <li><strong>Monetary Gifts</strong> – Let us direct funds to the greatest needs.</li>
  </ul>

  <?= $flashDonate ?>

  <!-- ★★★★★  DONATE SECTION  ★★★★★ -->
<section class="donate">
  <div class="donate__wrapper">
    <h2 class="donate__title">Share the Love 💖</h2>
    <p class="donate__subtitle">
      Your gift fuels our outreach and puts hope in someone’s hands.
      Every shilling counts — thank you!
    </p>

    <form method="post" action="" class="donate__form">
      <input type="text"   name="name"   placeholder="Your Name"   required>
      <input type="email"  name="email"  placeholder="Your Email"  required>
      <input type="number" name="amount" placeholder="Amount (KES)" min="1" step="0.01" required>
      <button type="submit">Give&nbsp;Now</button>
    </form>
  </div>
</section>
</div>

<div class="join-container">
  <h2>Volunteer With Us</h2>
  <p class="highlight">Share your time, skills, and heart.</p>

  <?= $flashVolunteer ?>

  <form class="volunteer" method="post" enctype="multipart/form-data" action="">
    <input type="text" name="first_name" placeholder="First Name" required>
    <input type="text" name="last_name"  placeholder="Last Name" required>
    <input type="text" name="phone"      placeholder="Phone" required>
    <input type="email" name="email"     placeholder="Email" required>
    <input type="text" name="Organisation" placeholder="Organization" required>
    <input type="text" name="address"      placeholder="Address" required>

    <select name="source">
      <option value="">How did you find out about us?</option>
      <option>Facebook</option><option>Friend</option><option>Church</option>
    </select>

    <h3>Availability</h3>
    <div class="checkbox-group">
      <?php
        $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Weekends'];
        foreach ($days as $d) {
            echo "<label><input type='checkbox' name='available_days[]' value='$d'> $d</label>";
        }
      ?>
    </div>

    <h3>Nationality</h3>
    <input type="text" name="Country"    placeholder="Country">
    <input type="text" name="County"     placeholder="County">
    <input type="text" name="SubCounty"  placeholder="Sub-county">
    <input type="text" name="Ward"       placeholder="Ward">
    <input type="text" name="work_duration" placeholder="How long have you lived here?">

    <h3>Upload ID (optional – PDF/JPG/PNG)</h3>
    <input type="file" name="id_document">

    <h3>Signature</h3>
    <input type="text" name="signature" placeholder="Type your name as signature">

    <button type="submit">Submit Application</button>
  </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
