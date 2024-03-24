import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Inertia } from "@inertiajs/inertia";
import { Head } from '@inertiajs/react';

export default function Index({phone_books }) {
    function destroy(e) {
        if (confirm("Are you sure you want to delete this user?")) {
            Inertia.delete(route("phonebook.destroy", e.currentTarget.id));
        }
    }

    return (
       <div>
            <Head title="Phone Books" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">

                            <div className="flex items-center justify-between mb-6">
                                <Link
                                    className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                    href={ route("phonebooks.create") }
                                >
                                    Create Phone Book
                                </Link>
                            </div>

                            <table className="table-fixed w-full">
                                <thead>
                                <tr className="bg-gray-100">
                                    <th className="px-4 py-2 w-20">No.</th>
                                    <th className="px-4 py-2">First Name</th>
                                    <th className="px-4 py-2">Last Name</th>
                                    <th className="px-4 py-2">Phone number</th>
                                    <th className="px-4 py-2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {
                                    phone_books != undefined && phone_books.map(({ id, first_name, last_name, phone_number }) => (
                                    <tr key={id}>
                                        <td className="border px-4 py-2">{ id }</td>
                                        <td className="border px-4 py-2">{ first_name }</td>
                                        <td className="border px-4 py-2">{ last_name }</td>
                                        <td className="border px-4 py-2">{ phone_number }</td>
                                        <td className="border px-4 py-2">
                                            <Link
                                                tabIndex="1"
                                                className="px-4 py-2 text-sm text-white bg-blue-500 rounded"
                                                href={route("phonebook.edit", id)}
                                            >
                                                Edit
                                            </Link>
                                            <button
                                                onClick={destroy}
                                                id={id}
                                                tabIndex="-1"
                                                type="button"
                                                className="mx-1 px-4 py-2 text-sm text-white bg-red-500 rounded"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                ))
                                }

                                { phone_books == undefined || phone_books.length === 0 && (
                                    <tr>
                                        <td
                                            className="px-6 py-4 border-t"
                                            colSpan="4"
                                        >
                                            No contacts found.
                                        </td>
                                    </tr>
                                )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    );
}
