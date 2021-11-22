<?php declare(strict_types = 1);

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    public const HOST = '127.0.0.1';
    public const PORT = '3306';
    public const DATABASE_NAME = 'carpooling';
    public const MYSQL_USER = 'root';
    public const MYSQL_PASSWORD = 'password';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec('SET CHARACTER SET utf8');
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
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
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
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
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

        return $query->execute($data);
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
            LEFT JOIN users_cars as uc ON uc.car_id = c.id_car
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
    public function createBooking(DateTime $start_day, string $notice_id, string $user_pax_id): string
    {
        $bookingId = '';

        $data = [
            'start_day' => $start_day->format(DateTime::RFC3339),
            'notice_id' => $notice_id,
            'user_pax_id' => $user_pax_id,
        ];
        $sql = 'INSERT INTO bookings (start_day, notice_id, user_pax_id) VALUES (:start_day, :notice_id, :user_pax_id)';
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
    public function updateBooking(string $id, DateTime $start_day, string $notice_id, string $user_pax_id): bool
    {
        $isOk = false;

        $data = [
            'id_booking' => $id,
            'start_day' => $start_day->format(DateTime::RFC3339),
            'notice_id' => $notice_id,
            'user_pax_id' => $user_pax_id,
        ];
        $sql = 'UPDATE bookings SET start_day = :start_day, notice_id = :notice_id, user_pax_id = :user_pax_id WHERE id_booking = :id;';
        $query = $this->connection->prepare($sql);

        return $query->execute($data);
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
        $sql = 'DELETE FROM bookings WHERE id_booking = :id;';
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
}
