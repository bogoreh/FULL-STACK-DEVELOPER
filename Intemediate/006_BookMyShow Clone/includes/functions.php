<?php
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

function formatDate($date) {
    return date('M d, Y', strtotime($date));
}

function formatTime($time) {
    return date('h:i A', strtotime($time));
}

function getGenres() {
    return ['Action', 'Comedy', 'Drama', 'Thriller', 'Horror', 'Romance', 'Sci-Fi', 'Adventure'];
}
?>