<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">
  <title>Timer</title>
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  <script src="jquery-3.5.1.min.js"></script>
  <script src="/socket.io/socket.io.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.11.1.js" type="text/javascript"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:100,300');

    button[data-setter] {
      outline: none;
      background: transparent;
      border: none;
      font-family: 'Roboto';
      font-weight: 300;
      font-size: 18px;
      width: 25px;
      height: 30px;
      color: #F7958E;
      cursor: pointer;
    }

    button[data-setter]:hover {
      opacity: 0.5;
    }

    .container {
      position: relative;
      top: 30px;
      width: 300px;
      margin: 0 auto;
    }

    .setters {
      position: absolute;
      left: 85px;
      top: 75px;
    }

    .minutes-set {
      float: left;
      margin-right: 28px;
    }

    .seconds-set {
      float: right;
    }

    .controlls {
      position: absolute;
      left: 75px;
      top: 105px;
      text-align: center;
    }

    .display-remain-time {
      font-family: 'Roboto';
      font-weight: 100;
      font-size: 65px;
      color: #F7958E;
    }

    .e-c-base {
      fill: none;
      stroke: #B6B6B6;
      stroke-width: 4px
    }

    .e-c-progress {
      fill: none;
      stroke: #F7958E;
      stroke-width: 4px;
      transition: stroke-dashoffset 0.7s;
    }

    .e-c-pointer {
      fill: #FFF;
      stroke: #F7958E;
      stroke-width: 2px;
    }

    #e-pointer {
      transition: transform 0.7s;
    }

    h1 {
      margin-top: 150px;
      text-align: center;
    }

    body {
      background-color: #f7f7f7;
    }
  </style>
  <style>
      #pause {
      outline: none;
      background: transparent;
      border: none;
      margin-top: 10px;
      width: 50px;
      height: 50px;
      position: relative;
    }

    .play::before {
      display: block;
      content: "";
      position: absolute;
      top: 8px;
      left: 16px;
      border-top: 15px solid transparent;
      border-bottom: 15px solid transparent;
      border-left: 22px solid #F7958E;
    }

    .pause::after {
      content: "";
      position: absolute;
      top: 8px;
      left: 12px;
      width: 15px;
      height: 30px;
      background-color: transparent;
      border-radius: 1px;
      border: 5px solid #F7958E;
      border-top: none;
      border-bottom: none;
    }

    #pause:hover {
      opacity: 0.8;
    }

  </style>
</head>

