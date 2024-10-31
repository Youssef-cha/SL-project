@extends('layouts.app')
@section('content')

    <div class="search-box">
        <input type="text" name="" id="search" placeholder="tapez annee Budgetaire" >
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
            request();
            $("#search").on("input", request);
            function request() {
                var input = $("#search").val();
                $.ajax({
                    method: 'get',
                    url: "{{ route('rubrique') }}",
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
