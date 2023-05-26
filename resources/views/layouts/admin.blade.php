@extends('layouts.adminDefault')
<div id="main">
    <div>
        @include('includes.sidebar')
    </div>
    <div class="container-wide">
        <div class="d-flex align-items-center flex-nowrap d-block d-lg-none">
            <div class="mobile-toggle w-100">
                <a href="#" class="sidebar-toggle text-decoration-none float-right mr-2 p-1">
                    <i class="fas fa-bars" style="color: #606566"></i>
                </a>
            </div>
        </div>
        @yield('content')
    </div>
</div>
