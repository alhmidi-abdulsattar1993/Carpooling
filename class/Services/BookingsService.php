<?php declare(strict_types = 1);

namespace App\Services;

use App\Entities\Booking;
use App\Entities\Notice;
use App\Entities\User;
use DateTime;

class BookingsService
{
    /**
     * Return all bookings from the database.
     */
    public function getBookings(): array
    {
        $bookings = [];

        $dataBaseService = new DataBaseService();
        $bookingsDTO = $dataBaseService->getBookings();
        if (!empty($bookingsDTO)) {
            foreach ($bookingsDTO as $bookingDTO) {
                $booking = new Booking();
                $booking->setId($bookingDTO['id_booking']);
                $booking->setIdNotice($bookingDTO['notice_id']);
                //$booking->setUserPax($bookingDTO['user_pax_id']);
                $date = new DateTime($bookingDTO['start_day']);
                if ($date !== false) {
                    $booking->setStartDay($date);
                }

                //Set booking's notice
                $notice = $this->getNotice($bookingDTO['notice_id']);
                $booking->setNotice($notice);

                //Get every passangers from the booking
                $pax = $this->getBookingPax($bookingDTO['id_booking']);
                $booking->setPax($pax);

                $bookings[] = $booking;
            }
        }

        return $bookings;
    }

    /**
     * Create or update a booking.
     */
    public function setBooking(?string $id, string $start_day, string $notice_id, ?array $users): string
    {
        $bookingId = '';

        $dataBaseService = new DataBaseService();
        $start_day_DateTime = new DateTime($start_day);

        if (empty($id)) {
            $bookingId = $dataBaseService->createBooking($start_day_DateTime, $notice_id);
        } else {
            $dataBaseService->updateBooking($id, $start_day_DateTime, $notice_id, $users);
            $bookingId = $id;
        }

        return $bookingId;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(string $id): bool
    {
        $dataBaseService = new DataBaseService();

        return $dataBaseService->deleteBooking($id);
    }

    /**
     * Return a notice from a booking id.
     */
    public function getNotice(string $id): Notice
    {
        $notice = new Notice();
        $dataBaseService = new DataBaseService();
        $noticeDTO = $dataBaseService->getNotice($id);

        if (!empty($noticeDTO)) {
            $notice->setId($noticeDTO['id_notice']);
            $notice->setText($noticeDTO['text']);
            $notice->setStartCity($noticeDTO['start_city']);
            $notice->setEndCity($noticeDTO['end_city']);
            $notice->setUserCreator($noticeDTO['user_creator_id']);
        }
        //Get data of the notice's creator
        $user = new User();
        $userDTO = $dataBaseService->getUser($noticeDTO['user_creator_id']);

        if (!empty($userDTO)) {
            $user->setId($userDTO['id_user'])
                ->setFirstname($userDTO['firstname'])
                ->setLastname($userDTO['lastname'])
                ->setEmail($userDTO['email'])
                ;
            $date = new DateTime($userDTO['birthday']);
            if ($date !== false) {
                $user->setBirthday($date);
            }
        }
        $notice->setCreator($user);

        return $notice;
    }

    /**
     * Create relation bewteen a booking and a passager.
     */
    public function setBookingUser(string $userId, string $bookingId): bool
    {
        $dataBaseService = new DataBaseService();

        return $dataBaseService->setBookingUser($userId, $bookingId);
    }

    /**
     * Get passengers of a given booking id.
     */
    public function getBookingPax(string $id)
    {
        $bookingPax = [];

        $dataBaseService = new DataBaseService();

        //Get relation between passagers and booking
        $bookingPaxDTO = $dataBaseService->getBookingPax($id);
        if (!empty($bookingPaxDTO)) {
            foreach ($bookingPaxDTO as $userDTO) {
                $user = new User();
                $user->setId($userDTO['id_user'])
                    ->setFirstname($userDTO['firstname'])
                    ->setLastname($userDTO['lastname'])
                    ->setEmail($userDTO['email'])
                ;
                $date = new DateTime($userDTO['birthday']);
                if ($date !== false) {
                    $user->setBirthday($date);
                }
                $bookingPax[] = $user;
            }
        }

        return $bookingPax;
    }
}
