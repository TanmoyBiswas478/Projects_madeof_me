<?php
include_once 'dbConnection.php';
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
