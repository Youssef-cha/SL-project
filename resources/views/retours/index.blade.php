@extends('layouts.app')
@section('content')
    <table class="afftable">
        <tr>
            <th>id</th>
            <th>RESPONSABLE</th>
            <th>MOTIF</th>
            <th>Date Retour</th>
        </tr>
        @foreach ($commande->retours as $retour)
        <tr>
            <th>{{$retour->id}}</th>
            <td>{{$retour->RESPONSABLE}}</td>
            <td>{{$retour->motif}}</td>
            <td>{{$retour->date_retour}}</td>
       
        </tr>
        @endforeach
    </table>
    <!-- <button><a href="{{route('commandes.retours')}}" class="btn2">retour</a></button> -->
    <a style="margin:auto" href="{{route('commandes.retours')}}" class="btn2">retour</a>
@endsection