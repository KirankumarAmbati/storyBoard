<?php
session_start();

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

  echo $email;
  echo $pwd;

  for($i=0;$i<count($userdata['users']);$i++)
  {
    if($userdata['users'][$i]['email'] == $email &&  $userdata['users'][$i]['pwd'] == md5($pwd))
    {
      echo "Login successful.";
      $_SESSION['email'] = $email;
      $_SESSION['firstName'] = $userdata['users'][$i]['firstName'];
      $_SESSION['lastName'] = $userdata['users'][$i]['lastName'];

      break;
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
    $userdata['users'][$i]['pwd'] = md5($pwd);

    echo "Registered !!!  " ;

    file_put_contents("data/users.json", json_encode($userdata));

    $_SESSION['email'] = $email;
    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/animate.css"> -->

    <!-- <link rel="stylesheet" href="css/styles.css"> -->

    <script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.2.js"></script>

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

      function displayMyStories()
      {
        document.getElementById('allStories').style.display='none';
        document.getElementById('myStories').style.display='block';
      }

      function displayAllStories()
      {
        document.getElementById('allStories').style.display='block';
        document.getElementById('myStories').style.display='none';
      }

      function updateStory(x)
      {
        location.href = 'pages/updateStory.php?updateStory=' + x.id;
      }

      function deleteStory(x)
      {
        if(confirm('Are you sure ? '))
        {
          location.href = 'pages/deleteStory.php?deleteStory=' + x.id;
        }
      }
    </script>
  </head>

  <body>
    <a onclick="addStoryFunction()">Add Story</a>

    <?php if(!isset($_SESSION['email'])){ ?>
    <a class="btn btn-primary" href="pages/login.php">Login</a>
    <?php } else{ ?>
    <a onclick="logout()">Logout</a>
    <a onclick="displayMyStories()">My Stories</a>
    <a onclick="displayAllStories()">All Stories</a>
    <?php } ?>

    <div id="allStories">

      <?php for($i=0;$i < count($data['stories']);$i++){ echo count($data['stories'])?>
      <div class="container well" id="story<?php echo $i; ?>">
        <div class="col-sm-2">
          <span class="h1"><?php echo $i+1 ?></span>
        </div>

        <div class="col-sm-9">
          <span class="h1"><?php echo $data['stories'][$i]['title'] ?></span><br>
          <span><?php echo $data['stories'][$i]['firstName']  ?>  <?php echo $data['stories'][$i]['lastName'] ?></span>

          <span ><?php echo $data['stories'][$i]['date'] ?></span>

          <p><?php echo $data['stories'][$i]['story'] ?></p>
        </div>

      </div>
    <?php } ?>

    </div>

    <div id="myStories" style='display:none'>
      <?php $k=0;
      $myStories = array(); ?>
      <?php for($j=0;$j < count($data['stories']);$j++){
        if($data['stories'][$j]['email'] == $_SESSION['email']){
      ?>
      <div class="container well" id="story<?php echo $j; ?>">
        <div class="col-sm-2">
          <span class="h1"><?php echo $k+1 ?></span>
        </div>

        <div class="col-sm-9">
          <span class="h1"><?php echo $data['stories'][$j]['title'] ?></span><br>

          <span ><?php echo $data['stories'][$j]['date'] ?></span>

          <p><?php echo $data['stories'][$j]['story'] ?></p>
        </div>

        <div class="">
          <button type="button" name="button" onclick="updateStory(this)" id="<?php echo $j; ?>">UPDATE</button>

          <button type="button" name="button" onclick="deleteStory(this)" id="<?php echo $j; ?>">DELETE</button>
        </div>
      </div>
      <?php $k++;}} ?>

      <?php $_SESSION['myStories'] = $myStories; ?>
    </div>
  </body>
</html>
