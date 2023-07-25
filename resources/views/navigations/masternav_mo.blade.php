<header class="bd-header">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <div class="col mr-4">
                @yield('masternav_extra_item')
            </div>
        </div>

        <div style="max-width:70%" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <span style="text-align: start">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </span>
                @if (Auth::check())
                    <span style="text-align: end">
                        <a  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg style="display:inline;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                        </a>
                        <div class="dropdown me-1">
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" aria-current="page" href="/logout">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </span>
                    <script> var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
                        var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                            return new bootstrap.Dropdown(dropdownToggleEl);
                        })
                    </script>
                @endif
            </div>
            <div class="offcanvas-body">
                @if (Auth::check())
                <div class="container">
                    <!-- Three columns of text below the carousel -->
                    <div class="row">
                        <div class="col" style="text-align:center">
                            <svg  style="display:inline;" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                        <h2 style="text-align:center" class="fw-normal mt-2">
                            <p class="fs-6" style="font-weight:normal">
                                {{ Auth::user()->name }}
                            </p>
                            <p class="fs-6" style="font-weight:light">
                                {{ Auth::user()->email }}
                            </p>
                        </h2>
                        <p></p>
                    </div>
                </div>
                <div class="container mt-5">
                    <!-- Three columns of text below the carousel -->
                    <div class="row">
                        <div class="col-4" style="text-align:center">
                            <a id="place_link0" href="/api/record">
                                <svg id="place_img0" style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                                <p id="place_name0">장소</p>
                            </a>
                        </div>
                        <div class="col-4" style="text-align:center">
                            <a id="place_link0" href="/api/record">
                                <svg id="place_img1" style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                                <p id="place_name1">+</p>
                            </a>
                        </div>
                        <div class="col-4" style="text-align:center">
                            <a id="place_link0" href="/api/record">
                                <svg id="place_img2" style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                                <p id="place_name2">+</p>
                            </a>
                       </div>
                    </div>
                </div>
                @else
                <div class="container">
                    <!-- Three columns of text below the carousel -->
                    <div class="row">
                        <div class="col" style="text-align:center">
                            <svg  style="display:inline;" xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                        <h2 style="text-align:center" class="fw-normal mt-2"><a style="display:inline;" style="font-weight:bold" class="nav-link active" aria-current="page" href="/login">로그인</a></h2>
                        <p></p>
                    </div>
                </div>
                <div class="container mt-5">
                    <!-- Three columns of text below the carousel -->
                    <div class="row">
                        <div class="col-4" style="text-align:center">
                            <svg style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                            <p>장소</p>
                        </div>
                        <div class="col-4" style="text-align:center">
                            <svg style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                            <p>+</p>
                        </div>
                        <div class="col-4" style="text-align:center">
                            <svg style="display:inline;" class="bd-placeholder-img rounded-circle" width="36" height="36" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#dddddd"/></svg>
                            <p>+</p>
                       </div>
                    </div>
                </div>
                @endif
                <hr class="mt-3">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col">
                            <h2 style="color:black" class="fw-normal fs-3"><a class="nav-link active" aria-current="page" {{ Auth::check() ? 'href=/mypage/record' : 'href=/login'  }} >내 기록조회</a></h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mt-2">
                            <h2 style="color:black" class="fw-normal fs-3"><a class="nav-link active" aria-current="page" {{ Auth::check() ? 'href=/mypage/ranking' : 'href=/login'  }} >뱃지.랭킹</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
@if (Auth::check())
<script>
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
                console.log(datas);
                if (datas == 'undefined') {
                    return;
                }
                $.each(datas.res, function(idx, val) {
                    console.log(idx);
                    console.log(val);
                    console.log($('#place_name' + idx));
                    $('#place_img' + idx).html();
                    $('#place_name' + idx).html(val.title.substring(0,7));
                    $('#place_link' + idx).attr('href','/api/record?map_id=' + val.map_id);
                });
            })
            .fail(function(xhr, status, errorThrown) {
                console.log('error');
            });

        }

        setRecentPlace();
</script>
@endif

@yield('masternav_script')