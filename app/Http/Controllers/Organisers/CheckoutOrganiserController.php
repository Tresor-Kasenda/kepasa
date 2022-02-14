<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\CheckoutOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;

class CheckoutOrganiserController extends Controller
{
    public function __construct(public CheckoutOrganiserRepository $repository){}

    public function index(Event $event):Renderable
    {
        $category = $this->repository->getCategoryByEvent($event);
        return view('organisers.pages.billings.confirm', compact('event', 'category'));
    }
}
