<?php
class ItemController {
    private $item;
    private $db;

    public function __construct($db) {
        $this->item = new Item($db);
    }

    public function index() {
        $stmt = $this->item->read();
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $items;
    }

    public function create($data) {
        if(!empty($data['name'])) {
            $this->item->name = $data['name'];
            $this->item->description = $data['description'];
            $this->item->price = $data['price'];
            $this->item->category = $data['category'];

            if($this->item->create()) {
                header("Location: index.php?action=items");
                exit();
            }
        }
        return false;
    }

    public function readOne($id) {
        $this->item->id = $id;
        if($this->item->readOne()) {
            return $this->item;
        }
        return null;
    }

    public function update($data) {
        if(!empty($data['id'])) {
            $this->item->id = $data['id'];
            $this->item->name = $data['name'];
            $this->item->description = $data['description'];
            $this->item->price = $data['price'];
            $this->item->category = $data['category'];

            if($this->item->update()) {
                header("Location: index.php?action=items");
                exit();
            }
        }
        return false;
    }

    public function delete($id) {
        $this->item->id = $id;
        if($this->item->delete()) {
            header("Location: index.php?action=items");
            exit();
        }
        return false;
    }
}
?>