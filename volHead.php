    <?php 
            $link=mysqli_connect("localhost","root","","community_connect");
            $q='select * from users';
            $res=mysqli_query($link,$q);
            $user=mysqli_fetch_array($res)
    ?>

<div class="initial">
    <div id="brand" class="d-flex align-items-center">
        <img src="lg.png" class="brand-logo" alt="logo">
        <span class="brand-text">Community Connect</span>
    </div>
    <div id="user" class="d-flex align-items-center">
        <span class="user-name">
           Welcome <?php echo $user['full_name']; ?>
        </span>
        <img src="user.png" class="user-icon" alt="User Icon">
    </div>
</div>
