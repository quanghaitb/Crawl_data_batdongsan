<?php 
  require_once('config/db.php');
  require_once('config/function.php');
  
  $result = display_data_limit(10);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BẤT ĐỘNG SẢN </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel = "stylesheet" href="style/style.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>



</div>
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" style="height: 200px;" src="images/image1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" style="height: 200px;" src="images/image2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" style="height: 200px;" src="images/image3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Bất động sản </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Bán</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Thuê</a>
      </li>
   
    </ul>
  </div>  
</nav>

<div class="container-md" style="margin-top:30px; max-width: 1440px;" >
  <div class="row">
    
      <div class="col-md-12">
        <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tiêu đề</th>
              <th>Tiêu đề địa chỉ</th>
              <!-- <th>Mô tả</th> -->
              <th>Địa chỉ</th>
              <th>Giá</th>
              <th>Đơn giá</th>
              <th>Phòng ngủ</th>
              <th>Nhà vệ sinh</th>
              <th>Pháp lý</th>
              <th>Nội thất</th>
              <!-- <th>Mặt đường</th>
              <th>Mặt tiền</th>
              <th>Số tầng</th> -->
              <th>Hướng ban công</th>
              <th>Diện tích</th>
              <!-- <th>Đơn vị diện tích</th> -->
              <th>Hướng nhà</th>
              <!-- <th>Ảnh</th> -->
              <!-- <th>Ngày đăng</th> -->
              <th>Số điện thoại</th>
              <th>Loại</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php while($row = $result->fetch_assoc())
                {
              ?>
              <td><?php  echo $row['id']; ?></td>
              <td><?php  echo $row['title']; ?></td>
              <td><?php  echo $row['title_address']; ?></td>
              <!-- <td><?php  echo $row['description']; ?></td> -->
              <td><?php  echo $row['detail_address']; ?></td>
              <td><?php  echo $row['price']; ?></td>
              <td><?php  echo $row['unit_price']; ?></td>
              <td><?php  echo $row['bedroom']; ?></td>
              <td><?php  echo $row['toilet']; ?></td>
              <td><?php  echo $row['law']; ?></td>
              <td><?php  echo $row['indoor']; ?></td>
              <!-- <td><?php  echo $row['road']; ?></td> -->
              <!-- <td><?php  echo $row['face_first']; ?></td> -->
              <!-- <td><?php  echo $row['floor']; ?></td> -->
              <td><?php  echo $row['direction_balcony']; ?></td>
              <td><?php  echo $row['area']; ?></td>
              <!-- <td><?php  echo $row['unit_area']; ?></td> -->
              <td><?php  echo $row['direction_of_house']; ?></td>
              <!-- <td><?php  echo $row['images']; ?></td> -->
              <!-- <td><?php  echo $row['created_at']; ?></td> -->
              <td><?php  echo $row['phone']; ?></td>
              <td><?php  echo $row['type_new']; ?></td>

              </tr>
              <?php
                }

              ?>
              
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    
    <a href ="page_export.php" class= "btn" style="background-color: navy; color: white; margin-left: 14px;">Export</a>
    
  </div>
</div>



  <!-- Footer -->
  <footer class="page-footer font-small blue" style="margin-top: 30px;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2020 Copyright:
    <a href="/"> MDBootstrap.com</a>
  </div>
  <!-- Copyright -->

  </footer>
  <!-- Footer -->


</body>
</html>

  



