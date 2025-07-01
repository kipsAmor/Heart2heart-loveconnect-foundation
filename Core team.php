<?php include 'header.php'; ?>
?>

<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(to bottom right, #fff4f6, #ffe3ec);
    color: #333;
    margin: 0;
    padding: 0;
  }

  .team-section {
    max-width: 1100px;
    margin: 0 auto;
    padding: 60px 20px;
    text-align: center;
  }

  .team-section h1 {
    color: #e91e63;
    font-size: 2.8rem;
    margin-bottom: 10px;
  }

  .team-section p.intro {
    max-width: 700px;
    margin: 0 auto 40px;
    font-size: 1.1rem;
    color: #555;
    line-height: 1.7;
  }

  .team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
    gap: 35px;
  }

  .member-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    padding: 25px;
    transition: transform 0.4s ease, box-shadow 0.3s ease;
  }

  .member-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
  }

  .member-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 14px;
    margin-bottom: 20px;
  }

  .member-card h3 {
    margin: 10px 0 5px;
    color: #c2185b;
    font-size: 1.3rem;
  }

  .member-card p.title {
    font-weight: 600;
    margin-bottom: 12px;
    color: #444;
    font-size: 1rem;
  }

  .member-card p.bio {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #555;
  }

  @media (max-width: 600px) {
    .team-section h1 {
      font-size: 2rem;
    }

    .team-section p.intro {
      font-size: 1rem;
    }

    .member-card img {
      height: 220px;
    }
  }
</style>

<div class="team-section">
  <h1>💖 Meet the Hearts Behind the Mission</h1>
  <p class="intro">
    Behind every life we touch at Heart2Heart & Love Connect Foundation is a committed, passionate team. These are the compassionate souls working tirelessly to create a world full of dignity, hope, and healing.
  </p>

  <div class="team-grid">

    <?php
    $team = [
      [
        "name" => "Amos Bett",
        "role" => "Founder & Executive Director",
        "image" => "images/Amos.jpg",
        "bio"  => "Amos is the heartbeat of our mission. With grace and boldness, she founded Heart2Heart to uplift vulnerable girls and families, turning her personal pain into powerful purpose."
      ],
      [
        "name" => "Jane Chebet Kigen",
        "role" => "Co-Founder & Programs Director",
        "image" => "images/Jane.jpg",
        "bio"  => "Jane is the engine behind our outreach. His calm strength and deep community ties help tailor every initiative to real, everyday needs."
      ],
      [
        "name" => "Mercy Mitei",
        "role" => "Communications & Outreach Lead",
        "image" => "images/Mercy.jpg",
        "bio"  => "Mercy doesn’t just communicate—she connects. Through her storytelling and advocacy, she bridges hearts and builds support for our work."
      ],
      [
        "name" => "vincent Cheruiyot",
        "role" => "Finance & Donations Coordinator",
        "image" => "images/Vincent.jpg",
        "bio"  => "Vincent stewards every donation with integrity. With sharp precision and unwavering ethics, he ensures that every shilling makes a difference."
      ],
      [
        "name" => "Ezra Cheruiyot",
        "role" => "Assistant Program & Health Coordinator",
        "image" => "images/Ezra.jpg",
        "bio"  => "Ezra is our safe space. With empathy and strength, she supports both our team and the community’s mental wellbeing, one healing step at a time."
      ]
    ];

    foreach ($team as $member) {
      echo "
      <div class='member-card'>
        <img src='{$member['image']}' alt='Photo of {$member['name']}'>
        <h3>{$member['name']}</h3>
        <p class='title'>{$member['role']}</p>
        <p class='bio'>{$member['bio']}</p>
      </div>";
    }
    ?>

  </div>
</div>

<?php include 'footer.php'; ?>
