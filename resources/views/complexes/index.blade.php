@extends('layouts.app')
@section('content')

    <div class="search-box">
        <input type="text" name="" id="search" placeholder="tapez nom complexe" >
    </div>
    <a href="{{ route('complexes.create') }}" class="btn-link">ajouter un complexe</a>
    <div id="serchResult">
    </div>
    <script>
        $(document).ready(function() {
            request();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#search").on("input", request);

            function request() {
                
                $.ajax({
                    method: 'get',
                    url: "{{ route('complexes.list') }}",
                    data: {
                        search: $("#search").val()
                    },
                    success: function(data) {
                        $("#serchResult").html(data);
                    }
                })
            }
        });
    </script>
@endsection
