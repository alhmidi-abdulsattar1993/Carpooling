<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Services\BookingsService;

class BookingsController
{
    /**
     * Return the html for the create action.
     */
    public function createBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['start_day'])
            && isset($_POST['notice_id'])
            && isset($_POST['users'])) {
            // Create the booking :
            $bookingService = new BookingsService();
            $bookingId = $bookingService->setBooking(
                null,
                $_POST['start_day'],
                $_POST['notice_id'],
                null
            );

            // Create the booking <-> pax users relations :
            $isOk = true;
            if (!empty($_POST['users'])) {
                foreach ($_POST['users'] as $userId) {
                    $isOk = $bookingService->setBookingUser($userId, $bookingId);
                }
            }

            if ($bookingId && $isOk) {
                $html = 'Réservation créée avec succès.';
            } else {
                $html = 'Erreur lors de la création de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getBookings(): string
    {
        $html = '';

        // Get all bookings :
        $bookingsService = new BookingsService();
        $bookings = $bookingsService->getBookings();

        // Get html :
        foreach ($bookings as $booking) {
            $noticeHtml = 'Annonce #';
            if (!empty($booking->getNotice())) {
                $notice = $booking->getNotice();
                $noticeHtml .= $notice->getId() .
                ' ' . $notice->getText() .
                ' Départ de : ' . $notice->getStartCity() .
                ' Arrivée à : ' . $notice->getEndCity() .
                ' Conducteur : ' . $notice->getCreator()->getFirstname() . ' ' . $notice->getCreator()->getLastname();
            }
            $passangersHtml = ' Passagers : ';
            if (!empty($booking->getPax())) {
                foreach ($booking->getPax() as $user) {
                    $passangersHtml .= $user->getFirstname() . ' ' . $user->getLastname() . ',';
                }
            }
            $html .=
                'Réservation #' . $booking->getId() . ' ' .
                $booking->getStartDay()->format('d-m-Y') . ' ' .
                $noticeHtml .
                $passangersHtml .
                '<br />';
        }

        return $html;
    }

    /**
     * Update the booking.
     */
    public function updateBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id_booking'])
            && isset($_POST['start_day'])
            && isset($_POST['notice_id'])
            && isset($_POST['users'])) {
            // Update the booking :
            $BookingsService = new BookingsService();
            $isOk = $BookingsService->setBooking(
                $_POST['id_booking'],
                $_POST['start_day'],
                $_POST['notice_id'],
                $_POST['users']
            );
            if ($isOk) {
                $html = 'Réservation mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la réservation.';
            }
        }

        return $html;
    }

    /**
     * Delete a booking.
     */
    public function deleteBooking(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id'])) {
            // Delete the user :
            $usersService = new BookingsService();
            $isOk = $usersService->deleteBooking($_POST['id']);
            if ($isOk) {
                $html = 'Réservation supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la réservation.';
            }
        }

        return $html;
    }
}
