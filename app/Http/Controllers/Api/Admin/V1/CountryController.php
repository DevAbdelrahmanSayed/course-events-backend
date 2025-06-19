<?php

namespace App\Http\Controllers\Api\Admin\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateCountryRequest;
use App\Http\Requests\Admin\UpdateCountryRequest;
use App\Http\Resources\Admin\CountryResource;
use App\Http\Resources\PaginatedResource;
use App\Models\Country;
use App\Services\Admin\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\RouteAttributes\Attributes\Get;
use Spatie\RouteAttributes\Attributes\Resource;
use Symfony\Component\HttpFoundation\Response;

#[Resource(
    resource: 'country',
    apiResource: true,
    shallow: true,
    names: 'admin.country',
    parameters: ['country' => 'country'],
    except: ['show']
)]
class CountryController extends Controller
{
    public function __construct(
        private readonly CountryService $countryService
    ) {}

    public function index(Request $request): JsonResponse
    {

        return ApiResponse::sendResponse(
            Response::HTTP_OK,
            'Countries retrieved successfully',
            PaginatedResource::make(
                $this->countryService->getPaginatedCountries(
                    $request->input('per_page', 15)
                ),
                CountryResource::class
            ),

        );

    }

    public function store(CreateCountryRequest $request): JsonResponse
    {

        return ApiResponse::sendResponse(
            Response::HTTP_CREATED,
            'Country created successfully',
            CountryResource::make(
                $this->countryService->create($request->validated())
            )
        );

    }

    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {

        return ApiResponse::sendResponse(
            Response::HTTP_OK,
            'Country updated successfully',
            CountryResource::make(
                $this->countryService->update($country, $request->validated())
            )
        );

    }

    public function destroy(Country $country): JsonResponse
    {
        $this->countryService->delete($country);

        return ApiResponse::sendResponse(
            Response::HTTP_OK,
            'Country deleted successfully'
        );

    }

    #[Get('country/dropdown')]
    public function dropdown(): JsonResponse
    {

        return ApiResponse::sendResponse(
            Response::HTTP_OK,
            'Countries for dropdown retrieved successfully',
            CountryResource::collection(
                $this->countryService->getAllForDropdown()
            )
        );

    }
}
