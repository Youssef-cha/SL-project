@extends('layouts.app')
@section('content')
    <div class="search-box">
    <input type="text" name="search" id="search" placeholder="Tapez numéro de commande">

    </div>
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
                var input = $("#search").val();
                $.ajax({
                    method: 'get',
                    url: "{{route('search')}}",
                    data: {
                        search: input
                    },
                    success: function(data) {
                        $("#serchResult").html(data);
                    }
                })
            }
        });
    </script>
@endsection
