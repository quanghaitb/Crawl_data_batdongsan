<?php 
  require_once('config/db.php');
  require_once('config/function.php');
  
  $result = display_data();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>BẤT ĐỘNG SẢN </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel = "stylesheet" href="style/style.css">
</head>
<body>


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
<div class="container-fluid">
  <div class="row">
    <nav aria-label="breadcrumb" class="col-sm-12">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="template.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Export Data</li>
      </ol>
    </nav>
    
  </div>
</div>
<div class="container" style="margin-top: 20;">
  <form action = "export.php" class="needs-validation" id = "form_fields" novalidate  enctype="application/x-www-form-urlencoded" method = "POST">
    <div class="row" >
      <div class="alert alert-warning" role="alert">
        Vui lòng chọn các trường muốn xuất dữ liệu!
      </div>
    </div>

    <div class="row" style="padding-top: 2rem;">

    
      <div class="col-sm-5 d-flex justify-content-center" >
          <label for="date_from">Từ ngày:   </label>
          <input type="date" id="date_from" name="date_from"  />
      </div>

      <div class="col-sm-5 d-flex justify-content-center">
          <label for="date_to">Đến ngày:   </label>
          <input type="date" id="date_to" name="date_to" value="2018-06-12" min="2018-06-07" />
      </div>

      <div class="col-sm-2 d-flex justify-content-center">
        
        <select class="form-select" aria-label="Default select example" name = "limit">
          <option selected>10</option>
          <option value="50" >50</option>
          <option value="500">500</option>
          <option value="2000">2000</option>
        </select>
      </div>
    </div>

    <div class="row">
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="title" name="field[]" id="field_title" checked>
        <label class="form-check-label" for="check1">
          Tiêu đề 
        </label>
      </div>

      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="detail_address" name="field[]" id="field_detail_address" checked>
        <label class="form-check-label" for="check2">
          Địa chỉ
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;" checked>
        <input class="form-check-input" type="checkbox" value="price" name="field[]" id="field_price">
        <label class="form-check-label" for="check3">
          Giá
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;" >
        <input class="form-check-input" type="checkbox" value="unit_price" name="field[]" id="field_unit_price">
        <label class="form-check-label" for="check4">
        Đơn giá
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="bedroom" name="field[]" id="field_bedroom">
        <label class="form-check-label" for="check5">
        Số phòng ngủ
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="toilet" name="field[]" id="field_toilet">
        <label class="form-check-label" for="check6">
        Số phòng vệ sinh
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="law" name="field[]" id="field_law">
        <label class="form-check-label" for="check7">
        Pháp lý
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="indoor" name="field[]" id="field_indoor">
        <label class="form-check-label" for="check8">
        Nội thất
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="road" name="field[]" id="field_road">
        <label class="form-check-label" for="check9">
        Mặt đường
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="face_first" name="field[]" id="field_face_first">
        <label class="form-check-label" for="check10">
        Mặt tiền
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="floor" name="field[]" id="field_floor">
        <label class="form-check-label" for="check11">
        Số tầng
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="direction_balcony" name="field[]" id="field_direction_balcony">
        <label class="form-check-label" for="check12">
        Hướng ban công
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="area" name="field[]" id="field_area">
        <label class="form-check-label" for="check13">
        Diện tích
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="unit_area" name="field[]" id="field_unit_area">
        <label class="form-check-label" for="check14">
        Đơn vị diện tích
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="images" name="field[]" id="field_images">
        <label class="form-check-label" for="check15">
        Ảnh
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="direction_of_house" name="field[]" id="field_direction_of_house">
        <label class="form-check-label" for="check16">
        Hướng nhà
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="created_at" name="field[]" id="field_created_at">
        <label class="form-check-label" for="check17">
        Ngày đăng
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="exp_at" name="field[]" id="field_exp_at">
        <label class="form-check-label" for="check18">
        Ngày hết hạn
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="name_per" name="field[]" id="field_name_per">
        <label class="form-check-label" for="check19">
        Người đăng
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" value="phone" name="field[]" id="field_phone">
        <label class="form-check-label" for="check20">
        Số điện thoại
        </label>
      </div>
      <div class="form-check col-sm-2" style="padding-top: 2rem;">
        <input class="form-check-input" type="checkbox" onClick="toggle(this)" name="all_fields" id="all_fields">
        <label class="form-check-label" for="check21">
        <strong>TẤT CẢ</strong>
        </label>
      </div>
    </div>

    <div class="main-export col-sm-12 d-flex flex-row-reverse" > 
      <button type = "submit" id="export" name='export' value ="submit" class="btn btn-info ">Xuất Excel </button >  
    </div>
    <div id = "hahaha"></div>
  </form>
</div>




  <!-- Footer -->
  <footer class="page-footer font-small blue" style="margin-top: 30px;">

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2023 
    <a href="/"> </a>
  </div>
  <!-- Copyright -->

  </footer>
  <!-- Footer -->


</body>
</html>


<script language="JavaScript">
    function toggle(source) {
      checkboxes = document.getElementsByName('field[]');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        checkboxes[i].checked = source.checked;
      }
    }
</script>
<script language="JavaScript">
  date_to.max = new Date().toISOString().split("T")[0];
  date_from.max = new Date().toISOString().split("T")[0];
  document.getElementById('date_to').valueAsDate = new Date();
  // document.getElementById('date_from').valueAsDate = new Date();
</script>



<?php
include('includes/scripts.php');
if (isset($_POST['excel'])){
    include 'export.php';
}
?>