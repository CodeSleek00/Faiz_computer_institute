<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pricing Plans</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background: linear-gradient(180deg, #fdfcff, #f3f7ff); margin: 0; padding: 40px 20px; color: #1d1d1f; }
    h1 { text-align: center; font-size: 28px; margin-bottom: 8px; }
    p.o-level-subtitle { text-align: center; color: #707070; font-size: 15px; }
    
    .o-level-pricing { 
      display: flex; 
      justify-content: center; 
      gap: 25px; 
      flex-wrap: wrap; 
      max-width: 1100px; 
      margin: auto; 
    }

    .o-level-card { 
      background: #fff; 
      border-radius: 20px; 
      box-shadow: 0 8px 20px rgba(0,0,0,0.05); 
      width: 320px; 
      padding: 30px; 
      transition: all 0.3s ease; 
      border: 2px solid transparent; 
    }

    .o-level-card:hover { transform: translateY(-5px); border-color: #c3d0ff; }
    .o-level-card.o-level-best { background: linear-gradient(145deg, #edf3ff, #fff); border: 2px solid #c3d0ff; }

    .o-level-plan-title { font-size: 22px; font-weight: 600; margin-bottom: 5px; }
    .o-level-plan-subtitle { color: #6b6b6b; font-size: 14px; margin-bottom: 15px; }
    .o-level-price { font-size: 26px; font-weight: 700; margin: 15px 0; }

    .o-level-btn { 
      background: #4a63ff; 
      color: #fff; 
      border: none; 
      padding: 12px 20px; 
      border-radius: 10px; 
      font-size: 15px; 
      cursor: pointer; 
      width: 100%; 
      transition: 0.3s; 
    }
    .o-level-btn:hover { background: #324ae0; }

    .o-level-features { list-style: none; padding: 0; margin-top: 20px; }
    .o-level-features li { 
      margin: 8px 0; 
      font-size: 14px; 
      color: #4b4b4b; 
      display: flex; 
      align-items: center; 
    }

    .o-level-features li::before { 
      content: "✔"; 
      color: #4a63ff; 
      font-weight: bold; 
      margin-right: 8px; 
    }

    .o-level-features li.o-level-cut { color: #a0a0a0; }
    .o-level-features li.o-level-cut::before { content: ""; color: #ff4c4c; font-weight: bold; }

    @media (max-width: 768px) { 
      .o-level-pricing { flex-direction: column; align-items: center; } 
      .o-level-card { width: 100%; max-width: 370px; } 
    }
  </style>
</head>
<body>
  <h1>Start Your O Level Preparation (Online/Offline)</h1>
  <p class="o-level-subtitle">Transparent pricing tailored to your needs, ensuring affordability without compromising on quality.</p>

  <div class="o-level-pricing">
    <div class="o-level-card">
      <div class="o-level-plan-title">Basic Access</div>
      <div class="o-level-plan-subtitle">O Level</div>
      <button class="o-level-btn" onclick="window.location.href='enroll.php?plan=Basic Access&price=6000'">Enroll Now</button>
      <div class="o-level-price">₹6,000</div>
      <ul class="o-level-features">
        <li>Access to all Subject Video Lectures</li>
        <li>150+ Mock Test</li>
        <li>Live-Session</li>
        <li>Online Notes & Important Points</li>
        <li>Ultimate Portal Access</li>
        <li class="o-level-cut">This plan does not include registration, Exam Form Submission, Project, any kind of Certificate</li>
      </ul>
    </div>

    <div class="o-level-card o-level-best">
      <div class="o-level-plan-title">Advanced Access</div>
      <div class="o-level-plan-subtitle">O Level</div>
      <button class="o-level-btn" onclick="window.location.href='enroll.php?plan=Advanced Access&price=17000'">Enroll Now</button>
      <div class="o-level-price">₹17,000</div>
      <ul class="o-level-features">
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

    <div class="o-level-card">
      <div class="o-level-plan-title">Customizable Access</div>
      <div class="o-level-plan-subtitle">Price Varies According to Your Customisation</div>
      <button class="o-level-btn" onclick="location.href='custom_enroll.php'">Enroll Now</button>
      <div class="o-level-price">₹1500-₹17,000</div>
      <ul class="o-level-features">
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
