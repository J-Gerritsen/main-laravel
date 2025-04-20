<?php

namespace App\Services;

use App\Http\Requests\ContactMessageRequest;
use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Collection;

class ContactService
{
    public function store(ContactMessageRequest $request): ContactMessage
    {
        return ContactMessage::create($request->validated());
    }

    public function getAll(): Collection
    {
        return ContactMessage::all();
    }
}
