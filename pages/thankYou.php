<?php
session_start();
$data = $_SESSION['data'];

if(isset($_POST['addStoryButton']))
{
  $length = count($data['stories']);

  echo $length;

  $data['stories'][$length]['title'] = $_POST['title'];
  $data['stories'][$length]['story'] = $_POST['story'];
  $data['stories'][$length]['firstName'] = $_SESSION['firstName'];
  $data['stories'][$length]['lastName'] = $_SESSION['lastName'];
  $data['stories'][$length]['date'] = date("F jS, Y");
  $data['stories'][$length]['email'] = $_SESSION['email'];

  echo count($data['stories']);


  file_put_contents("../data/stories.json", json_encode($data));

  echo "Successfully.. Added";
}

if (isset($_POST['updateStoryButton']))
{
  $choice = $_POST['updateStory'];

  echo $choice;

  $data['stories'][$choice]['title'] = $_POST['title'];
  $data['stories'][$choice]['story'] = $_POST['story'];
  $data['stories'][$choice]['firstName'] = $_SESSION['firstName'];
  $data['stories'][$choice]['lastName'] = $_SESSION['lastName'];
  $data['stories'][$choice]['date'] = date("F jS, Y");
  $data['stories'][$choice]['email'] = $_SESSION['email'];

  file_put_contents("../data/stories.json", json_encode($data));

  echo "Successfully.. Updated";
}
?>
<meta http-equiv="refresh" content=";URL=../index.php" />
