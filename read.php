<?php $conn = mysqli_connect('localhost','root','','practise_php');



if(isset($_GET['delete']) && $_GET['delete'] != '')
{
    $QueryString ="DELETE FROM student where id = '".$_GET['delete']."'";
	$QueryStringDelete = mysqli_query($conn,$QueryString);
    header("location:read.php");
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
      <form class="d-flex" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
        <button class="btn btn-outline-success" type="submit" name="searchbtn">Search</button>
      </form>
    </div>
  </div>
</nav>
  <div class="container mt-5">
      <a href="insert.php" class="btn btn-primary">Add Candidate</a>
  <table class="table mt-4">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile_no.</th>
      <th scope="col">Files</th>
      <th scope="col">Is_status</th>
      <th scope="col">Created_date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql ="SELECT * FROM student";
    if(isset($_POST['searchbtn'])){
        $searchData = $_POST['search'];
        $sql="SELECT * FROM student WHERE ('Name' LIKE '%".$searchData."%' ||'Email' LIKE '%".$searchData."%' || 'Mobile' LIKE '%".$searchData."%') ";
    }
	$QueryString = mysqli_query($conn, $sql);
    echo mysqli_num_rows($QueryString);
	$i = 1;
    if( mysqli_num_rows($QueryString)>0){
	while($ResultString = mysqli_fetch_array($QueryString)){
								
	?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $ResultString['Name']; ?></td>
      <td><?php echo $ResultString['Email']; ?></td>
      <td><?php echo $ResultString['Mobile']; ?></td>
      <td><?php echo $ResultString['Files']; ?></td>
      <td><?php echo $ResultString['Is_status']; ?></td>
      <td><?php echo $ResultString['Created_date']; ?></td>
      <td>
          <a href="insert.php?edited=<?php echo $ResultString['id'];?>" class="btn btn-primary" name="studentid">edit</a>
          <a href="read.php?delete=<?php echo $ResultString['id']; ?>" class="btn btn-danger">delete</a>
      </td>
    </tr>
    <?php $i++; } } else{?>
  </tbody>
</table>
<?php echo "No data found"; } ?>
  </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>