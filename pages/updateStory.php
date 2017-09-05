<?php
session_start();
$data=$_SESSION['data'];

if(isset($_GET['updateStory']))
{
  $choice = $_GET['updateStory'];
  $data['stories'][$choice]['story'];
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
      function prefillTextarea()
      {
        document.getElementById('story').value = '<?php echo $data['stories'][$choice]['story'] ?>';
      }
    </script>
  </head>
  <body onload="prefillTextarea()">
    <form class="" action="thankYou.php" method="post">
      <input type="text" name="title" id= "title" value='<?php echo $data['stories'][$choice]['title'] ?>'>
      <textarea name="story" id="story" rows="8" cols="80" ></textarea>
      <input type="text" name="updateStory" value="<?php echo $choice ?>" hidden>
      <button type="submit" name="updateStoryButton">UpDate</button>
    </form>
  </body>
</html>
<?php

}

?>
