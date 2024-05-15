<div class="relative overflow-x-auto">
    <div class="mb-5">

        <div class="max-w-md mx-auto">
            @include('layout.success')
        </div>
        <form action="{{ route('l_index') }}" method="GET" class="max-w-md mx-auto">
            @csrf
            @include('layout.search')
        </form>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Employee No
                </th>
                <th scope="col" class="px-6 py-3">
                    Full Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Department
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $leave->created_at }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $leave->emp_no }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $leave->emp_name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $leave->position }}
                    </td>
                    <td class="px-6 py-4">
                       @if ($leave->status == "APPROVE")
                           <span class="text-red-500"> {{ $leave->status }}</span>
                           @else
                           <span class="text-blue-500"> {{ $leave->status }}</span>
                       @endif
                    </td>
                    @if ($leave->status == "APPROVE")
                    <td></td>
                    <td></td>
                    @else
                    <td class="px-6 py-4">
                        <form action="{{ route('l_approve', $leave->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="email" value="{{ $leave->email }}">
                            <button
                                class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-3 border border-green-500 hover:border-transparent rounded">Approve</button>
                        </form>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('l_delete', $leave->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <input name="email" type="hidden" value="{{ $leave->email }}">
                            <button
                                class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-3 border border-red-500 hover:border-transparent rounded">
                                Reject
                            </button>
                        </form>
                    </td>
                    @endif
                    <td class="px-6 py-4">
                        <a href="{{ route('l_view', $leave->id) }}"
                            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-3 border border-blue-500 hover:border-transparent rounded">
                            View
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-4 w-11/12 mx-8">
        {{ $leaves->links() }}
    </div>
</div>
