@extends('layouts.app')
@section('content')
    @livewire('efps-list', [ 'complexe' => $complexe->id])
@endsection
