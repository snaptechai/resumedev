<div id="image-modal" class="fixed inset-0 z-50 overflow-auto bg-black/60 backdrop-blur-sm hidden">
    <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl mx-auto my-12 max-w-2xl w-full transform transition-all">
        <div class="flex items-center justify-between p-2 border-b dark:border-gray-700">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                Template Image
            </h3>
            <button type="button" onclick="closeModal('image-modal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white bg-transparent hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div class="bg-white p-4 rounded">
            <img id="modal-image" src="" alt="Template Image" class="w-150 h-auto"> 
        </div>
    </div>
</div> 