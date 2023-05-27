@extends('layouts.master')

@section('style')
    <link href="/build/assets/home.css" rel="stylesheet">
@stop
@section('contents')
    <h2>Record</h2>
    <div id="map_list" style="width:100%"></div>
@stop
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script>
        $.ajax({
            url: "/api/record/show",
            method: "GET",
            dataType: "json"
        })
        .done(function(record_datas) {
            if (record_datas == 'undefined') {
                return;
            }
            console.log(record_datas);
            $.each(record_datas, function(idx, value) {
                $('#map_list').append('<div> user :' + value.user_id + '</div>' + '<div> record :' + value.record + '</div>');
            });
        })
        .fail(function(xhr, status, errorThrown) {
            console.log('error');
        });
	</script>
@stop
