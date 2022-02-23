<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Event;
use App\Models\Images;
use App\Services\ImageUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ImagesOrganiserRepository
{
    use ImageUpload;

    public function getContents(): LengthAwarePaginator
    {
        return Images::query()
            ->with('event')
            ->orderByDesc('created_at')
            ->paginate(8);
    }

    public function getEvents(): Collection|array
    {
        return Event::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function create($attributes): Model|Builder
    {
        $image = Images::query()
            ->create([
                'event_id' => $attributes->input('event_id'),
                'image' => self::uploadFiles($attributes),
                'company_id' => $attributes->user()->company->id
            ]);
        toast("Image ajouter avec success", 'success');
        return $image;
    }

    public function update(string $key, $attributes): Model|Builder|null
    {
        $image = $this->getImageByKey(key: $key);
        $this->removePicture($image);
        $image->update([
            'event_id' => $attributes->input('event_id'),
            'image' => self::uploadFiles($attributes),
            'company_id' => $attributes->user()->company->id
        ]);
        toast("Image a ete mise a jours", 'success');
        return $image;
    }

    public function delete(string $key): Model|Builder|null
    {
        $image = $this->getImageByKey($key);
        $this->removePicture($image);
        $image->delete();
        toast("Image a ete supprimer", 'success');
        return $image;
    }

    public function getImageByKey(string $key): Model|Builder|null
    {
        return Images::query()
            ->where('key', '=', $key)
            ->first();
    }
}
