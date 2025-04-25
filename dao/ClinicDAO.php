<?php

require_once('models/Clinic.php');
require_once('models/Message.php');

class ClinicDAO implements ClinicDAOInterface {
    
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url) {
        
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);

    }

    public function buildClinic($data) {

        $clinic = new Clinic();
        $clinic->id = $data['id'];
        $clinic->title = $data['title'];
        $clinic->description = $data['description'];
        $clinic->image = $data['image'];
        $clinic->trailer = $data['trailer'];
        $clinic->category = $data['category'];
        $clinic->length = $data['legth'];
        $clinic->users_id = $data['users_id'];
        
        return $clinic;

    }

    public function findAll() {

    }

    public function getLastClinics() {

    }

    public function getClinicByCategory($category) {

    }

    public function getClicnicByUserId($id) {

    }

    public function findById($id) {

    }

    public function findByTitle($title) {

    }

    public function create(Clinic $clinic) {

        $stmt = $this->conn->prepare("INSERT INTO clinica (
            title, 
            description, 
            image, 
            trailer, 
            category, 
            length, 
            users_id
        ) VALUES (
            :title, 
            :description, 
            :image, 
            :trailer, 
            :category, 
            :length, 
            :users_id
        );");

        $stmt->bindParam(":title", $clinic->title);
        $stmt->bindParam(":description", $clinic->description);
        $stmt->bindParam(":image", $clinic->image);
        $stmt->bindParam(":trailer", $clinic->trailer);
        $stmt->bindParam(":category", $clinic->category);
        $stmt->bindParam(":length", $clinic->length);
        $stmt->bindParam(":users_id", $clinic->users_id);
        $stmt->execute();

        $this->message->setMessage("Clínica adicionada com sucesso!", "success", "index.php");

    }

    public function update(Clinic $clinic) {

    }

    public function destroy($id) {

    }


}