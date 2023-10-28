<header class="header-dashboard d-flex justify-content-between fixed-top">
    <div class="search-form d-none">
        <a href="#" class="btn close-search" id="close-search"><i class="fa-solid fa-xmark"></i></a>
        <input type="text"
               class="form-control dashboard_search_text"
               style="border: none;background: #F2F4F7;"
               v-model="dashboard_search_text"
               @keyup.enter="$router.push({path: '/control/search?query='+dashboard_search_text+'&i='+Math.floor(Math.random() * Math.floor(99)), })"
               placeholder="@lang('nav_bar.Search by appointment, people name, mobile, email or booking reference')">
        <button
            type="submit"
            class="btn"
            @click="$router.push({path: '/control/search?query='+dashboard_search_text+'&i='+Math.floor(Math.random() * Math.floor(99)), })">
            <img src="/images/searchbtn.svg">
        </button>
    </div>
    <div class="btn-open">
        <a href="javascript:void(0);" id="btn" class="d-block btn-menu-toggle" @click="toggleSideBar"><img
                src="{{asset("images/btn-menu.svg")}}"></a>
    </div>

    <div class="links-header">
        <ul>
            <li class="list-inline-item icon-header position-relative btn-notifications d-none">
                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="bottom" title="News" id="btn-notifications"
                   @click="$root.show_popup_notifications">
                    <img  @click="$root.show_popup_notifications" src="{{asset("images/bell.svg")}}">
                    <span  @click="$root.show_popup_notifications" v-if="$root.unread_notification_count"
                          class="position-absolute top-0  translate-middle badge rounded-pill bg-danger d-flex justify-content-center align-items-center"
                          v-html="$root.unread_notification_count">

                      </span>
                </a>
            </li>
            <li class="list-inline-item icon-header d-none"><a href="#" class="bx-search"><img
                        src="{{asset("images/search.svg")}}"></a></li>
            <li class="list-inline-item icon-header d-none"><a href="#"><img src="{{asset("images/rocket.svg")}}"></a>
            </li>
            <li class="list-inline-item icon-header d-none"><a href="#"><img src="{{asset("images/bell.svg")}}"></a>
            </li>
            <li class="list-inline-item dropdown d-none">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <span class="centerProfileTitle flags ">
                        <img style="width: 24px;height: auto;"
                             src="{{auth()->user()->locale == 'ar' ? asset('images/'.'ar.png') : asset('images/'.'en.png')}}"
                             alt="">
                    </span>
                </a>
                <ul class="dropdown-menu text-start d-none" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('changeLocale','ar') }}">
                            <img src="{{asset('images/'.'ar.png')}}" style="width: 24px;height: auto;" alt="">
                            اللغة العربية
                        </a></li>
                    <li><a class="dropdown-item" href="{{ route('changeLocale','en') }}">
                            <img src="{{asset('images/'.'en.png')}}" style="width: 24px;height: auto;" alt="">
                            English</a></li>
                </ul>
            </li>
            <li class="list-inline-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                   aria-expanded="false">
                    <span class="centerProfileTitle navbar-username">{{auth()->user()->name}}</span>

                    <img
                        class="rounded-circle nav-bar-logo {{!auth()->user()->image ? 'd-none' : ''}}"
                        src="{{auth()->user()->image_url}}">

                    <span
                        class="badge rounded-circle nav-bar-badge badge-secondary {{auth()->user()->image ? 'd-none' : ''}}"
                        style="background: rgb(206 109 72);font-size: 24px;vertical-align: middle;font-family: auto;margin-left: 4px;padding: 0.35em 0.55em;">
                        {{Str::upper(Str::substr(auth()->user()->name,0,1))}}
                    </span>
                    {{--                                        <img src="{{asset("images/name-com.svg")}}">--}}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li class="d-none">
                        <router-link class="dropdown-item" to="/control/profile">بيانات حسابي</router-link>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        </ul>
    </div>
</header>
@yield('header')
