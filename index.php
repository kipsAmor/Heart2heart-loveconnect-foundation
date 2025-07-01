<?php
/* ---------- DB CONNECTION ---------- */
include 'dbconnect.php';        // provides $conn

// Pull latest stats (adjust field / table names as needed)
$sql   = "SELECT beneficiaries, volunteers, funds, projects FROM stats LIMIT 1";
$stats = mysqli_fetch_assoc(mysqli_query($conn, $sql)) ?: [
  'beneficiaries' => 0,
  'volunteers'    => 0,
  'funds'         => 0,
  'projects'      => 0,
];

/* ---------- PAGE LAYOUT BEGINS ---------- */
include 'header.php';
?>

<!-- Font Awesome (icons) -->
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-/+q5b5f…"
      crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
  /* ===== GLOBAL ===== */
  body{
    margin:0;font-family:'Quicksand',sans-serif;
    background:#0f0f0f url('images/background.jpg') center/cover fixed no-repeat;
    color:#fff;animation:moveBg 60s linear infinite
  }
  @keyframes moveBg{0%{background-position:0 0}100%{background-position:100% 100%}}
  @keyframes fadeIn{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}

  /* ===== WELCOME SECTION ===== */
  .home{
    display:flex;flex-direction:column;justify-content:center;align-items:center;
    min-height:80vh;padding:60px 20px;margin:40px auto;max-width:850px;text-align:center;
    background:rgba(250,222,222,.3);backdrop-filter:blur(6px);border-radius:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.25);animation:fadeIn 2s ease
  }
  .home h1{font-size:3rem;color:#ff4081;margin-bottom:1.5rem}
  .home p {font-size:1.1rem;max-width:700px;line-height:1.7;margin-bottom:1rem;color:#f1f1f1}

  /* ===== NAV CARDS ===== */
  .nav-section{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:5px;margin:50px auto;padding:5px;max-width:900px
  }
  .nav-card{
    background:rgba(255,255,255,.1);backdrop-filter:blur(4px);
    border-radius:15px;padding:30px 20px;text-align:center;
    box-shadow:0 6px 15px rgba(0,0,0,.2);
    transition:transform .3s,background-color .3s
  }
  .nav-card:hover{transform:translateY(-5px);background:rgba(255,255,255,.2)}
  .nav-card a{text-decoration:none;font-weight:bold;color:#fff;font-size:1.1rem}
  .nav-card a:hover{color:#ff80ab}
  .nav-card p{margin:0 0 15px;font-size:.95rem;color:#ff80ab}

  /* ===== ANALYSIS CARDS ===== */
  .analysis-section{
    display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:20px;margin:50px auto;padding:20px;max-width:900px
  }
  .analysis-card{
    background:rgba(255,255,255,.12);backdrop-filter:blur(4px);
    border-radius:15px;padding:40px 25px;text-align:center;
    box-shadow:0 6px 15px rgba(0,0,0,.25);
    transition:transform .3s,background-color .3s
  }
  .analysis-card:hover{transform:translateY(-6px);background:rgba(255,255,255,.22)}
  .analysis-icon{font-size:2.5rem;color:#ff4081;margin-bottom:10px}
  .analysis-card h3{margin:0;font-size:2rem;color:#ff4081}
  .analysis-card span{display:block;font-size:.95rem;color:#ddd}

  /* ===== MOBILE ===== */
  @media(max-width:600px){
    .home h1{font-size:2rem}
    .home p {font-size:1rem}
  }
</style>

<!-- ===== WELCOME SECTION ===== -->
<section class="home">
  <h1><strong>Welcome to Heart to Heart &amp; Love Connect Foundation</strong></h1>
  <p>Empowering lives through compassion, love, and community support. Join us in making a meaningful difference through sustainable programs, heartfelt connections, and unwavering support for the vulnerable in our society.</p>
  <p>Our initiatives include mentorship for youth, mental health support, food &amp; clothing drives, educational sponsorships, community clean-ups, and capacity-building workshops.</p>
</section>

<!-- ===== NAVIGATION CARDS ===== -->
<section class="nav-section">
  <div class="nav-card"><p>Discover our story</p><a href="about.php">About&nbsp;Us</a></div>
  <div class="nav-card"><p>See our initiatives</p><a href="programs.php">Programs</a></div>
  <div class="nav-card"><p>Join our mission</p><a href="get involved.php">Get&nbsp;Involved</a></div>
  <div class="nav-card"><p>Mark your calendar</p><a href="key events.php">Key&nbsp;Events</a></div>
</section>

<!-- ===== IMPACT / ANALYSIS SECTION ===== -->
<section class="analysis-section">
  <div class="analysis-card">
    <i class="fa-solid fa-heart-pulse analysis-icon"></i>
    <h3 class="count-up" data-count="<?= $stats['beneficiaries'] ?>">0</h3>
    <span>Beneficiaries Served</span>
  </div>
  <div class="analysis-card">
    <i class="fa-solid fa-hands-helping analysis-icon"></i>
    <h3 class="count-up" data-count="<?= $stats['volunteers'] ?>">0</h3>
    <span>Active Volunteers</span>
  </div>
  <div class="analysis-card">
    <i class="fa-solid fa-dollar-sign analysis-icon"></i>
    <h3 class="count-up" data-count="<?= $stats['funds'] ?>">0</h3>
    <span>Funds Raised</span>
  </div>
  <div class="analysis-card">
    <i class="fa-solid fa-award analysis-icon"></i>
    <h3 class="count-up" data-count="<?= $stats['projects'] ?>">0</h3>
    <span>Projects Completed</span>
  </div>
</section>

<!-- ===== COUNTER & OBSERVER SCRIPT ===== -->
<script>
  /* Count-up animation */
  function animateCount(el, target, duration = 1500){
    const start = +el.textContent, range = target - start;
    let startTime = null;
    const step = timestamp => {
      if(!startTime) startTime = timestamp;
      const progress = Math.min((timestamp - startTime) / duration, 1);
      el.textContent = Math.floor(progress * range + start);
      if(progress < 1){ requestAnimationFrame(step); }
      else { el.textContent = target.toLocaleString(); }
    };
    requestAnimationFrame(step);
  }

  /* Trigger when card enters viewport */
  const observer = new IntersectionObserver(entries=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        const el = entry.target;
        animateCount(el, +el.dataset.count);
        observer.unobserve(el);
      }
    });
  }, {threshold:0.6});

  document.querySelectorAll('.count-up').forEach(el=>observer.observe(el));
</script>

<?php include 'footer.php'; ?>
