<?php
 session_start();


 include '../Controller/userC.php';
 include '../Controller/employeC.php';
 include '../Controller/employeurC.php';

 $userC = new UserC();
 $user =  $userC->showUser($_SESSION["id"]);

 $role = get_role_by_id($_SESSION["id"]);

 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>user profile bio graph and total sales - Bootdey.com</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/prof.css">
<link rel="stylesheet" href="../assets/css/profile_edit.css">
<script src="../assets/js/profile_edit.js"></script>
<div class="container bootstrap snippets bootdey">
<div class="row">
<div class="profile-nav col-md-3">
<div class="panel">
<div class="user-heading round">

<div class="profile-pic">
  <label class="-label" for="file">
    <span class="glyphicon glyphicon-camera"></span>
    <span>Change Image</span>
  </label>
  <input id="file" type="file" onchange="loadFile(event)"/>
  <img src="https://cdn.pixabay.com/photo/2017/08/06/21/01/louvre-2596278_960_720.jpg" id="output" width="200" />
</div>

<h1><?php echo $_SESSION["fullname"]; ?></h1>
<p><?php echo $role; ?></p>
</div>
<ul class="nav nav-pills nav-stacked">
<li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
<li><a href="#"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-warning pull-right r-activity">9</span></a></li>
<li><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
</ul>
</div>
</div>
<div class="profile-info col-md-9">
<div class="panel">
<form>
<textarea placeholder="Ajoutez une nouvelle offre d'emploi!" rows="2" class="form-control input-lg p-text-area"></textarea>
</form>
<footer class="panel-footer">
<button class="btn btn-warning pull-right custom-button" >Post</button>
<ul class="nav nav-pills">
<li>
<a href="#"><i class="fa fa-map-marker"></i></a>
</li>
<li>
<a href="#"><i class="fa fa-camera"></i></a>
</li>
<li>
<a href="#"><i class=" fa fa-film"></i></a>
</li>
<li>
<a href="#"><i class="fa fa-microphone"></i></a>
</li>
</ul>
</footer>
</div>
<div class="panel">
<div class="bio-graph-heading">
Aliquam ac magna metus. Nam sed arcu non tellus fringilla fringilla ut vel ispum. Aliquam ac magna metus.
</div>
<div class="panel-body bio-graph-info">
<h1>Bio Graph</h1>
<div class="row">
<div class="bio-row">
<p><span>First Name </span><?php echo $user["first_name"]; ?></h2></p>
</div>
<div class="bio-row">
<p><span>Last Name </span><?php echo $user["last_name"]; ?></p>
</div>
<div class="bio-row">
<p><span>Birthday</span><?php echo $user["dob"]; ?></p>
</div>
<div class="bio-row">
<p><span>Occupation </span> UI Designer</p>
</div>
<div class="bio-row">
<p><span>Email </span><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="a5cfd6c8ccd1cde5c3c9c4d1c9c4c78bc6cac8"><?php echo $user["email"]; ?></a></p>
</div>
<div class="bio-row">
<p><span>Phone </span><?php echo $user["telephone"]; ?></p>
</div>
</div>
</div>
</div>
<div>
<div class="row">
<div class="col-md-6">
<div class="panel">
<div class="panel-body">
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="35" data-fgcolor="#e06b7d" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(224, 107, 125); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
<div class="bio-desk">
<h4 class="red">Envato Website</h4>
<p>Started : 15 July</p>
<p>Deadline : 15 August</p>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="63" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
<div class="bio-desk">
<h4 class="terques">ThemeForest CMS </h4>
<p>Started : 15 July</p>
<p>Deadline : 15 August</p>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="75" data-fgcolor="#96be4b" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(150, 190, 75); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
<div class="bio-desk">
<h4 class="green">VectorLab Portfolio</h4>
<p>Started : 15 July</p>
<p>Deadline : 15 August</p>
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="panel">
<div class="panel-body">
<div class="bio-chart">
<div style="display:inline;width:100px;height:100px;"><canvas width="100" height="100px"></canvas><input class="knob" data-width="100" data-height="100" data-displayprevious="true" data-thickness=".2" value="50" data-fgcolor="#cba4db" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-stretch: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(203, 164, 219); padding: 0px; -webkit-appearance: none; background: none;"></div>
</div>
<div class="bio-desk">
<h4 class="purple">Adobe Muse Template</h4>
<p>Started : 15 July</p>
<p>Deadline : 15 August</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>