<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_code = $_POST['user_code'];
    if ($user_code !== "40054") {
        die("<script>alert('รหัสผู้ใช้ไม่ถูกต้อง!'); window.history.back();</script>");
    }
    
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $upload_dir = "gallery/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file = $_FILES['image'];
    $file_name = time() . "_" . basename($file['name']);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        // บันทึกข้อมูลลงใน gallery.html
        $gallery_file = "gallery.html";
        $new_entry = "<div class='card'>
                        <img src='$target_file' class='card-img-top'>
                        <div class='card-body'>
                            <h5 class='card-title'>$title</h5>
                            <p class='card-text'>$description</p>
                        </div>
                      </div>\n";
        file_put_contents($gallery_file, $new_entry, FILE_APPEND);
        
        echo "<script>alert('อัปโหลดสำเร็จ!'); window.location.href='gallery.html';</script>";
    } else {
        echo "<script>alert('อัปโหลดไม่สำเร็จ!'); window.history.back();</script>";
    }
}
?>
