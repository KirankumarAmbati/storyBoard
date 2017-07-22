<?php
session_start();
$data = $_SESSION['data'];

if(isset($_POST['addStoryButton']))
{
  $length = count($data['stories']);

  echo $length;

  $data['stories'][$length]['title'] = $_POST['title'];
  $data['stories'][$length]['story'] = $_POST['story'];

  file_put_contents("../data/stories.json", json_encode($data));

  echo "Successfully.. Added";
}
?>
<meta http-equiv="refresh" content="3;URL=../index.php" />
