@extends('template.sign')

@section('title', 'Sign In')

@section('content')
    <h4 class="fw-300 c-grey-900 mB-40">Select an organization</h4>
    <div class="list-group">
        @foreach ($organizations as $organization)
            <a href="{{ $organization->route }}" class="list-group-item list-group-item-action">{{ $organization->name }}</a>
        @endforeach
    </div>
@endsection