<body>
  <div id="css-script-menu">
    <div class="css-script-center">
      <div class="css-script-ads">
        <script type="text/javascript">
          google_ad_client = "ca-pub-2783044520727903";
          google_ad_slot = "3025259193";
          google_ad_width = 728;
          google_ad_height = 90;
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
        </script>
      </div>
      <div class="css-script-clear"></div>
    </div>
  </div>
  <h1>Timer</h1>
  <div class="container">
    <div class="setters">
      <div class="minutes-set">
        <button data-setter="minutes-plus">+</button>
        <button data-setter="minutes-minus">-</button>
      </div>
      <div class="seconds-set">
        <button data-setter="seconds-plus">+</button>
        <button data-setter="seconds-minus">-</button>
      </div>
    </div>
    <div class="circle"> <svg width="300" viewBox="0 0 220 220" xmlns="http://www.w3.org/2000/svg">
        <g transform="translate(110,110)">
          <circle r="100" class="e-c-base" />
          <g transform="rotate(-90)">
            <circle r="100" class="e-c-progress" />
            <g id="e-pointer">
              <circle cx="100" cy="0" r="8" class="e-c-pointer" />
            </g>
          </g>
        </g>
      </svg>
    </div>
    <div class="controlls">
      <div class="display-remain-time" >00:30</div>
      <!-- <form method="post" action="include/timer_2.php" id="form_id"> -->
        <button id="pause" type="submit" form="form_id" class="play" name="pause" value="pause" ></button>
      <!-- </form> -->
    </div>

    <table id="lists">
      <thead>
        <tr class="row100 head">
          <th class="cell100 column3" name="time">Start time</th>
          <th class="cell100 column4" name="e_time">End time</th>
        </tr>
      </thead>
      <tbody id="body" name="body">
        <?php
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $dbname = "test";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT Start_time, End_time FROM timer";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo "<tr><td>" . $row['Start_time'] . "</td><td>" . $row['End_time'] . "</td></tr>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();
        ?>
      </tbody>
    </table>
  </div>
  <script>
    //circle start
    let progressBar = document.querySelector('.e-c-progress');
    // let indicator = document.getElementById('e-indicator');
    let pointer = document.getElementById('e-pointer');
    let length = Math.PI * 2 * 100;

    progressBar.style.strokeDasharray = length;

    function update(value, timePercent) {
      var offset = - length - length * value / (timePercent);
      progressBar.style.strokeDashoffset = offset;
      pointer.style.transform = `rotate(${360 * value / (timePercent)}deg)`;
    };

    //circle ends
    const displayOutput = document.querySelector('.display-remain-time')
    const pauseBtn = document.getElementById('pause');
    const setterBtns = document.querySelectorAll('button[data-setter]');

    let intervalTimer;
    let timeLeft;
    let wholeTime = 0.5 * 8; // manage this to set the whole time 
    let isPaused = false;
    let isStarted = false;


    update(wholeTime, wholeTime); //refreshes progress bar
    displayTimeLeft(wholeTime);

    function changeWholeTime(seconds) {
      if ((wholeTime + seconds) > 0) {
        wholeTime += seconds;
        update(wholeTime, wholeTime);
      }
    }

    for (var i = 0; i < setterBtns.length; i++) {
      setterBtns[i].addEventListener("click", function (event) {
        var param = this.dataset.setter;
        switch (param) {
          case 'minutes-plus':
            changeWholeTime(1 * 60);
            break;
          case 'minutes-minus':
            changeWholeTime(-1 * 60);
            break;
          case 'seconds-plus':
            changeWholeTime(1);
            break;
          case 'seconds-minus':
            changeWholeTime(-1);
            break;
        }
        displayTimeLeft(wholeTime);
      });
    }
    // 1600366665425 = Date.now
    // 30000 = seconds * 1000
    // 1600366695425 = remainTime
    // 1600366695425 - 1600366665425 = 30000 = remainTime - Date.now()
    // 
    function timer(seconds) { //counts time, takes seconds
      let remainTime = Date.now() + (seconds * 1000);
      displayTimeLeft(seconds);

      intervalTimer = setInterval(function () {
        timeLeft = Math.round((remainTime - Date.now()) / 1000);
        if (timeLeft <= 0) {
          clearInterval(intervalTimer);
          isStarted = false;
          setterBtns.forEach(function (btn) {
            btn.disabled = false;
            btn.style.opacity = 1;
          });
          displayTimeLeft(wholeTime);
          pauseBtn.classList.remove('pause');
          pauseBtn.classList.add('play');
          return;
        }
        displayTimeLeft(timeLeft);
      });
    }
    function pauseTimer(event) {
      if (isStarted === false) {
        timer(wholeTime);
        isStarted = true;
        this.classList.remove('play');
        this.classList.add('pause');

        setterBtns.forEach(function (btn) {
          btn.disabled = true;
          btn.style.opacity = 0.5;
        });

      } else if (isPaused) {
        this.classList.remove('play');
        this.classList.add('pause');
        timer(timeLeft);
        isPaused = isPaused ? false : true
      } else {
        this.classList.remove('pause');
        this.classList.add('play');
        clearInterval(intervalTimer);
        isPaused = isPaused ? false : true;
      }
    }

    function displayTimeLeft(timeLeft) { //displays time on the input
      let minutes = Math.floor(timeLeft / 60);
      let seconds = timeLeft % 60;
      let displayString = `${minutes < 10 ? '0' : ''}${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
      displayOutput.textContent = displayString;
      update(timeLeft, wholeTime);

      document.getElementById("pause").onclick = function hello() {
        var today = new Date();
        var seconds_2 = today.getSeconds() + seconds;
        var minutes_2 = today.getMinutes() + minutes;
        if (seconds_2 >= 60) {
          minutes_2 = minutes_2 + 1;
          seconds_2 = seconds_2 - 60;
        }
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var e_time = today.getHours() + ":" + minutes_2 + ":" + seconds_2;
        var rows = "";
        rows += "<tr><th>" + time + "</th></tr>";
        // $(rows).appendTo("#lists tbody");
        // alert(rows)
        $("<tr><th>" + time + "</th><th>" + e_time + "</th></tr>").appendTo('#lists tbody');
        $.ajax({
          type: 'POST',
          url: 'include/timer_2.php',
          data: {'seconds_2': seconds_2},
        });
        $.ajax({
          type: 'POST',
          url: 'include/timer_2.php',
          data: {'minutes_2': minutes_2},
        });
        $.ajax({
          type: 'POST',
          url: 'include/timer_2.php',
          data: {'time': time},
        });
        $.ajax({
          type: 'POST',
          url: 'include/timer_2.php',
          data: {'e_time': e_time},
        });

      }
      
    }

   pauseBtn.addEventListener('click',pauseTimer);
</script>
<script>
  // $("#form_id").submit(function(e) {
  //   e.preventDefault();
  //   });
</script>
<script type="text/javascript">
$('.play').click(function() {
  $.ajax({
    type: "POST",
    url: "include/timer_2.php"
  })
});
</script>


</body>

</html>