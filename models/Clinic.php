<?php

class Clinic {
    
    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $legth;
    public $users_id;

    public function imageGenerateName() {
        return bin2hex(random_bytes(60)) . ".jpg";
    }
}

interface ClinicDAOInterface {
    public function buildClinic($data);
    public function findAll();
    public function getLastClinics();
    public function getClinicByCategory($category);
    public function getClicnicByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create(Clinic $clinic);
    public function update(Clinic $clinic);
    public function destroy($id);
}