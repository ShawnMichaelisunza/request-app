
        <!-- aside -->
        <aside class="flex w-72 flex-col space-y-2 border-r-2 border-gray-200 bg-white p-2" style="height: 90.5vh"
            x-show="asideOpen">

            <a href="{{route('admin_dashboard')}}" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                <span class="text-2xl"><i class="bx bx-book"></i></span>
                <span>Dashboard</span>
            </a>

            <a href="{{route('ot_index')}}" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                <span class="text-2xl"><i class="bx bx-book"></i></span>
                <span>Overtime</span>
            </a>

            <a href="{{route('cs_index')}}" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                <span class="text-2xl"><i class="bx bx-book"></i></span>
                <span>Change Shift</span>
            </a>


            <a href="{{route('hd_index')}}" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                <span class="text-2xl"><i class="bx bx-book"></i></span>
                <span>Half day/Undertime</span>
            </a>

            <a href="{{route('l_index')}}" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                <span class="text-2xl"><i class="bx bx-book"></i></span>
                <span>Leave</span>
            </a>
            <form action="{{route('logout')}}" method="GET">
                <button type="submit" class="flex items-center space-x-1 rounded-md px-2 py-3 hover:bg-gray-100 hover:text-blue-600">
                    <span class="text-2xl"><i class="bx bx-door-open"></i></span>
                    <span>Logout</span>
                </button>
            </form>
        </aside>
