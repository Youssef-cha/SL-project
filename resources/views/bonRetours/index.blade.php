@extends('layouts.app')
@section('content')
    @livewire('bon-retours-list', ['bonCommande' => $bonCommande->id])
@endsection
