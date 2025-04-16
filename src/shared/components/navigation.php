<?php
function renderNavigation() {
    $isLoggedIn = isset($_SESSION['user_id']);
    ?>
    <nav class="main-navigation">
        <div class="nav-logo">
            <a href="<?php echo SITE_URL; ?>"><?php echo APP_NAME; ?></a>
        </div>
        <ul class="nav-links">
            <li><a href="<?php echo SITE_URL; ?>">All Users</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a href="<?php echo SITE_URL; ?>/places/new">Add Place</a></li>
                <li>
                    <form action="<?php echo SITE_URL; ?>/logout.php" method="POST" style="display: inline;">
                        <button type="submit" class="btn-link">Logout</button>
                    </form>
                </li>
            <?php else: ?>
                <li><a href="<?php echo SITE_URL; ?>/auth">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <style>
        .main-navigation {
            background: #292929;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logo a {
            color: white;
            text-decoration: none;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .nav-links {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 1rem;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
        }
        .btn-link {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1rem;
            padding: 0;
        }
    </style>
    <?php
}
?> 