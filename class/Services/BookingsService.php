<?php declare(strict_types = 1);

namespace App\Services;

use App\Entities\Booking;
use App\Entities\Notice;
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
                $booking->setUserPax($bookingDTO['user_pax_id']);
                $date = new DateTime($bookingDTO['start_day']);
                if ($date !== false) {
                    $booking->setStartDay($date);
                }

                //Set booking's notice
                $notice = $this->getNotice($bookingDTO['notice_id']);
                $booking->setNotice($notice);

                $bookings[] = $booking;
            }
        }

        return $bookings;
    }

    /**
     * Create or update a booking.
     */
    public function setBooking(?string $id, string $start_day, string $notice_id, string $user_pax_id): string
    {
        $bookingId = '';

        $dataBaseService = new DataBaseService();
        $start_day_DateTime = new DateTime($start_day);

        if (empty($id)) {
            $bookingId = $dataBaseService->createBooking($start_day_DateTime, $notice_id, $user_pax_id);
        } else {
            $dataBaseService->updateBooking($id, $start_day_DateTime, $notice_id, $user_pax_id);
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

        return $notice;
    }
}
