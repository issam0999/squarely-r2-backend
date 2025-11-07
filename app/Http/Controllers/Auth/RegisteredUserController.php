<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'center_id' => 'nullable|exists:centers,id',
        ]);


        // First create the contact
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'center_id' => $validated['center_id'] ?? 1,
            'status' => Contact::STATUS_ACTIVE,
            'type_id' => Contact::TYPE_CONTACT,
        ]);
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'contact_id' => $contact->id,

        ]);

        event(new Registered($user));

        return response()->noContent();
    }
}
