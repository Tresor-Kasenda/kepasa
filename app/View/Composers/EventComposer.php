<?php
declare(strict_types=1);

namespace App\View\Composers;

use App\Repository\HomeRepository;
use Illuminate\View\View;

class EventComposer
{
    public function __construct(public HomeRepository $repository){}

    public function compose(View $view)
    {
        $view->with('events' ,$this->repository->getContents());
    }
}
