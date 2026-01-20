 <?php
    include 'userHead.php';
    ?>
 <?php
$conn = mysqli_connect("localhost", "root", "", "community_connect");

// 1️⃣ Get logged-in user
$user_id = $_SESSION['user_id'] ?? 0;
if ($user_id == 0) { die("You must be logged in."); }

// 2️⃣ Get community ID
$id = $_POST['id'] ?? ($_GET['id'] ?? 0);
$id = intval($id);
if ($id <= 0) { die("Invalid community!"); }

// 3️⃣ Fetch community details
$com_query = "SELECT * FROM communities WHERE id = $id";
$com_res = mysqli_query($conn, $com_query);
$community = mysqli_fetch_assoc($com_res);
if (!$community) { die("Community not found!"); }

// 4️⃣ Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- POST SUBMISSION ---
    if (isset($_POST['post_text'])) {  // only runs when post form is submitted
        $content = trim($_POST['post_text']);
        if (empty($content)) {
            echo "<script>alert('Post content cannot be empty!');</script>";
            exit;
        }

        $content = mysqli_real_escape_string($conn, $content);

        $folder = ""; // default empty
        if (!empty($_FILES["post"]["name"])) {
            $image = $_FILES["post"]["name"];
            $tmp = $_FILES["post"]["tmp_name"];
            $folder = "posts_image/" . $image;
            move_uploaded_file($tmp, $folder);
        }

        $q = "INSERT INTO posts (community_id, user_id, content, post) 
              VALUES ('$id', '$user_id', '$content', '$folder')";
        $result = mysqli_query($conn, $q);

        if ($result) {
            echo "<script>alert('Post Sent Successfully'); window.location='com-Post.php?id=$id';</script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // --- COMMENT SUBMISSION ---
    if (isset($_POST['comment_text'])) {  // only runs when comment form is submitted
        $comment_text = trim($_POST['comment_text']);
        $post_id = intval($_POST['post_id']);

        if (empty($comment_text)) {
            echo "<script>alert('Comment cannot be empty!');</script>";
            exit;
        }

        if ($post_id <= 0) {
            echo "<script>alert('Invalid post!');</script>";
            exit;
        }

        $comment_text = mysqli_real_escape_string($conn, $comment_text);

        $insert_comment = "
            INSERT INTO comments (post_id, community_id, user_id, content, created_at)
            VALUES ('$post_id', '$id', '$user_id', '$comment_text', NOW())
        ";
        if (mysqli_query($conn, $insert_comment)) {
            mysqli_query($conn, "UPDATE posts SET comments = comments + 1 WHERE id = $post_id");
            echo "<script>
                alert('Comment added!');
                window.location='com-Post.php?id=$id';
            </script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

?>
 <?php
$post_query = mysqli_query($conn, "
    SELECT posts.*, users.username
    FROM posts
    JOIN users ON users.user_id = posts.user_id
    WHERE posts.community_id = $id
    ORDER BY posts.id DESC
");

if (!$post_query) {
    die("SQL Error: " . mysqli_error($conn));
}
?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1" />
     <title>{{Community-Name}} - Community Connect</title>

     <!-- GOOGLE FONTS -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">

     <!-- BOOTSTRAP CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

     <!-- Custom CSS -->
     <link rel="stylesheet" href="userStyle.css">
     <link rel="stylesheet" href="comStyle.css">

     <!-- BOOTSTRAP ICONS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

     <style>
     body {
         font-family: 'Outfit', sans-serif;
         background: #f8f9fa;
         color: #111827;
         margin: 0 0 110px 0;
         /* bottom space so last content is not hidden behind fixed composer */
     }

     .post {
         border: none;
         border-radius: 10px;
         background: #fff;
         box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
         padding: 18px;
         margin-bottom: 1.1rem;
     }

     .postHead h5 {
         margin: 0;
         font-weight: 600;
     }

     .postHead h6 {
         margin: 0;
         color: #6b7280;
         font-size: .9rem;
     }

     .postContent {
         margin-top: .75rem;
     }

     /* CREATE COMPOSER */
     .composer-fixed {
         position: fixed;
         left: 50%;
         transform: translateX(-50%);
         bottom: 14px;
         z-index: 1200;
         width: calc(100% - 32px);
         max-width: 920px;
         background: transparent;
         pointer-events: none;
         /* allow clicks only inside the inner form */
     }

     .composer-inner {
         pointer-events: auto;
         background: #fff;
         border-radius: 12px;
         padding: 12px;
         box-shadow: 0 10px 30px rgba(12, 18, 28, 0.08);
         display: flex;
         gap: 12px;
         align-items: center;
     }

     .composer-left {
         display: flex;
         align-items: center;
         gap: 12px;
         min-width: 0;
         flex: 1;
     }

     .add-btn {
         width: 44px;
         height: 44px;
         border-radius: 50%;
         border: 1px solid rgba(0, 0, 0, 0.12);
         display: flex;
         align-items: center;
         justify-content: center;
         font-size: 22px;
         background: #fff;
         cursor: pointer;
     }

     .composer-input {
         border: none;
         outline: none;
         width: 100%;
         font-size: 15px;
         padding: 8px 10px;
         border-radius: 8px;
         background: #f7f8fb;
     }

     .composer-actions {
         display: flex;
         align-items: center;
         gap: 8px;
     }

     .btn-post {
         background: #8540f5;
         color: #fff;
         border: 0;
         padding: 8px 12px;
         border-radius: 8px;
         font-weight: 600;
         cursor: pointer;
     }

     /* preview area */
     .composer-preview {
         margin-top: 8px;
         display: flex;
         gap: 8px;
         flex-wrap: wrap;
     }

     .preview-thumb {
         width: 68px;
         height: 68px;
         border-radius: 8px;
         object-fit: cover;
         border: 1px solid #e6e6e6;
     }

     /* make sure the page content is readable on small screens */
     @media (max-width: 576px) {
         .composer-inner {
             padding: 10px;
             gap: 8px;
         }

         .composer-input {
             font-size: 14px;
             padding: 6px 8px;
         }

         body {
             margin-bottom: 140px;
         }

         /* extra bottom space for composer on tiny screens */
     }

     /* sticky right column for desktop */
     .sticky-right {
         position: sticky;
         top: 20px;
     }

     /* details styling (comments) */
     details {
         margin-top: 12px;
         background: #fbfdff;
         border: 1px solid #eee;
         padding: 10px;
         border-radius: 10px;
     }

     summary {
         cursor: pointer;
         font-weight: 600;
         display: flex;
         align-items: center;
         gap: 6px;
     }

     summary::-webkit-details-marker {
         display: none;
     }

     /* like button style */
     .like-btn {
         background: none;
         border: none;
         margin-top: 5px;
         margin-bottom: -10px;
         padding: 0;
         color: #343a40;
         font-weight: 600;
         display: flex;
         align-items: center;
         gap: 6px;
         cursor: pointer;
     }

     .like-btn {
         background-color: #fff;
         padding: 5px 12px;
         cursor: pointer;
         transition: transform 0.2s, color 0.2s;
     }

     .like-btn.clicked {
         color: #e74c3c;
         /* Red color when liked */
         transform: scale(1.3);
         /* Pop effect */
     }
     </style>
 </head>

 <body>


     <div class="container container-top">

         <?php
        $active = 'com-Post';
        include 'comHead.php';
        ?>
         <!-- main row -->
         <div class="row gx-4">

             <!-- posts -->


             <div class="col-lg-8 col-12 mt-4">
                 <?php
        while ($row = mysqli_fetch_assoc($post_query)):
    ?>

                 <div class="post">

                     <div class="postHead">
                         <h5><?= htmlspecialchars($row['username']) ?></h5>
                         <h6><?= date("d M Y, h:i A", strtotime($row['created_at'])) ?></h6>
                     </div>

                     <hr>

                     <div class="postContent">
                         <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>

                         <?php if (!empty($row['post'])): ?>
                         <img src="<?= $row['post'] ?>" class="img-fluid rounded mt-2"
                             style="max-height: 350px; object-fit: cover;">
                         <?php endif; ?>
                     </div>

                     <div class="d-flex align-items-center mt-2">
                         <!-- Like button form -->
                         <form action="like.php" method="post" class="me-3 like-form">
                             <input type="hidden" name="id" value="<?= $row['id'] ?>"> <!-- Post ID -->
                             <button type="submit" class="like-btn">
                                 <i class="bi bi-hand-thumbs-up"></i> Like
                             </button>
                         </form>

                         <!-- Display likes and comments -->
                         <div class="ms-auto text-muted">
                             Likes: <strong><?= $row['likes'] ?? 0 ?></strong> ·
                             Comments: <strong><?= $row['comments'] ?? 0 ?></strong>
                         </div>
                     </div>



                     <details>
                         <summary>
                             <i class="bi bi-chat"></i> Comments (<?= $row['comments'] ?? 0 ?>)
                         </summary>

                         <div class="mt-3">

                             <?php
        //fetch comments...

        $post_id = $row['id'];

        $comment_list = mysqli_query($conn, "
            SELECT comments.*, users.username 
            FROM comments 
            JOIN users ON users.user_id = comments.user_id
            WHERE comments.post_id = $post_id
            ORDER BY comments.id DESC
        ");
        ?>

                             <?php while ($c = mysqli_fetch_assoc($comment_list)): ?>
                             <div class="mb-2">
                                 <strong><?= htmlspecialchars($c['username']) ?></strong>
                                 <small class="text-muted">·
                                     <?= date("d M Y h:i A", strtotime($c['created_at'])) ?></small>
                                 <div><?= nl2br(htmlspecialchars($c['content'])) ?></div>
                                 <hr>
                             </div>
                             <?php endwhile; ?>

                             <form action="com-Post.php" method="post">
                                 <input type="hidden" name="post_id" value="<?= $row['id']; ?>">
                                 <input type="hidden" name="id" value="<?= $community['id']; ?>">
                                 <div class="input-group input-group-sm mt-2">
                                     <input type="text" name="comment_text" class="form-control"
                                         placeholder="Write a comment..." required>
                                     <button class="btn btn-outline-primary btn-sm" type="submit">Send</button>
                                 </div>
                             </form>


                         </div>
                     </details>
                 </div>
                 <?php endwhile; ?>

             </div>


             <form id="createPostForm" method="post" enctype="multipart/form-data"
                 action="com-Post.php?id=<?= $community['id'];?>">
                 <!-- note: this form exists in DOM here but will be visually fixed -->
                 <div class="composer-fixed" aria-hidden="false">
                     <div class="composer-inner">

                         <div class="composer-left">
                             <!-- label triggers hidden file input (no JS) -->
                             <label for="imageInput" class="add-btn" title="Add photos">+</label>
                             <input type="file" id="imageInput" name="post" accept="image/*" multiple hidden>

                             <input type="text" name="post_text" class="composer-input" placeholder="Write your post..."
                                 aria-label="Write your post" required>
                         </div>

                         <div class="composer-actions">
                             <button type="submit" class="btn-post">Post</button>
                         </div>
                     </div>

                     <!-- preview container (left empty — previews require JS to fill) -->
                     <div class="composer-preview" id="composerPreview" aria-hidden="true"></div>
                 </div>
             </form>

         </div> <!-- end left column -->

         <!-- RIGHT column -->
         <div class="col-lg-4 col-12">
             <div class="sticky-right">
                 <div class="card mb-3">
                     <div class="card-body">
                         <div class="d-flex align-items-center">
                             <img src="#" width="48" height="48" style="border-radius:50%;background:#eee;">
                             <div class="ms-3">
                                 <strong>Member Name</strong>
                             </div>
                         </div>

                         <hr>

                         <p class="text-muted text-center">No members yet...</p>
                     </div>
                 </div>
             </div>
         </div>

     </div> <!-- end row -->
     </div> <!-- end container -->

     <!-- BOOTSTRAP JS BUNDLE -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
 </body>

 </html>