<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../shared/components/navigation.php';

$userId = $_GET['userId'] ?? null;
if (!$userId) {
    header('Location: ' . SITE_URL);
    exit;
}

$db = Database::getInstance()->getConnection();

// Get user information
$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    header('Location: ' . SITE_URL);
    exit;
}

// Get user's places
$stmt = $db->prepare('SELECT * FROM places WHERE creator_id = ?');
$stmt->execute([$userId]);
$places = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user['name']); ?>'s Places - <?php echo APP_NAME; ?></title>
    <style>
        .places-list {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .place-item {
            background: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .place-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .place-description {
            color: #666;
            margin-bottom: 1rem;
        }
        .place-address {
            color: #666;
            font-style: italic;
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
        .btn-edit {
            background: #00695c;
        }
        .btn-delete {
            background: #c62828;
        }
        .actions {
            margin-top: 1rem;
            display: flex;
            gap: 1rem;
        }
    </style>
</head>
<body>
    <?php renderNavigation(); ?>
    
    <div class="places-list">
        <h2><?php echo htmlspecialchars($user['name']); ?>'s Places</h2>
        
        <?php if (empty($places)): ?>
            <p>No places found.</p>
        <?php else: ?>
            <?php foreach ($places as $place): ?>
                <div class="place-item">
                    <div class="place-title"><?php echo htmlspecialchars($place['title']); ?></div>
                    <div class="place-description"><?php echo htmlspecialchars($place['description']); ?></div>
                    <div class="place-address"><?php echo htmlspecialchars($place['address']); ?></div>
                    
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $place['creator_id']): ?>
                        <div class="actions">
                            <a href="<?php echo SITE_URL; ?>/places/<?php echo $place['id']; ?>" class="btn btn-edit">Edit</a>
                            <form action="<?php echo SITE_URL; ?>/places/delete.php" method="POST" style="display: inline;">
                                <input type="hidden" name="place_id" value="<?php echo $place['id']; ?>">
                                <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html> 