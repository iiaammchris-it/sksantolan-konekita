<?php
// Handle file uploads and store in a folder called 'uploads'
$uploadDir = 'uploads/';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Store uploaded files and sanitize inputs
function saveFile($fileInput) {
    global $uploadDir;
    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($_FILES[$fileInput]['name']);
        $targetFile = $uploadDir . time() . '_' . $fileName;
        move_uploaded_file($_FILES[$fileInput]['tmp_name'], $targetFile);
        return $targetFile;
    }
    return '';
}

// Sanitize form input
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Get values
$name = cleanInput($_POST['name']);
$contact = cleanInput($_POST['contact']);
$email = cleanInput($_POST['email']);
$address = cleanInput($_POST['address']);
$intro = cleanInput($_POST['introduction']);

$profilePic = saveFile('profile-pic');
$cv = saveFile('cv');
$coverLetter = saveFile('cover-letter');
$portfolioImages = [];
if (!empty($_FILES['images']['name'][0])) {
    foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
        $fileName = basename($_FILES['images']['name'][$index]);
        $targetFile = $uploadDir . time() . '_' . $fileName;
        move_uploaded_file($tmpName, $targetFile);
        $portfolioImages[] = $targetFile;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile Submitted</title>
  <style>
    body {
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      background: #f3f3f3;
      padding: 20px;
    }

    .profile-container {
      max-width: 900px;
      margin: auto;
      background: white;
      border-radius: 16px;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    }

    .profile-container h2 {
      text-align: center;
      color: #742f88;
      margin-bottom: 20px;
    }

    .profile-row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
    }

    .profile-col {
      flex: 1 1 45%;
    }

    .profile-img {
      max-width: 150px;
      border-radius: 50%;
      margin-bottom: 1rem;
    }

    .portfolio-images {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    .portfolio-images img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
    }

    a.file-link {
      color: #742f88;
      text-decoration: none;
    }

    a.file-link:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      .profile-row {
        flex-direction: column;
      }

      .profile-col {
        flex: 1 1 100%;
      }

      .profile-img {
        margin: auto;
        display: block;
      }

      .portfolio-images {
        justify-content: center;
      }
    }
  </style>
</head>
<body>

  <div class="profile-container">
    <h2>Job Seeker Profile</h2>
    <div class="profile-row">
      <div class="profile-col">
        <?php if ($profilePic): ?>
          <img src="<?= $profilePic ?>" alt="Profile Picture" class="profile-img" />
        <?php endif; ?>
        <p><strong>Name:</strong> <?= $name ?></p>
        <p><strong>Contact:</strong> <?= $contact ?></p>
        <p><strong>Email:</strong> <?= $email ?></p>
        <p><strong>Address:</strong> <?= $address ?></p>
      </div>
      <div class="profile-col">
        <p><strong>Introduction:</strong><br><?= nl2br($intro) ?></p>
        <?php if ($cv): ?>
          <p><strong>CV:</strong> <a class="file-link" href="<?= $cv ?>" target="_blank">View CV</a></p>
        <?php endif; ?>
        <?php if ($coverLetter): ?>
          <p><strong>Cover Letter:</strong> <a class="file-link" href="<?= $coverLetter ?>" target="_blank">View Cover Letter</a></p>
        <?php endif; ?>
      </div>
    </div>
    <?php if (!empty($portfolioImages)): ?>
      <div>
        <h3>Portfolio</h3>
        <div class="portfolio-images">
          <?php foreach ($portfolioImages as $img): ?>
            <img src="<?= $img ?>" alt="Portfolio Image" />
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>

</body>
</html>