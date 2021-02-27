<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
    <div class="sidebar-brand-text mx-3">
        @if(Session::has('user'))
            {{ Session::get('user')->name }}
        @endif
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->

@if(Session::get('user')->access_level == 0)
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-user"></i>
        <span>Users</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">User List:</h6>
            <a class="collapse-item" href="/registration_requests">Registration Requests</a>
            <a class="collapse-item" href="/users">Users</a>
        </div>
    </div>
</li>
@endif

@if(Session::get('user')->access_level == 1)
@php

$tdate = Session::get('user')->account_valid_till;
$fdate = date('Y-m-d');
$datetime1 = strtotime($fdate); // convert to timestamps
$datetime2 = strtotime($tdate); // convert to timestamps
$days = (int)(($datetime2 - $datetime1)/86400);

@endphp

    @if($days > 0)

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-user"></i>
            <span>Sales Accounts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sales Account List:</h6>
                <a class="collapse-item" href="/sales_accounts">Sales Accounts</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-store"></i>
            <span>Products</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Products:</h6>
                <a class="collapse-item" href="/products">Product List</a>
                <a class="collapse-item" href="/categories">Category List</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSale"
            aria-expanded="true" aria-controls="collapseSale">
            <i class="fas fa-shopping-cart"></i>
            <span>Sale</span>
        </a>
        <div id="collapseSale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sale:</h6>
                <a class="collapse-item" href="/pending_sell_list">Pending Sales</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOtherExpense"
            aria-expanded="true" aria-controls="collapseOtherExpense">
            <i class="fas fa-money-check-alt"></i>
            <span>Expenses</span>
        </a>
        <div id="collapseOtherExpense" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Expenses:</h6>
                <a class="collapse-item" href="/expenses">Expenses</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/tables">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>
    @endif
@endif

@if(Session::get('user')->access_level == 2)
@php

$tdate = Session::get('user')->account_valid_till;
$fdate = date('Y-m-d');
$datetime1 = strtotime($fdate); // convert to timestamps
$datetime2 = strtotime($tdate); // convert to timestamps
$days = (int)(($datetime2 - $datetime1)/86400);

@endphp

    @if($days > 0)

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSale"
            aria-expanded="true" aria-controls="collapseSale">
            <i class="fas fa-money-check-alt"></i>
            <span>Sale</span>
        </a>
        <div id="collapseSale" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Sale:</h6>
                <a class="collapse-item" href="/pending_sell_list">Pending Sales</a>
            </div>
        </div>
    </li>
    @endif
@endif

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>