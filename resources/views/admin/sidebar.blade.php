<li class="@yield('active-dashboard-menu')">
    <a href="{{ route('admin.dashboard') }}" class="iq-waves-effect" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-house-door iq-arrow-left"></i>
        <span>Dashboard</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
</li>

<li class="@yield('active-tariff-menu')">
    <a href="{{ route('admin.tariffRates') }}" class="iq-waves-effect" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-house-door iq-arrow-left"></i>
        <span>Tariff Rates</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
</li>

<li class="@yield('active-concessionaire-menu')">
    <a href="#concessionaireInfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-person-workspace iq-arrow-left"></i>
        <span>Consumer</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
    <ul id="concessionaireInfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
        <li class="@yield('active-concessionaire-list')">
            <a href="{{ route('admin.concessionaireList') }}">
                <i class="bi bi-card-list"></i>Consumer List
            </a>
        </li>
        <li class="@yield('active-concessionaire-meter')">
            <a href="{{ route('admin.concessionaireMeter') }}">
                <i class="bi bi-pencil-square"></i>Consumer Meter
            </a>
        </li>
        {{-- <li class="@yield('active-concessionaire-bill')">
            <a href="{{ route('admin.concessionaireMeterBill') }}">
                <i class="bi bi-receipt"></i>Consumer Meter Bill
            </a>
        </li> --}}
        <li class="@yield('active-concessionaire-billing')">
            <a href="{{ route('admin.concessionaireBilling') }}">
                <i class="bi bi-cash-coin"></i>Consumer Billing
            </a>
        </li>
    </ul>
</li>

<li class="@yield('active-report-menu')">
    <a href="#reportInfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-bar-chart iq-arrow-left"></i>
        <span>Reports</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
</li>

<li class="@yield('active-user-menu')">
    <a href="#userInfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-person-badge iq-arrow-left"></i>
        <span>User</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
    <ul id="userInfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
        <li class="@yield('active-user-list')">
            <a href="{{ route('admin.userList') }}">
                <i class="bi bi-card-list"></i>User List
            </a>
        </li>
        <li class="@yield('active-user-management')">
            <a href="{{ route('admin.userManagement') }}">
                <i class="bi bi-pencil-square"></i>User Management
            </a>
        </li>
    </ul>
</li>

<li class="@yield('active-report-menu')">
    <a href="#reportInfo" class="iq-waves-effect" data-toggle="collapse" aria-expanded="false">
        <span class="ripple rippleEffect"></span>
        <i class="bi bi-bar-chart iq-arrow-left"></i>
        <span>Reports</span>
        <i class="bi bi-chevron-right iq-arrow-right"></i>
    </a>
</li>
