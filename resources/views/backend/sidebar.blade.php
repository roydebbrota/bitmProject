@php
$role = Auth::user()->role;
@endphp


<nav class="d-none d-md-block bg-dark sidebar">
        <div class="sidebar-sticky accordion" id="dashboard">
            <ul class="nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link text-light {{Request::is('home') ? 'show bg-secondary text-light' : ''}}" href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        Dashboard 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed text-light {{Request::is('*/settings/*') ? 'active bg-secondary' : ''}}" href="#" data-toggle="collapse" data-target="#settings">
                        <i class="fas fa-address-card"></i>
                        Settings      
                    </a>
                    <div id="settings" class="collapse {{Request::is('*/settings/*') ? 'show bg-secondary text-light' : ''}} " data-parent="#dashboard">
                      <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*/settings/profile') ? 'active bg-light text-dark' : 'text-light'}}" href="{{ url($role,['settings','profile']) }}"><i class="far fa-user  text-warning"></i> Profile</a>
                            </li>
                            <li class="nav-item ml-n2">
                                <a class="nav-link text-light" href="#"><i class="fas fa-key text-warning"></i> Reset Password</a>
                            </li>
                        </ul>
                      </div>
                    </div>
                </li>


                <li class="nav-item">
                    <a class="nav-link collapsed text-light {{Request::is('*/inventory/*') ? 'active bg-secondary' : ''}}" href="#" data-toggle="collapse" data-target="#inventory">
                        <i class="fas fa-address-card"></i>
                         Inventory      
                    </a>
                    <div id="inventory" class="collapse {{Request::is('*/inventory/*') ? 'show bg-secondary text-light' : ''}} " data-parent="#dashboard">
                      <div class="card-body">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*/inventory/category') ? 'active bg-light text-dark' : 'text-light'}}" href="{{ url($role,['inventory','category']) }}"><i class="fas fa-th-large text-warning"></i> Category</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link {{Request::is('*/inventory/sub_category') ? 'active bg-light text-dark' : 'text-light'}}" href="{{ url($role,['inventory','sub_category']) }}"><i class="fas fa-th text-warning"></i> Sub Category</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link {{Request::is('*/inventory/brand') ? 'active bg-light text-dark' : 'text-light'}}" href="{{ url($role,['inventory','brand']) }}"><i class="fas fa-band-aid text-warning"></i> Brand</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{Request::is('*/inventory/product') ? 'active bg-light text-dark' : 'text-light'}}" href="{{ url($role,['inventory','product']) }}"><i class="fas fa-people-carry text-warning"></i> Product</a>
                            </li>
                      </div>
                    </div>
                </li>
              
            </ul>
        </div>
    </nav>