<?php

if(!(isset($_GET['tlc'])))
{
  header("Location: index.php");
}
else
{
  include("dbConnection.php");
  $TLC = $_GET['tlc'];

  $getTimes = mysqli_query($link, "SELECT * FROM 'TrainTimes' WHERE 'TLC'='".$TLC."'");
  
  if($getTimes)
  {
    echo "worked";
    echo $getTimes;
  }
  else
  {
    echo "not worked";
    echo $getTimes;
  }
  
  while ($row = mysqli_fetch_assoc($getTimes)) {
     echo "yes";
  }
}

?>