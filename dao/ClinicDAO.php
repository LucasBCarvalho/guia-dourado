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
        $clinic->length = $data['length'];
        $clinic->users_id = $data['users_id'];

        return $clinic;

    }

    public function findAll() {

    }

    public function getLastClinics() {

        $clinics = array();

        $stmt = $this->conn->query("SELECT * FROM clinica ORDER BY id DESC");
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $clinicsArray = $stmt->fetchAll();

            foreach ($clinicsArray as $clinic) {

                $clinics[] = $this->buildClinic($clinic);

            }
        }

        return $clinics;
    }

    public function getClinicByCategory($category) {

        $clinics = array();

        $stmt = $this->conn->prepare("SELECT * FROM clinica
                                        WHERE category = :category
                                        ORDER BY id DESC");
        $stmt->bindParam(":category", $category);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $clinicsArray = $stmt->fetchAll();

            foreach ($clinicsArray as $clinic) {

                $clinics[] = $this->buildClinic($clinic);

            }
        }

        return $clinics;
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