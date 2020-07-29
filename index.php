
<?php
//registration

require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

        // Set these parameters
        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT);

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: index.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
}


?>

<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username']))
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $err = "Please enter username + password";
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }


if(empty($err))
{
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;
    
    
    // Try to execute this statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt))
                    {
                        if(password_verify($password, $hashed_password))
                        {
                            // this means the password is corrct. Allow user to login
                            session_start();
                            $_SESSION["username"] = $username;
                            $_SESSION["id"] = $id;
                            $_SESSION["loggedin"] = true;

                            //Redirect user to welcome page
                            header("location: index.php");
                            
                        }
                    }

                }

    }
}    


}


?>




<?php
$insert = false;
if(isset($_POST['name'])){
 //set connection variables
   $server = "localhost";
   $username = "root";
   $password = "";
 //create database connections
   $con = mysqli_connect($server, $username, $password);

   //check for connection success
   if(!$con){
       die("connection failed!". mysqli_connect_error());
   }
   //echo "success! connecting to db";

   //collect post variables
   $name= $_POST['name2'];
   $email= $_POST['email2'];
   $phone= $_POST['number2'];
   $address= $_POST['address'];
   $accom= $_POST['accom'];
   $area= $_POST['area'];
   $budjet= $_POST['budjet'];
  
   $sql = "INSERT INTO `realestatesell`.`sellprop` (`Name`, `Email`, `Phone no.`, `Address`, `Budjet`, `Accomodation`, `Area`, `Datetime`, `id`) VALUES ('$name2', '$email2', '$number2', '$address', '$budjet', '$accom', '$area', '2020-07-12 22:18:00', '')";
//   echo $sql;

  //execute the query
   if($con->query($sql) == true){   //con is object operator query function
       //echo "successfully inserted";

       //flag for successful connection
       $insert = true;
   }
   else{
       echo  "ERROR: $sql <br> $con->error";
   }
//close the database connection
   $con->close();
}
?>




