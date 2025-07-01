<?php include 'header.php'; ?>

<style>
  body {
    font-family: 'Quicksand', sans-serif;
    background: linear-gradient(to right, #fff4f6, #ffe3ec);
    margin: 0;
    padding: 0;
    color: #333;
  }

  .contact {
    padding: 80px 20px;
    max-width: 800px;
    margin: auto;
    text-align: center;
    animation: fadeIn 1.5s ease;
  }

  .contact h2 {
    font-size: 2.5rem;
    color: #e91e63;
    margin-bottom: 2rem;
    font-weight: 700;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    background: #fff;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    animation: slideIn 1s ease;
  }

  input, textarea {
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
  }

  input:focus, textarea:focus {
    border-color: #e91e63;
    box-shadow: 0 0 8px rgba(233, 30, 99, 0.2);
  }

  textarea {
    resize: vertical;
    min-height: 150px;
  }

  button {
    padding: 1rem 1.5rem;
    background-color: #e91e63;
    color: white;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: #d81b60;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @keyframes slideIn {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @media (max-width: 600px) {
    form {
      padding: 1.5rem;
    }

    .contact h2 {
      font-size: 2rem;
    }
  }
</style>

<section class="contact">
  <h2>Contact Us</h2>
  <form action="contact.php" method="post">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <textarea name="message" placeholder="Message" required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>

<?php include 'footer.php'; ?>
