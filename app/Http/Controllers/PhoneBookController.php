<?php

namespace App\Http\Controllers;
use App\Models\PhoneBook;
use App\Rules\CountryCodeRule;
use App\Rules\TimeZoneRule;
use App\Services\PhoneBookService;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PhoneBookController extends Controller
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
     * Show the form for creating a new phone book.
     *
     * @return Response
     */
    public function index()
    {
        $phone_books = PhoneBook::all();
        return Inertia::render('PhoneBooks/Index', ['phone_books' => $phone_books]);
    }

    /**
     * Show the form for creating a new phone book.
     */
    public function api_index()
    {
        return Inertia::render('PhoneBooksApi/Index');
    }

    /**
     * Show the form for creating a new phone book.
     */
    public function api_create()
    {
        return Inertia::render('PhoneBooksApi/Create');
    }

    /**
     * Create Phone Book View
     *
     * @return response()
     */
    public function create()
    {
        return Inertia::render('PhoneBooks/Create');
    }

    /**
     * Show the form for creating a new phone book.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => ['required','min:6'],
            'phone_number' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', new CountryCodeRule],
            'tz_name' => ['required', new TimeZoneRule],
        ])->validate();

        PhoneBook::create($request->all());

        return redirect()->route('phonebook.index');
    }


    /**
     * Edit PhoneBook by id VIEW
     *
     * @return response()
     */
    public function edit($id, PhoneBook $phoneBook)
    {
        $item = $phoneBook->find($id)->first();
        return Inertia::render('PhoneBooks/Edit', [
            'phoneBook' => $item
        ]);
    }


    /**
     * Show the form for updating.
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        Validator::make($request->all(), [
            'first_name' => ['min:6'],
            'phone_number' => ['min:6', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'country_code' => ['required', new CountryCodeRule],
            'tz_name' => ['required', new TimeZoneRule],
        ])->validate();

        PhoneBook::find($id)->update($request->all());
        return redirect()->route('phonebook.index');
    }

    /**
     * Delete BhoneBook item by ID.
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $item = $this->model->findOrFail($id);
            $item->delete();
            return $this->index();
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }

}
