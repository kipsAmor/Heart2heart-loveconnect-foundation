<?php include 'header.php'; ?>

<style>
  body {
    font-family: 'Quicksand', sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom right, #fff4f6, #ffe3ec);
    color: #333;
  }

  .programs {
    padding: 80px 20px;
    text-align: center;
    animation: fadeIn 1.5s ease-in-out;
  }

  .programs h2 {
    font-size: 2.8rem;
    color: #e91e63;
    margin-bottom: 40px;
    font-weight: 700;
  }

  .program-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
    padding: 0;
    margin: 0 auto;
    max-width: 1100px;
    list-style: none;
  }

  .program-list li {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease;
    display: flex;
    flex-direction: column;
    text-align: left;
  }

  .program-list li:hover {
    transform: translateY(-5px);
  }

  .program-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .program-content {
    padding: 20px;
  }

  .program-content h3 {
    font-size: 1.4rem;
    margin: 0 0 10px;
    color: #e91e63;
  }

  .program-content p {
    font-size: 1rem;
    color: #555;
    margin: 0;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

<section class="programs">
  <div class="container">
    <h2>Our Programs</h2>
    <ul class="program-list">
      <li>
        <img src="images/foodhampers.jpeg" alt="Orphan Support" class="program-image">
        <div class="program-content">
          <h3>👶 Food Hampers distribution </h3>
          <p>We’ve delivered food hampers to more than 150 vulnerable families(Orphan and Vulnerable Children,elderly and pwds), especially during school holidays and tough economic periods, ensuring no child sleeps hungry..
            we believe that no one should go to bed hungry. Your gift fills a stomach — and a heart</p>
        </div>
      </li>
      <li>
        <img src="images/dignitysani.jpg" alt="Women Empowerment" class="program-image">
        <div class="program-content">
          <h3>👩‍💼 Vulnarable Women & Girls  Empowerment & Mentorship</h3>
          <p>💖We’ve partnered with local schools and community health workers to distribute sanitary towels to over 2000 girls in underserved areas within Nakuru County, helping reduce absenteeism and promoting menstrual dignity.
We believe that a simple pack can keep a girl in school, restore her confidence, and protect her dreams.
</p>
        </div>
      </li>
      <li>
        <img src="images/solaiweel.jpg" alt="Mobility Devices" class="program-image">
        <div class="program-content">
          <h3>🛠️ Mobility Devices</h3>
          <p>Through generous donations, we’ve distributed wheelchairs, walking frames, and crutches to people living with disabilities—restoring movement, independence, and joy.
           We believe that freedom is dignity. Give someone the power to move, live, and smile again </p>
        </div>
      </li>
      <li>
        <img src="images/clothes.jpg" alt="Clothes donation" class="program-image">
        <div class="program-content">
          <h3>❤️ Clothes/Beddings  distribution  Initiatives</h3>
          <p>We’ve collected and distributed gently used clothes & beddings  to children in orphanages, street families, and struggling households—giving warmth and restoring pride.
            We belive believe in Wrapping someone in warmth. Your clothes can carry hope, comfort, and self-worth</p>
        </div>
      </li>
      <li>
        <img src="images/shletr.jpg" alt="Shelter for the needy initiative " class="program-image">
        <div class="program-content">
          <h3>❤️ Shelter for the needy Initiatives</h3>
          <p>Through the generosity of partners and kind-hearted well-wishers, we’ve transformed lives by building **two new homes for vulnerable families in Mauche, Njoro Constituency, and one more in Kuresoi North Constituency**. These safe, permanent houses stand as proof that when a caring community pools its resources, hope truly becomes a home.</p>
        </div>
      </li>
      <li>
        <img src="images/treees.jpg" alt="Enviromental conservation " class="program-image">
        <div class="program-content">
          <h3>❤️ Shelter for the needy Initiatives</h3>
          <p>As part of our commitment to a greener future, we ensure that tree planting follows every event we hold. These efforts not only restore the environment but also symbolize growth, resilience, and long-term impact for the communities we serve.</p>
        </div>
      </li>
    </ul>
  </div>
</section>

<?php include 'footer.php'; ?>
