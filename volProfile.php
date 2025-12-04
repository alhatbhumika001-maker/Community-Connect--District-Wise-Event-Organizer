<?php
        include 'volHead.php';
        if (isset($_SESSION['login_user'])) 
        {

            $username = $_SESSION['login_user']['username'];
            $email = $_SESSION['login_user']['email'];
            $full_name = $_SESSION['login_user']['full_name'];
            $role = $_SESSION['login_user']['role'];
            $district = $_SESSION['login_user']['district'];
            $bio = $_SESSION['login_user']['bio'];
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Community Connect</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap"
        rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="volStyle.css">

    <!-- BOOTSTRAP ICONS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <style>
        body {
            background: #f7f9fb;
            font-family: "Outfit", sans-serif;
        }

        .profile {
            margin-left: 0;
            margin-right: 0;
            padding: 0;
            position: relative;
            text-align: center;
            padding-bottom: 50px;
        }

        .wall {
            position: relative;
            width: 100%;
            display: block;
        }

        .wall .wallpaper {
            width: 100%;
            height: 200px;
            border: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .wall .user-logo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 60%;
            position: absolute;
            left: 50%;
            bottom: -75px;
            transform: translateX(-50%);
            background-color: rgba(250, 235, 215, 0.685);
            border: 4px solid rgb(182, 88, 219);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .user-heading .name {
            margin-top: 90px;
            color: #18122B;
        }

        .community {
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: 960px;
            box-shadow: 2px 7px 20px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            margin-bottom: 50px;
        }

        .community .com-head {
            margin-top: 40px;
            margin-bottom: 30px;
            color: #18122B;
            padding-left: 10px;
        }

        .community .com-list {
            background-color: #8540f55d;
            border-radius: 50px;
            box-sizing: border-box;
            width: auto;
            height: 40px;
            font-size: large;
            display: flex;
            align-content: center;
            justify-content: center;
            margin-bottom: 20px;
            padding: 8px 0px;
        }

        .bi-emoji-neutral {
            color: #8540f5;
            font-size: 80px;
            margin-bottom: 20px;
        }

        .past-event{
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: 960px;
            box-shadow: 2px 7px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            margin-bottom: 50px;
        }

        .event-card {
            width: 100%;
            max-width: 960px;
            margin-top: 20px;
            display: grid;
            grid-template-columns: 120px 1fr;
            grid-template-rows: auto 220px auto;
            /* (date, content), photo, button */
            border-radius: 8px;
            padding: 10px;
            box-sizing: border-box;
            background: #fff;
        }

        /* Date box (top-left) */
        .date-box {
            grid-column: 1 / 2;
            grid-row: 1 / 2;
            border: var(--border);
            border-radius: 6px;
            padding: 8px;
            text-align: center;
        }

        /* Content (top-right) */
        .content-box {
            grid-column: 2 / 3;
            grid-row: 2 / 3;
            border-radius: 6px;
            padding: 8px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* Photo (middle-right) */
        .photo-box {
            grid-column: 2 / 3;
            grid-row: 1 / 2;
            border-radius: 6px;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f2f2f2;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        @media (max-width: 720px) {
            .event-card {
                grid-template-columns: 1fr;
                /* one column */
                grid-template-rows: auto auto auto auto;
                /* date, content, photo, button */
            }

            .date-box {
                grid-column: 1 / 2;
                grid-row: 1 / 2;
                text-align: left;
            }

            .content-box {
                grid-column: 1 / 2;
                grid-row: 2 / 3;
            }

            .photo-box {
                grid-column: 1 / 2;
                grid-row: 3 / 4;
                min-height: 220px;
            }
        }

        .bi-calendar-plus {
            color: #8540f5;
            font-size: 70px;
            margin-bottom: 20px;
        }

        .contact{
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: 960px;
            box-shadow: 2px 7px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            margin-bottom: 50px;
        }

        .create{
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: 960px;
            box-shadow: 2px 7px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            margin-bottom: 50px;
        }

        .edit-profile{
            width: 100%;
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            max-width: 800px;
            box-shadow: 2px 7px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 30px;
            margin-bottom: 50px;  
        }

        .edit-profile .edit-card{
            max-width: 600px;
            margin: 0 auto;
            text-align: left;
        }
       
    </style>
</head>
<body>
    <?php 
        $active = 'profile';
        include 'volNav.php';
    ?>
    <main class="main">
        <div class="profile container-fluid">
            <div class="wall">
                <img class="wallpaper" src="p-bg.jpg" alt="wallpaper">
                <img class="user-logo" src="user.png" alt="user-icon">
            </div>
            <div class="user-heading">
                <h2 class="name"><?php echo $full_name; ?></h2>
                <h5 class="address text-muted"><?php echo $role; ?>  <?php echo $district; ?>, Maharashtra </h5>
                <h6 class="bio text-muted"><?php echo $bio; ?></h6>
            </div>
            <button class="btn btn-outline-indigo btn-sm" data-bs-toggle="collapse" data-bs-target="#editProfileSection">
                <i class="bi bi-pencil-square me-1"></i>Edit Profile
            </button>
            <div class="collapse edit-profile container-fluid mt-3" id="editProfileSection">
                <div class="edit-card">
                    <h3 class="mb-4 mt-3">Edit Profile</h3>
            
                    <form action="update_Profile.php" method="POST">
            
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control" value="<?php echo $full_name; ?>">
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <input type="text" name="role" class="form-control" value="<?php echo $role; ?>">
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label">District</label>
                            <input type="text" name="district" class="form-control" value="<?php echo $district; ?>">
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label">Bio</label>
                            <textarea name="bio" class="form-control" rows="3"><?php echo $bio; ?></textarea>
                        </div>
            
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        </div>
            
                        <div class="d-flex justify-content-center mt-4">
                            <button class="btn btn-outline-indigo">Save Changes</button>
                        </div>

                    </form>
            

                </div>
            </div>

        </div>

        <div class="community container-fluid">
            <h3 class="com-head">Communities Joined</h3>
            <!-- if any communities joined, display them here -->
            <div class="com-list me-3 mb-3">
                <p class="com-name">{{Community_Name}}</p>
            </div>
            <!-- else display the following message -->
            <div class="no-com text-center mb-4">
                <div><i class="bi bi-emoji-neutral"></i></div>
                <h4>No communities found</h4>
                <p class="text-muted">Explore more communities</p>
                <div class="d-flex justify-content-center mt-4">
                    <a href="exploreCommunity.php" class="btn btn-outline-indigo filter-pill">Explore</a>
                </div>
            </div>
        </div>

        <div class="past-event container-fluid">
            <h3 class="com-head">Past Events Registered</h3>
            <!-- if any past events registered, display them here -->
            <div class="event-card mb-5 pe-4">
                <div class="date-box ">
                    {{ DATE }}<br>
                    <small>{{ TIME }}</small>
                </div>
                <div class="photo-box mt-3 mb-3">
                    <!-- server: either render <img src="..."> or leave as empty placeholder -->
                    <!-- Example: <img src="{{ IMAGE_URL }}" alt="{{ EVENT_NAME }}"> -->
                    <!-- If you prefer no image, leave this empty and it will show neutral background -->
                </div>
                <div class="content-box">
                    <div class="mb-2" style="font-weight:700">{{ EVENT_NAME }}</div>
                    <div class="mb-2">{{ COMMUNITY_NAME }}</div>
                    <div class="mb-2 text-muted fs-6">{{ EVENT_DISTRICT }}</div>
                    <div class="text-muted mb-2 fs-6">{{ EVENT_DESCRIPTION }}</div>
                </div>
            </div>
            <!-- else the following block should be executed -->
            <div class="empty-card text-center mb-4">
                <div><i class="bi bi-calendar-plus"></i></div>
                <h4>No event registered</h4>
                <p class="text-muted">Explore more events</p>
                <div class="d-flex justify-content-center mt-4">
                    <a href="event.php" class="btn btn-outline-indigo filter-pill">Explore</a>
                </div>
            </div>
        </div>

        <div class="contact container-fluid">
            <h3 class="com-head">Connect with me -</h3>
            <p class="text-muted">Email: {{Email}}</p>
        </div>

        <div class="create container-fluid">
            <h3 class="com-head">Want to have your own <b>Community</b> and organize <b>Events</b>?</h3>
            <a href="createCommunity.php" class="btn btn-outline-indigo filter-pill mb-4">Create Community</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>