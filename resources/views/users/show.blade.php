@extends('layouts.master')
@section('heading')
     My Profile
@endsection
    @section('content')
    @include('partials.userheader')



   @stop 
@push('scripts')
        <script>
        $('#pagination a').on('click', function (e) {
            e.preventDefault();
            var url = $('#search').attr('action') + '?page=' + page;
            $.post(url, $('#search').serialize(), function (data) {
                $('#posts').html(data);
            });
        });


        </script>
@endpush


