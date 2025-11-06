<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Resources\ContactResource;
use App\Http\Responses\ApiResponse;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $contacts = Contact::where('center_id', $user->center_id)->paginate(10);

        return ApiResponse::success(
            ContactResource::collection($contacts),
            'Contacts retrieved successfully'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();

        $data['status'] = Contact::STATUS_ACTIVE;

        $result = Contact::create($data);

        return ApiResponse::success(new ContactResource($result), 'Contact created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return ApiResponse::success(new ContactResource($contact), 'Contact retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $relativePath = $contact->saveImage($data['image']);
            $data['image'] = $relativePath;
        }

        $contact->update($data);

        return ApiResponse::success(new ContactResource($contact), 'Contact updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->update(['status' => Contact::STATUS_DELETED]);
        return ApiResponse::success(null, 'Contact deleted successfully');
    }
}
