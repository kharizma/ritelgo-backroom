<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="{{ route('home') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" width="150px" alt="logo" />
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <span class="icon {{ (\Request::route()->getName() == 'home') ? 'text-ritelgo-primary' : '' }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                            <path
                            d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                        </svg>
                    </span>
                    <span class="text {{ (\Request::route()->getName() == 'home') ? 'text-ritelgo-primary' : '' }}">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('invoices.index') }}" class="nav-link">
                    <span class="icon {{ (\Request::route()->getName() == 'invoices.index') ? 'text-ritelgo-primary' : '' }}">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M3.33334 3.35442C3.33334 2.4223 4.07954 1.66666 5.00001 1.66666H15C15.9205 1.66666 16.6667 2.4223 16.6667 3.35442V16.8565C16.6667 17.5519 15.8827 17.9489 15.3333 17.5317L13.8333 16.3924C13.537 16.1673 13.1297 16.1673 12.8333 16.3924L10.5 18.1646C10.2037 18.3896 9.79634 18.3896 9.50001 18.1646L7.16668 16.3924C6.87038 16.1673 6.46298 16.1673 6.16668 16.3924L4.66668 17.5317C4.11731 17.9489 3.33334 17.5519 3.33334 16.8565V3.35442ZM4.79168 5.04218C4.79168 5.39173 5.0715 5.6751 5.41668 5.6751H10C10.3452 5.6751 10.625 5.39173 10.625 5.04218C10.625 4.69264 10.3452 4.40927 10 4.40927H5.41668C5.0715 4.40927 4.79168 4.69264 4.79168 5.04218ZM5.41668 7.7848C5.0715 7.7848 4.79168 8.06817 4.79168 8.41774C4.79168 8.76724 5.0715 9.05066 5.41668 9.05066H10C10.3452 9.05066 10.625 8.76724 10.625 8.41774C10.625 8.06817 10.3452 7.7848 10 7.7848H5.41668ZM4.79168 11.7932C4.79168 12.1428 5.0715 12.4262 5.41668 12.4262H10C10.3452 12.4262 10.625 12.1428 10.625 11.7932C10.625 11.4437 10.3452 11.1603 10 11.1603H5.41668C5.0715 11.1603 4.79168 11.4437 4.79168 11.7932ZM13.3333 4.40927C12.9882 4.40927 12.7083 4.69264 12.7083 5.04218C12.7083 5.39173 12.9882 5.6751 13.3333 5.6751H14.5833C14.9285 5.6751 15.2083 5.39173 15.2083 5.04218C15.2083 4.69264 14.9285 4.40927 14.5833 4.40927H13.3333ZM12.7083 8.41774C12.7083 8.76724 12.9882 9.05066 13.3333 9.05066H14.5833C14.9285 9.05066 15.2083 8.76724 15.2083 8.41774C15.2083 8.06817 14.9285 7.7848 14.5833 7.7848H13.3333C12.9882 7.7848 12.7083 8.06817 12.7083 8.41774ZM13.3333 11.1603C12.9882 11.1603 12.7083 11.4437 12.7083 11.7932C12.7083 12.1428 12.9882 12.4262 13.3333 12.4262H14.5833C14.9285 12.4262 15.2083 12.1428 15.2083 11.7932C15.2083 11.4437 14.9285 11.1603 14.5833 11.1603H13.3333Z" />
                        </svg>
                    </span>
                    <span class="text {{ (\Request::route()->getName() == 'invoices.index') ? 'text-ritelgo-primary' : '' }}">Invoice</span>
                </a>
            </li>
            <span class="divider"><hr /></span>
            <li class="nav-item nav-item-has-children">
                <a
                  href="#0"
                  class="{{ in_array(\Request::route()->getName(),
                    array(
                        'master.users.index',
                        'master.users.create',
                        'master.users.edit',
                        'master.business-types.index',
                        'master.business-types.create',
                        'master.business-types.edit',
                        'master.package-subscriptions.index',
                        'master.package-subscriptions.edit',
                        'master.package-subscription-details.show',
                    )) ? '' : 'collapsed' }} nav-link"
                  data-bs-toggle="collapse"
                  data-bs-target="#ddmenu_2"
                  aria-controls="ddmenu_2"
                  aria-expanded="{{ in_array(\Request::route()->getName(),
                    array(
                        'master.users.index',
                        'master.users.create',
                        'master.users.edit',
                        'master.business-types.index',
                        'master.business-types.create',
                        'master.business-types.edit',
                        'master.package-subscriptions.index',
                        'master.package-subscriptions.edit',
                        'master.package-subscription-details.show',
                    )) ? 'true' : 'false' }}"
                  aria-label="Toggle navigation"
                >
                    <span class="icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M1.66666 5.41669C1.66666 3.34562 3.34559 1.66669 5.41666 1.66669C7.48772 1.66669 9.16666 3.34562 9.16666 5.41669C9.16666 7.48775 7.48772 9.16669 5.41666 9.16669C3.34559 9.16669 1.66666 7.48775 1.66666 5.41669Z" />
                            <path
                            d="M1.66666 14.5834C1.66666 12.5123 3.34559 10.8334 5.41666 10.8334C7.48772 10.8334 9.16666 12.5123 9.16666 14.5834C9.16666 16.6545 7.48772 18.3334 5.41666 18.3334C3.34559 18.3334 1.66666 16.6545 1.66666 14.5834Z" />
                            <path
                            d="M10.8333 5.41669C10.8333 3.34562 12.5123 1.66669 14.5833 1.66669C16.6544 1.66669 18.3333 3.34562 18.3333 5.41669C18.3333 7.48775 16.6544 9.16669 14.5833 9.16669C12.5123 9.16669 10.8333 7.48775 10.8333 5.41669Z" />
                            <path
                            d="M10.8333 14.5834C10.8333 12.5123 12.5123 10.8334 14.5833 10.8334C16.6544 10.8334 18.3333 12.5123 18.3333 14.5834C18.3333 16.6545 16.6544 18.3334 14.5833 18.3334C12.5123 18.3334 10.8333 16.6545 10.8333 14.5834Z" />
                        </svg>
                    </span>
                    <span class="text">Master</span>
                </a>
                <ul id="ddmenu_2" class="collapse dropdown-nav {{ in_array(\Request::route()->getName(),
                    array(
                        'master.users.index',
                        'master.users.create',
                        'master.users.edit',
                        'master.business-types.index',
                        'master.business-types.create',
                        'master.business-types.edit',
                        'master.package-subscriptions.index',
                        'master.package-subscriptions.edit',
                        'master.package-subscription-details.show',
                    )) ? 'show' : '' }}">
                    <li>
                        <a href="{{ route('master.business-types.index') }}" class="nav-link {{ in_array(\Request::route()->getName(),array('master.business-types.index','master.business-types.create','master.business-types.edit')) ? 'text-ritelgo-primary' : '' }}"> Tipe Bisnis </a>
                    </li>
                    <li>
                        <a href="{{ route('master.package-subscriptions.index') }}" class="nav-link {{ in_array(\Request::route()->getName(),array('master.package-subscriptions.index','master.users.create','master.users.edit','master.package-subscription-details.show')) ? 'text-ritelgo-primary' : '' }}"> Paket Langganan </a>
                    </li>
                    <li>
                        <a href="{{ route('master.users.index') }}" class="nav-link {{ in_array(\Request::route()->getName(),array('master.users.index','master.users.create','master.users.edit')) ? 'text-ritelgo-primary' : '' }}"> Pengguna </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
  </aside>