<?php

class Review {

    public $id;
    public $user;
    public $rating;
    public $review;
    public $users_id;
    public $clinics_id;

}

interface ReviewDAOInterface {

    public function buildReview($data);
    public function create(Review $review);
    public function getClinicsReview($id);
    public function hasAlreadlyReviewed($id, $users_id);
    public function getRatings($id);
}

?>