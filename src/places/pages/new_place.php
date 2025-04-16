<?php
require_once '../../config/config.php';
require_once '../../config/database.php';
require_once '../shared/components/navigation.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . SITE_URL . '/auth');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $address = $_POST['address'] ?? '';
    
    if (empty($title) || empty($description) || empty($address)) {
        $error = 'Please fill in all fields.';
    } else {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO places (title, description, address, creator_id) VALUES (?, ?, ?, ?)');
            $stmt->execute([$title, $description, $address, $_SESSION['user_id']]);
            $success = 'Place added successfully!';
        } catch (PDOException $e) {
            $error = 'Error adding place. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Place - <?php echo APP_NAME; ?></title>
    <style>
        .place-form {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-control {
            margin-bottom: 1rem;
        }
        .form-control label {
            display: block;
            margin-bottom: 0.5rem;
        }
        .form-control input,
        .form-control textarea {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .form-control textarea {
            height: 150px;
            resize: vertical;
        }
        .btn {
            background: #00695c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 1rem;
        }
        .success {
            color: green;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php renderNavigation(); ?>
    
    <div class="place-form">
        <h2>Add New Place</h2>
        
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-control">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            
            <div class="form-control">
                <label for="description">Description</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            
            <div class="form-control">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            
            <button type="submit" class="btn">Add Place</button>
        </form>
    </div>
</body>
</html> 