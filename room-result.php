
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hamish Allan | Room Search</title>
    <link rel="icon" type="image/x-icon" href="img/favicon-32x32.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <link href="css/style.css" rel="stylesheet" />

</head>
<!-- Navbar -->
<header>
    <nav class="navbar navbar-expand-lg" style="padding: 0px;">
      <div class="container-fluid nav-container">
        <a class="navbar-brand" href="index.html">
          <img src="img/logo.png" height="30" alt="">
        </a>
        <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarExample01"
          aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse " id="navbarExample01">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="projects.html">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <!-- Navbar -->

<body>
   

<div id="results-container" class="container w-50 py-3 text-center">
    <h1>Room Details</h1>
    <hr>

    <?php

        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = 'root';
        $DATABASE_PASS = '';
        $DATABASE_NAME = 'uofg_room_information';

        // Create connection
        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
        // Check connection
        if ( mysqli_connect_errno() ) {
            // If there is an error with the connection, stop the script and display the error.
            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
        }

        //if ( !isset($_POST['username']) ) {
        // Could not get the data that should have been sent.
        //	exit('Please fill in the username field!');
        //}
        if ($stmt = $con->prepare("SELECT room.*, building.building_name, building.building_image FROM building, room WHERE room.building_id = building.building_id and room.room_number like ? and building.building_id = ?;")) {
            // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
            $stmt->bind_param('ss', $_POST['room_name'],$_POST['building']);
            $stmt->execute();

            $result = $stmt->get_result();
            foreach($result as $row) {
            echo "<h2>" .  $row['building_name'] . ": Room " . $row['room_number'] . "</h2>";
            echo "<p class='subheading'>Chairs: " . $row['chair_type'] . "<p>";
            echo "<p class='subheading'>Whiteboard: " . $row['whiteboard_type'] . "<p>";
            echo "<p class='subheading'>Computer: " . $row['computer_type'] . "<p>";
            echo "<p class='subheading'>Room Notes: " . $row['description'] . "<p>";
              
            echo "<img src='" . $row['building_image'] . "'>";
            
            }
            $stmt->close();
        }
    ?>  
    <br><br>
    <a href="room-finder.php">
      <button class="btn btn-primary" action="room-finder.php">Search Again</button>
    </a>
</div>
    
<br>


<footer class="text-center fixed-bottom text-white" style="background-color: #2d3035;">
            <!-- Grid container -->
            <!--  <div class="container p-4 pb-0">
                <!-- Section: Social media -->
            <!--   <section class="mb-4">
                    <!-- Linkedin -->
            <!--        <a data-mdb-ripple-init class="btn text-white m-1" style="background-color: #0082ca;"
                        href="https://www.linkedin.com/in/hamish-a-476503298/" role="button"><i
                            class="fab fa-linkedin-in"></i></a>
                    <!-- Github -->
            <!--        <a data-mdb-ripple-init class="btn text-white m-1" style="background-color: #333333;"
                        href="https://github.com/HamishTheGinger" role="button"><i class="fab fa-github"></i></a>
                </section>
                <!-- Section: Social media -->
            <!--  </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Copyright:
                <a class="text-white" href="https://hamishallan.uk/">Hamish Allan</a>
            </div>
            <!-- Copyright -->
        </footer>
</html>

