
    <div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 flex flex-col"> 
        <div class="bg-white shadow-sm border-b border-green-100 flex-shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <x-app-logo class="w-8 h-8 sm:w-10 sm:h-10" />
                        </div> 
                    </div>
                    
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm text-gray-600">Welcome back,</p>
                            <p class="text-lg font-semibold text-green-700">{{ auth()->user()->name ?? 'Administrator' }}</p>
                        </div>
                        <div class="text-right sm:hidden">
                            <p class="text-sm font-semibold text-green-700">{{ auth()->user()->name ?? 'Admin' }}</p>
                        </div>
                        <div class="h-8 w-8 sm:h-10 sm:w-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="h-4 w-4 sm:h-6 sm:w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-6 sm:py-12">
            <div class="w-full max-w-5xl">
                <div class="bg-white rounded-2xl shadow-lg border border-green-100 overflow-hidden">
                    <div class="p-6 sm:p-8 lg:p-12">
                        <div class="text-center"> 
                            <div class="mb-6 sm:mb-8">
                                <div class="flex justify-center mb-4">
                                    <x-app-logo class="w-12 h-12 sm:w-16 sm:h-16" />
                                </div>
                                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-green-800 mb-2 sm:mb-4">
                                    Welcome to Resume Mansion
                                </h1>
                                <h2 class="text-lg sm:text-xl lg:text-2xl font-semibold text-green-600 mb-4 sm:mb-6">
                                    Admin Panel
                                </h2>
                                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed px-4 sm:px-0">
                                    Your centralized hub for managing resume services, helping professionals create outstanding resumes, 
                                    and building successful careers.
                                </p>
                            </div>
                             
                            <div class="flex justify-center">
                                <div class="bg-green-50 p-4 sm:p-6 rounded-xl border border-green-200 max-w-md w-full">
                                    <p class="text-green-700 font-medium text-base sm:text-lg">
                                        Ready to make a difference in people's careers?
                                    </p>
                                    <p class="text-green-600 mt-2 text-sm sm:text-base">
                                        Use the navigation menu to access all administrative functions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        <div class="bg-white border-t border-green-100 flex-shrink-0">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                <div class="text-center text-gray-600">
                    <p class="text-sm sm:text-base">&copy; {{ date('Y') }} Resume Mansion. All rights reserved.</p> 
                </div>
            </div>
        </div>
    </div> 