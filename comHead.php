<!-- banner -->
<div class="com-banner mt-4 mb-1">
    <img class="com-banner-img" src="#" alt="">
</div>

<!-- community header -->
<div class="com-head d-flex flex-column align-items-center justify-content-center py-4">
    <h2>{{Community-name}}</h2>
    <h5 class="text-muted">{{Privacy}} • {{Member_Count}}</h5>
    <p class="text-muted">{{Bio}}</p>
</div>

<!-- nav tabs -->
<nav class="com-nav">
    <ul class="nav com-nav-ul">
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 'com-Events') echo 'active'; ?>" href="com-Events.php">Events</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 'com-Notice') echo 'active'; ?>" href="com-Notice.php">Notice</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if ($active == 'com-Post') echo 'active'; ?>" href="com-Post.php">Post</a>
        </li>
    </ul>
</nav>