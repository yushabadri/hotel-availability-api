<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Resources\V1\HotelResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\HotelResourceCollection;
use App\Services\ResponseHandlerService;
use Illuminate\Validation\ValidationException;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HotelController extends Controller
{
    // injecting dependencies into the constructor to makes it easier to swap out implementations, mock dependencies during testing.
    protected $responseHandler;
    protected $hotelService;

    public function __construct(ResponseHandlerService $responseHandler, HotelService $hotelService)
    {
        $this->responseHandler = $responseHandler;
        $this->hotelService = $hotelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Authenticate the agency using JWT authentication and Retrieve the agency ID
        $agency = auth('agency')->user();
        $agencyId = $agency->id;

        $hotels = $this->hotelService->getHotelsByAgencyId($agencyId);

        // If agency records not exist, show result error; otherwise success. 
        if ($hotels->isEmpty()) {
            return $this->responseHandler->handle(Response::HTTP_NO_CONTENT, [], 'No hotel found.');
        }

        // returning a collection of resources Properties serialized data
        $hotelsData = new HotelResourceCollection($hotels);

        return $this->responseHandler->handle(Response::HTTP_OK, $hotelsData, 'hotels data successfully returned.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, HotelService $hotelService)
    {
        try {

            // Authenticate the agency using JWT authentication and Retrieve the agency ID
            $agency = auth('agency')->user();
            $agencyId = $agency->id;

            // Validate the request data
            $validatedData = $request->validate([
                'property_id' => 'required|exists:properties,id',
                'agency_id' => 'nullable|exists:agencies,id',
                'name' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:255',
                'description_license' => 'nullable|string|max:255',
                'address' => 'nullable|string|max:255',
                'rating' => 'nullable|string',
                'facilities' => 'nullable|json',
            ]);

            // Convert the facilities
            $validatedData['facilities'] = json_decode($validatedData['facilities']);

            // Create the hotels for the agency
            $hotel = $hotelService->createHotelsByAgencyId($agencyId, $validatedData);

            // returning a single hotel serialized data.
            $hotelData = new HotelResource($hotel);

            return $this->responseHandler->handle(Response::HTTP_CREATED, $hotelData, 'Hotel created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Display a list of hotels associated with the authenticated user's agency.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function availability(Authenticatable $user)
    {
        // Check if the user has agency_id
        if (isset($user->agency_id)) {
            // Get the Hotels data by agency_id
            $hotels = HotelService::getHotelsByAgencyId($user->agency_id);
 
            // If Hotels records exist, show success; otherwise, show no result error
            if (!empty($hotels)) {
                // data serialization
                $hotelsData = new HotelResourceCollection($hotels);

                // Use Custom general handler to show the response
                return ResponseHandlerService::handle(Response::HTTP_OK, $hotelsData, 'Hotels data successfully returned.');
            } else {
                return ResponseHandlerService::handle(Response::HTTP_NO_CONTENT, [], 'No hotels found for the given criteria.');
            }
        } else {
            // If agency ID is null, return 404 Not Found
            return ResponseHandlerService::handle(Response::HTTP_NOT_FOUND, [], 'User\'s agency ID not found or not available.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
