@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-white">Edit Event</h2>
        <p class="text-sm text-gray-400 mt-1">Update the selected event details.</p>
    </div>

    <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('events._form')
    </form>
@endsection