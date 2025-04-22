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
        $clinic->legth = $data['legth'];
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

    }

    public function update(Clinic $clinic) {

    }

    public function destroy($id) {

    }


}