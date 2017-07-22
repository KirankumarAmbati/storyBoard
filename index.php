<?php
session_start();
echo session_cache_expire();
echo session_save_path();

$json_object = file_get_contents("data/stories.json");
$_SESSION['data'] = json_decode($json_object, true);
$data = $_SESSION['data'];

$json_object = file_get_contents("data/users.json");
$userdata = json_decode($json_object, true);

if(isset($_POST['loginButton']))
{
  echo 'Yess';

  $email = $_POST['email'];
  $pwd = $_POST['pwd'];

  for($i=0;$i<count($userdata['users']);$i++)
  {
    if($userdata['users'][$i]['email'] == $email &&  $userdata['users'][$i]['pwd'] == $pwd)
    {
      echo "Login successful.";
      $_SESSION['email'] = $email;
    }
    else
    {
      echo "Login Failed.";
    }

  }
}

if(isset($_POST['registerButton']))
{
  $i = 0;

  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $email=$_POST['email'];
  $pwd=$_POST['pwd'];
  $confPwd = $_POST['confPwd'];

  for(; $i<count($userdata['users']);$i++)
  {
    if($userdata['users'][$i]['email'] == $email)
    {
      break;
    }
  }

  if($i == count($userdata['users']))
  {
    $userdata['users'][$i]['firstName'] = $firstName;
    $userdata['users'][$i]['lastName'] = $lastName;
    $userdata['users'][$i]['email'] = $email;
    $userdata['users'][$i]['pwd'] = $pwd;

    echo "Registered !!!  ";

    file_put_contents("data/users.json", json_encode($userdata));

    $_SESSION['email'] = $email;
  }
  else {
    echo "Already registered !! ";
  }
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Story Board</title>
    <script type="text/javascript">
      function addStoryFunction()
      {
        <?php

        if(isset($_SESSION['email']))
        {
          echo "location.href='pages/addStory.php';";
        }
        else
        {
          echo "location.href='pages/login.php';";
        } ?>
      }

      function logout()
      {
        location.href='pages/logout.php'
      }

    </script>
  </head>
  <body>
    <a onclick="addStoryFunction()">Add Story</a>
    <a onclick="logout()">Logout</a>
    <?php if(!isset($_SESSION['email'])){ ?>
    <a href="pages/login.php">Login</a>
    <?php } ?>
    <div class="">
      <?php for($i=0;$i < count($data['stories']);$i++){ echo count($data['stories'])?>
      <h1><?php echo $data['stories'][$i]['title'] ?></h1>
      <p><?php echo $data['stories'][$i]['story'] ?></p>

    <?php } ?>
    </div>
  </body>
</html>
