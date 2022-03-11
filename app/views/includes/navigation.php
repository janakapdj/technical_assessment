<nav class="top-nav">
    <ul>
        <li>
            <a href="<?php echo URLROOT; ?>">Home</a>
        </li>
        <?php if(isset($_SESSION['user_id'])) : ?>
            <li>
                <a href="<?php echo URLROOT; ?>/campaigns">Campaigns</a>
            </li>
        <?php endif; ?>
        <li class="btn-login">
            <?php if(isset($_SESSION['user_id'])) : ?>
                <a href="<?php echo URLROOT; ?>/users/logout">Log out</a>
            <?php else : ?>
                <a href="<?php echo URLROOT; ?>/users/login">Login</a>
            <?php endif; ?>
        </li>
    </ul>
</nav>