<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Quiz Maker </title>
<link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include_once 'dbConnection.php';
?>
<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">Quiz Maker</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'dbConnection.php';
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];
$email=$_SESSION['email'];

include_once 'dbConnection.php';
echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand"><b>SW</b></div>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
		<!-- <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li> --></ul>
            <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Enter tag ">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</button>
      </form> -->
      </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {

$result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
  echo '<style>
          #msg{
                color: red;
                font-size: 14px;
          }
        </style>
        ';
  echo '<tr style="color:#99cc32">
        <td>'.$c++.'</td><td>'.$title. '&nbsp;
            <span class="glyphicon glyphicon-ok" aria-hidden="true">
                  
            </span>
        </td>
        <td>'.$total.'</td>
        <td>'.$sahi*$total.'</td>
        <td>'.$time. '&nbsp;min</td>
        <td> <span id="msg">This quiz is already solved by you</span></td>
      </tr>';

}
}
$c=0;
echo '</table></div>';

}?>


<!--home closed-->

<!--quiz start-->
<?php
include_once 'dbConnection.php';

if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];
    $start_time = isset($_GET['start_time']) ? $_GET['start_time'] : time();

    // Fetch time limit from database
    $query = "SELECT time FROM quiz WHERE eid = '$eid' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $time = $row['time']; // Time limit in minutes
    } else {
        $time = 10; // Default to 10 minutes if no time found
    }

    echo("
    <form id='quizForm' action='update.php?q=quiz&step=2&eid=" . $eid . "&n=" . $sn . "&t=" . $total . "' method='post'>
        <!-- Quiz questions go here -->
    </form>
    <span id='countdown' class='timer'></span>
    <script>
        var totalQuizTime = " . ($time * 60) . ";
        var quizId = '" . $eid . "';
        var startTime = " . ($start_time * 1000) . ";
        var endTime = startTime + totalQuizTime * 1000;

        function startQuizTimer() {
            function updateTimer() {
                var now = Date.now();
                var remainingTime = Math.max(0, Math.floor((endTime - now) / 1000));

                var minutes = Math.floor(remainingTime / 60);
                var seconds = remainingTime % 60;
                if (seconds < 10) seconds = '0' + seconds;

                document.getElementById('countdown').innerHTML = minutes + ':' + seconds;

                // Auto-submit when time runs out
                if (remainingTime <= 0) {
                    clearInterval(timerInterval);
                    document.getElementById('countdown').innerHTML = 'Time Up';
                    alert(\"Time's up! Submitting your answers.\");
                    document.getElementById('quizForm').submit();

                    // Redirect to results page after auto-submission
                    setTimeout(function() {
                        window.location.href = 'result_display.php?q=result&eid=" . $eid . "';
                    }, 1000);
                }
            }

            var timerInterval = setInterval(updateTimer, 1000);
            updateTimer();

            // Handle page reload or exit
            window.addEventListener('beforeunload', function() {
                if (Date.now() >= endTime) {
                    localStorage.removeItem('quizStartTime_' + quizId);
                } else {
                    document.getElementById('quizForm').submit();

                    // Redirect to results page after auto-submission
                    setTimeout(function() {
                        window.location.href = 'result_display.php?q=result&eid=" . $eid . "';
                    }, 1000);
                }
            });
        }

        // Start the timer immediately as we load the page
        window.onload = startQuizTimer;
    </script>
    ");

    // Display question and options
    $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn'");
    echo '<div class="panel" style="margin:5%">';
    while ($row = mysqli_fetch_array($q)) {
        $qns = $row['qns'];
        $qid = $row['qid'];
        echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br />' . $qns . '</b><br /><br />';
    }

    $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid'");
    echo '<form id="quizForm" action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
    <br />';

    while ($row = mysqli_fetch_array($q)) {
        $option = $row['option'];
        $optionid = $row['optionid'];
        echo '<input type="radio" name="ans" value="' . $optionid . '">' . $option . '<br /><br />';
    }
    echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
}

// Result display (as before, no change)
if (@$_GET['q'] == 'result' && @$_GET['eid']) {
    $eid = @$_GET['eid'];
    $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email'") or die('Error157');

    echo '<div class="panel">
    <center><h1 class="title" style="color:#660033">Result</h1><center>
    <br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

    while ($row = mysqli_fetch_array($q)) {
        $sahi_count = $row['sahi'];
        $wrong_count = $row['wrong'];
        $total_questions = $row['level'];

        $quiz_query = mysqli_query($con, "SELECT sahi, wrong FROM quiz WHERE eid='$eid'") or die('Error querying quiz table');
        $quiz_values = mysqli_fetch_array($quiz_query);
        $sahi_points = $quiz_values['sahi'];
        $wrong_points = $quiz_values['wrong'];

        $total_score = ($sahi_count * $sahi_points) - ($wrong_count * $wrong_points);

        echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>' . $total_questions . '</td></tr>
              <tr style="color:#99cc32"><td>Right Answers&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $sahi_count . '</td></tr> 
              <tr style="color:red"><td>Wrong Answers&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $wrong_count . '</td></tr>
              <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $total_score . '</td></tr>';
    }

    echo '</table></div>';
}
?>


<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
/*if(@$_GET['q']== 3) 
{
$q=mysqli_query($con,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>USN</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($con,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
$gender=$row['gender'];
$college=$row['college'];
}
$c++;
echo '<tr><td style="color:#99cc32"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$college.'</td><td>'.$s.'</td>';
}
echo '</table></div>';}*/


?>



</div></div></div></div>
<!--Footer start-->
<div class="row footer">
<div class="col-md-4 box">
<a href="#">About us</a>
</div>
<div class="col-md-4 box">
<a href="#" data-toggle="modal" data-target="#developers">Developers</a>
</div>
<div class="col-md-4 box">
      <a href="feedback.php" target="_blank">Feedback</a></div>
  </div> 
</div>

<div class="modal fade title1" id="developers">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title text-center" style="font-family:'typo';">
            <span style="color:orange">Developers From Software World</span>
          </h4>
        </div>

        <div class="modal-body text-center">
          <div class="row">
            <div class="col-md-12">
              <h3>
                Tanmoy Biswas<br /><br />
                Bikram Deb<br /><br />
                Ashneer Roy
              </h3>
            </div>
          </div>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Admin Password" class="form-control"/>
</div>
<div class="form-group" text-align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>
  
    </div>
  </div>
</div>
<!--footer end-->


</body>
</html>
