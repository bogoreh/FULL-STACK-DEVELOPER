<?php
class Movie {
    private $conn;
    private $table_name = "movies";

    public $id;
    public $title;
    public $description;
    public $genre;
    public $duration;
    public $language;
    public $release_date;
    public $poster_url;
    public $trailer_url;
    public $rating;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row) {
            $this->title = $row['title'];
            $this->description = $row['description'];
            $this->genre = $row['genre'];
            $this->duration = $row['duration'];
            $this->language = $row['language'];
            $this->release_date = $row['release_date'];
            $this->poster_url = $row['poster_url'];
            $this->trailer_url = $row['trailer_url'];
            $this->rating = $row['rating'];
            return true;
        }
        return false;
    }

    public function getShows() {
        $query = "SELECT s.*, t.name as theater_name, t.location 
                  FROM shows s 
                  JOIN theaters t ON s.theater_id = t.id 
                  WHERE s.movie_id = ? AND s.show_date >= CURDATE() 
                  ORDER BY s.show_date, s.show_time";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt;
    }
}
?>