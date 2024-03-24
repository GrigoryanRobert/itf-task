<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PhoneBook;
use App\Rules\TimeZoneRule;
use App\Services\PhoneBookService;
use App\Rules\CountryCodeRule;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneBookApiController extends Controller
{
    /**
     * @var PhoneBookService
     */
    protected $phoneBookService;

    /**
     * __construct
     *
     * @param PhoneBookService $phone_book
     * @return void
     */
    public function __construct(PhoneBookService $phone_book_service)
    {
        $this->phoneBookService = $phone_book_service;
    }

    /**
     * get phone books item with pagination
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $phoneBooks = $this->phoneBookService->get_by_pagination();

        return response()->json(['results' => $phoneBooks]);
    }

    /**
     * show custom item by id
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $phoneBook = PhoneBook::find($id);

        if (!$phoneBook) {
            return response()->json([
                'message' => 'Phone book not found.'
            ], 404);
        }

        return response()->json(['results' => $phoneBook]);
    }

    /**
     * create new phone book item
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'phone_number' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', new CountryCodeRule],
            'tz_name' => ['required', new TimeZoneRule],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ], 422);
        }

        try {
            $requestParametrs = $request->only(['first_name', 'last_name', 'phone_number', 'tz_name', 'country_code']);
            $this->phoneBookService->create($requestParametrs);

            return response()->json([
                'message' => 'Phone book created successfully.'
            ]);
        } catch (Exception) {

            return response()->json([
                'message' => 'Something went really wrong.'
            ], 500);
        }

    }

    /**
     * update custom item by id
     * @param string $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update(string $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['min:6'],
            'phone_number' => ['min:6', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', new CountryCodeRule],
            'tz_name' => ['required', new TimeZoneRule],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'validation_error' => $validator->messages(),
            ],422);
        }

        try {
            $requestParametrs = $request->only(['first_name', 'last_name', 'phone_number', 'tz_name', 'country_code']);
            $this->phoneBookService->update($id, $requestParametrs);
            PhoneBook::find($id)->update($request->all());

            return response()->json([
                'message' => 'Phone book updated successfully.'
            ]);
        } catch (Exception) {
            return response()->json([
                'message' => 'Something went really wrong.'
            ], 500);
        }

    }

    /**
     * Delete PhoneBook item by ID.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->phoneBookService->destroy($id);

            return response()->json([
                'message' => 'Phone book item deleted successfully.'
            ]);
        } catch (ModelNotFoundException) {
            return response()->json([
                'message' => 'Something went really wrong.'
            ]);
        }
    }
}
