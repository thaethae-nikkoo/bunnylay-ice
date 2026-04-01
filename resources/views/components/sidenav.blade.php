<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('index')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="w-px-50 h-auto">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Bunny Lay</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if(is_active_route(config('sidemenus.index'))) active @endif">
            <a href="{{route('index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">ပင်မစာမျက်နှာ</div>
            </a>
        </li>

        <li class="menu-item @if(is_active_route(config('sidemenus.profile'))) active @endif">
            <a href="{{route('profile')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">ကျွန်ုပ်၏ပရိုဖိုင်</div>
            </a>
        </li>

        <!-- Layouts -->
        @if(Auth::user()->is_super_admin)
        <li class="menu-item @if(is_active_route(config('sidemenus.admin'))) active @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user-check"></i>
                <div data-i18n="Layouts">အက်ထ်မင်များ</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('adminLists')}}" class="menu-link">
                        <div data-i18n="Without navbar">{{__('template_names.list_title_text')}}</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('adminCreate')}}" class="menu-link">
                        <div data-i18n="Without menu">{{__('template_names.create_title_text')}}</div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="menu-item @if(is_active_route(config('sidemenus.machines'))) active @endif">
            <a href="{{route('machines.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cog"></i>
                <div data-i18n="Analytics">စက်များ</div>
            </a>
        </li>
        @endif
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item @if(is_active_route(config('sidemenus.profile'))) active @endif">
            <a href="{{route('payment_method.list')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Analytics">ငွေပေးချေမှုအမျိုးအစား</div>
            </a>
        </li>
        <li class="menu-item @if(is_active_route(config('sidemenus.descriptions'))) active @endif">
            <a href="{{route('description_gps.list')}}" class="menu-link">
               <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div data-i18n="Analytics">အကြောင်းအရာ</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text"></span>
        </li>
        <li class="menu-item">
            <a href="{{route('logout')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-power-off"></i>
                <div data-i18n="Analytics">ထွက်မည်</div>
            </a>
        </li>
    </ul>
</aside>
