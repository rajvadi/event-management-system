@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Create Event</h2>
        <p class="text-sm text-gray-400 mt-1">Add a new event to your platform.</p>
    </div>

    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('events._form')
    </form>
@endsection