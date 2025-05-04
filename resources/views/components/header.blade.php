<header class="bleezy-header-area">
    <div class="header-right-overlay"></div>
    <div class="mobile-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <p>
                        <i class="fa fa-language"></i> 
                        <a href="{{ route(Route::currentRouteName(), 'fr') }}"
                            style="{{ app()->getLocale() == 'fr' ? 'border-bottom: 1px dotted white' : '' }}"
                            title="@lang('lang.switch_in', ['param'=>__('lang.french')])">@lang('lang.french')</a> 
                        | 
                        <a href="{{ route(Route::currentRouteName(), 'en') }}" 
                            style="{{ app()->getLocale() == 'en' ? 'border-bottom: 1px dotted white' : '' }}"
                            title="@lang('lang.switch_in', ['param'=>__('lang.english')])">@lang('lang.english')</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="site-logo">
                    <a href="{{ route('welcome', app()->getLocale()) }}"><img src="{{ asset('images/logo.webp') }}" alt="LOGO" style="height: 80px; width: 80px" /></a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="header-right">
                    <div class="header-right-top">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="single-top-right">
                                    <p>@lang('lang.call_us'): <a href="tel:+224625123232" title="@lang('lang.call_us')">+224 625 12 32 32</a></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-top-right">
                                    <ul>
                                        <li><a href="https://facebook.com/jsssarl" title="@lang('lang.join_us')"><i class="fa fa-facebook"></i></a></li>
                                        <li><a title="@lang('lang.follow_us')"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="https://www.linkedin.com/company/jaguar-security-services" title="@lang('lang.let_connect')"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="mailto:jaguar28jss@gmail.com" title="@lang('lang.mail_us')"><i class="fa fa-envelope"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="single-top-right">
                                    <p>
                                        <i class="fa fa-language"></i> 
                                        <a href="{{ route(Route::currentRouteName(), 'fr') }}" 
                                            style="{{ app()->getLocale() == 'fr' ? 'border-bottom: 1px dotted white' : '' }}"
                                            title="@lang('lang.switch_in', ['param'=>__('lang.french')])">@lang('lang.french')</a> 
                                        | 
                                        <a href="{{ route(Route::currentRouteName(), 'en') }}" 
                                            style="{{ app()->getLocale() == 'en' ? 'border-bottom: 1px dotted white' : '' }}"
                                            title="@lang('lang.switch_in', ['param'=>__('lang.english')])">@lang('lang.english')</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-container">
                        <div class="row">
                            <div class="col-md-11 col-sm-11">
                                <!-- Responsive Menu -->
                                <div class="bleezy-responsive-menu"></div>
                                <!-- Responsive Menu -->
                                <div class="mainmenu">
                                    <nav>
                                        <ul id="bleezy_navigation">
                                            <li class="{{ Route::is('welcome', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('welcome', app()->getLocale()) }}">@lang('lang.home')</a></li>
                                            <li class="{{ Route::is('about', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('about', app()->getLocale()) }}">@lang('lang.about')</a></li>
                                            <li class="{{ Route::is('services', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('services', app()->getLocale()) }}">@lang('lang.service', array('param'=>"s"))</a></li>
                                            <li class="{{ Route::is('team', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('team', app()->getLocale()) }}">@lang('lang.team', array('param'=>"s"))</a></li>
                                            <li class="{{ Route::is('shops', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('shops', app()->getLocale()) }}">@lang('lang.shop', array('param'=>"s"))</a></li>
                                            <li class="{{ Route::is('contacts', app()->getLocale()) ? 'current-page-item' : '' }}"><a href="{{ route('contacts', app()->getLocale()) }}">@lang('lang.contact', array('param'=>"s"))</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>