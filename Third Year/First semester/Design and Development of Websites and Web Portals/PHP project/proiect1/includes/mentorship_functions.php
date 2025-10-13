<?php
function findMatch($mentee_id) {
    $conn = new mysqli("host", "user", "password", "database");
    $mentee = $conn->query("SELECT * FROM mentees WHERE id = $mentee_id")->fetch_assoc();
    $result = $conn->query("SELECT * FROM mentors WHERE domain = '{$mentee['domain']}' AND availability = 1");
    return $result->num_rows > 0 ? $result->fetch_assoc() : null;
}

function scheduleSession($mentor_id, $mentee_id, $date, $time, $subject) {
    $conn = new mysqli("host", "user", "password", "database");
    $sql = "INSERT INTO sessions (mentor_id, mentee_id, date, time, subject, status) VALUES ($mentor_id, $mentee_id, '$date', '$time', '$subject', 'Scheduled')";
    return $conn->query($sql) ? "Sesiune programată cu succes!" : "Eroare: " . $conn->error;
}

function trackProgress($session_id, $description, $status, $objectivesMet) {
    $conn = new mysqli("host", "user", "password", "database");
    $sql = "INSERT INTO progress_tracking (session_id, description, status, objectives_met) VALUES ($session_id, '$description', '$status', '$objectivesMet')";
    return $conn->query($sql) ? "Progresul a fost înregistrat!" : "Eroare: " . $conn->error;
}

function submitFeedback($session_id, $mentor_id, $mentee_id, $rating, $comments) {
    $conn = new mysqli("host", "user", "password", "database");
    $sql = "INSERT INTO feedback (session_id, mentor_id, mentee_id, rating, comments) VALUES ($session_id, $mentor_id, $mentee_id, $rating, '$comments')";
    return $conn->query($sql) ? "Feedback trimis cu succes!" : "Eroare: " . $conn->error;
}
?>
