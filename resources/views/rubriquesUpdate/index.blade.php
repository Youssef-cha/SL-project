@extends('layouts.app')
@section('content')
    <div class="search-box">
        <input type="text" name="" id="search" placeholder="tapez reference rubrique" >
    </div>
    @session('error')
            <div class="pop-up-error">
                {{ $value }}
            </div>
        @endsession
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
                    url: "{{ route('editRubrique') }}",
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
