@extends('layouts.master')

@section('style')
    <link href="/build/assets/home.css" rel="stylesheet">
    <style>
    .bd-header {
        position: absolute;
    }
    body {
        overflow-x: hidden;
        overflow-y: hidden;
    }
    </style>
@stop
@section('contents')
    <div class="position-relative" style="margin-top: 60px">
        <!--div id="map" style="width:100%;"></div>
        <div id="map_list_items" style="transform: translate(0px, -50px) !important; z-index:101" class="position-absolute top-100 start-0 d-flex flex-column flex-md-row gap-4 py-md-5 justify-content-center">
            <div class="list-group" id="list-group-handle">
                <div class="col" style="border-radius: 15px 15px 0 0; border-color:#e2e8f0; background-color:white; text-align:center; z-index:102">
                    <div>
                        <svg style="display: inline" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                            <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div-->
        <div></div>
        <main class="container">
            <div class="row">
                <div class="col">
                    <strong id="place_name" class='mr-1'>{{ $user_rank_map_list->title }}</strong>
                </div>
                <div class="col-3">
                    <div class="accordion accordion-flush" style="border:none" id="accordionExample">
                        <div class="accordion-item" style="border:none">
                            <strong>
                                {{ $now_month_type == 'last_half' ? '후반기' : '전반기' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="map-content--item">
                    <span id="first_theme" class="h3 text-dark">50m</span>
                    <div id="map_list" style="width:100%"></div>
                    <table class="table" id="record_rank_list_type1">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">기록</th>
                                <!--th scope="col">인증</th-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td colspan='4'>no record</td></tr>
                        </tbody>
                    </table>
                </div>
                <div id="liveAlertPlaceholder"></div>
            </div>
        </main>
    </div>
@stop
@section('masternav_extra_item')
    <div class="input-group input-group-sm ml-3 mt-1">
        <span class="input-group-text"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-justify" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
            </svg>
        </span>
        <input placeholder="신목로 53" type="text" id="search_map_data" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
        <span class="input-group-text" id="search_map_btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg></span>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=96gg9oc940&submodules=geocoder"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="/build/assets/js/jquery-ui.js"></script>
	<script>

    window.onload  = function() {
        rest_height = 0;
        max_height = 0;
        box = document.getElementById("list-group-handle");
        box.addEventListener('touchmove', function(e) {
            var touchLocation = e.targetTouches[0];
            rest_height = screen.height - touchLocation.pageY - 25;
            max_height = $(document).height() - screen.height;
            if (max_height > rest_height) {
                $("#list-group-handle").css({'transform':'translate(0px, -' + rest_height + 'px)'})
            }
        });

        box.addEventListener('touchend', function(e) {
            var x = parseInt(box.style.left);
            var y = parseInt(box.style.top);
        });
    }

	</script>
@stop

@section('masternav_script')
    <script>
        const now_date = new Date();
        const now_year = now_date.getYear();
        const now_month = now_date.getMonth();
        const month_type = now_month >= 6 ? 'last_half' : 'first_half';
        const sport_code = "short_lane";

        $('#search_map_btn').on('click', function() {
            if ($('#search_map_data').val() == '') {
                return appendAlert('검색어를 입력해주세요.', 'danger');
            }
            findGeocoder($('#search_map_data').val());
        });

        const alertPlaceholder = document.getElementById('navbarCollapse');
        const appendAlert = (message, type) => {
            const wrapper = document.createElement('div');
            if (typeof $('#search_alert_msg') != 'undefined')   $('#search_alert_msg').remove();
            wrapper.innerHTML = [
                `<div id="search_alert_msg" class="alert alert-${type} alert-dismissible" role="alert" style="padding : 0.5em 2.5em 0.5em 0.5em; margin:0em;" >`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding : 0.7em 0.5em; margin:0em;"></button>',
                '</div>'
            ].join('');

            alertPlaceholder.append(wrapper);

            setTimeout(() => {
                if (typeof $('#search_alert_msg') != 'undefined') {
                    $('#search_alert_msg').remove();
                }
            }, 2000);
        }

        search_data = {
            'page' : 1,
            'search_name' : '',
            'year' : now_date.getFullYear(),
            'month_type' : month_type,
            'sport_code' : sport_code
        }

        $('#month_type').val(month_type).change();

        getRankList(search_data, "FIRST");
        getRankList(search_data, "");

        $('#record_rank_pagination_type1').prepend("<div class='mb-2 d-grid gap-2'><button type='button' class='btn btn-sm btn-light fw-bolder fs-6' id='add_record_type1' colspan='4'>+</button></div>");
        $('#record_rank_pagination_type2').prepend("<div class='mb-2 d-grid gap-2'><button type='button' class='btn btn-sm btn-light fw-bolder fs-6' id='add_record_type2' colspan='4'>+</button></div>");

        $('#add_record_type1, #add_record_type2').on('click', function() {
            sport_code_data = "";

            switch ($('#sport_code').val()) {
                case "short_lane":
                    sport_code_data = ($(this).attr('id') == 'add_record_type1') ? '50' : '100';
                    break;
                case "middle_lane":
                    sport_code_data = ($(this).attr('id') == 'add_record_type1') ? '200' : '400';
                    break;
                case "long_lane":
                    sport_code_data = ($(this).attr('id') == 'add_record_type1') ? '800' : '1500';
                    break;
            }

            @if (Auth::check() !== false)
                location.href = "/api/record/edit?type=swim&sport_code=" + sport_code_data + "&map_id=" + '{{ $user_rank_map_list->map_id }}';
            @endif
        });

        function getRankList(param, type) {
            queryString = "page=" + param.page;
            queryString += "&search_name=" + param.search_name;
            queryString += "&year=" + param.year;
            queryString += "&month_type=" + param.month_type;
            queryString += "&sport_code=" + param.sport_code;
            queryString += "&sport_category=" + param.sport_category;
            queryString += "&map_id=" + '{{ $user_rank_map_list->map_id }}';
            $.ajax({
                url: "/api/record/show?" + queryString,
                method: "GET",
                dataType: "json"
            })
            .done(function(datas) {
                if (datas == 'undefined') {
                    return;
                }
                setRankList(datas, param.page, type);
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('error');
            });

        }

        function setRankList(datas, page_id, type) {
            record_datas = datas.data;
            record_datas2 = datas.data2;
            record_count = datas.count;
            record_count2 = datas.count2;

            if (datas.sport_category == 'player') {
                $('#sport_player').addClass('text-primary').removeClass('text-secondary').attr('data', 'Y');
                $('#sport_team').addClass('text-secondary').removeClass('text-primary').attr('data', '');
            } else {
                $('#sport_player').addClass('text-secondary').removeClass('text-primary').attr('data', '');
                $('#sport_team').addClass('text-primary').removeClass('text-secondary').attr('data', 'Y');
            }

            if (type == 'FIRST') {
                $('#record_rank_list_type1 tbody').empty();
                $('#record_rank_pagination_type1 ul').empty();
                $.each(record_datas, function(idx, r_data) {
                    $.each(r_data, function(key, value) {
                        $('#record_rank_list_type1 tbody').append("<tr>"
                            + "<th scope='row'>" + (10 * (page_id - 1) + key + 1) + "</th>"
                            + "<td>" + value.user_id + "</td>"
                            + "<td>" + value.record + "</td>"
                            //+ "<td></td>"
                            + "</tr>");
                    });
                });
                if (record_count == 0) {
                    $('#record_rank_list_type1 tbody').append("<tr><td colspan='4'>no record</td></tr>");
                }

                if (record_count > 10) {
                    for (var i = 0; i < record_count / 10; i++) {
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
                    record_id = $(this).attr('data');
                    search_data = {
                        'page' : record_id,
                        'search_name' : '',
                        'year' : $('select#year').val(),
                        'month_type' : $('select#month_type').val(),
                        'sport_code' : $('select#sport_code').val()
                    }
                    getRankList(search_data, "FIRST");
                });
            } else {
                $('#record_rank_list_type2 tbody').empty();
                $('#record_rank_pagination_type2 ul').empty();
                $.each(record_datas2, function(idx, r2_data) {
                    $.each(r2_data, function(key, value) {
                        $('#record_rank_list_type2 tbody').append("<tr>"
                            + "<th scope='row'>" + (10 * (page_id - 1) + key + 1) + "</th>"
                            + "<td>" + value.user_id + "</td>"
                            + "<td>" + value.record + "</td>"
                            //+ "<td></td>"
                            + "</tr>");
                    });
                });
                if (record_count2 == 0) {
                    $('#record_rank_list_type2 tbody').append("<tr><td colspan='4'>no record</td></tr>");
                }
                if (record_count2 > 10) {
                    for (var i = 0; i < record_count2 / 10; i++) {
                        if (i == 10) return;
                        page_id_active = "";
                        if ((i + 1) == page_id) {
                            page_id_active = " active";
                        }
                        $('#record_rank_pagination_type2 ul').append('<li class="page-item' + page_id_active + '" aria-current="page">'
                                    + '<span class="page-link record_rank_pagination_type2_item"' + 'data="' + (i + 1) + '">' + (i + 1) + '</span>'
                                    + '</li>');
                    }
                }
                $('.record_rank_pagination_type2_item').on('click', function() {
                    record_id = $(this).attr('data');
                    search_data = {
                        'page' : record_id,
                        'search_name' : '',
                        'year' : $('select#year').val(),
                        'month_type' : $('select#month_type').val(),
                        'sport_code' : $('select#sport_code').val()
                    }
                    getRankList(search_data, "");
                });
            }
        }

    </script>
@endsection
