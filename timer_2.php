<?php


    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'test');
    date_default_timezone_set('Asia/Tashkent');

    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if ($conn->connect_errno) {
      exit('Oshibka');
    };
    $conn->set_charset('utf8');



    $seconds_2 = $_POST['seconds_2'];
    $minutes_2 = $_POST['minutes_2'];
    $e_time = $_POST['e_time'];
    $time = $_POST['time'];
    $date_clicked = Date('H:i:s');
    // $date_clicked_2 = $date_clicked->add(new DateInterval('PT' . $minutes_2 . 'M' . $seconds_2 . 'S'));
    if (!empty($e_time)) {
      $sql = "INSERT INTO timer (Start_time, End_time) VALUES ('$date_clicked', '$e_time')";

    if ($conn->query($sql) === TRUE){
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    };
  };


?>