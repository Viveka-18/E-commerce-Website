<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-color:rgb(24, 58, 94);
    color: #fff;
    padding: 20px;
}

.footer-section {
    flex: 1 1 200px;
    margin: 10px;
}

.footer-section h3 {
    color:rgb(255, 255, 255);
    margin-bottom: 10px;
    font-size: 20px;
}

.footer-section p,
.footer-section ul {
    font-size: 14px;
    line-height: 1.6;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.social-media img {
    margin-top: 0px;
    width: 25px;
    margin:auto;
    vertical-align: middle;
}

.social-media a {
    display: inline-block;
    margin-right: 10px;
}
.social-media .twit{
    margin-right: 45px;
    padding: 5px;
}
.social-media .insta{
   margin-left:5px;
}

.footer-section form input[type="email"] {
    width: 70%;
    padding: 8px;
    margin-right: 5px;
    border: none;
    border-radius: 4px;
}

.footer-section form button {
    padding: 8px 12px;
    background-color: #f4a261;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.footer-section form button:hover {
    background-color: #e76f51;
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
    color: #ccc;
}

.footer-bottom a {
    color:rgb(24, 58, 94);
    font-weight:medium;
    text-decoration: none;
}
.footer-bottom p{
    color: black;
}

.footer-bottom a:hover {
    text-decoration: underline;
}
.logo{
    font-size: x-large;
    font-weight: bold;
}
.customer{
   margin-left:200px;
}
.about{
    margin-left:150px;
}</style>
</head>
<body>
    
<footer>
        <div class="footer-container">
            <div class="footer-section about">
                <h3>About Us</h3>
                <p>FlipStore is your one-stop shop for all your shopping needs, 
                    offering the best products at unbeatable prices. For those of you with erratic working hours, Flipstore is your best bet. Shop in your PJs,
                    at night or in the wee hours of the morning. This e-commerce never shuts down.</p>
            </div>
            <div class="footer-section customer">
                <h3>Customer Service</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Returns</a></li>
                    <li><a href="#">Shipping Info</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <ul class="social-media">
                    <li><a href="#"><img src="./logos/facebooklogo.png" alt="Facebook"> Facebook</a></li>
                    <li><a href="#" class="twit"><img src="./logos/twitterlogo.jpg" alt="Twitter"> Twitter</a></li>
                    <li><a href="#" class="insta"><img src="./logos/instalogo.jpg" alt="Instagram"> Instagram</a></li>
                </ul>
            </div>
            
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 FlipStore. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>

</body>
</html>