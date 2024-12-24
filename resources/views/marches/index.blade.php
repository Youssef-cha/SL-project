@extends('layouts.app')
@section('content')
    @livewire('marches-list', [ 'appelOffre' => $appelOffre->numero_appel_offre])
@endsection
