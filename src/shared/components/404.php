<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../components/navigation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - <?php echo APP_NAME; ?></title>
    <style>
        .error-container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            text-align: center;
        }
        .error-title {
            font-size: 2rem;
            color: #d32f2f;
            margin-bottom: 1rem;
        }
        .error-message {
            font-size: 1.2rem;
            color: #666;
            margin-bottom: 1rem;
        }
        .btn {
            background: #00695c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <?php renderNavigation(); ?>
    
    <div class="error-container">
        <h1 class="error-title">404 Not Found</h1>
        <p class="error-message">The page you are looking for does not exist.</p>
        <a href="<?php echo SITE_URL; ?>" class="btn">Go to Home</a>
    </div>
</body>
</html> 