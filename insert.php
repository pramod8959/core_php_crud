<?php
$conn = mysqli_connect('localhost','root','','practise_php');
// if ($conn->query($sql) === TRUE) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . $conn->error;
// }
// if($conn){
//   echo "yes";
// }
// else{
//   echo "no";
// }
if(isset($_POST['submitbtn']))
{
    $name=$_POST['uname'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $pass=md5($_POST['pass']);
    $filetmpname = $_FILES['file']['tmp_name'];
	  $filename = $_FILES['file']['name'];
	  $mynewfilename = str_replace(' ', '-', $name).'_'.$filename;
	  $destinationfolder = 'upload/'.$mynewfilename;
	  move_uploaded_file($filetmpname, $destinationfolder);
    $QueryString = "INSERT INTO student(Name,Email,Mobile,Password,Files,Is_status,Created_date) VALUES ('".$name."', '".$email."', '".$mobile."', '".$pass."', '".$mynewfilename."', '1', NOW())";
	  if(mysqli_query($conn, $QueryString)){
	  	header("location:index.php?msg='Succ'");
      echo "done";
	  }else{
      // echo $conn->connect_errno;
	  	header("location:.php?msg='err'");
	  }
}

if(isset($_GET['edited']) && $_GET['edited'] != '')
{
	$QueryStringEdit = mysqli_query($conn, "SELECT * FROM student where (id = '".$_GET['edited']."')");
	$Result = mysqli_fetch_array($QueryStringEdit);
}

if(isset($_POST['updatebtn'])){
  $str=$_SERVER['HTTP_REFERER'];
  $temp = explode( "?", $str );
  $result = explode( "=", $temp['1'] );
  $id=$result['1'];
  // print_r($_POST);die;
	$name = $_POST['uname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$QueryString = "UPDATE student SET Name='".$name."',Email='".$email."',Mobile='".$mobile."' WHERE (id = '".$id."')";
	if(mysqli_query($conn, $QueryString)){
		header("location:index.php?msg='update'");
	}else{
		header("location:index.php?msg='err'");
	}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-light bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
<div class="container mt-4 w-25 bg-primary p-5">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <input type="text" class="form-control" id="uname" name="uname" placeholder="full name" value="<?php if(isset($_GET['edited']) && $_GET['edited'] != ''){ echo $Result['Name']; } ?>">
  </div>
  <div class="mb-3">
    <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php if(isset($_GET['edited']) && $_GET['edited'] != ''){ echo $Result['Email']; } ?>">
  </div>
  <div class="mb-3">
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile" value="<?php if(isset($_GET['edited']) && $_GET['edited'] != ''){ echo $Result['Mobile']; } ?>">
  </div>
  <?php if(!isset($_GET['edited'])){ ?>
  <div class="mb-3">
    <input type="password" class="form-control" id="pass" name="pass" placeholder="password">
  </div>
  <div class="mb-3">
    <input type="file" class="form-control" id="file" name="file">
  </div>
  <button type="submit" class="btn btn-danger" name="submitbtn">Submit</button>
  <?php } else{ ?>
    <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="<?Php echo $_GET['edited'] ; ?>" >
  <button type="submit" class="btn btn-danger" name="updatebtn">Updated</button>
  
  <?php } ?>
</form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>