@extends('layouts.app')
@section('content')
    @livewire('retours-list', [ 'commande' => $commande->NUM_COMMANDE])
@endsection
