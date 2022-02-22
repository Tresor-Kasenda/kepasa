<?php
declare(strict_types=1);

namespace App\Repository\Organisers;

use App\Models\Images;
use App\Services\ImageUpload;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
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

    public function create($attributes): Model|Builder
    {
        $image = Images::query()
            ->create([
                'event_id' => $attributes->input('event_id'),
                'image' => self::uploadFiles($attributes)
            ]);
        toast("Image ajouter avec success", 'success');
        return $image;
    }

    public function update(string $key, $attributes)
    {
        $image = $this->getImageByKey($attributes, $key);
        $this->removePicture($image);
        $image->update([
            'event_id' => $attributes->input('event_id'),
            'image' => self::uploadFiles($attributes)
        ]);
        toast("Image a ete mise a jours", 'success');
        return $image;
    }

    public function delete(string $key)
    {
        $image = $this->getImageByKey($key);
        $this->removePicture($image);
        $image->delete();
        toast("Image a ete supprimer", 'success');
        return $image;
    }

    public function getImageByKey(string $key): mixed
    {
        return Images::query()
            ->when('key', fn($query) => $query->where('key', $key))
            ->first();
    }
}
