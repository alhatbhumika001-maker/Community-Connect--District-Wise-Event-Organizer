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
        padding: 0;
        color: #343a40;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php
    include 'userHead.php';
    ?>

    <?php
    include 'userNav.php';
    ?>


    <div class="container container-top">

        <?php
        $active = 'com-Post';
        include 'comHead.php';
        ?>
        <!-- main row -->
        <div class="row gx-4">

            <!-- posts -->
            <div class="col-lg-8 col-12">
                <div class="post" id="post-1">
                    <div class="postHead">
                        <h5>Username</h5>
                        <h6>2h ago</h6>
                    </div>
                    <hr>
                    <div class="postContent">
                        <p>This is a sample post. Users can read and scroll while the composer remains accessible.
                        </p>
                    </div>

                    <div class="d-flex align-items-center mt-2">
                        <form action="/like.php" method="post" class="me-3">
                            <input type="hidden" name="post_id" value="1">
                            <button class="like-btn"><i class="bi bi-hand-thumbs-up"></i> Like</button>
                        </form>

                        <div class="ms-auto text-muted">Likes: <strong>3</strong> · Comments: <strong>2</strong>
                        </div>
                    </div>

                    <details>
                        <!-- Should Come from backend -->
                        <summary><i class="bi bi-chat"></i> Comments (1)</summary>

                        <div class="mt-3">
                            <div class="mb-2">
                                <!-- Should give username -->
                                <strong>Member A</strong> <small class="text-muted">· 1h</small>
                                <div>Nice — I'll join.</div>
                                <hr>
                            </div>

                            <form action="/comment.php" method="post">
                                <input type="hidden" name="post_id" value="1">
                                <div class="input-group input-group-sm mt-2">
                                    <input type="text" name="comment_text" class="form-control"
                                        placeholder="Write a comment...">
                                    <button class="btn btn-outline-indigo btn-sm" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                    </details>
                </div>

                <!-- ... more posts ... -->

                <!-- IMPORTANT: composer DOM position is AFTER posts (keeps server order logical)
             but we make it fixed via CSS so it's always visible.
             The form has id="createPostForm" so the fixed element can be targeted by form attributes.
        -->
                <form id="createPostForm" action="/create_post.php" method="post" enctype="multipart/form-data">
                    <!-- note: this form exists in DOM here but will be visually fixed -->
                    <div class="composer-fixed" aria-hidden="false">
                        <div class="composer-inner">

                            <div class="composer-left">
                                <!-- label triggers hidden file input (no JS) -->
                                <label for="imageInput" class="add-btn" title="Add photos">+</label>
                                <input type="file" id="imageInput" name="images[]" accept="image/*" multiple hidden>

                                <input type="text" name="post_text" class="composer-input"
                                    placeholder="Write your post..." aria-label="Write your post" required>
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