<?php
include_once 'auth.php';
?>
<header>
    <nav class="container">
        <a href="../index.php" class="logo">BookMyShow Clone</a>
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
            <li><a href="movies.php">Movies</a></li>
            <li><a href="theaters.php">Theaters</a></li>
            <?php if(isLoggedIn()): ?>
                <li><a href="profile.php">My Profile</a></li>
                <li><a href="logout.php">Logout (<?php echo $_SESSION['user_name']; ?>)</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>