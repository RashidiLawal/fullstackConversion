<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../shared/components/navigation.php';

$db = Database::getInstance()->getConnection();
$stmt = $db->query('SELECT * FROM users');
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - <?php echo APP_NAME; ?></title>
    <style>
        .users-list {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .user-item {
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .user-info {
            flex-grow: 1;
        }
        .user-name {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .user-email {
            color: #666;
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
    
    <div class="users-list">
        <h2>Users</h2>
        <?php foreach ($users as $user): ?>
            <div class="user-item">
                <div class="user-info">
                    <div class="user-name"><?php echo htmlspecialchars($user['name']); ?></div>
                    <div class="user-email"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
                <a href="<?php echo SITE_URL; ?>/<?php echo $user['id']; ?>/places" class="btn">View Places</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html> 