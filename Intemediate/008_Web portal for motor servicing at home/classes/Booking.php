<?php
class Booking {
    private $conn;
    private $table_name = "bookings";

    public $id;
    public $user_id;
    public $service_id;
    public $vehicle_type;
    public $vehicle_model;
    public $vehicle_number;
    public $service_date;
    public $service_time;
    public $address;
    public $status;
    public $total_amount;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET user_id=:user_id, service_id=:service_id, vehicle_type=:vehicle_type, 
                     vehicle_model=:vehicle_model, vehicle_number=:vehicle_number, 
                     service_date=:service_date, service_time=:service_time, 
                     address=:address, status=:status, total_amount=:total_amount";
        
        $stmt = $this->conn->prepare($query);
        
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->service_id = htmlspecialchars(strip_tags($this->service_id));
        $this->vehicle_type = htmlspecialchars(strip_tags($this->vehicle_type));
        $this->vehicle_model = htmlspecialchars(strip_tags($this->vehicle_model));
        $this->vehicle_number = htmlspecialchars(strip_tags($this->vehicle_number));
        $this->service_date = htmlspecialchars(strip_tags($this->service_date));
        $this->service_time = htmlspecialchars(strip_tags($this->service_time));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->status = "pending";
        $this->total_amount = htmlspecialchars(strip_tags($this->total_amount));
        
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":service_id", $this->service_id);
        $stmt->bindParam(":vehicle_type", $this->vehicle_type);
        $stmt->bindParam(":vehicle_model", $this->vehicle_model);
        $stmt->bindParam(":vehicle_number", $this->vehicle_number);
        $stmt->bindParam(":service_date", $this->service_date);
        $stmt->bindParam(":service_time", $this->service_time);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":total_amount", $this->total_amount);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getUserBookings($user_id) {
        $query = "SELECT b.*, s.name as service_name 
                 FROM " . $this->table_name . " b 
                 LEFT JOIN services s ON b.service_id = s.id 
                 WHERE b.user_id = :user_id 
                 ORDER BY b.created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        return $stmt;
    }

    public function updateStatus($booking_id, $status) {
        $query = "UPDATE " . $this->table_name . " 
                 SET status = :status 
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $booking_id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>