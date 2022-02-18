<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Images;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ImagesOrganiserRepository
{
    public function getContents(): LengthAwarePaginator
    {
        return Images::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->paginate(8);
    }

}
