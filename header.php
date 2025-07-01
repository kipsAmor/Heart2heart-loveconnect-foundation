<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Heart to Heart & Love Connect Foundation</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Quicksand', sans-serif;
      background: linear-gradient(to right, #f7f7f7, #ffffff);
    }

    nav {
      background-color: #e91e63;
      padding: 1rem 0;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    nav ul {
      display: flex;
      justify-content: center;
      list-style: none;
      margin: 0;
      padding: 0;
      flex-wrap: wrap;
    }

    nav ul li {
      position: relative;
      margin: 0 1rem;
    }

    nav ul li a {
      text-decoration: none;
      color: white;
      font-weight: 600;
      font-size: 1rem;
      transition: color 0.3s, background 0.3s;
      padding: 0.5rem 1rem;
      border-radius: 30px;
      display: inline-block;
    }

    nav ul li a:hover {
      background-color: #ffffff;
      color: #e91e63;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      background-color: #e91e63;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      list-style: none;
      padding: 0;
      margin: 0;
      min-width: 160px;
      z-index: 999;
    }

    .dropdown-menu li {
      width: 100%;
    }

    .dropdown-menu li a {
      padding: 0.6rem 1rem;
      width: 100%;
      display: block;
      color: white;
      border-radius: 0;
    }

    .dropdown-menu li a:hover {
      background-color: #ffffff;
      color: #e91e63;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }

    @media (max-width: 768px) {
      nav ul {
        flex-direction: column;
        align-items: center;
      }

      nav ul li {
        margin: 0.5rem 0;
      }

      .dropdown-menu {
        position: static;
        box-shadow: none;
        border-radius: 0;
      }

      .dropdown-menu li a {
        padding-left: 2rem;
      }
    }
  </style>
</head>
<body>
  <nav>
    <ul>
  <li><a href="index.php">Home</a></li>
  <li><a href="about.php">About Us</a></li>
  <li><a href="programs.php">Programs</a></li>
  <li><a href="key events.php">Key Events</a></li>
  <li><a href="contact.php">Contact Us</a></li>
  <li><a href="Core team.php">Core team</a></li>
  <li class="dropdown">
    <a href="get involved.php">Get Involved</a>
    <ul class="dropdown-menu">
      <li><a href="volunteer.php">Volunteer</a></li>
      <li><a href="donate.php">Donate</a></li>
    </ul>
  </li>
</ul>

  </nav>
</body>
</html>
