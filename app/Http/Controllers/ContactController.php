<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMessageRequest;
use App\Services\ContactService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function showForm(): object
    {
        return view('contact.form');
    }

    public function submit(ContactMessageRequest $request): RedirectResponse
    {
        $this->contactService->store($request);

        return redirect()->route('contact.index');
    }

    public function index(): object
    {
        $messages = $this->contactService->getAll();

        return view('contact.index', compact('messages'));
    }
}
