<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Create New Election</h1>

    <form wire:submit.prevent="createElection" class="space-y-6">
        <div>
            <label class="block text-sm font-medium mb-2">Election Name</label>
            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2" required>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea wire:model="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Start Date & Time</label>
                <input type="datetime-local" wire:model="starts_at" class="w-full border rounded px-3 py-2" required>
                @error('starts_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">End Date & Time</label>
                <input type="datetime-local" wire:model="ends_at" class="w-full border rounded px-3 py-2" required>
                @error('ends_at') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-t pt-6">
            <h2 class="text-xl font-bold mb-4">Candidates</h2>
            
            @foreach($candidates as $index => $candidate)
                <div class="bg-gray-50 p-4 rounded mb-3">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-semibold">{{ $candidate['name'] }}</h3>
                        <button type="button" wire:click="removeCandidate({{ $index }})" class="text-red-500">Remove</button>
                    </div>
                    @if($candidate['bio'])
                        <p class="text-sm text-gray-600">{{ $candidate['bio'] }}</p>
                    @endif
                </div>
            @endforeach

            <div class="bg-blue-50 p-4 rounded">
                <h3 class="font-semibold mb-3">Add Candidate</h3>
                <div class="space-y-3">
                    <input type="text" wire:model="newCandidate.name" placeholder="Candidate Name" class="w-full border rounded px-3 py-2">
                    <textarea wire:model="newCandidate.bio" placeholder="Bio (optional)" class="w-full border rounded px-3 py-2" rows="2"></textarea>
                    <button type="button" wire:click="addCandidate" class="bg-blue-500 text-white px-4 py-2 rounded">Add Candidate</button>
                </div>
            </div>
            @error('candidates') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded font-semibold">Create Election</button>
        </div>
    </form>
</div>
