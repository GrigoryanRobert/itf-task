import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Inertia } from "@inertiajs/inertia";
import { Head } from '@inertiajs/react';

export default function Edit(props) {
    // console.log(props);
    const { data, setData, errors, put } = useForm({
        first_name: props.phoneBook.first_name,
        last_name:  props.phoneBook.last_name,
        phone_number:  props.phoneBook.phone_number,
    });

    function handleSubmit(e) {
        e.preventDefault();
        put(route("phonebook.update", props.phoneBook.id));
    }

    return (
       <div>
            <Head title="Update Phone Book" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">

                            <div className="flex items-center justify-between mb-6">
                                <h2
                                    className="px-6 py-2 text-white bg-green-500 rounded-md focus:outline-none"
                                >
                                    Update Phone Book
                                </h2>
                                <div className="flex items-center justify-between mb-6">
                                    <Link
                                        className="px-6 py-2 text-white bg-blue-500 rounded-md focus:outline-none"
                                        href={ route("phonebook.index") }
                                    >
                                        Back
                                    </Link>
                                </div>
                            </div>

                            <form name="createForm" onSubmit={handleSubmit}>
                                <div className="flex flex-col">
                                    <div className="mb-4">
                                        <label className="">First Name</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            label="FirstName"
                                            name="first_name"
                                            value={data.first_name}
                                            onChange={(e) =>
                                                setData("first_name", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.first_name}
                                        </span>
                                    </div>
                                    <div className="mb-4">
                                        <label className="">Last Name</label>
                                        <input
                                            type="text"
                                            className="w-full px-4 py-2"
                                            label="LastName"
                                            name="last_name"
                                            value={data.last_name}
                                            onChange={(e) =>
                                                setData("last_name", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.last_name}
                                        </span>
                                    </div>
                                    <div className="mb-0">
                                        <label className="">Phone Number</label>
                                        <input
                                            type="text"
                                            className="w-full rounded"
                                            label="phoneNumber"
                                            name="phone_number"
                                            errors={errors.phone_number}
                                            value={data.phone_number}
                                            onChange={(e) =>
                                                setData("phone_number", e.target.value)
                                            }
                                        />
                                        <span className="text-red-600">
                                            {errors.phone_number}
                                        </span>
                                    </div>
                                </div>
                                <div className="mt-4">
                                    <button
                                        type="submit"
                                        className="px-6 py-2 font-bold text-white bg-green-500 rounded"
                                    >
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    );
}
