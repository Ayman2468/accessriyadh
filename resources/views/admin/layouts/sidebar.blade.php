<div class="sidebar open" style="overflow-y: auto">
    <div class="logo-details" style="padding: 20px 0">
        <a class="logo_name" href="/"><img  src="{{asset("images/logo.png")}}" style="    width: 75px;"></a>
        <a class="min-logo" href="/"><img src="{{asset("images/logo.png")}}" style="width: 50px;"></a>
    </div>
    <ul class="nav-list">

        <li>
            <div
                style="color: #98A2B3;margin-bottom: 10px;margin-top: 10px;">الادارة</div>
        </li>
        <li>
            <router-link to="/control/home" :class="[$route.meta.activeName === 'home' ? 'active' : '']">
                <i class='my-icon icon-home'></i>
                <span class="links_name">الرئيسية</span>
            </router-link>
            <span class="tooltip">الرئيسية</span>
        </li>



        <li  :class="[$route.meta.activeName === 'customers' ? 'nav-item has-submenu active dropdown ' : 'nav-item has-submenu']">
            <a class="nav-link " href="#" aria-expanded="true">
                <i class='my-icon icon-staff'></i>
                <span class="links_name">المستفيدين</span>
                <i :class="['bi','small','fa',$route.meta.activeName === 'customers' ? 'fa-angle-up' : 'fa-angle-down']" style="    position: relative;left: -50px;"></i>
            </a>
            <ul :class="[$route.meta.activeName === 'customers' ? 'submenu collapse show' : 'submenu collapse']" style="padding: 6px;">
                <li>
                    <router-link to="/control/in-treatment-customers"
                                 :class="[$route.meta.activeNameSub === 'in-treatment-customers' ? 'active' : '']" >
                        <i class='my-icon icon-staff'></i>
                        <span class="links_name" style="font-size: 15px;"> مستفيدين قيد العلاج</span>
                    </router-link>
                    <span class="tooltip">مستفيدين قيد العلاج</span>
                </li>
                <li>
                    <router-link to="/control/in-complete-customers"
                                 :class="[$route.meta.activeNameSub === 'in-complete-customers' ? 'active' : '']">
                        <i class='my-icon icon-staff'></i>
                        <span class="links_name" style="font-size: 15px;"> مستفيدين أكملوا العلاج</span>
                    </router-link>
                    <span class="tooltip">مستفيدين أكملوا العلاج</span>
                </li>
            </ul>

            <span class="tooltip">المستفيدين</span>

        </li>
        @hasanyrole('super-admin|reception')
        <li>
            <router-link to="/control/prescriptions" :class="[$route.meta.activeName === 'prescriptions' ? 'active' : '']">
                <i class='my-icon icon-plans'></i>
                <span class="links_name">وصفات العلاج</span>
            </router-link>
            <span class="tooltip">وصفات العلاج</span>
        </li>
        @endhasanyrole
        <li>
            <router-link to="/control/transfers" :class="[$route.meta.activeName === 'transfers' ? 'active' : '']">
                <i class='my-icon icon-calender'></i>
                <span class="links_name">قائمة الانتظار</span>
                <span style="position: absolute;left: 15px;" class="badge bg-primary" v-if="$root.transfer_waiting_count" v-html="$root.transfer_waiting_count"></span>
            </router-link>
            <span class="tooltip">قائمة الانتظار</span>
        </li>
        @hasanyrole('super-admin')
        <li  :class="[$route.meta.activeName === 'users' ? 'nav-item has-submenu active dropdown ' : 'nav-item has-submenu']">
            <a class="nav-link " href="#" aria-expanded="true">
                <i class='my-icon icon-staff'></i>
                <span class="links_name">المستخدمين</span>
                <i :class="['bi','small','fa',$route.meta.activeName === 'users' ? 'fa-angle-up' : 'fa-angle-down']" style="    position: relative;left: -50px;"></i>
            </a>
            <ul :class="[$route.meta.activeName === 'users' ? 'submenu collapse show' : 'submenu collapse']" style="padding: 6px;">
                <li>
                    <router-link to="/control/users"
                                 :class="[$route.meta.activeNameSub === 'users' ? 'active' : '']" >
                        <i class='my-icon icon-staff'></i>
                        <span class="links_name" style="font-size: 15px;"> إدارة المستخدمين</span>
                    </router-link>
                    <span class="tooltip">إدارة المستخدمين</span>
                </li>
                <li>
                    <router-link to="/control/doctors"
                                 :class="[$route.meta.activeNameSub === 'doctors' ? 'active' : '']">
                        <i class='my-icon icon-staff'></i>
                        <span class="links_name" style="font-size: 15px;"> عرض الاطباء</span>
                    </router-link>
                    <span class="tooltip">عرض الاطباء</span>
                </li>
                <li>
                    <router-link to="/control/clinics"
                                 :class="[$route.meta.activeNameSub === 'clinics' ? 'active' : '']">
                        <i class='my-icon icon-staff'></i>
                        <span class="links_name" style="font-size: 15px;"> عرض العيادات</span>
                    </router-link>
                    <span class="tooltip">عرض العيادات</span>
                </li>
            </ul>

            <span class="tooltip">إدارة المستخدمين</span>

        </li>
        @endhasanyrole
        <li class="profile" style="background: #3b8c87;">
            <div class="profile-details" style="width: 100%">
{{--                <img src="{{auth()->user()->image ? auth()->user()->image_url : "/images/avatar-profile.svg" }}"--}}
{{--                     id="sidebar-profileImg" alt="profileImg">--}}

              <div class="d-flex justify-content-center" style="    margin: 0 auto;">
                  <img src="{{asset('images/logout.png')}}" style="width: auto !important;height: fit-content;object-fit: none;border-radius: 0;margin: 0;padding: 5px 10px;" alt="">
                  <a href="{{ route('logout') }}" class="navbar-logout-btn"
                     style="text-align: center;display: block;font-size: 14px;"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج</a></div>

            </div>
        </li>
    </ul>
</div>
