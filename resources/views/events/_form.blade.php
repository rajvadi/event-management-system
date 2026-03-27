@php
    $isEdit = isset($event);
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="rounded-2xl bg-[#111827] border border-white/10 p-6 shadow-lg">
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-white">
                    {{ $isEdit ? 'Edit Event Details' : 'Create New Event' }}
                </h3>
                <p class="text-sm text-gray-400 mt-1">
                    Fill in the event information below.
                </p>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Event Name <span class="text-red-400">*</span></label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $event->name ?? '') }}"
                        placeholder="Enter event name"
                        class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500"
                    >
                    @error('name')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description <span class="text-red-400">*</span></label>
                    <textarea
                        name="description"
                        rows="5"
                        placeholder="Write event description"
                        class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500"
                    >{{ old('description', $event->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Date & Time <span class="text-red-400">*</span></label>
                        <input
                            type="datetime-local"
                            name="event_datetime"
                            value="{{ old('event_datetime', isset($event->event_datetime) ? \Carbon\Carbon::parse($event->event_datetime)->format('Y-m-d\TH:i') : '') }}"
                            class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-violet-500"
                        >
                        @error('event_datetime')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Status <span class="text-red-400">*</span></label>
                        <select
                            name="status"
                            class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-violet-500"
                        >
                            <option value="">Select status</option>
                            <option value="upcoming" {{ old('status', $event->status ?? '') === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="completed" {{ old('status', $event->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Price <span class="text-red-400">*</span></label>
                        <input
                            type="number"
                            step="0.01"
                            name="price"
                            value="{{ old('price', $event->price ?? '') }}"
                            placeholder="Enter price"
                            class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500"
                        >
                        @error('price')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Capacity <span class="text-red-400">*</span></label>
                        <input
                            type="number"
                            name="capacity"
                            value="{{ old('capacity', $event->capacity ?? '') }}"
                            placeholder="Enter capacity"
                            class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500"
                        >
                        @error('capacity')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-2xl bg-[#111827] border border-white/10 p-6 shadow-lg">
            <h3 class="text-lg font-semibold text-white mb-4">Event Image</h3>

            <div class="space-y-4">
                <div
                    id="imagePreviewContainer"
                    class="relative w-full h-56 rounded-2xl border border-dashed border-white/20 bg-[#0f172a] flex items-center justify-center overflow-hidden cursor-pointer hover:border-violet-500 transition"
                >
                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept="image/*"
                        class="absolute inset-0 opacity-0 cursor-pointer"
                    >

                    <img
                        id="imagePreview"
                        src="{{ isset($event->image) ? asset('storage/' . $event->image) : '' }}"
                        class="w-full h-full object-cover {{ isset($event->image) ? '' : 'hidden' }}"
                    >

                    <div id="placeholderText" class="text-center text-gray-400 {{ isset($event->image) ? 'hidden' : '' }}">
                        <p class="text-sm">Click to upload image</p>
                        <p class="text-xs mt-1">PNG, JPG, WEBP</p>
                    </div>
                </div>

                @error('image')
                    <p class="text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="rounded-2xl bg-[#111827] border border-white/10 p-6 shadow-lg">
            <h3 class="text-lg font-semibold text-white mb-4">Actions</h3>

            <div class="space-y-3">
                <button
                    type="submit"
                    id="submitBtn"
                    class="w-full rounded-xl bg-violet-600 hover:bg-violet-500 px-4 py-3 font-medium text-white transition cursor-pointer"
                >
                    {{ $isEdit ? 'Update Event' : 'Create Event' }}
                </button>

                <a
                    href="{{ route('events.index') }}"
                    class="block w-full rounded-xl bg-white/5 border border-white/10 px-4 py-3 text-center font-medium text-gray-300 hover:bg-white/10 transition"
                >
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submitBtn');

        if (form && submitBtn) {
            form.addEventListener('submit', function () {
                submitBtn.disabled = true;
                submitBtn.innerText = 'Processing...';
                submitBtn.classList.add('opacity-70', 'cursor-not-allowed');
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('imagePreview');
        const placeholder = document.getElementById('placeholderText');

        if (input) {
            input.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (!file) {
                    preview.src = '';
                    preview.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                    return;
                }
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                };

                reader.readAsDataURL(file);
            });
        }
    });
</script>