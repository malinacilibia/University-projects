<?php
session_start();
include 'config/Database.php';

// Include localizarea
$lang = $_GET['lang'] ?? 'ro'; // Setăm limba implicită ca română
$messagesFile = "lang/$lang/messages.php";
if (!file_exists($messagesFile)) {
    $lang = 'ro'; // Dacă limba selectată nu există, revenim la română
    $messagesFile = "lang/$lang/messages.php";
}
$messages = include $messagesFile;

$error = '';
$success = '';
$user_id = $_SESSION['user_id'];

// Obține datele utilizatorului
$db = new Database();
$conn = $db->getConnection();

// Procesare formular
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nume = htmlspecialchars($_POST['nume']);
    $email = htmlspecialchars($_POST['email']);
    $parola = $_POST['parola'];

    // Upload avatar
    if (!empty($_FILES['avatar']['name'])) {
        $avatar_dir = "uploads/avatars/";
        $avatar_file = $avatar_dir . basename($_FILES['avatar']['name']);
        $image_file_type = strtolower(pathinfo($avatar_file, PATHINFO_EXTENSION));

        // Validare tip fișier
        if (in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar_file)) {
                $query_avatar = "UPDATE users SET avatar = :avatar WHERE id = :id";
                $stmt_avatar = $conn->prepare($query_avatar);
                $stmt_avatar->bindParam(':avatar', $avatar_file);
                $stmt_avatar->bindParam(':id', $user_id);
                $stmt_avatar->execute();
                $success = $messages['avatar_update_success'];
            } else {
                $error = $messages['avatar_upload_error'];
            }
        } else {
            $error = $messages['avatar_invalid_type'];
        }
    }

    // Actualizare nume și email
    if (!empty($nume) && !empty($email)) {
        try {
            if (!empty($parola)) {
                $parola_hash = password_hash($parola, PASSWORD_BCRYPT);
                $query = "UPDATE users SET username = :nume, email = :email, password = :parola WHERE id = :id";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':parola', $parola_hash);
            } else {
                $query = "UPDATE users SET username = :nume, email = :email WHERE id = :id";
                $stmt = $conn->prepare($query);
            }

            $stmt->bindParam(':nume', $nume);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $user_id);

            if ($stmt->execute()) {
                $success = $messages['success_message'];
            } else {
                $error = $messages['error_message'];
            }
        } catch (PDOException $e) {
            $error = $messages['error_message'] . ": " . $e->getMessage();
        }
    } else {
        $error = $messages['all_fields_required'];
    }
}

// Obține datele utilizatorului
$query = "SELECT username, email, avatar FROM users WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $messages['profile_title']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container mt-5">
    <h2><?php echo $messages['profile_title']; ?></h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="profil_utilizator.php?lang=<?php echo $lang; ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nume" class="form-label"><?php echo $messages['username_label']; ?></label>
            <input type="text" class="form-control" id="nume" name="nume" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label"><?php echo $messages['email_label']; ?></label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="parola" class="form-label"><?php echo $messages['password_label']; ?></label>
            <input type="password" class="form-control" id="parola" name="parola">
        </div>
        <div class="mb-3">
            <label for="avatar" class="form-label"><?php echo $messages['avatar_label']; ?></label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            <img src="<?= htmlspecialchars($user['avatar']) ?>" alt="Avatar" class="mt-3" style="max-width: 100px;">
        </div>
        <button type="submit" class="btn btn-primary"><?php echo $messages['button_actualizare']; ?></button>
    </form>
</div>
</body>
</html>
<?php include 'includes/footer.php'; ?>
