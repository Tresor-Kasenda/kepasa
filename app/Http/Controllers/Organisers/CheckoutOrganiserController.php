<?php
declare(strict_types=1);

namespace App\Http\Controllers\Organisers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repository\Organisers\CheckoutOrganiserRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CheckoutOrganiserController extends Controller
{
    public function __construct(public CheckoutOrganiserRepository $repository){}

    public function index(Event $event):Renderable
    {
        $category = $this->repository->getCategoryByEvent($event);
        return view('organisers.pages.billings.confirm', compact('event', 'category'));
    }

    public function confirmed(Request $attributes): RedirectResponse
    {
        $token = $this->repository->transactionWithDpo(attributes: $attributes);
        return redirect()->away("https://secure.3gdirectpay.com/dpopayment.php?ID=$token");
    }
}
