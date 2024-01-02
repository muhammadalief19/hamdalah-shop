@extends('layouts.main')

@section('body')
    <div class="flex flex-col gap-3">
        <h1 class="text-3xl font-semibold mb-4">Dashboard</h1>
        <div class="w-3/4 mx-auto">
            @include('partials.stats')
        </div>
    </div>    
@endsection
