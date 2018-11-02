<?php
if($_SERVER['HTTP_HOST'] == "utahtriangle"){
  define("DB_SERVER", "localhost");
	define("DB_USER", "root");
	define("DB_PASS", "");
	define("DB_NAME", "triangle");
} else {
	define("DB_SERVER", "aayl4l63aa9poa.ch0fcpxcz4ha.us-west-2.rds.amazonaws.com:3306");
    define("DB_USER", "utahtriangle");
    define("DB_PASS", "3D7wbU9INI0ScGf7sjbs");
    define("DB_NAME", "ebdb");
}
  // 1. Create a database connection
  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
    
?>
