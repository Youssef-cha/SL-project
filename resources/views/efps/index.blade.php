@extends('layouts.app')
@section('content')
    <table class="afftable">
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>creer a</th>
        </tr>
        @foreach ($complexe->efps as $efp)
        <tr>
            <th>{{$efp->id}}</th>
            <td>{{$efp->nom_efp}}</td>
            <td>{{$efp->created_at}}</td>
        </tr>
        @endforeach
    </table>
    <!-- <button><a href="{{route('commandes.retours')}}" class="btn2">retour</a></button> -->
    <a style="margin:auto" href="{{route('complexes.index')}}" class="btn2">retour</a>
@endsection