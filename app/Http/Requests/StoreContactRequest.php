<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
<<<<<<< HEAD
            'center_id' => 'required|exists:centers,id',
=======
            'image' => 'nullable|string',
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'type_id' => 'nullable|integer',
            'date_of_birth' => 'nullable|date',
            'country_id' => 'nullable|integer',
            'city_id' => 'nullable|integer',
<<<<<<< HEAD
            'status' => 'nullable|boolean',
            'address' => 'nullable|string|max:500',

=======
            'center_id' => 'nullable|exists:centers,id',
            'status' => 'nullable|boolean',
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
        ];
    }
}
