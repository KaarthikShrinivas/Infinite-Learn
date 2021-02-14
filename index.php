<!DOCTYPE html>
<html>
  <head>
    <title>Infinite Learn</title>
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script>
      function signinPage()
      {
        window.location.href = "Login.php";
      }
    </script>
  </head>
  <body>
    <a name="top"></a>
    <div class="nav-bar">
      <h2>Infinite Learn</h2>
      <div class="links">
        <a href="#Services">Services</a>
        <a href="#About">About Us</a>
        <a href="#Contact">Contact Us</a>
        <a href="Login.php">Sign In</a>
      </div>
    </div>
    <div class="Intro">
      <h1>Infinite Learn</h1>
      <h2>Learn Till Infinity and Beyond</h2>
    </div>
    <div class="wrap">
      <div class="search">
        <input type="text" class="searchTerm" placeholder="Search Books.." >
        <button type="submit" class="searchButton"><i class="fa fa-search"></i></button
      </div>
    </div>
    <br>
    <br>
    <br>
    <h2 id="TB"> Trending Books</h2>
    <div class="cards" onclick="signinPage()">
      <img src="Card1.jpg" alt="CLRS" height="400px" width="100%">
      <div class="CardsInfo">
        <p><strong>Name: </strong> Introduction to Algorithms</p>
        <p><strong>Author: </strong> Thomas H. Cormen, Charles E.Leiserson, Ronald L.Rivest and Clifford Stein</p>
        <p><b>Field:</b> Computer Science and Engineering</p>
      </div>
    </div>
    <div class="cards" id="second" onclick="signinPage()">
      <img src="Card2.jpg" alt="CLRS" height="400px" width="100%">
      <div class="CardsInfo">
        <p><strong>Name: </strong> Programming Python: Powerful Object-Oriented Programming (4th Edition) </p>
        <p><strong>Author: </strong> Mark Lutz</p>
        <p><b>Field:</b> Computer Science and Engineering</p>
      </div>
    </div>
    <div class="cards" id="third" onclick="signinPage()">
      <img src="Card3.jpg" alt="CLRS" height="400px" width="100%">
      <div class="CardsInfo">
        <p><strong>Name: </strong> Practical Electronics for Inventors</p>
        <p><strong>Author: </strong> Paul Scherz and Simon Monk </p>
        <p><b>Field:</b> Electrical and Electronics Engineering</p>
      </div>
    </div>
    <br>
    <a name="Services"></a>
    <div class="service">
      <h3>Our Services:</h3>
      <ul>
        <li>We Provide an Elite service of Providing E-books to the Great Learners and Explorers.</li>
        <li>We have an option that Enables the Learners who wish to buy books and get a physical Copy.</li>
        <li>We also provide delivery services of the books for Learners who buys books in our website and are in within 10 kilometer distance from our Library.</li>
      </ul>
    </div>

    <div class="about">
      <h3>About Us:</h3>
      <p>We are Upcoming Computer Science Engineers Who wish to Help Students and Passionate Learners, Who struggle to find Perfect Books For Them. </p>
      <p><strong>Team Members</strong></p>
      <ul>
        <li>Dhanish Kumar V</li>
        <li>Girish S</li>
        <li>Hariharan A</li>
        <li>V.Kaarthik Shrinivas</li>
        <li>Suraj.P</li>
      </ul>
    </div>
    <a name="About"></a>
    <div class="contact">
      <img src="ProjectLogo.PNG" alt="">
    </div>
  </body>
</html>
