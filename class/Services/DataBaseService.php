<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): string
    {
        $userId = '';

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $userId = $this->connection->lastInsertId();
        }

        return $userId;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id_user  = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id_user  = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all cars.
     */
    public function getCars(): array
    {
        $cars = [];

        $sql = 'SELECT * FROM cars';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $cars = $results;
        }

        return $cars;
    }

    /**
     * Create relation bewteen an user and his car.
     */
    public function setUserCar(string $userId, string $carId): bool
    {
        $isOk = false;

        $data = [
            'userId' => $userId,
            'carId' => $carId,
        ];
        $sql = 'INSERT INTO users_cars (user_id, car_id) VALUES (:userId, :carId)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Get cars of given user id.
     */
    public function getUserCars(string $userId): array
    {
        $userCars = [];

        $data = [
            'userId' => $userId,
        ];
        $sql = '
            SELECT c.*
            FROM cars as c
            LEFT JOIN users_cars as uc ON uc.car_id = c.id
            WHERE uc.user_id = :userId';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $userCars = $results;
        }

        return $userCars;
    }
    /**
     * Creat a car
     */
    
    public function setCar(string $brand, string $model, string $color, int $nbrSlots): string
    {
        $carId = '';

        $data = [
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
          
        ];
        $sql = 'INSERT INTO cars (brand, model, color, nbrSlots) VALUES (:brand, :model, :color, :nbrSlots )';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $carId = $this->connection->lastInsertId();
        }

        return $carId;
    }
    /**
     * Update a car
     */
    public function updateCar(string $id, string $brand, string $model, string $color, int $nbrSlots): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'brand' => $brand,
            'model' => $model,
            'color' => $color,
            'nbrSlots' => $nbrSlots,
        ];
        $sql = 'UPDATE cars SET brand = :brand, model = :model, color = :color, nbrSlots = :nbrSlots WHERE id_car  = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an car.
     */
    public function deleteCar(string $id): bool
    {
        $isOk = false;

        $data = [
            'id_car' => $id,
        ];
        $sql = 'DELETE FROM cars WHERE id_car  = :id_car;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }
     /**
     * Return all bookings.
     */
    public function getBookings(): array
    {
        $bookings = [];

        $sql = 'SELECT * FROM bookings';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $bookings = $results;
        }

        return $bookings;
    }

    /**
     * Create a booking.
     */
    public function createBooking(DateTime $start_day, string $notice_id): string
    {
        $bookingId = '';

        $data = [
            'start_day' => $start_day->format(DateTime::RFC3339),
            'notice_id' => $notice_id,
        ];
        $sql = 'INSERT INTO bookings (start_day, notice_id) VALUES (:start_day, :notice_id)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $bookingId = $this->connection->lastInsertId();
        }

        return $bookingId;
    }

    /**
     * Create a booking.
     */
    public function updateBooking(string $id, DateTime $start_day, string $notice_id, array $users): bool
    {
        $isOk1 = false;
        $isOk2 = false;

        //update the booking
        $data = [
            'id_booking' => $id,
            'start_day' => $start_day->format(DateTime::RFC3339),
            'notice_id' => $notice_id,
        ];
        $sql = 'UPDATE bookings SET start_day = :start_day, notice_id = :notice_id WHERE id_booking = :id_booking;';
        $query = $this->connection->prepare($sql);
        $isOk1 = $query->execute($data);

        //delete booking users relation
        $data = [
            'id_booking' => $id,
        ];
        $sql = 'DELETE FROM users_bookings WHERE booking_id = :id_booking;';
        $query = $this->connection->prepare($sql);
        $isOk2 = $query->execute($data);

        //update booking users relation
        foreach ($users as $user) {
            //if error
            if (!($this->setBookingUser($user, $id))) {
                return false;
            }
        }

        if ($isOk1 == $isOk2) {
            return true;
        }

        return false;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM bookings WHERE id_booking = :id; DELETE FROM users_bookings WHERE booking_id = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Return a notice from its id.
     */
    public function getNotice(string $id): array
    {
        $notice = [];

        $data = [
            'id' => $id,
        ];
        $sql = 'SELECT * FROM notices WHERE notices.id_notice = :id';
        $query = $this->connection->prepare($sql);
        $query->execute($data);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $notice = $result;
        }

        return $notice;
    }

    /**
     * Return all notices.
     */
    public function getNotices(): array
    {
        $notices = [];

        $sql = 'SELECT * FROM notices';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $notices = $results;
        }

        return $notices;
    }

    /**
     * Return a user from its id.
     */
    public function getUser(string $id): array
    {
        $user = [];
        $data = [
            'id' => $id,
        ];

        $sql = 'SELECT * FROM users WHERE users.id_user = :id';
        $query = $this->connection->prepare($sql);
        $query->execute($data);

        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            $user = $result;
        }

        return $user;
    }

    /**
     * Create a notice.
     */
    public function createNotice(string $text, string $start_city, string $end_city, string $user_creator_id): string
    {
        $noticeId = '';

        $data = [
            'text' => $text,
            'start_city' => $start_city,
            'end_city' => $end_city,
            'user_creator_id' => $user_creator_id,
        ];
        $sql = 'INSERT INTO notices (text, start_city, end_city, user_creator_id) VALUES (:text, :start_city, :end_city, :user_creator_id)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);
        if ($isOk) {
            $noticeId = $this->connection->lastInsertId();
        }

        return $noticeId;
    }

    /**
     * Delete a notice.
     */
    public function deleteNotice(string $id): bool
    {
        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM notices WHERE id_notice = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Update a notice.
     */
    public function updateNotice(string $id, string $text, string $start_city, string $end_city, string $user_creator_id): bool
    {
        $data = [
            'id' => $id,
            'text' => $text,
            'start_city' => $start_city,
            'end_city' => $end_city,
            'user_creator_id' => $user_creator_id,
        ];
        $sql = 'UPDATE notices SET text = :text, start_city = :start_city, end_city = :end_city, user_creator_id = :user_creator_id WHERE id_notice = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Create relation bewteen a booking and its pax user.
     */
    public function setBookingUser(string $userId, string $bookingId): bool
    {
        $data = [
            'userId' => $userId,
            'bookingId' => $bookingId,
        ];

        $sql = 'INSERT INTO users_bookings (booking_id, user_id) VALUES (:bookingId, :userId)';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
    }

    /**
     * Get passenger of given booking id.
     */
    public function getBookingPax(string $bookingId): array
    {
        $bookingPax = [];

        $data = [
            'booking_id' => $bookingId,
        ];
        $sql = '
            SELECT u.*
            FROM users as u
            LEFT JOIN users_bookings as ub ON ub.user_id = u.id_user
            WHERE ub.booking_id = :booking_id';
        $query = $this->connection->prepare($sql);
        $query->execute($data);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $bookingPax = $results;
        }

        return $bookingPax;
    }
}
