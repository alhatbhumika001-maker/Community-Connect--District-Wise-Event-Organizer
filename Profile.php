<?php
session_start();
include 'mainNav.php';

$conn = mysqli_connect("localhost", "root", "", "community_connect");

if (isset($_SESSION['login_user'])) {
    $user = $_SESSION['login_user'];
    $username = $user['username'];
    $email = $user['email'];
    $full_name = $user['full_name'];
    $role = $user['role'];
    $district = $user['district'];
    $bio = $user['bio'];
    $user_id = $user['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Profile - Community Connect</title>

<!-- GOOGLE FONTS -->
<link href="https://fonts.googleapis.com/css2?family=Handlee&family=Outfit:wght@400;600&display=swap" rel="stylesheet" />

<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

<style>
  body {
    font-family: 'Outfit', sans-serif;
    background: #fafafa;
    margin: 0;
    padding: 0;
    color: #3b2f6b;
  }

  /* Sidebar (optional) */
  .sidebar {
    width: 280px;
    position: fixed;
    top: 80px;
    left: 0;
    bottom: 0;
    background: linear-gradient(90deg, #f9f2ff 0%, #d4c0ff 100%);
    padding-top: 20px;
    overflow-y: auto;
    box-shadow: 2px 0 8px rgb(117 94 189 / 0.15);
    border-right: 1px solid #c3b7f7;
  }

  .sidebar-profile-img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #a076ff;
    box-shadow: 0 0 10px #a076ff88;
  }

  .sidebar-nav .nav-link {
    color: #6b55a5;
    font-weight: 600;
    padding: 12px 25px;
    border-radius: 12px;
    transition: background-color 0.3s ease;
  }

  .sidebar-nav .nav-link.active,
  .sidebar-nav .nav-link:hover {
    background: #d9c9ff;
    color: #512da8;
  }

  .main {
    margin-left: 280px;
    padding: 40px 60px;
  }

  /* Profile Header with Gradient Banner */
  /* Profile Header with Gradient Banner */
.wall {
    position: relative;
    width: 100%;
    height: 250px;
    background: linear-gradient(90deg, #9b59b6, #8e44ad, #6a1b9a, #4a148c);
    box-shadow: 0 4px 20px rgb(121 70 239 / 0.6);
    border-radius: 18px;
    overflow: visible; /* <-- important, allow user image to overflow */
}

.wallpaper {
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
    opacity: 0.7;
    mix-blend-mode: multiply;
    filter: brightness(0.75);
}

.user-logo {
    position: absolute;
    bottom: -50px; /* move image further down */
    left: 50%;
    transform: translateX(-50%);
    width: 160px;
    height: auto; /* keeps aspect ratio */
    max-height: 160px; /* optional limit */
    border-radius: 50%; /* rectangular, not circular */
    border: 5px solid #d8b4fe;
    box-shadow:
      0 0 10px #a67cff,
      0 0 20px #8e44ad,
      0 0 30px #6a1b9a;
    object-fit: contain; /* keeps full image visible */
    background-color: white;
    z-index: 10;
    
}

  /* User heading text */
  .user-heading {
    text-align: center;
    margin-top: 110px;
  }

  .user-heading .name {
    font-weight: 700;
    font-size: 1.9rem;
    color: #4b3476;
    margin-top:-20px;
  }

  .user-heading .address {
    font-weight: 500;
    font-size: 1rem;
    color: #7e6ba0;
  }

  .user-heading .bio {
    font-style: italic;
    color: #9c89c8;
    margin-top: 4px;
  }

  /* Edit Profile Button */
  .btn-outline-indigo {
    border-color: #7e57c2;
    color: #6a1b9a;
    font-weight: 600;
  }

  .btn-outline-indigo:hover {
    background-color: #7e57c2;
    color: #fff;
  }

  /* Cards for Communities, Events, etc */
  .community, .past-event, .contact, .create, .edit-profile {
    max-width: 900px;
    background-color: #fff;
    border-radius: 20px;
    padding: 30px 40px;
    box-shadow: 0 10px 25px rgba(111, 66, 193, 0.1);
    margin: 50px auto;
  }

  .com-head {
    color: #6a1b9a;
    font-weight: 600;
    font-size: 1.3rem;
    margin-bottom: 25px;
  }

  .com-list {
    background: #d8b4fe70;
    border-radius: 60px;
    font-size: 1.1rem;
    padding: 10px 25px;
    margin: 8px 8px 8px 0;
    display: inline-block;
    color: #5e2a97;
    font-weight: 600;
  }

  /* Event Card Styling */
  .event-card {
    display: grid;
    grid-template-columns: 140px 1fr;
    gap: 20px;
    background: #f6f1ff;
    padding: 15px 20px;
    border-radius: 15px;
    margin-bottom: 28px;
    box-shadow: 0 6px 15px rgba(106, 27, 154, 0.15);
  }

  .photo-box {
    border-radius: 15px;
    overflow: hidden;
    background: white;
    box-shadow: 0 5px 12px rgba(121, 70, 239, 0.2);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .photo-box img {
    width: 100%;
    height: 140px;
    object-fit: cover;
    border-radius: 15px;
  }

  .content-box > div {
    font-weight: 600;
    color: #5e2a97;
  }

  .content-box .text-muted {
    font-weight: 400;
    color: #907ccf;
    font-size: 0.9rem;
  }

  /* Empty / No content cards */
  .no-com, .empty-card {
    color: #8b6fc1;
  }

  .no-com i, .empty-card i {
    font-size: 3rem;
    margin-bottom: 10px;
  }

  /* Explore buttons */
  .filter-pill {
    border: 2px solid #7e57c2;
    background: transparent;
    color: #6a1b9a;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 6px 14px;
    border-radius: 30px;
    transition: background-color 0.3s ease;
  }

  .filter-pill:hover {
    background-color: #7e57c2;
    color: white;
  }

  /* Contact & Create sections */
  .contact p, .create h3 {
    color: #6a1b9a;
    font-weight: 600;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .main {
      margin-left: 0;
      padding: 20px;
    }

    .event-card {
      grid-template-columns: 1fr;
    }

    .photo-box img {
      height: 180px;
    }
  }
</style>
</head>
<body>

<!-- Sidebar (optional) -->
<div class="sidebar">
  <div class="text-center py-4 border-bottom">
    <?php if (isset($_SESSION['login_user'])): ?>
      <a href="profile.php">
        <img src="user.png" alt="Profile" class="sidebar-profile-img" />
      </a>
      <h6 class="mt-3 mb-0"><?= htmlspecialchars($full_name) ?></h6>
    <?php else: ?>
      <a href="login.php">
        <img src="user.png" alt="Guest" class="sidebar-profile-img" />
      </a>
      <h6 class="mt-3 mb-0">Guest</h6>
    <?php endif; ?>
  </div>
  <nav class="nav flex-column sidebar-nav mt-3 px-3">
    <a class="nav-link <?= ($active ?? '') == 'profile' ? 'active' : '' ?>" href="profile.php">Profile</a>
    <a class="nav-link <?= ($active ?? '') == 'myEvent' ? 'active' : '' ?>" href="myCommunity.php ">Created Communities</a>
    <a class="nav-link <?= ($active ?? '') == 'myCommunity' ? 'active' : '' ?>" href="myEvent.php">Created Events</a>
    <a class="nav-link <?= ($active ?? '') == 'joinedCom' ? 'active' : '' ?>" href="joinedCom.php">Joined Communities</a>
    <a class="nav-link <?= ($active ?? '') == 'joinedEve' ? 'active' : '' ?>" href="joinedEve.php">Joined Events</a>

    <a class="nav-link" data-bs-toggle="collapse" href="#createMenu" role="button" aria-expanded="false" aria-controls="createMenu">
      Create <span class="chevron">▾</span>
    </a>
    <div class="collapse ps-3" id="createMenu">
      <a class="nav-link small" href="createCommunity.php">Community</a>
      <a class="nav-link small" href="createEvent.php">Event</a>
    </div>
  </nav>

  <div class="mt-auto border-top">
    <?php if (isset($_SESSION['login_user'])): ?>
      <a href="logout.php" class="nav-link text-danger px-4 py-3">Logout</a>
    <?php else: ?>
      <a href="login.php" class="nav-link text-info px-4 py-3">Login</a>
    <?php endif; ?>
  </div>
</div>

<!-- Main content -->
<main class="main">
  <div class="profile container-fluid">
    <div class="wall">
      <img src="p-bg.jpg" alt="Wallpaper" class="wallpaper" />
      <img src="user.png" alt="User Icon" class="user-logo" />
    </div>

    <div class="user-heading">
      <h2 class="name"><?= htmlspecialchars($full_name ?? 'Guest'); ?></h2>
      <h5 class="address text-muted"><?= htmlspecialchars($role ?? ''); ?> <?= htmlspecialchars($district ?? ''); ?>, Maharashtra</h5>
      <h6 class="bio text-muted"><?= htmlspecialchars($bio ?? ''); ?></h6>
    </div>

    <?php if (isset($_SESSION['login_user'])): ?>
           <div class="text-center mt-3">
  <button class="btn btn-outline-indigo btn-sm"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#editProfileSection"
          aria-expanded="false"
          aria-controls="editProfileSection">
    <i class="bi bi-pencil-square me-1"></i>Edit Profile
  </button>
</div>


      <div class="collapse edit-profile container-fluid mt-3" id="editProfileSection">
        <div class="edit-card">
          <h3 class="mb-4 mt-3">Edit Profile</h3>
          <form action="update_Profile.php" method="POST">
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="full_name" class="form-control" value="<?= htmlspecialchars($full_name) ?>" />
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username) ?>" />
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <input type="text" name="role" class="form-control" value="<?= htmlspecialchars($role) ?>" />
            </div>
            <div class="mb-3">
              <label class="form-label">District</label>
              <input type="text" name="district" class="form-control" value="<?= htmlspecialchars($district) ?>" />
            </div>
            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea name="bio" class="form-control" rows="3"><?= htmlspecialchars($bio) ?></textarea>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" />
            </div>
            <div class="d-flex justify-content-center mt-4">
              <button class="btn btn-outline-indigo">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    <?php endif; ?>

    <!-- Communities Joined -->
    <?php
    if (isset($user_id)) {
        $stmt = $conn->prepare("SELECT c.id, c.community_name FROM communities c JOIN community_members uc ON c.id = uc.community_id WHERE uc.user_id=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $joinedCommunities = $result->fetch_all(MYSQLI_ASSOC);
    }
    ?>
    <div class="community container-fluid">
      <h3 class="com-head">Communities Joined</h3>
      <?php if (!empty($joinedCommunities)): ?>
        <?php foreach ($joinedCommunities as $c): ?>
          <div class="com-list"><?= htmlspecialchars($c['community_name']); ?></div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="no-com text-center mb-4">
          <div><i class="bi bi-emoji-neutral"></i></div>
          <h4>No communities found</h4>
          <p class="text-muted">Explore more communities</p>
          <a href="exploreCommunity.php" class="btn filter-pill mt-2">Explore</a>
        </div>
      <?php endif; ?>
    </div>

    <!-- Past Events -->
    <?php
    if (isset($user_id)) {
        $stmt3 = $conn->prepare("SELECT r.event_name, r.event_date, r.start_time, r.district, e.about, e.image FROM registrations r LEFT JOIN community_events e ON r.event_id=e.id WHERE r.user_id=? AND r.status='approved' ORDER BY r.created_at DESC");
        $stmt3->bind_param("i", $user_id);
        $stmt3->execute();
        $events = $stmt3->get_result();
    }
    ?>
    <div class="past-event container-fluid">
      <h3 class="com-head">Past Events Registered</h3>
      <?php if (isset($events) && $events->num_rows > 0): ?>
        <?php while ($event = $events->fetch_assoc()): ?>
          <div class="event-card">
            <div class="photo-box">
              <?php if (!empty($event['image'])): ?>
                <img src="<?= htmlspecialchars($event['image']); ?>" alt="<?= htmlspecialchars($event['event_name']); ?>" />
              <?php endif; ?>
            </div>
            <div class="content-box">
              <div><?= htmlspecialchars($event['event_name']); ?></div>
              <div><?= date('d M', strtotime($event['event_date'])); ?> | <?= date('h:i A', strtotime($event['start_time'])); ?></div>
              <div>Community Event</div>
              <div class="text-muted"><?= htmlspecialchars($event['district']); ?></div>
              <div class="text-muted"><?= htmlspecialchars($event['about'] ?? 'No description available'); ?></div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <div class="empty-card text-center mb-4">
          <div><i class="bi bi-calendar-plus"></i></div>
          <h4>No event registered</h4>
          <p class="text-muted">Explore more events</p>
          <a href="event.php" class="btn filter-pill mt-2">Explore</a>
        </div>
      <?php endif; ?>
    </div>

    <div class="contact container-fluid">
      <h3 class="com-head">Connect with me -</h3>
      <p>Email: <?= htmlspecialchars($email ?? 'guest@domain.com'); ?></p>
    </div>

    <div class="create container-fluid">
      <h3 class="com-head">Want to have your own <b>Community</b> and organize <b>Events</b>?</h3>
      <a href="createCommunity.php" class="btn filter-pill mb-4">Create Community</a>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
