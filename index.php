<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home Page</title>

    <link rel="stylesheet" type="text/css" href="indexstyles.css">
    <link rel="preconnect" href="http://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans: ital, wght@0,100; 0,30 0;0,400;0,500; 0,600; 0,700; 1, 100; 1, 200; 1,300; 1,400; 1,500; 1,600;1,700&family=Montserrat: wght@700; 800; 900&display=swap" rel="stylesheet">
</head>

<body>



    <div class="hero">
        <nav>
            <h2 class="logo">Honey<span>Meds</span></h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href=" index.php#about-us">About</a></li>
                <li><a href="services.html">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <button type="button" onclick="window.location.href = 'patlogin.php';">Login</button>
        </nav>

        <div class="content">
            <h1>Feeling under <br><span>the weather today?</span> <br>We get it...</h1>
            <p class="par">Let us help you out.</p>

            <button class="cn"><a href="patlogin.php">Get a consultation today</a></button>

        </div>


    </div>




    </div>

    <div class="about-section">
        <div class="inner-container">
            <h1 id="about-us">About Us</hl>
                <p class="text">
                    Quality healthcare should e easily available to anyone despite their location. This is our goal in mind when offering you our services. We aim to make everyone feel at home and have the best online pharmacy tool at their fingertips. So, help us, help you out. Chill back and wait as our well qualified experts attend to you.
                    HoneyMeds has you covered all round the clock.
                </p>


        </div>
    </div>


    <div class="testimonials">
        <div class="inner">
            <h1>Testimonials</h1>
            <div class="border"></div>

            <div class="row">
                <div class="col">
                    <div class="testimonial">
                        <img src="p1.png">
                        <div class="name">Dana Kwoks</div>
                        <div class="stars">
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                        </div>
                        <p>
                            Quality services and exceptional customer care. I would choose this over any physical pharmacy any day.
                        </p>
                    </div>
                </div>

                <div class="col">
                    <div class="testimonial">
                        <img src="p2.png">
                        <div class="name">josh </div>
                        <div class="stars">
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                        </div>
                        <p>
                            A fantastic experience! The website is user-friendly, making it easy to find what I needed. The checkout process was smooth, and my order arrived quickly. The quality of the medication was top-notch, and the packaging was secure. I'll definitely be a returning customer! Highly recommended!
                        </p>
                    </div>
                </div>

                <div class="col">
                    <div class="testimonial">
                        <img src="p3.png">
                        <div class="name">Lawrence Stitch</div>
                        <div class="stars">
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                            <i class="fa-solid fa-star" style="color: #0ec42c;"></i>
                        </div>
                        <p>
                            I had an excellent experience using this online pharmacy. The website's user-friendly interface made it easy to find what I needed. They offer an impressive selection of medicines, ensuring I found everything I was looking for. As a satisfied customer, I'll be returning for my future medical needs.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer>
        <div class="footerContainer">
            <div class="socialIcons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-google-plus"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
            </div>
            <div class="footerNav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footerBottom">
                <p>Copyright <i class="fa-regular fa-copyright"></i> 2023<span class="designer"><a href="adminlogin.php">Admin Login</a></span></p>
            </div>
        </div>

    </footer>


</body>

</html>