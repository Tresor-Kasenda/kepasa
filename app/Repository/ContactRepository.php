<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactRepository
{
    public function store($attributes): Model|Builder
    {
        return Contact::query()
            ->create([
                'name' => $attributes->input('name'),
                'email' => $attributes->input('email'),
                'subject' => $attributes->input('subject'),
                'messages' => $attributes->input('messages'),
            ]);
    }
}
