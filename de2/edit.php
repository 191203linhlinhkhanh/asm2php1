<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa</title>
</head>
<body>
<?php
    require_once "connect.php";
    $sql = "select * from drink_categories";

    $stmt = $conn->prepare($sql);

    $stmt->execute();
    $drink_categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (isset($_POST['btn'])) {
        $id = $_POST['id'];
        $ten = $_POST['ten'];
        $price = $_POST['price'];
        $category_id= $_POST['category_id'];
    if (isset($_FILES['image'])) {
        $src= "img/";
        $image = $_FILES['image']['name'] ;
        $tmp_image = $src . $image;
        move_uploaded_file($_FILES['image']['tmp_name'],$tmp_image);
    }

        if (!$errors) {
            $sql = "update drinks set ten = '$ten', price='$price',image='$image', category_id='$category_id'
            where id=$id";
            // chuẩn bị
            $stmt = $conn->prepare($sql);
            // thực thi
            $stmt->execute();
    
            header("location:index.php");
            exit;
        }
        
    }
    $sql = "select * from drinks where id";
=    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $drink = $stmt ->fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
    <h1>Sửa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="ten">Name</label>
            <input type="text" name="ten" id="ten" placeholder="nhập tên">
            <?php if (isset($errors['ten']))?> 
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" placeholder="nhập giá">
            <?php if (isset($errors['price']))?>  
        </div>
        <div class="form-group">
            <label for="image">image</label>
            <input type="file" name="image" id="image">
            <?php if (isset($errors['image']))?>
        </div>
        <div class="form-group">
            <label for="category_id">category_id</label>
            <select name="category_id" id="category_id">
                  <?php
                  $sql = "SELECT * FROM drink_categories";
                  
                  $result = $conn->query($sql);

                  $drink_categories = $result->fetchAll();
                  foreach ($drink_categories as $drink_categories) {
                      echo "<option value={$drink_categories['category_id']}>{$drink_categories['category_name']}</option>";
                  }
                  ?>
                </select>
                <br>
                <button type="submit" name="submit">Thêm mới</button>
                <a href="index.php">XEM DANH SÁCH</a>
        </div>
    </form>
</div>
</body>
</html>