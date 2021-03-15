@extends('layouts.dashboard')

@if (Auth::user()->role == 5)

    @section('dashboard', 'Super Admin')

    @section('sidebar')

    <li class="nav-item">
        <a href="/super-admin/staf" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Staf</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="/super-admin/officer" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Officer</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Leader</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
            <i class="far fa-circle nav-icon"></i>
            <p>Cashier</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Attendance</p>
        </a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Officer Registration</p>
        </a>
    </li>

    @endsection

@endif
