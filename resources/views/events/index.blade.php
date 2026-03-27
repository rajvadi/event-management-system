@extends('layouts.app')

@section('content')
    <div class="space-y-6">

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <div class="rounded-2xl bg-[#111827] border border-white/10 p-5 shadow-lg">
                <p class="text-sm text-gray-400">Total Events</p>
                <h3 class="text-3xl font-bold mt-2">{{ $events->total() }}</h3>
            </div>

            <div class="rounded-2xl bg-[#111827] border border-white/10 p-5 shadow-lg">
                <p class="text-sm text-gray-400">Upcoming</p>
                <h3 class="text-3xl font-bold mt-2 text-yellow-400">
                    {{ \App\Models\Event::where('status', 'upcoming')->count() }}
                </h3>
            </div>

            <div class="rounded-2xl bg-[#111827] border border-white/10 p-5 shadow-lg">
                <p class="text-sm text-gray-400">Completed</p>
                <h3 class="text-3xl font-bold mt-2 text-emerald-400">
                    {{ \App\Models\Event::where('status', 'completed')->count() }}
                </h3>
            </div>

            <div class="rounded-2xl bg-[#111827] border border-white/10 p-5 shadow-lg">
                <p class="text-sm text-gray-400">Page Results</p>
                <h3 class="text-3xl font-bold mt-2 text-violet-400">{{ $events->count() }}</h3>
            </div>
        </div>

        <!-- Filters -->
        <div class="rounded-2xl bg-[#111827] border border-white/10 p-5 shadow-lg">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-white">All Events</h3>
                    <p class="text-sm text-gray-400">Search, filter and manage event records</p>
                </div>

                <form method="GET" action="{{ route('events.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3 w-full lg:w-auto">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by event name..."
                        class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white placeholder:text-gray-500 focus:outline-none focus:ring-2 focus:ring-violet-500"
                    >

                    <select
                        name="status"
                        class="w-full rounded-xl bg-[#0f172a] border border-white/10 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-violet-500"
                    >
                        <option value="">All Status</option>
                        <option value="upcoming" {{ request('status') == 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <button
                        type="submit"
                        class="rounded-xl bg-violet-600 hover:bg-violet-500 px-4 py-3 font-medium text-white transition cursor-pointer"
                    >
                        Apply Filter
                    </button>
                </form>
            </div>
        </div>

        <!-- Desktop Table -->
        <div class="hidden xl:block rounded-2xl bg-[#111827] border border-white/10 shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-white/5 border-b border-white/10">
                        <tr class="text-left text-sm text-gray-400">
                            <th class="px-6 py-4">Event</th>
                            <th class="px-6 py-4">Date & Time</th>
                            <th class="px-6 py-4">Price</th>
                            <th class="px-6 py-4">Capacity</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        @forelse($events as $event)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-5">
                                        @if($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}"
                                                 alt="{{ $event->name }}"
                                                 class="w-20 h-20 rounded-xl object-cover border border-white/10">
                                        @else
                                            <div class="w-20 h-20 rounded-xl bg-[#0f172a] border border-white/10 flex items-center justify-center text-gray-500 text-xs">
                                                No Image
                                            </div>
                                        @endif

                                        <div>
                                            <h4 class="font-semibold text-white">{{ $event->name }}</h4>
                                            <p class="text-sm text-gray-400 line-clamp-1">
                                                {{ $event->description }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-300">
                                    {{ \Carbon\Carbon::parse($event->event_datetime)->format('d M Y, h:i A') }}
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-300">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-violet-500/10 border border-violet-500/20 text-violet-300 font-semibold text-sm">
                                        ₹{{ number_format($event->price, 2) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-300">
                                    {{ $event->capacity }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        {{ $event->status === 'upcoming' ? 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/20' : 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/20' }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('events.edit', $event->id) }}"
                                           class="rounded-lg bg-blue-500/15 border border-blue-500/20 px-4 py-2 text-sm text-blue-300 hover:bg-blue-500/25 transition">
                                            Edit
                                        </a>

                                        <button
                                            type="button"
                                            onclick="openDeleteModal('{{ route('events.destroy', $event->id) }}')"
                                            class="rounded-lg bg-red-500/15 border border-red-500/20 px-4 py-2 text-sm text-red-300 hover:bg-red-500/25 transition cursor-pointer">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-gray-400">
                                    <div class="text-center py-16">
                                        <div class="text-6xl mb-4">📭</div>
                                        <h3 class="text-xl font-semibold text-white">No events found</h3>
                                        <p class="text-gray-400 mt-2">Try adjusting filters or create a new event.</p>

                                        <a href="{{ route('events.create') }}"
                                        class="inline-block mt-6 px-6 py-3 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-medium">
                                            Create Event
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Mobile / Tablet Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:hidden gap-5">
            @forelse($events as $event)
                <div class="rounded-2xl bg-[#111827] border border-white/10 shadow-lg overflow-hidden">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}"
                             alt="{{ $event->name }}"
                             class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-[#0f172a] flex items-center justify-center text-gray-500 border-b border-white/10">
                            No Image Available
                        </div>
                    @endif

                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3">
                            <h3 class="text-lg font-semibold text-white">{{ $event->name }}</h3>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                {{ $event->status === 'upcoming' ? 'bg-yellow-500/15 text-yellow-300 border border-yellow-500/20' : 'bg-emerald-500/15 text-emerald-300 border border-emerald-500/20' }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>

                        <p class="mt-2 text-sm text-gray-400 line-clamp-2">
                            {{ $event->description }}
                        </p>

                        <div class="mt-4 space-y-2 text-sm text-gray-300">
                            <p><span class="text-gray-400">Date:</span> {{ \Carbon\Carbon::parse($event->event_datetime)->format('d M Y, h:i A') }}</p>
                            <p><span class="text-gray-400">Price:</span> ₹{{ number_format($event->price, 2) }}</p>
                            <p><span class="text-gray-400">Capacity:</span> {{ $event->capacity }}</p>
                        </div>

                        <div class="mt-5 flex gap-3">
                            <a href="{{ route('events.edit', $event->id) }}"
                               class="flex-1 text-center rounded-xl bg-blue-500/15 border border-blue-500/20 px-4 py-2.5 text-sm font-medium text-blue-300 hover:bg-blue-500/25 transition">
                                Edit
                            </a>

                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full rounded-xl bg-red-500/15 border border-red-500/20 px-4 py-2.5 text-sm font-medium text-red-300 hover:bg-red-500/25 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 rounded-2xl bg-[#111827] border border-white/10 p-10 text-center">
                    <h3 class="text-lg font-semibold text-white">No events found</h3>
                    <p class="text-sm text-gray-400 mt-2">Try changing the filter or create a new event.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($events->count())
            <div class="rounded-2xl bg-[#111827] border border-white/10 p-4">
                @if ($events->hasPages())
                    <div class="flex items-center justify-between">

                        <!-- Previous -->
                        @if ($events->onFirstPage())
                            <span class="px-4 py-2 text-gray-500">← Prev</span>
                        @else
                            <a href="{{ $events->previousPageUrl() }}"
                            class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition">
                                ← Prev
                            </a>
                        @endif

                        <!-- Pages -->
                        <div class="flex items-center gap-2">
                            @foreach ($events->getUrlRange(1, $events->lastPage()) as $page => $url)
                                @if ($page == $events->currentPage())
                                    <span class="px-4 py-2 rounded-lg bg-violet-600 text-white font-semibold">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                    class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        <!-- Next -->
                        @if ($events->hasMorePages())
                            <a href="{{ $events->nextPageUrl() }}"
                            class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition">
                                Next →
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-500">Next →</span>
                        @endif

                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection