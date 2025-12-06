<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

    $filename = $_FILES["image"]["name"];
    $tmpname = $_FILES["image"]["tmp_name"];
    $folder="event_images/".$filename;
    move_uploaded_file($tmpname, $folder);
    
    $event_name	 = $_POST['event_name'];
    $category= $_POST['category'];
    $other_category	 = $_POST['other_category'];
    $district= $_POST['district'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $date = $_POST['date'];
    $event_type = $_POST['event_type'];
    $about = $_POST['about'];
    
// 🔹 INSERT QUERY
$q = "INSERT INTO community_events (event_name, category, other_category, district, image, start_time, end_time,date,event_type,about,created_by)
      VALUES ('$event_name', '$category', '$other_category', '$district', '$folder', '$start_time', '$end_time','$date','$event_type','$about',id)";

$result = mysqli_query($conn, $q);

if ($result) {
    echo "<script>alert('Event Created Successfully'); window.location='exploreEvent.php';</script>";
} else {
    header("Location: event_insert.php?error=Something went wrong! Please try again.");
}
?>
