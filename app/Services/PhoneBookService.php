<?php

namespace App\Services;

use App\Models\PhoneBook;

class PhoneBookService
{
    /**
     * get phone books with pagination
     * @return mixed
     */
    public function get_by_pagination():mixed
    {
       return   PhoneBook::paginate(15);
    }

    /**
     * @param array $data
     * @return void
     */
    public function create(array $data): void
    {
        PhoneBook::create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return void
     */
    public function update($id,array $data): void
    {
        PhoneBook::find($id)->update($data);
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id) : void
    {
        $item = PhoneBook::findOrFail($id);
        $item->delete();
    }
}
