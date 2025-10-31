<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pricing Plans</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    /* --- your existing styles (copied) --- */
    * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: linear-gradient(180deg, #fdfcff, #f3f7ff); margin: 0; padding: 40px 20px; color: #1d1d1f; }
    h1 { text-align: center; font-size: 28px; margin-bottom: 8px; }
    p.subtitle { text-align: center; color: #707070; font-size: 15px; }
    .pricing { display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; max-width: 1100px; margin: auto; }
    .card { background: #fff; border-radius: 20px; box-shadow: 0 8px 20px rgba(0,0,0,0.05); width: 320px; padding: 30px; transition: all 0.3s ease; border: 2px solid transparent; }
    .card:hover { transform: translateY(-5px); border-color: #c3d0ff; }
    .card.best { background: linear-gradient(145deg, #edf3ff, #fff); border: 2px solid #c3d0ff; }
    .plan-title { font-size: 22px; font-weight: 600; margin-bottom: 5px; }
    .plan-subtitle { color: #6b6b6b; font-size: 14px; margin-bottom: 15px; }
    .price { font-size: 26px; font-weight: 700; margin: 15px 0; }
    button { background: #4a63ff; color: #fff; border: none; padding: 12px 20px; border-radius: 10px; font-size: 15px; cursor: pointer; width: 100%; transition: 0.3s; }
    button:hover { background: #324ae0; }
    ul { list-style: none; padding: 0; margin-top: 20px; }
    ul li { margin: 8px 0; font-size: 14px; color: #4b4b4b; display: flex; align-items: center; }
    ul li::before { content: "✔"; color: #4a63ff; font-weight: bold; margin-right: 8px; }
    ul li.cut { color: #a0a0a0; }
    ul li.cut::before { content: ""; color: #ff4c4c; font-weight: bold; }
    @media (max-width: 768px) { .pricing { flex-direction: column; align-items: center; } .card { width: 100%; max-width: 370px; } }
  </style>
</head>
<body>
  <h1>Start Your O Level Preparation (Online/Offline)</h1>
  <p class="subtitle">Transparent pricing tailored to your needs, ensuring affordability without compromising on quality.</p>

  <div class="pricing">
    <div class="card">
      <div class="plan-title">Basic Access</div>
      <div class="plan-subtitle">O Level </div>
      <!-- pass plan and price via GET -->
      <button onclick="window.location.href='enroll.php?plan=Basic Access&price=6000'">Enroll Now</button>
      <div class="price">₹6,000</div>
      <ul>
        <li>Access to all Subject Video Lectures</li>
        <li>150+ Mock Test</li>
        <li>Live-Session</li>
        <li>Online Notes & Important Points</li>
        <li>Ultimate Portal Access</li>
        <li class="cut">This plan does not include registration, Exam Form Submission, Project, any kind of Certificate</li>
      </ul>
    </div>

    <div class="card best">
      <div class="plan-title">Advanced Access</div>
      <div class="plan-subtitle">O Level</div>
      <button onclick="window.location.href='enroll.php?plan=Advanced Access&price=17000'">Enroll Now</button>
      <div class="price">₹17,000</div>
      <ul>
        <li>Access to all Subject Video Lectures</li>
        <li>150+ Mock Test</li>
        <li>Live-Session</li>
        <li>Online Notes & Important Points</li>
        <li>Ultimate Portal Access</li>
        <li>Registration</li>
        <li>Exam Form Submission</li>
        <li>Project</li>
        <li>Certificate Included (if Pass)</li>
      </ul>
    </div>

    <div class="card">
      <div class="plan-title">Customizable Access</div>
      <div class="plan-subtitle">Price Varies According to Your Customisation</div>
      <button onclick="location.href='custom_enroll.php'">Enroll Now</button>
      <div class="price">₹1500-₹17,000</div>
      <ul>
        <li>Custom course</li>
        <li>Dedicated Videos</li>
        <li>Live Sessions</li>
        <li>Strategic and Consulting sessions bi-weekly</li>
        <li>Payment plan based on milestones</li>
      </ul>
    </div>
  </div>
</body>
</html>
