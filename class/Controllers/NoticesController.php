<?php declare(strict_types = 1);

namespace App\Controllers;

use App\Services\NoticesService;

class NoticesController
{
    /**
     * Return the html for the create action. WIP.
     */
    public function createNotice(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['text'])
            && isset($_POST['start_city'])
            && isset($_POST['end_city'])
            && isset($_POST['user_creator_id'])) {
            // Create the notice:
            $noticeService = new NoticesService();
            $noticeId = $noticeService->setNotice(
                null,
                $_POST['text'],
                $_POST['start_city'],
                $_POST['end_city'],
                $_POST['user_creator_id']
            );

            if ($noticeId) {
                $html = 'Annonce créée avec succès.';
            } else {
                $html = 'Erreur lors de la création de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getNotices(): string
    {
        $html = '';

        // Get all notices :
        $noticesService = new NoticesService();
        $notices = $noticesService->getNotices();

        // Get html :
        foreach ($notices as $notice) {
            $userHtml = '';
            if (!empty($notice->getCreator())) {
                $user = $notice->getCreator();
                $userHtml .= 'Créé par : ' . $user->getFirstname() . ' ' . $user->getLastname();
            }
            $html .=
                '#' . $notice->getId() . ' ' .
                $notice->getStartCity() . ' ' .
                $notice->getEndCity() . ' ' .
                $notice->getUserCreator() . ' ' .
                $userHtml .
                '<br />';
        }

        return $html;
    }

    /**
     * Update the notice.
     */
    public function updateNotice(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id_notice'])
            && isset($_POST['text'])
            && isset($_POST['start_city'])
            && isset($_POST['end_city'])
            && isset($_POST['user_creator_id'])) {
            // Update the notice :
            $noticesService = new NoticesService();
            $isOk = $noticesService->setNotice(
                $_POST['id_notice'],
                $_POST['text'],
                $_POST['start_city'],
                $_POST['end_city'],
                $_POST['user_creator_id']
            );
            if ($isOk) {
                $html = 'Annonce mise à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de l\'annonce.';
            }
        }

        return $html;
    }

    /**
     * Delete a notice.
     */
    public function deleteNotice(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id_notice'])) {
            // Delete the notice :
            $noticesService = new NoticesService();
            $isOk = $noticesService->deleteNotice($_POST['id_notice']);
            if ($isOk) {
                $html = 'Annonce supprimée avec succès.';
            } else {
                $html = 'Erreur lors de la supression de l\'annonce.';
            }
        }

        return $html;
    }
}
