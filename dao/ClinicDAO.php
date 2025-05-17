<?php

require_once('models/Clinic.php');
require_once('models/Message.php');

require_once('dao/ReviewDAO.php');

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

        $reviewDao = new ReviewDAO($this->conn, $this->url);

        $rating = $reviewDao->getRatings($clinic->id);

        $clinic->rating = $rating;

        return $clinic;

    }

    public function findAll() {

    }

    public function getLastClinics() {

        $clinics = array();
        $stmt    = $this->conn->query("SELECT * FROM clinica ORDER BY id DESC");
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
        $stmt    = $this->conn->prepare("SELECT * FROM clinica WHERE category = :category ORDER BY id DESC");
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
        $clinics = array();
        $stmt    = $this->conn->prepare("SELECT * FROM clinica WHERE users_id = :users_id");
        $stmt->bindParam(":users_id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {

            $clinicsArray = $stmt->fetchAll();

            foreach ($clinicsArray as $clinic) {

                $clinics[] = $this->buildClinic($clinic);

            }
        }

        return $clinics;
    }

    public function findById($id) {
        $clinic = array();
        $stmt   = $this->conn->prepare("SELECT * FROM clinica WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $clinicData = $stmt->fetch();
            $clinic = $this->buildClinic($clinicData);
            return $clinic;
        } else {
            return false;
        }

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

        $stmt       = $this->conn->prepare("UPDATE clinica SET
        title       = :title,
        description = :description,
        image       = :image,
        trailer     = :trailer,
        category    = :category,
        length      = :length
        WHERE id    = :id;");

        $stmt->bindParam(":title", $clinic->title);
        $stmt->bindParam(":description", $clinic->description);
        $stmt->bindParam(":image", $clinic->image);
        $stmt->bindParam(":trailer", $clinic->trailer);
        $stmt->bindParam(":category", $clinic->category);
        $stmt->bindParam(":length", $clinic->length);
        $stmt->bindParam(":id", $clinic->id);

        $stmt->execute();

        $this->message->setMessage("Clínica atualizado com sucesso!", "success", "dashboard.php");
    }

    public function destroy($id) {

        $stmt = $this->conn->prepare("DELETE FROM clinica WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $this->message->setMessage("Clínica removida com sucesso!", "success", "dashboard.php");
    }


}