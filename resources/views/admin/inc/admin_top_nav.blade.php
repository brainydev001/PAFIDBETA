 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
         {{-- menu --}}
         <li class="nav-item">
             <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
         </li>

         {{-- Dashboard  --}}
         @if (Auth::user()->hasRole('R.C'))
             <li class="nav-item d-none d-sm-inline-block">
                 <a href="{{ url('rc-dashboard') }}" class="nav-link"><i class="fas fa-home "></i> Dashboard</a>
             </li>
         @elseif(Auth::user()->hasRole('A.C'))
             <li class="nav-item d-none d-sm-inline-block">
                 <a href="{{ url('ac-dashboard') }}" class="nav-link"><i class="fas fa-home "></i> Dashboard</a>
             </li>
         @elseif(Auth::user()->hasRole('F.C'))
             <li class="nav-item d-none d-sm-inline-block">
                 <a href="{{ url('fc-dashboard') }}" class="nav-link"><i class="fas fa-home "></i> Dashboard</a>
             </li>
         @else
             <li class="nav-item d-none d-sm-inline-block">
                 <a href="{{ url('main-manager') }}" class="nav-link"><i class="fas fa-home "></i> Dashboard</a>
             </li>
         @endif

     </ul>

     <!-- SEARCH FORM -->
     <form class="form-inline ml-3">
         <div class="input-group input-group-sm">
             <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
             <div class="input-group-append">
                 <button class="btn btn-navbar" type="submit">
                     <i class="fas fa-search"></i>
                 </button>
             </div>
         </div>
     </form>

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
         <!-- Messages Dropdown Menu -->
         {{-- reminders --}}
         {{-- <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-comments"></i>
                 <span class="badge badge-danger navbar-badge">3</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 New Reminder
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 New Reminder
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <!-- Message Start -->
                     <div class="media">
                         <div class="media-body">
                             <h3 class="dropdown-item-title">
                                 New Reminder
                                 <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                             </h3>
                             <p class="text-sm">Call me whenever you can...</p>
                             <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                         </div>
                     </div>
                     <!-- Message End -->
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All Reminders</a>
             </div>
         </li> --}}

         {{-- user activity --}}
         <!-- Notifications Dropdown Menu -->
         {{-- <li class="nav-item dropdown">
             <a class="nav-link" data-toggle="dropdown" href="#">
                 <i class="far fa-bell"></i>
                 <span class="badge badge-warning navbar-badge">15</span>
             </a>
             <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                 <span class="dropdown-item dropdown-header">15 Notifications</span>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-envelope mr-2"></i> 4 new reminders
                     <span class="float-right text-muted text-sm">3 mins</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-users mr-2"></i> 8 new users
                     <span class="float-right text-muted text-sm">12 hours</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item">
                     <i class="fas fa-file mr-2"></i> 3 new requisition
                     <span class="float-right text-muted text-sm">2 days</span>
                 </a>
                 <div class="dropdown-divider"></div>
                 <a href="#" class="dropdown-item dropdown-footer">See All User Activities</a>
             </div>
         </li> --}}

         {{-- logout --}}
         <li class="nav-item">
             <a class="nav-link" href="{{ url('/logout') }}">
                 <i class="fas fa-sign-out-alt"></i>
             </a>
         </li>
     </ul>
 </nav>
 <!-- /.navbar -->
