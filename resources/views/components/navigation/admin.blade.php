<aside
   class="fixed inset-y-0 left-0 bg-white text-white z-40 sidebar-transition transition-all duration-300 ease-in-out flex flex-col justify-between rounded-r-2xl shadow-xl border border-r-gray-200"
        :class="sidebarOpen ? 'w-64' : 'w-22'">
    <div>
        <div class="flex flex-col items-center py-4">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-12 h-12" />
            <span class="mt-2 text-gray-800 font-semibold text-sm transition-opacity duration-200"
                  :class="{ 'opacity-0 hidden': !sidebarOpen, 'opacity-100': sidebarOpen }">
                FDM Bulungan
            </span>
        </div>
        <nav class="px-4 py-2 space-y-2">
             <a href=""
                   class="flex items-center px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.home') ? 'bg-[#009999] font-semibold' : 'text-gray-900 hover:bg-gray-100' }}"
                   :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">
                    <i class="fa-solid fa-house" :class="{ 'text-lg': !sidebarOpen }"></i>
                    <span class="ml-3 transition-opacity duration-200"
                          :class="{ 'opacity-0 hidden': !sidebarOpen, 'opacity-100': sidebarOpen }">
                        Dashboard
                    </span>
                </a>
            <a href=""
                   class="flex items-center px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.home') ? 'bg-[#009999] font-semibold' : 'text-gray-900 hover:bg-gray-100' }}"
                   :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">
                    <i class="fa-solid fa-clipboard" :class="{ 'text-lg': !sidebarOpen }"></i>
                    <span class="ml-3 transition-opacity duration-200"
                          :class="{ 'opacity-0 hidden': !sidebarOpen, 'opacity-100': sidebarOpen }">
                        Penerimaan
                    </span>
                </a>
            <a href=""
                   class="flex items-center px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.home') ? 'bg-[#009999] font-semibold' : 'text-gray-900 hover:bg-gray-100' }}"
                   :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">
                    <i class="fa-solid fa-seedling" :class="{ 'text-lg': !sidebarOpen }"></i>
                    <span class="ml-3 transition-opacity duration-200"
                          :class="{ 'opacity-0 hidden': !sidebarOpen, 'opacity-100': sidebarOpen }">
                        Penyemaian
                    </span>
                </a>
            <a href=""
                   class="flex items-center px-3 py-2 rounded-xl transition-all duration-200 {{ request()->routeIs('admin.home') ? 'bg-[#009999] font-semibold' : 'text-gray-900 hover:bg-gray-100' }}"
                   :class="{ 'justify-center': !sidebarOpen, 'justify-start': sidebarOpen }">
                    <i class="fa-solid fa-magnifying-glass" :class="{ 'text-lg': !sidebarOpen }"></i>
                    <span class="ml-3 transition-opacity duration-200"
                          :class="{ 'opacity-0 hidden': !sidebarOpen, 'opacity-100': sidebarOpen }">
                        Inspeksi
                    </span>
                </a>
        </nav>
    </div>
</aside>
