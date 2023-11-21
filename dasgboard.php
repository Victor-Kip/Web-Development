<!DOCTYPE html>
<html>

<head>
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: "montserrat", sans-serif;

        }


        .hero {
            height: 30vh;
            width: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(projimage.jpg);
            background-size: cover;
            background-position: center;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 40px;
            padding-left: 10%;
            padding-right: 10%;
        }

        .logo {
            color: white;
            font-size: 28px;
        }

        span {
            color: #ea1538;
        }

        nav ul li {
            list-style-type: none;
            display: inline-block;
            padding: 10px 20px;
            position: relative;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        nav ul li a:hover {
            color: #ea1538;
            transition: .3s;
        }

        .dropdown {
            left: 0;
            opacity: 0;
            position: absolute;
            top: 35px;
            visibility: hidden;
            z-index: 1;
        }

        li:hover ul.dropdown {
            opacity: 1;
            top: 40px;
            visibility: visible;
        }

        .dropdown li {
            float: none;
            width: 100px;
            display: flex;
            align-items: center;

        }
    </style>



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
                <li><a href="#">Drugs</a>
                    <ul class="dropdown">
                        <li class="tablets"><a href="category.php?cat=tablets">Tablets</a></li>
                        <li class="powder"><a href="category.php?cat=powder">Powder</a></li>
                        <li class="paste"><a href="category.php?cat=paste">Paste</a></li>
                    </ul>
                </li>

            </ul>
            <button type="button" onclick="window.location.href = 'patlogin.php';">Login</button>
        </nav>

        <h1 class="branding-title"><a href="/">Drug Catalog</a></h1>



    </div>

    <div id="content">