<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coming Soon - Tree Theme</title>
  <style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        background: linear-gradient(to bottom, #a8e6cf, #dcedc1);
        color: #ffffff;
        height: 100vh;
        overflow: hidden;
        background: linear-gradient(0deg, rgba(0, 0, 0, 1) 50%, rgba(202, 109, 87, 1) 100%);
        border: 4px solid #35a4b3;
    }

    h1 {
      font-size: 3rem;
      margin: 0;
    }

    p {
      font-size: 1.5rem;
      margin: 10px 0;
    }

    .tree {
      margin-top: 20px;
      width: 200px;
      height: 200px;
      background: #8d6e63;
      border-radius: 50px 50px 0 0;
      position: relative;
    }

    .tree::before,
    .tree::after {
      content: '';
      position: absolute;
      bottom: 60px;
      width: 160px;
      height: 160px;
      background: #388e3c;
      border-radius: 50%;
    }

    .tree::before {
      left: -40px;
    }

    .tree::after {
      left: 40px;
    }

    .countdown {
      font-size: 1.5rem;
      margin-top: 20px;
    }

    footer {
      position: absolute;
      bottom: 20px;
      font-size: 0.9rem;
      color: #ffffff;
    }
  </style>
</head>
<body>
  <h1>Coming Soon</h1>
  <p>Something amazing is growing...</p>
  <div class="logo-wrapper"><img style="width:200px; height:200px" src="https://threestartrading.in/public/admin/assets/img/logo.png" alt="logo"></div>
  <div class="countdown" id="countdown">Loading countdown...</div>
  <footer>&copy; {{date('Y')}} Three Star Tranding Website. All rights reserved.</footer>

  <script>
    // Set the launch date (example: 10 days from now)
    const launchDate = new Date('2025-02-20');
    //launchDate.setDate(launchDate.getDate() + 10);

    function updateCountdown() {
      const now = new Date().getTime();
      const distance = launchDate - now;

      if (distance < 0) {
        document.getElementById("countdown").textContent = "The tree has grown!";
        clearInterval(countdownInterval);
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("countdown").textContent = 
        `Launching in: ${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    // Update countdown every second
    const countdownInterval = setInterval(updateCountdown, 1000);

    // Initial call to display immediately
    updateCountdown();
  </script>
</body>
</html>
