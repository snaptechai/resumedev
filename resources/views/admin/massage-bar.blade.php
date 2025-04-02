
<div>
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
            class="relative p-4 m-5 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-2 text-green-700">
                &times;
            </button>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
            class="relative p-4 m-5 text-red-700 bg-red-100 border border-red-400 rounded">
            {{ session('error') }}
            <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-2 text-red-700">
                &times;
            </button>
        </div>
    @endif
</div> 