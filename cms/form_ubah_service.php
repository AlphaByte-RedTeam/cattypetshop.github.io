<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CMS Catty Pet Shop | Ubah Service</title>
  <link rel="stylesheet" href="./toruskit-free/dist/css/toruskit.bundle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/12f0b33110.js" crossorigin="anonymous"></script>
  <meta property="og:title" content="Catty Pet Shop">
  <meta property="og:description" content="Catty Pet Shop is a trusted pet store since 2019 that excel in grooming and training services. We also sell pet products.">
  <meta property="og:image" content="">
  <link rel="stylesheet" href="./styles/style.css" type="text/css">
  <link rel="apple-touch-icon" sizes="57x57" href="./images/favicon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="./images/favicon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="./images/favicon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="./images/favicon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="./images/favicon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="./images/favicon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="./images/favicon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="./images/favicon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="./images/favicon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192" href="./images/favicon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="./images/favicon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon/favicon-16x16.png">
  <link rel="icon" href="./images/favicon/favicon-32x32.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">
  <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
  <!-- footer css -->
  <!-- <link rel="stylesheet" href="css/sb-admin.css">
  <link href="css/bootstrap.min.css" rel="stylesheet"> -->

  <!-- online version css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function konfirmasi_ubah() {
      if (confirm('Yakin simpan perubahan data ?'))
        return true;
      else
        return false;
    }
  </script>

</head>

<body>
  <?php
  session_start();

  if (empty($_SESSION['isLoggedin']))
  	header("location: helper/logout.php");

  if (empty($_GET['id']))
    header("location: list/services_list.php");

  require_once "helper/koneksi.php";
  ?>

  <?php
  $id_service = $_GET['id'];

  $sql = "";
  $sql = " select * from tb_service where id_service ='$id_service' limit 1";

  $result = mysqli_query($conn, $sql) or die($sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $title_service = $row['title_service'];
      $img_service = $row['img_service'];
      $flag = $row['flag_active'];
    }
  }
  ?>

  <div class="container mt-3">
    <h2>Ubah Service</h2>
    <form action="helper/simpan_ubah_service.php" method="post" onSubmit="return konfirmasi_ubah();">

      <div class="mb-3 mt-3">
        <label for="id_service">Id:</label>
        <input type="text" class="form-control" readonly id="id_service" name="id_service" value="<?php echo $id_service; ?>">
      </div>

      <div class="mb-3 mt-3">
        <label for="title_service">Title:</label>
        <input type="text" class="form-control" id="title_service" placeholder="Enter Title" name="title_service" value="<?php echo $title_service; ?>" required>
      </div>

      <div class="mb-3 mt-3">
        <label for="img_service">Img:</label>
        <input type="file" class="form-control" id="img_service" placeholder="Enter Img" name="img_service" value="<?php echo $img_service; ?>" required>
      </div>

      <!-- don't put value in input to prevent bug in simpan_ubah_member -->
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="isActive" name="isActive" <?php if ($flag==1): ?> checked <?php endif; ?>>
        <label for="flexCheckDefault" class="form-check-label" >
          Make Active
        </label>
      </div>

      <br><br>
      <button type="submit" class="btn btn-primary">Submit</button>

      <a href="list/services_list.php"><button type="button" class="btn btn-info">Cancel</button></a>
    </form>
  </div>
</body>

</html>