<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <style>

  </style>
  <title>Real Estate2.0</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
      <h1> RealEstate2.0.com</h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Feedback</a>
        </li>
      </ul>
      <button type="button" class="btn btn-success rounded-pill" data-toggle="modal" data-target="#exampleModal2">
        Register
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Register Your self by Creating an Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Enter Your Name</label>
                  <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Set a Password for your account</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-success">Register</button>

              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success mx-3 my-3 rounded-pill" data-toggle="modal" data-target="#exampleModall">
        Login
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModall" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Login </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST">
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-success">Login</button>

              </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <div class="row mx-auto">

      <div class="col-10 col-md-6 search-box">
        <input class="search-txt" id="searchbar" type="text" name="search" placeholder="Type to search">
        <a class="search-btn" href="#">
          <i class="fa fa-search" aria-hidden="true"></i>
        </a>
      </div>
      <div class="form-group" id="cities">

        <select class="form-control" id="exampleFormControlSelect1">
          <option>Pune</option>
          <option>Mumbai</option>
          <option>Kolhapur</option>
          <option>Nagpur</option>

        </select>
      </div>
    </div>


    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="row mx-auto carousel-inner">
      <div class="carousel-item active">
        <img src="perfect-house1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Welcome</h2>
          <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          <a class="btn btn-primary" href="#" role="button">BUY</a>
          <a class="btn btn-primary" href="rent.html" role="button">RENT</a>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            SELL
          </button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1400x500/?nature,home" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2> News</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <a class="btn btn-primary" href="#" role="button">BUY</a>
          <a class="btn btn-primary" href="/rent.html" role="button">RENT</a>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            SELL
          </button>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://source.unsplash.com/1400x500/?nature,home" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h2>Sell</h2>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          <a class="btn btn-primary" href="#" role="button">BUY</a>
          <a class="btn btn-primary" href="/rent.html" role="button">RENT</a>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            SELL
          </button>
        </div>
      </div>
    </div>
     <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Sell Out</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div>
              <form action="index.php" method="POST" id="sell">
                <input type="text" name="name2" id="name2" placeholder="Full name">
                <input type="email" name="email2" id="email2" placeholder="Email">
                <input type="number" name="number2" id="number2" placeholder="Contact-no">
                <input type="text" name="address" id="address" placeholder="Address">
                <input type="number" name="budjet" id="budjet" placeholder="Budjet">
                <input type="text" name="accom" id="accom" placeholder="Accomodation">
                <input type="number" name="area" id="area" placeholder="Area(in sq.ft)">
                <h2>Amenities</h2>
                <label class="container">Availability of groceries and essential products
                  <input type="checkbox" checked="checked" id="avl"
                    value="Availability of groceries and essential products">
                  <span class="checkmark"></span>
                </label>

                <label class="container">Parks/Gardens/Recreation
                  <input type="checkbox" id="parks" value="Parks/Gardens/Recreation">
                  <span class="checkmark"></span>
                </label>

                <label class="container">Good parking slot
                  <input type="checkbox" id="parking" value="Good parking slot">
                  <span class="checkmark"></span>
                </label>

                <label class="container">Gyms
                  <input type="checkbox" id="gyms" value="Gyms">
                  <span class="checkmark"></span>
                </label>
                <label class="container">Swimming pool
                  <input type="checkbox" id="swimming" value="Swimming pool">
                  <span class="checkmark"></span>
                </label>
                <label class="container">Mall
                  <input type="checkbox" id="malls" value="Mall">
                  <span class="checkmark"></span>
                </label>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <button type="button" id="enquire" class="btn btn-success">Enquire</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <h2><strong>Featured Projects</strong></h2>
  <h3>Exclusive showcase of top projects</h3>

  <section class="feature-box row mx-auto closeouts mx-3 my-3">

    <div class="feature-box mx-3 my-3">
      <div class="conf">
        <div class="bloga">
          <img src="flats-in-omr.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success"  onclick="link()" href="property1.html" role="button"> Click here to know more</a>

          </div>
        </div>
      </div>
    </div>
    <div class="feature-box mx-3 my-3">
      <div class="conf">
        <div class="bloga">
          <img src="lawhill.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success" href="property1.html"  role="button"> Click here to know more</a>

          </div>
        </div>
      </div>

    </div>
  </section>

  <h2><strong>Trending Projects</strong></h2>
  <section class="feature-box closeouts mx-3 my-3">
    <div class="feature-box">
      <div class="conf">
        <div class="bloga">
          <img src="Apartments.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success" href="property1.html" role="button"> Click here to know more</a>
          </div>
        </div>
      </div>
    </div>
    <div class="feature-box my-3 mx-3">
      <div class="conf">
        <div class="bloga">
          <img src="Crew_Apartments Living Room.jpg">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success" href="#" href="property1.html" role="button"> Click here to know more</a>

          </div>
        </div>
      </div>

    </div>
    <div class="ifr">
      <iframe width="315" height="315"
        src="http://www.megapolisserenity.com/?gclid=Cj0KCQjw-Mr0BRDyARIsAKEFbedrh9GfN-74NxDhhY3piYQR4UbBjN_mqB20zwL42Z2OEFnThQsUMdgaAuU6EALw_wcB"
        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen></iframe>
    </div>
  </section>
  <h2><strong>Featured Collections</strong></h2>
  <h3> Handpicked Projects for you</h3>
  <section class="feature-box closeouts mx-3 my-3">

    <div class="feature-box mx-3 my-3">
      <div class="conf">
        <div class="bloga">
          <img src="house.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> Enjoy higher degree of freedom and privacy </h3>
            <a class="btn btn-success" href="property1.html" onclick="link()" role="button"> Click here to know more</a>

          </div>
        </div>
      </div>

    </div>
    <div class="feature-box mx-3 my-3">

      <div class="conf">
        <div class="bloga">
          <img src="luxury.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> Ready to move in luxurious flats </h3>

            <a class="btn btn-success" href="property1.html" role="button"> Click here to know more</a>

          </div>
        </div>
      </div>
    </div>
  </section>
  <h2><strong> Upcoming Projects </strong></h2>
  <h3>Get to know about Awesome Ongoing projects in your city</h3>
  <section class="feature-box closeouts my-3 mx-3">
    <div class="feature-box mx-3 my-3">

      <div class="conf">

        <div class="bloga">

          <img src="18-037-24_Fire_Pit_Area_efyaf4.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success" href="#"  onclick="link()"role="button"> Click here to know more</a>

          </div>
        </div>
      </div>

    </div>
    <div class="feature-box mx-3 my-3">
      <div class="conf">
        <div class="bloga">
          <img src="127531242.jpg" alt="">
        </div>
        <div class="back">
          <div class="back-body">
            <h3> random project </h3>
            <h3> random developer</h3>
            <h3>price</h3>
            <a class="btn btn-success" href="#"  onclick="link()"role="button"> Click here to know more</a>

          </div>
        </div>
      </div>
    </div>
  </section>
  <footer class="container my-5 bg-light">
    <div class="css-1s85d9h">
      <span class="css-1s7vcku">Partners</span>
      <a title="India's most trusted Real Estate Community" href="https://www.indianrealestateforum.com/"
        target="_blank" class="css-1rkyyfw"></a>
      <a title="makaan" href="https://www.makaan.com/" target="_blank" class="css-i3is0w"></a>
      <a title="Proptiger" href="https://www.proptiger.com/" target="_blank" class="css-zp4i3h"></a>
    </div>
    <div class="row">
      <div class="col-12 col-md">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor"
          stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="d-block mb-2" role="img"
          viewBox="0 0 24 24" focusable="false">
          <title>Product</title>
          <circle cx="12" cy="12" r="10"></circle>
          <path
            d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94">
          </path>
        </svg>
        <small class="d-block mb-3 text-muted">© 2017-2020</small>
      </div>
      <div class="col-6 col-md">
        <h5>Features</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Cool stuff</a></li>
          <li><a class="text-muted" href="#">Random feature</a></li>
          <li><a class="text-muted" href="#">Team feature</a></li>
          <li><a class="text-muted" href="#">Stuff for developers</a></li>
          <li><a class="text-muted" href="#">Another one</a></li>
          <li><a class="text-muted" href="#">Last time</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Resource</a></li>
          <li><a class="text-muted" href="#">Resource name</a></li>
          <li><a class="text-muted" href="#">Another resource</a></li>
          <li><a class="text-muted" href="#">Final resource</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>Resources</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Business</a></li>
          <li><a class="text-muted" href="#">Education</a></li>
          <li><a class="text-muted" href="#">Government</a></li>
          <li><a class="text-muted" href="#">Gaming</a></li>
        </ul>
      </div>
      <div class="col-6 col-md">
        <h5>About</h5>
        <ul class="list-unstyled text-small">
          <li><a class="text-muted" href="#">Team</a></li>
          <li><a class="text-muted" href="#">Locations</a></li>
          <li><a class="text-muted" href="#">Privacy</a></li>
          <li><a class="text-muted" href="#">Terms</a></li>
        </ul>
      </div>
    </div>
  </footer>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="f.js"></script>
</body>

</html>