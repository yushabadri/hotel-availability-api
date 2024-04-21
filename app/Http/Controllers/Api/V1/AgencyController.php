<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AgencyResource;
use App\Services\ResponseHandlerService;
use Illuminate\Validation\ValidationException;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AgencyController extends Controller
{
    // injecting dependencies into the constructor to makes it easier to swap out implementations, mock dependencies during testing.
    protected $responseHandler;
    protected $agency;

    public function __construct(ResponseHandlerService $responseHandler, Agency $agency)
    {
        $this->responseHandler = $responseHandler;
        $this->agency = $agency;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agencies = $this->agency->all();

        // If agency records not exist, show result error; otherwise success. 
        if ($agencies->isEmpty()) {
            return $this->responseHandler->handle(Response::HTTP_NO_CONTENT, [], 'No Agency found.');
        }
        // returning a collection of resources Agencies serialized data
        $agenciesData = AgencyResource::collection($agencies);

        return $this->responseHandler->handle(Response::HTTP_OK, $agenciesData, 'Agencies data successfully returned.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:agencies,email',
                'password' => 'required|string|min:6', 
            ]);
         
            // Agency data creation
            $agency = $this->agency->create($validatedData);
            // returning a single Agency serialized data.
            $agencyData = new AgencyResource($agency);

            return $this->responseHandler->handle(Response::HTTP_CREATED, $agencyData, 'Agency created successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
