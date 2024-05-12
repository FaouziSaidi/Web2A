<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/css/stylejob.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .task {
  position: relative;
  color: #2e2e2f;
  cursor: move;
  background-color: #fff;
  padding: 1rem;
  border-radius: 8px;
  box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
  margin-bottom: 1rem;
  border: 3px dashed transparent;
  max-width: 350px;
}

.task:hover {
  box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;
  border-color: rgba(162, 179, 207, 0.2) !important;
}

.task p {
  font-size: 15px;
  margin: 1.2rem 0;
}

.tag {
  border-radius: 100px;
  padding: 4px 13px;
  font-size: 12px;
  color: #ffffff;
  background-color: #1389eb;
}

.tags {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.options {
  background: transparent;
  border: 0;
  color: #c4cad3;
  font-size: 17px;
}

.options svg {
  fill: #9fa4aa;
  width: 20px;
}

.stats {
  position: relative;
  width: 100%;
  color: #9fa4aa;
  font-size: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stats div {
  margin-right: 1rem;
  height: 20px;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.stats svg {
  margin-right: 5px;
  height: 100%;
  stroke: #9fa4aa;
}

.viewer span {
  height: 30px;
  width: 30px;
  background-color: rgb(28, 117, 219);
  margin-right: -10px;
  border-radius: 50%;
  border: 1px solid #fff;
  display: grid;
  align-items: center;
  text-align: center;
  font-weight: bold;
  color: #fff;
  padding: 2px;
}

.viewer span svg {
  stroke: #fff;
}

.CardWithForm {
    width: 350px;
    font-family: Arial, sans-serif;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .CardHeader {
    margin-bottom: 12px;
  }

  .CardTitle {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 4px;
  }

  .CardDescription {
    font-size: 0.9rem;
    color: #666;
  }

  .CardContent {
    margin-bottom: 12px;
  }

  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .flex {
    display: flex;
    flex-direction: column;
  }

  .space-y-1\\.5 > * {
    margin-top: 6px;
  }

  label {
    font-size: 1rem;
    font-weight: bold;
  }

  input, button {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
  }

  button {
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 1rem;
  }

  button.outline {
    background-color: transparent;
    border: 1px solid #007bff;
    color: #007bff;
  }

  button:hover {
    background-color: #0056b3;
  }

  .Select {
    position: relative;
    display: inline-block;
  }

  .SelectTrigger {
    cursor: pointer;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
  }

  .SelectValue {
    color: #666;
  }

  .SelectContent {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    z-index: 1;
  }

  .SelectItem {
    padding: 8px;
    cursor: pointer;
  }

  .CardFooter {
    display: flex;
    justify-content: flex-end;
    width: calc(100% - 32px); /* Adjust this value as needed */
  }

  .CardFooter .Button {
    margin-left: 8px;
  }

  .CardFooter .Button:first-child {
    margin-left: 0;
  }

    </style>
</head>
<body>

<?php
// Include the jobC.php file to access job data
include("../controller/jobC.php");

// Create an instance of the jobC class
$jobClass = new jobC;

// Fetch the list of jobs from the database
$jobList = $jobClass->listejob();

// Loop through each job and generate HTML dynamically
foreach ($jobList as $job) {
    ?>
    <div class="container shadow-lg border" style="padding-left: 17%; padding-right: 17%; margin-top: 30px; ">

<div class="row">
  <div class="col-md-6">
    <div class="p-2">
      <div class="CardHeader">
        <h2 class="CardTitle"><?php echo $job["title"]; ?></h2>
        <p class="CardDescription"><?php echo $job["others"]; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 d-flex align-items-center justify-between">
    <div class="p-2" style="width: 200px;">
      <div class="d-flex align-items-center">
        <h7 class="mr-2" style="padding-right:1%;"><?php echo $job["date_of_creation"]; ?></h7>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    <div class="p-2">
      <div class="CardFooter">
        <button class="Button outline" onclick="window.location.href='http://localhost/haithem/View/SaveApplyJob.php?job=<?php echo $job["id"]; ?>&type=0';">Apply</button>
        <button class="Button" onclick="window.location.href='http://localhost/haithem/View/SaveApplyJob.php?job=<?php echo $job["id"]; ?>&type=1';">Save</button>
      </div>
    </div>
  </div>
</div>
</div>
    <?php
}
?>










</body>
</html>
