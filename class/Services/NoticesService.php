<?php declare(strict_types = 1);

namespace App\Services;

use App\Entities\Booking;
use App\Entities\Notice;
use App\Entities\User;
use DateTime;

class NoticesService
{
    /**
     * Return all notices from the database.
     */
    public function getNotices(): array
    {
        $notices = [];

        $dataBaseService = new DataBaseService();
        $noticesDTO = $dataBaseService->getNotices();
        if (!empty($noticesDTO)) {
            foreach ($noticesDTO as $noticeDTO) {
                $notice = new Notice();
                $notice->setId($noticeDTO['id_notice']);
                $notice->setText($noticeDTO['text']);
                $notice->setStartCity($noticeDTO['start_city']);
                $notice->setEndCity($noticeDTO['end_city']);
                $notice->setUserCreator($noticeDTO['user_creator_id']);

                //Set notice's creator
                $user = $this->getCreator($noticeDTO['user_creator_id']);
                $notice->setCreator($user);

                $notices[] = $notice;
            }
        }

        return $notices;
    }

    /**
     * Create or update a notice.
     */
    public function setNotice(?string $id, string $text, string $start_city, string $end_city, string $user_creator_id): string
    {
        $noticeId = '';

        $dataBaseService = new DataBaseService();

        if (empty($id)) {
            $noticeId = $dataBaseService->createNotice($text, $start_city, $end_city, $user_creator_id);
        } else {
            $dataBaseService->updateNotice($id, $text, $start_city, $end_city, $user_creator_id);
            $noticeId = $id;
        }

        return $noticeId;
    }

    /**
     * Delete a notice.
     */
    public function deleteNotice(string $id): bool
    {
        $dataBaseService = new DataBaseService();

        return $dataBaseService->deleteNotice($id);
    }

    /**
     * Return all booking from a notice. WIP.
     */
    public function getBookings(string $id): array
    {
        return [];
    }

    /**
     * Return the creator of a notice.
     */
    public function getCreator(string $id): User
    {
        $user = new User();
        $dataBaseService = new DataBaseService();
        $userDTO = $dataBaseService->getUser($id);

        if (!empty($userDTO)) {
            $user->setId($userDTO['id_user']);
            $user->setFirstname($userDTO['firstname']);
            $user->setLastname($userDTO['lastname']);
            $user->setEmail($userDTO['email']);
            $date = new DateTime($userDTO['birthday']);
            if ($date !== false) {
                $user->setBirthday($date);
            }
        }

        return $user;
    }
}
