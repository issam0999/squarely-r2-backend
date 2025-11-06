<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'center_id' => 'nullable|exists:centers,id',
        ]);

        DB::beginTransaction();
        try {
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
                'center_id' => $validated['center_id'] ?? 1,
            ]);

            $token = $user->createToken('api')->plainTextToken;
            DB::commit();

            $user->load('contact');

            return ApiResponse::success([
                'user' => new UserResource($user),
                'token' => $token,
            ], 'User registered successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            return ApiResponse::error('Registration failed: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->with('contact')->first();

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
            'userAbilityRules' => 'admin',
        ]);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out']);
    }
}
