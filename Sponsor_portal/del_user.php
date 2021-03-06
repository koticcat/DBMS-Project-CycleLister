<?php
  session_start();
	$user=$_SESSION["login_user"];
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
      $choice=$_POST['SURE_BUTTON'];
      if($choice=='N')
      {
        header("location:welcome_sponsor.php");
      }
      else
      {
          $sql="select * from cycle_list where reg_no='$user' and NOT available='L';";
        	$result=mysqli_query($link,$sql);
	        $count=mysqli_num_rows($result);
          if($count==0)
          {
              $sql="Delete from s_login where reg_s='$user';";
              $result=mysqli_query($link,$sql);
              if($result)
                header('location: ../Logout.php');
          }
          else
          {
            $error="No all cycles are locked!";
          }

      }
  }
  mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete user</title>
  <link rel="stylesheet" type="text/css" href="../css/reg.css"/>
	<link rel="icon" href="/DBMS/favicon.jpg">
	<style type="text/css"></style>
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Dancing+Script" rel="stylesheet">
</head>
<body>
  <div id="container">
    <div id="nav">
      <div id="name_logo">
        <p>Cycle-Lister VIT&trade;</p>
      </div>
      <div id="ret">
        <a href="welcome_sponsor.php" target="_self" class="button">Back</a>
      </div>
    </div>
    <div id="wrapper">
      <header>
        <h1>Are you Sure?</h1>
      </header>
      <form id="form_id" method="POST" action="#">
        <button id="REG_button" name="SURE_BUTTON" type="submit" value="Y">YES</button>
        <button id="REG_button" name="SURE_BUTTON" type="submit" value="N">No</button>
      </form>
      <p>Note: All cycle's must be returned and locked in order to delete</p>
      <div class="error">
  				<?php
  					if(isset($error))
  					{
  						echo $error;
  					}
  				?>
  		</div>
    </div>
  </div>
</body>
</html>
