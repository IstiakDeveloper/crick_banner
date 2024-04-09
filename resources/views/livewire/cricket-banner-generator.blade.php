<div class="p-6 max-w-xl mx-auto bg-white rounded-lg shadow-md">
    @if(!$generatedBannerUrl)
    <!-- Display the form only if banner is not generated -->
    <form wire:submit.prevent="generateBanner">
        <div class="mb-4">
            <label for="teamName" class="block text-sm font-medium text-gray-700">Team Name:</label>
            <input type="text" wire:model="teamName" id="teamName" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>
        <div class="mb-4">
            <label for="teamTagline" class="block text-sm font-medium text-gray-700">Team Tagline:</label>
            <input type="text" wire:model="teamTagline" id="teamTagline" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
        </div>

        <h2 class="text-lg font-medium text-gray-900">Players</h2>
        @foreach($players as $index => $player)
            <div class="mt-4" wire:key="player-field-{{ $index }}">
                <label for="playerName{{ $index }}" class="block text-sm font-medium text-gray-700">Player Name:</label>
                <input type="text" wire:model="players.{{ $index }}.name" id="playerName{{ $index }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mt-4">
                <label for="playerRole{{ $index }}" class="block text-sm font-medium text-gray-700">Player Role:</label>
                <select wire:model="players.{{ $index }}.role" id="playerRole{{ $index }}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="">Select Role</option>
                    <option value="Batsman">Batsman</option>
                    <option value="Bowler">Bowler</option>
                    <option value="All Rounder">All Rounder</option>
                    <option value="Wicket Keeper">Wicket Keeper</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="playerPhoto{{ $index }}" class="block text-sm font-medium text-gray-700">Player Photo:</label>
                <input type="file" wire:model="players.{{ $index }}.photo" id="playerPhoto{{ $index }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="mt-2">
                <button type="button" wire:click="removePlayer({{ $index }})" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring-red active:bg-red-700 transition ease-in-out duration-150">
                    Remove Player
                </button>
            </div>
        @endforeach

        <div class="mt-4">
            <button type="button" wire:click="addPlayer" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                Add Player
            </button>
        </div>

        <div class="mt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring-green active:bg-green-700 transition ease-in-out duration-150">
                Generate Banner
            </button>
        </div>
    </form>
    @endif

    @if($generatedBannerUrl)
    <!-- Display the generated banner -->
    <div class="mt-4">
        <img src="{{ $generatedBannerUrl }}" alt="Generated Banner" class="max-w-full h-auto">
    </div>
    <!-- Provide download link for the banner -->
    <div class="mt-4">
        <a href="{{ $generatedBannerUrl }}" download="{{ $teamName }}_banner.jpg" class="inline-block px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:ring-indigo active:bg-indigo-700 transition ease-in-out duration-150">Download Banner</a>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="mt-4 text-red-500">{{ session('error') }}</div>
    @endif

</div>
