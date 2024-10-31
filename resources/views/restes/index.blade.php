@extends('layouts.app')
@section('content')

    <div class="search-box">
        <input type="text" name="" id="search"placeholder="tapez annee Budgetaire" >
        <button id="searchBtn" type="submit">chercher</button>
    </div>
    <div id="serchResult">
    </div>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#searchBtn").on("click", request);

            function request() {
                var input = $("#search").val();
                $.ajax({
                    method: 'get',
                    url: "{{ route('reste') }}",
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
