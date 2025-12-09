<?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// 1. Get Community ID
if (!isset($_GET['id'])) {
    die("Community ID missing.");
}

$community_id = intval($_GET['id']);

// 2. Fetch community details
$com_query = "
    SELECT * FROM communities 
    WHERE id = $community_id
";

$com_res = mysqli_query($conn, $com_query);

if (!$com_res) {
    die("SQL Error: " . mysqli_error($conn));
}

$community = mysqli_fetch_assoc($com_res);

// 3. No community found
if (!$community) {
    die("Community not found.");
}
?>

<!-- Banner -->
<div class="com-banner mt-4 mb-1">
    <img class="com-banner-img" src="<?php echo $community['image']; ?>" 
         alt="<?php echo $community['community_name']; ?>">
</div>

<!-- Community Header -->
<div class="com-head d-flex flex-column align-items-center justify-content-center py-4">
    <h2><?php echo $community['community_name']; ?></h2>
    <h5 class="text-muted"><?php echo $community['privacy']; ?> • 0 Members</h5>
    <p class="text-muted"><?php echo $community['about']; ?></p>
</div>
