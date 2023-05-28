@extends('layouts.master')

@section('style')
    <link href="/build/assets/home.css" rel="stylesheet">
@stop
@section('contents')
    <div class="col ml-3 mt-3">
        <span class="h1 text-dark">미진수영장</span>
        <span class="h3 text-dark">순위</span>
    </div>
    <div class="col" style="height:1em; background-color:whitesmoke"></div>
    <main class="container">
        <div class="row g-5">
            <!--div class="col-3">
                <div class="map-content-img-item">
                    <img src="https://search.pstatic.net/common/?src=https%3A%2F%2Fldb-phinf.pstatic.net%2F20150831_112%2F1440987756524Gez5F_JPEG%2F11866967_0.jpg"/>
                </div>
            </div-->
            <div class="col-5">
                <div class="map-content--item">
                    <span class="h3 text-dark">50m</span>
                    <div id="map_list" style="width:100%"></div>
                    <table class="table" id="record_rank_list_type1">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">기록</th>
                            <th scope="col">인증</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan='4'>no record</td></tr>
                        </tbody>
                    </table>
                    <nav aria-label="..." id="record_rank_pagination_type1">
                        <ul class="pagination pagination-sm">
                            <li class="page-item active" aria-current="page">
                                <span class="page-link record_rank_pagination_type1_item" data="1">1</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-5">
                <div class="map-content--item">
                    <span class="h3 text-dark">100m</span>
                    <div id="map_list" style="width:100%"></div>
                    <table class="table" id="record_rank_list_type2">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID</th>
                            <th scope="col">기록</th>
                            <th scope="col">인증</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan='4'>no record</td></tr>
                        </tbody>
                    </table>
                    <div class="col  align-self-center">
                        <nav aria-label="..." id="record_rank_pagination_type2">
                            <ul class="pagination pagination-sm">
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link record_rank_pagination_type2_item" data="1">1</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="map_list" style="width:100%"></div>
@stop
@section('javascript')
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
	<script>
        getRankList(1);
        function getRankList(page_id) {
            $.ajax({
                url: "/api/record/show?page=" + page_id,
                method: "GET",
                dataType: "json"
            })
            .done(function(datas) {
                if (datas == 'undefined') {
                    return;
                }
                setRankList(datas, page_id);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('error');
            });

        }

        function setRankList(datas, page_id) {
            record_datas = datas.data;
            record_count = datas.count;
            if (record_datas.length > 0) {
                $('#record_rank_list_type1 tbody').empty();
                $('#record_rank_pagination_type1 ul').empty();
            }
            $.each(record_datas, function(idx, value) {
                if (idx >= 10) return;
                $('#record_rank_list_type1 tbody').append("<tr>"
                        + "<th scope='row'>" + (idx + 1) + "</th>"
                        + "<td>" + value.user_id + "</td>"
                        + "<td>" + value.record + "</td>"
                        + "<td></td>"
                        + "</tr>");
            });
            if (record_count > 10) {
                for (var i = 0; i <= record_count / 10; i++) {
                    if (i == 10) return;
                    page_id_active = "";
                    if ((i + 1) == page_id) {
                        page_id_active = " active";
                    }
                    $('#record_rank_pagination_type1 ul').append('<li class="page-item' + page_id_active + '" aria-current="page">'
                                + '<span class="page-link record_rank_pagination_type1_item"' + 'data="' + (i + 1) + '">' + (i + 1) + '</span>'
                                + '</li>');
                }
            }
            $('.record_rank_pagination_type1_item').on('click', function() {
                record_id = $(this).attr('id');
                getRankList($(this).attr('data'));
            });
        }
	</script>
@stop
