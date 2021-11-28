<?php

namespace App\Controllers;

use App\Services\CarsService;

class CarsController
{   
    /**
     * add a car .
     */
    public function createCar(): string
    {
        $html = '';
        if (isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots']) )
            {
                // Create the user :
                $carsService = new CarsService();
                $carsid = $carsService->setCar(
                    null,
                    $_POST['brand'],
                    $_POST['model'],
                    $_POST['color'],
                    $_POST['nbrSlots']
                );
            }
            if (isset($carsid) ) {
                $html = 'La voiture été créé avec succès.';
            } else {
                $html = 'Erreur lors de la création de la voiture .';
            }
        

        return $html;
    }

    /**
     * Update a car .
     */
    public function updateCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id']) &&
           isset($_POST['brand']) &&
            isset($_POST['model']) &&
            isset($_POST['color']) &&
            isset($_POST['nbrSlots']) )
            {
            // Update the car :
            $carService = new CarsService();
            $isOk = $carService ->setCar(
                $_POST['id'],
                $_POST['brand'],
                $_POST['model'],
                $_POST['color'],
                $_POST['nbrSlots']
            );
            if ($isOk) {
                $html = 'la viture mis à jour avec succès.';
            } else {
                $html = 'Erreur lors de la mise à jour de la voiture.';
            }
        }

        return $html;
    }

    /**
     * Return the html for the read action.
     */
    public function getCars(): array
    {
        $html = [];

        // Get all cars :
        $carsService = new CarsService();
        $cars = $carsService->getCars();

        // Get html :
        foreach ($cars as $car) { 
                array_push($html , array(
                    'brand' =>   $car->getBrand(),
                    'model' =>   $car->getModel(),
                    'color' =>   $car->getColor(),
                    'nbrSlots' =>   $car->getnbrSlots() ));
        }

        return $html;
    }

    /**
     * Delete a car.
     */
    public function deleteCar(): string
    {
        $html = '';

        // If the form have been submitted :
        if (isset($_POST['id_car'])) {
            // Delete the user :
            $carsService = new CarsService();
            $isOk = $carsService->deletecar($_POST['id_car']);
            if ($isOk) {
                $html = 'Voiture supprimé avec succès.';
            } else {
                $html = 'Erreur lors de la supression de la voiture.';
            }
        }

        return $html;
    }
    
}
