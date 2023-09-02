
function getRankList(param, type) {
    queryString = "page=" + param.page;
    queryString += "&search_name=" + param.search_name;
    queryString += "&year=" + param.year;
    queryString += "&month_type=" + param.month_type;
    queryString += "&sport_code=" + param.sport_code;
    queryString += "&sport_category=" + param.sport_category;
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

function setRecentPlace() {
    $.ajax({
        url: "/api/record/mypage",
        method: "GET",
        dataType: "json"
    })
    .done(function(datas) {
        if (datas == 'undefined') {
            return;
        }
        $.each(datas.res, function(idx, val) {
            $('#place_img' + idx).html();
            $('#place_name' + idx).html(val.title.substring(0,7));
            $('#place_link' + idx).attr('href','/api/record?map_id=' + val.map_id);
        });
    })
    .fail(function(xhr, status, errorThrown) {
        console.log('error');
    });

}

function app_logout() {
    $.ajax({
        url: "{{ route('logout') }}",
        method: "POST",
        dataType: "json",
        data: "",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(datas) {
        console.log(datas);
        return;
    })
    .fail(function(xhr, status, errorThrown) {
        console.log('error');
    });

    location.href="/api/map";
}

export { getRankList, setRecentPlace, app_logout };
