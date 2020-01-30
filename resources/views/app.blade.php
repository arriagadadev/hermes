@extends('template.main')

@section('title', 'Hermes Platform')

@section('content')	
	<h4>{{ Auth::user()->lastOrganizationDisplayed->name }}</h4>
	<router-view></router-view>
@endsection