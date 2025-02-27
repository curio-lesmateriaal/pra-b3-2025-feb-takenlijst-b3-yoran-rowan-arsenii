<?php require_once __DIR__.'/../backend/config.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/img/logo-big-outlines-only.png" alt="logo" class="logo">
        </nav>
        <div>
            <a href="<?php echo $base_url; ?>/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/task/index.php">Kanbanbord</a> |
            <?php
             if(isset($_SESSION['user_id'])): ?>
                <a href="<?php echo $base_url; ?>/logout.php">Uitloggen</a>
            <?php else: ?>
                <a href="<?php echo $base_url; ?>/login.php">Inloggen</a>
            <?php endif; ?>
        </div>
    </div>
</header>
