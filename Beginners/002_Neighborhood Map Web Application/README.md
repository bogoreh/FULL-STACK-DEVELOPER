# Neighborhood Map Web Application

A simple PHP-based web application for exploring and managing neighborhood locations with Google Maps integration.

## Features

- Interactive Google Maps display
- Add new locations with address autocomplete
- Filter locations by type
- Search locations by name
- View location details on map
- Delete locations
- Responsive design

## Setup Instructions

1. **Database Setup**:
   - Create a MySQL database named `neighborhood_map`
   - Update database credentials in `config.php`

2. **Google Maps API**:
   - Get a Google Maps API key from [Google Cloud Console](https://console.cloud.google.com/)
   - Enable Maps JavaScript API and Places API
   - Replace `YOUR_GOOGLE_MAPS_API_KEY_HERE` in `config.php` with your actual API key

3. **File Structure**:
   - Upload all files to your web server
   - Ensure PHP has PDO MySQL extension enabled

4. **Permissions**:
   - Make sure the web server has write permissions for the database

## Usage

1. Open `index.php` in your web browser
2. Use the form to add new locations
3. Click on markers to view location details
4. Use filters and search to find specific locations
5. Click "View" to focus on a location
6. Click "Delete" to remove a location

## Technologies Used

- PHP 7.4+
- MySQL
- Google Maps JavaScript API
- HTML5/CSS3
- JavaScript (ES6+)