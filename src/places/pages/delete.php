<?php
require_once '../../config/config.php';
require_once '../../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . SITE_URL . '/auth');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . SITE_URL);
    exit;
}

$placeId = $_POST['place_id'] ?? null;
if (!$placeId) {
    header('Location: ' . SITE_URL);
    exit;
}

try {
    $db = Database::getInstance()->getConnection();
    
    // First verify that the place belongs to the current user
    $stmt = $db->prepare('SELECT id FROM places WHERE id = ? AND creator_id = ?');
    $stmt->execute([$placeId, $_SESSION['user_id']]);
    $place = $stmt->fetch();
    
    if ($place) {
        // Delete the place
        $stmt = $db->prepare('DELETE FROM places WHERE id = ? AND creator_id = ?');
        $stmt->execute([$placeId, $_SESSION['user_id']]);
    }
    
    header('Location: ' . SITE_URL);
} catch (PDOException $e) {
    // Log the error and redirect
    error_log('Error deleting place: ' . $e->getMessage());
    header('Location: ' . SITE_URL);
}
exit;
?> 