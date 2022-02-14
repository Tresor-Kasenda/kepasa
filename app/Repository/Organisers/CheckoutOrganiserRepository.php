<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

class CheckoutOrganiserRepository
{
    public function getCategoryByEvent($event)
    {
        return $event->load('category');
    }
}
