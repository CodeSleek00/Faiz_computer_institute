<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background:#f4f7fc;
}

/* Banner */
.banner{
    background:url('https://images.unsplash.com/photo-1525186402429-b4ff38bedbec?auto=format&fit=crop&w=1400&q=60');
    background-size:cover;
    background-position:center;
    height:250px;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-align:center;
}
.banner h1{
    font-size:42px;
    font-weight:700;
}

/* Main Box */
.container{
    width:90%;
    max-width:1200px;
    background:white;
    margin:-80px auto 40px auto;
    border-radius:15px;
    padding:40px;
    box-shadow:0px 4px 14px rgba(0,0,0,0.1);
    display:flex;
    gap:40px;
}

/* Left */
.left{
    width:40%;
}
.left h2{
    font-size:28px;
    margin-bottom:10px;
}
.left p{
    color:#555;
    line-height:1.6;
}
.info-box{
    margin:20px 0;
}
.info-item{
    margin-bottom:15px;
    display:flex;
    gap:15px;
}
.info-item i{
    font-size:22px;
    color:#0056ff;
}
.social-icons i{
    font-size:22px;
    margin-right:15px;
    cursor:pointer;
    color:#0d6efd;
}

/* Right */
.right{
    width:60%;
}
.right h2{
    font-size:28px;
    margin-bottom:10px;
}
.input-flex{
    display:flex;
    gap:15px;
}
input, textarea{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:15px;
}
textarea{
    resize:none;
    height:100px;
}
button{
    width:100%;
    padding:14px;
    background:#0056ff;
    color:white;
    border:none;
    font-size:18px;
    border-radius:6px;
    cursor:pointer;
}
button:hover{
    background:#0042c1;
}

/* Map */
.map{
    width:100%;
    height:350px;
    margin-top:20px;
}
</style>

</head>
<body>

<!-- Banner -->
<div class="banner">
    <h1>Contact Us</h1>
</div>

<!-- Main Contact Box -->
<div class="container">

    <!-- LEFT SIDE -->
    <div class="left">
        <h2>Get in Touch</h2>
        <p>Feel free to reach out. We are here to help you anytime.</p>

        <div class="info-box">
            <div class="info-item">
                <i>📍</i>
                <div>
                    <b>Head Office</b><br>
                    Lucknow, Uttar Pradesh – India
                </div>
            </div>

            <div class="info-item">
                <i>📧</i>
                <div>
                    <b>Email Us</b><br>
                    support@yourdomain.com
                </div>
            </div>

            <div class="info-item">
                <i>📞</i>
                <div>
                    <b>Call Us</b><br>
                    +91 9876543210
                </div>
            </div>
        </div>

        <h3>Follow Us</h3>
        <div class="social-icons">
            <i>📘</i>
            <i>📸</i>
            <i>🐦</i>
            <i>▶️</i>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="right">
        <h2>Send us a Message</h2>

        <div class="input-flex">
            <input type="text" id="name" placeholder="Name">
            <input type="text" id="company" placeholder="Company">
        </div>

        <div class="input-flex">
            <input type="text" id="phone" placeholder="Phone">
            <input type="email" id="email" placeholder="Email">
        </div>

        <input type="text" id="subject" placeholder="Subject">

        <textarea id="message" placeholder="Message"></textarea>

        <button onclick="submitForm()">Send</button>

        <p id="response" style="margin-top:10px;color:green;font-weight:bold;"></p>
    </div>

</div>

<!-- Map -->
<div class="map">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19810.07453196937!2d-0.133610!3d51.506178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604cd5162939f%3A0xdeb8f8f37ac6b8e1!5e0!3m2!1sen!2sin!4v1700000000001"
        width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy"></iframe>
</div>

<script>
function submitForm(){
    let fd = new FormData();
    fd.append("name", document.getElementById("name").value);
    fd.append("contact", document.getElementById("phone").value);
    fd.append("email", document.getElementById("email").value);
    fd.append("message", document.getElementById("message").value);

    fetch("save_contact.php", {
        method: "POST",
        body: fd
    })
    .then(r => r.text())
    .then(data => {
        document.getElementById("response").innerHTML = data;
        document.getElementById("name").value = "";
        document.getElementById("phone").value = "";
        document.getElementById("email").value = "";
        document.getElementById("message").value = "";
    });
}
</script>

</body>
</html>
