<x-layout>

    <table class="min-w-full border-collapse block md:table">
        <caption></caption>
        <thead class="block md:table-header-group">
            <tr
                class="border border-grey-500 md:border-none block md:table-row absolute -top-full md:top-auto -left-full md:left-auto  md:relative ">
                <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">ID
                </th>
                <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">Name
                </th>
                <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                    Description</th>
                <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                    Number of flights operated</th>
                <th class="bg-purple-400 p-2 text-white md:border md:border-grey-500 text-left block md:table-cell">
                    Actions</th>
            </tr>
        </thead>

        <tbody class="block md:table-row-group">
            @foreach ($content as $airline)
                <tr>
                    @foreach ($airline as $attribute => $data)
                        @if ($attribute == 'id' || $attribute == 'name' || $attribute == 'description')
                            <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                                {{ $data }}
                            </td>
                        @endif
                    @endforeach

                    <td class="p-2 md:border md:border-grey-500 text-center block md:table-cell">
                        {{ count($airline['flights']) }}</td>

                    <td class="p-2 md:border md:border-grey-500 text-left block md:table-cell">
                        <button
                            class="bg-purple-400 hover:bg-purple-800 text-white py-1 px-2 border rounded-full">Edit</button>
                        <button
                            class="bg-red-500 hover:bg-red-700 text-white py-1 px-2 border rounded-full">Delete</button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- -INPUT FIELD --}}

    <div class="flex justify-center py-10">
        <div class="mb-3 xl:w-96 ">

            <label for="label_input_airline" class="form-label inline-block mb-2 text-gray-700">Register a new
                airline!</label>

            <input type="text"
                class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                id="input_airline_name" placeholder="Name" />

            <div class="py-3">

                <input type="text"
                    class="
        form-control
        block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    id="input_airline_name" placeholder="Description" />

            </div>
        </div>
    </div>


</x-layout>
