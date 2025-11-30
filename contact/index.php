<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <style>
        body{
            font-family: Arial;
            background:#f5f5f5;
            padding:40px;
        }
        .container{
            width:400px;
            padding:20px;
            margin:auto;
            background:white;
            border-radius:10px;
            box-shadow:0px 0px 10px rgba(0,0,0,0.1);
        }
        input, textarea{
            width:100%;
            padding:10px;
            margin:10px 0;
            border:1px solid #ccc;
            border-radius:5px;
        }
        button{
            width:100%;
            padding:12px;
            background:#007bff;
            border:none;
            color:white;
            font-size:16px;
            border-radius:5px;
            cursor:pointer;
        }
        button:hover{
            background:#0056b3;
        }
        #response{
            margin-top:10px;
            font-weight:bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Contact Us</h2>

    <input type="text" id="name" placeholder="Enter Full Name" required>
    <input type="text" id="contact" placeholder="Enter Contact Number" required>
    <input type="email" id="email" placeholder="Enter Email ID" required>
    <textarea id="message" placeholder="Enter Your Query" rows="4" required></textarea>

    <button onclick="submitForm()">Submit</button>

    <p id="response"></p>
</div>

<script>
function submitForm(){
    let name = document.getElementById("name").value;
    let contact = document.getElementById("contact").value;
    let email = document.getElementById("email").value;
    let message = document.getElementById("message").value;

    let formData = new FormData();
    formData.append("name", name);
    formData.append("contact", contact);
    formData.append("email", email);
    formData.append("message", message);

    fetch("save_contact.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("response").innerHTML = data;
        document.getElementById("name").value = "";
        document.getElementById("contact").value = "";
        document.getElementById("email").value = "";
        document.getElementById("message").value = "";
    });
}
</script>

</body>
</html>
