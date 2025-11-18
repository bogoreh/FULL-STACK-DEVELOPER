<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'event_website');
define('DB_USER', 'root');
define('DB_PASS', '');

// Sample events data (in a real app, this would come from database)
$events = [
    [
        'id' => 1,
        'title' => 'Tech Conference 2024',
        'description' => 'Annual technology conference featuring latest innovations',
        'date' => '2024-12-15',
        'time' => '09:00 AM',
        'location' => 'Convention Center, New York',
        'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=400',
        'category' => 'Technology'
    ],
    [
        'id' => 2,
        'title' => 'Music Festival',
        'description' => 'Weekend music festival with popular artists',
        'date' => '2024-11-20',
        'time' => '02:00 PM',
        'location' => 'Central Park, NYC',
        'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=400',
        'category' => 'Music'
    ],
    [
        'id' => 3,
        'title' => 'Business Workshop',
        'description' => 'Learn business strategies from industry experts',
        'date' => '2024-10-10',
        'time' => '10:00 AM',
        'location' => 'Business Hub, Downtown',
        'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=400',
        'category' => 'Business'
    ]
];
?>