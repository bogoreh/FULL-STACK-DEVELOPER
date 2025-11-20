<?php
class Booking {
    private $conn;
    private $table_name = "bookings";

    public $id;
    public $user_id;
    public $show_id;
    public $seats;
    public $total_amount;
    public $booking_date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET user_id=:user_id, show_id=:show_id, seats=:seats, total_amount=:total_amount";
        
        $stmt = $this->conn->prepare($query);
        
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->show_id = htmlspecialchars(strip_tags($this->show_id));
        $this->seats = htmlspecialchars(strip_tags($this->seats));
        $this->total_amount = htmlspecialchars(strip_tags($this->total_amount));
        
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":show_id", $this->show_id);
        $stmt->bindParam(":seats", $this->seats);
        $stmt->bindParam(":total_amount", $this->total_amount);
        
        if($stmt->execute()) {
            $this->updateShowSeats();
            return true;
        }
        return false;
    }

    private function updateShowSeats() {
        $query = "UPDATE shows SET available_seats = available_seats - ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->seats);
        $stmt->bindParam(2, $this->show_id);
        $stmt->execute();
    }

    public function getUserBookings($user_id) {
        $query = "SELECT b.*, m.title, t.name as theater_name, s.show_date, s.show_time 
                  FROM bookings b 
                  JOIN shows s ON b.show_id = s.id 
                  JOIN movies m ON s.movie_id = m.id 
                  JOIN theaters t ON s.theater_id = t.id 
                  WHERE b.user_id = ? 
                  ORDER BY b.booking_date DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $user_id);
        $stmt->execute();
        return $stmt;
    }
}
?>