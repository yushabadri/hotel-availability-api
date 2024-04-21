<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePropertyRequest;
use App\Http\Resources\V1\PropertyResource;
use App\Services\ResponseHandlerService;
use Illuminate\Validation\ValidationException;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    // injecting dependencies into the constructor to makes it easier to swap out implementations, mock dependencies during testing.
    protected $responseHandler;
    protected $property;

    public function __construct(ResponseHandlerService $responseHandler, Property $property)
    {
        $this->responseHandler = $responseHandler;
        $this->property = $property;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = $this->property->all();

        // If agency records not exist, show result error; otherwise success. 
        if ($properties->isEmpty()) {
            return $this->responseHandler->handle(Response::HTTP_NO_CONTENT, [], 'No Property found.');
        }
        // returning a collection of resources Properties serialized data
        $propertiesData = PropertyResource::collection($properties);

        return $this->responseHandler->handle(Response::HTTP_OK, $propertiesData, 'Properties data successfully returned.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request  $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'provider_id' => 'required|exists:providers,id',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'description_license' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'rating' => 'required|numeric|min:0',
                'facilities' => 'required|json',
            ]);

            // Convert the facilities
            $validatedData['facilities'] = json_decode($validatedData['facilities']);

            // Create the property with the validated data
            $property = $this->property->create($validatedData);

            // returning a single Property serialized data.
            $propertyData = new PropertyResource($property);

            return $this->responseHandler->handle(Response::HTTP_CREATED, $propertyData, 'Property created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
