<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f172a] text-white min-h-screen">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="hidden lg:flex w-64 bg-[#111827] border-r border-white/10 flex-col">
            <div class="px-6 py-6 border-b border-white/10">
                <h1 class="text-2xl font-bold tracking-wide text-white">EventHub</h1>
                <p class="text-sm text-gray-400 mt-1">Event Admin Panel</p>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('events.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-violet-600 text-white font-medium">
                    <span>📅</span>
                    <span>Events</span>
                </a>

                <a href="{{ route('events.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-300 hover:bg-white/5 transition">
                    <span>➕</span>
                    <span>Create Event</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Topbar -->
            <header class="bg-[#111827]/80 backdrop-blur border-b border-white/10">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Event Dashboard</h2>
                        <p class="text-sm text-gray-400">Manage your event listings and details</p>
                    </div>

                    <a href="{{ route('events.create') }}"
                       class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-violet-600 hover:bg-violet-500 text-white font-medium shadow-lg shadow-violet-900/30 transition">
                        + Create Event
                    </a>
                </div>
            </header>

            <main class="p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div id="flashMessage"
                        class="mb-6 rounded-xl border border-emerald-500/20 bg-emerald-500/10 px-4 py-3 text-emerald-300 transition-opacity duration-500">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50">
        <div class="bg-[#111827] border border-white/10 rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold text-white mb-2">Delete Event</h3>
            <p class="text-sm text-gray-400 mb-6">
                Are you sure you want to delete this event?
            </p>

            <div class="flex justify-end gap-3">
                <button id="cancelDelete"
                    class="px-4 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-300 hover:bg-white/10 transition">
                    Cancel
                </button>

                <button id="confirmDelete"
                    class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-500 text-white transition cursor-pointer">
                    Delete
                </button>
            </div>
        </div>
    </div>
</body>
<script>
    let deleteUrl = '';

    function openDeleteModal(url) {
        deleteUrl = url;

        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        const btn = document.getElementById('confirmDelete');
        btn.disabled = false;
        btn.innerText = 'Delete';
        btn.classList.remove('opacity-70', 'cursor-not-allowed');
    }

    document.getElementById('cancelDelete').addEventListener('click', function () {
        document.getElementById('deleteModal').classList.add('hidden');
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        const btn = this;

        if (!deleteUrl) return;

        btn.disabled = true;
        btn.innerText = 'Processing...';
        btn.classList.add('opacity-70', 'cursor-not-allowed');

        // create form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = deleteUrl;

        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;

        document.body.appendChild(form);
        form.submit();
    });

    document.addEventListener('DOMContentLoaded', function () {
        const flash = document.getElementById('flashMessage');

        if (flash) {
            setTimeout(() => {
                flash.style.opacity = '0';

                setTimeout(() => {
                    flash.remove();
                }, 500); // wait for fade-out
            }, 3000); // visible for 3 seconds
        }
    });
</script>
</html>