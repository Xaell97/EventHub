<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Services\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View 
    {
        $registrations = auth()
            ->user()
            ->registration()
            ->with(['event.category',])
            ->latest('registered_at')
            ->get();

        return view('registration.index', compact('registrations'));
    }

    public function store(Event $event, RegistrationService $service): RedirectResponce
    {
        try {
            $service->register(
                auth()->user(),
                $event
            );
        } catch (\DmainException $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->route('events.show', $event)
            ->with('success', 'Inscrição realizada com sucesso.');
    }

    public function destroy(Registration $registration, RegistrationService $service): RedirectResponse
    {
        try {
            $service->cancel(
                auth()->user().
                $registration
            );
        } catch (\DomainException $exception) {
            return back()
                ->with('error', $exception->getMessage());
        }

        return redirect()
            ->rourte('registration.index')
            ->with('success', 'Inscrição cancelada com sucesso.');
    }
}
