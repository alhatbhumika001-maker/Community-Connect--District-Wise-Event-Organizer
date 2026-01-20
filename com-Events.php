    <?php
    include 'userHead.php';
    ?>
   <?php
    $conn = mysqli_connect("localhost", "root", "", "community_connect");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the community ID from URL or request
    if (!isset($_GET['id'])) {
        die("Community ID not specified.");
    }

    $id = intval($_GET['id']); // always sanitize input

    // SQL Query: fetch events only for this community
    $event_query = "
        SELECT community_events.*, communities.community_name 
        FROM community_events 
        JOIN communities ON community_events.community = communities.id
        WHERE communities.id = $id
        ORDER BY community_events.id DESC
    ";

    $event_result = mysqli_query($conn, $event_query);

    if (!$event_result) {
        die("SQL Error: " . mysqli_error($conn));
    }

    $event_count = mysqli_num_rows($event_result);


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
       <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
           rel="stylesheet">

       <!-- BOOTSTRAP CSS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

       <!-- Custom CSS -->
       <link rel="stylesheet" href="userStyle.css">
       <link rel="stylesheet" href="comStyle.css">

       <!-- BOOTSTRAP ICONS -->
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

       <!-- Your custom CSS (kept) -->
       <link rel="stylesheet" href="comStyle.css" />

       <style>
       body {
           font-family: 'Outfit', sans-serif;
           background: #f8f9fa;
           color: #111827;
           margin: 0;
       }

       /* Small create button area (centered, small) */
       .create-event-wrap {
           text-align: center;
           margin-top: 12px;
           margin-bottom: 12px;
       }

       .create-event-btn {
           background: #8540f5;
           color: #fff;
           border-radius: 8px;
           padding: .35rem .8rem;
           font-weight: 600;
           font-size: .92rem;
           border: none;
       }

       /* Cards + event photo */
       .card {
           border: none;
           border-radius: 10px;
           box-shadow: 0 6px 18px rgba(31, 41, 55, 0.06);
           margin-bottom: 1rem;
           overflow: hidden;
       }

       .card-header {
           background: rgba(133, 64, 245, 0.06);
           padding: .9rem 1rem;
       }

       .card-header h5 {
           color: #8540f5;
           margin: 0;
           font-weight: 600;
           font-size: 1.05rem;
       }

       .card-header small {
           display: block;
           color: #6b7280;
           margin-top: .25rem;
       }

       .card-body {
           padding: 1rem;
       }

       .event-photo {
           width: 100%;
           height: 200px;
           object-fit: cover;
           border-radius: 6px;
           background: #efefef;
       }

       .bi-emoji-frown {
           font-size: 60px;
           color: #8540f5;
       }

       /* responsive */
       @media (max-width:768px) {
           .com-banner {
               height: 180px;
           }

           .event-photo {
               height: 140px;
           }

           .com-nav-ul {
               gap: .6rem;
               padding: 0 .5rem;
               overflow-x: auto;
               -webkit-overflow-scrolling: touch;
           }
       }

       /* small modal tweaks */
       .modal .form-label {
           font-weight: 600;
       }
       </style>
   </head>

   <body>

      

    

       <div class="container-fluid">

           <?php
            $active = 'com-Events';
            include 'comHead.php';
            ?>


           <div class="create-event-wrap">
               <!-- Show this button only to organizers — server should render conditionally.
           To hide by default, server can omit or output style="display:none". -->
               <button class="create-event-btn" data-bs-toggle="modal" data-bs-target="#createEventModal">
                   + Create Post
               </button>
           </div>

           <!-- main inner container (keeps content centered) -->
           <div class="container page-inner mt-3">

               <div class="row gx-4">

                   <!-- LEFT: Events column -->
                   <div class="col-lg-8 col-12">
                       <?php if ($event_count > 0): ?>
                       <?php while ($row = mysqli_fetch_assoc($event_result)): ?>
                       <div class="card mb-3">
                           <div class="card-header">
                               <h5><?php echo $row['event_name']; ?></h5>
                               <small>
                                   <?php
                                            $event_datetime = date("F j, Y — g:i A", strtotime($row['date']));
                                            echo $event_datetime;
                                            ?>
                               </small>
                           </div>

                           <div class="card-body">
                               <!-- Bootstrap Carousel -->
                               <?php
                                        // Images from the database
                                        $images = !empty($row['image']) ? explode(",", $row['image']) : [];
                                        ?>

                               <?php if (count($images) > 0): ?>
                               <?php if (count($images) === 1): ?>
                               <!-- Only one image: show without carousel controls -->
                               <img src="<?php echo $row['image']; ?>" class="d-block w-100 event-photo mb-3"
                                   alt="event image">
                               <?php else: ?>
                               <!-- Multiple images: use carousel -->
                               <div id="eventCarousel<?php echo $row['id']; ?>" class="carousel slide mb-3"
                                   data-bs-ride="carousel">
                                   <div class="carousel-inner">
                                       <?php foreach ($images as $index => $img): ?>
                                       <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                           <img src="<?php echo htmlspecialchars($img); ?>"
                                               class="d-block w-100 event-photo" alt="event image">
                                       </div>
                                       <?php endforeach; ?>
                                   </div>
                                   <button class="carousel-control-prev" type="button"
                                       data-bs-target="#eventCarousel<?php echo $row['id']; ?>" data-bs-slide="prev">
                                       <span class="carousel-control-prev-icon"></span>
                                   </button>
                                   <button class="carousel-control-next" type="button"
                                       data-bs-target="#eventCarousel<?php echo $row['id']; ?>" data-bs-slide="next">
                                       <span class="carousel-control-next-icon"></span>
                                   </button>
                               </div>
                               <?php endif; ?>
                               <?php else: ?>
                               <!-- No image -->
                               <img src="https://via.placeholder.com/1200x500?text=No+Image"
                                   class="d-block w-100 event-photo mb-3" alt="no image">
                               <?php endif; ?>


                               <p class="card-text"> <?php echo substr($row['about'], 0, 200); ?>...</p>
                           </div>
                       </div>
                       <?php endwhile; ?>
                       <?php else: ?>
                       <!-- Empty state -->
                       <div class="empty-card text-center mb-4">
                           <div class="bi bi-emoji-frown"></div>
                           <h4 class="mt-2">No event conducted yet..</h4>
                       </div>
                       <?php endif; ?>
                   </div>

                   <!-- RIGHT: Members column -->
                   <div class="col-lg-4 col-12">
                       <div class="card p-0">
                           <div class="card-body">
                               <div class="d-flex align-items-center mb-3">
                                   <img class="user-logo" src="#" alt="user-logo" width="48" height="48"
                                       style="border-radius:50%;background:#efefef;">
                                   <div class="ms-3">
                                       <div class="username" style="font-weight:600;">Member Name</div>
                                   </div>
                               </div>

                               <hr>

                               <div class="empty-card text-center mb-0">
                                   <div class="bi bi-emoji-frown"></div>
                                   <h6 class="mt-2 mb-0">No members yet..</h6>
                               </div>
                           </div>
                       </div>
                   </div>

               </div>
           </div>
       </div>

       <!-- ===== Create Event Modal (FRONTEND only) ===== -->
       <div class="modal fade" id="createEventModal" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog modal-lg modal-dialog-centered">
               <div class="modal-content">
                   <!-- NOTE: action="" so front-end only. Replace action and method to post to your backend later. -->
                   <form action="" method="post" enctype="multipart/form-data">
                       <div class="modal-header">
                           <h5 class="modal-title">Create Post</h5>
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>

                       <div class="modal-body">
                           <div class="mb-3">
                               <label class="form-label">Event Title <span class="text-danger">*</span></label>
                               <input name="title" class="form-control" required>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Event Date & Time</label>
                               <input name="event_date" type="datetime-local" class="form-control">
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Description</label>
                               <textarea name="description" class="form-control" rows="4"></textarea>
                           </div>

                           <div class="mb-3">
                               <label class="form-label">Event Images (optional)</label>
                               <input name="images[]" type="file" class="form-control" accept="image/*" multiple>
                               <small class="text-muted">Choose multiple images. Server must handle uploads; this is
                                   frontend-only.</small>
                           </div>
                       </div>

                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                           <button type="submit" class="btn" style="background:#8540f5;color:#fff;">Create Post</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>

       <!-- BOOTSTRAP JS BUNDLE -->
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
   </body>

   </html>