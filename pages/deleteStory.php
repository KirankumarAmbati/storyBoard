<?php
session_start();
$data = $_SESSION['data'];

if(isset($_GET['deleteStory']))
{
  $choice = $_GET['deleteStory'];

  $tempData=[];

  $i=0;

  for($n=0; $n<count($data['stories']);$n++)
  {
    if($n != $choice)
    {
      $tempData['stories'][$i] = $data['stories'][$i];
      $i++;
    }
  }
  echo count($data['stories']);

  file_put_contents("../data/stories.json", json_encode($tempData));

  echo count($tempData['stories']);

  echo "Successfully.. Deleted.";
}
?>

<meta http-equiv="refresh" content="3;URL=../index.php"/>
