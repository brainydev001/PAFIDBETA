 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->


     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-1 pb-1 mb-1 d-flex justify-content-between">
             <div class="info p-2">
                 <small class="text-green">User name</small>
                 <a href="#" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
             </div>
         </div>
         <div class="user-panel mt-1 pb-1 mb-1 d-flex justify-content-between">
             <div class="info p-2">
                 <small class="text-green">User role</small>
                 <a href="#" class="d-block">{{ auth()->user()->roleUser->name }}</a>
             </div>
         </div>
         @if (Auth::user()->hasRole('Managment') || Auth::user()->hasRole('System'))
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

                     {{-- calender --}}
                     <li class="nav-item">
                         <a href="{{ url('fullcalender') }}" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Calendar
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>

                     {{-- users & farmers --}}

                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fa fa-users"></i>
                             <p>
                                 Users
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview bg-grey text-dark border">
                             <li class="nav-item">
                                 <a href="{{ url('user-create/User') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create staff member</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-create/Farmer') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create farmer</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-users') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Users</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-farmers/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Farmers</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- activities --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-check-square"></i>
                             <p>
                                 Activities
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('activity-create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Activity</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-index/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Activities</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- Expenses --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-credit-card"></i>
                             <p>
                                 Expenses
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('expense-create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Expense</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('expenses') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Expenses</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- requestion --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-medkit"></i>
                             <p>
                                 Requisitions
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('requisition') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Make Requisition</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-list/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition List</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-pdm/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Request List</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- proofs --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-industry"></i>
                             <p>
                                 Payment Proof
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('proof/create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Proof</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('proof/Proof') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Payments</p>
                                 </a>
                             </li>
                             {{-- <li class="nav-item">
                           <a href="#" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p>PAFID to Farmer</p>
                           </a>
                       </li> --}}
                             {{-- <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>PAFID to Staff</p>
                          </a>
                      </li> --}}
                             {{-- <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Pending Payments</p>
                          </a>
                      </li> --}}
                         </ul>
                     </li>

                     {{-- finance --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-briefcase"></i>
                             <p>
                                 Finance
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('finance/Invoices') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Invoices</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('finance/Budget') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Budget</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('finance/Reciepts') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Receipts</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('send-mail/Staff') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Payment To Staff</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                <a href="{{ url('send-mail/Farmer') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment To Farmer</p>
                                </a>
                            </li>
                         </ul>
                     </li>

                     {{-- analysis --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Reports
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Users') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Staff Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Farmers') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Farmer Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('expense-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Expense Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Activity Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/Request') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/PDM') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('payment-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Payment Analysis</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- sys settings --}}
                     <li class="nav-header">System Operations</li>
                     {{-- sms --}}
                     <li class="nav-item">
                         <a href="{{ url('sms_manager') }}" class="nav-link">
                             <i class="nav-icon fas fa-comments"></i>
                             <p>
                                 Messenger
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- logs --}}
                     <li class="nav-item">
                         <a href="{{ url('logs') }}" class="nav-link">
                             <i class="nav-icon fas fa-user-secret"></i>
                             <p>
                                 Logs
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- security & access control --}}
                     <li class="nav-item">
                         <a href="{{ url('access_control') }}" class="nav-link">
                             <i class="nav-icon fas fa-lock"></i>
                             <p>
                                 Security & Access Control
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- otp --}}
                     <li class="nav-item">
                         <a href="{{ url('otp') }}" class="nav-link">
                             <i class="nav-icon fas fa-folder"></i>
                             <p>
                                 O.T.P
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- archives --}}
                     <li class="nav-item">
                         <a href="{{ url('archives') }}" class="nav-link">
                             <i class="nav-icon fas fa-archive"></i>
                             <p>
                                 Archives
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- backups --}}
                     <li class="nav-item">
                         <a href="{{ url('backup/public') }}" class="nav-link">
                             <i class="nav-icon fas fa-server"></i>
                             <p>
                                 Backup
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
             <!-- /.sidebar-menu -->
         @elseif(Auth::user()->hasRole('R.C'))
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                     {{-- calender --}}
                     <li class="nav-item">
                         <a href="{{ url('fullcalender') }}" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Calendar
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>

                     {{-- users & farmers --}}

                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fa fa-users"></i>
                             <p>
                                 Users
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview bg-grey text-dark border">
                             <li class="nav-item">
                                 <a href="{{ url('user-create/Farmer') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create farmer</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-farmers/RC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Farmers</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- activities --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-check-square"></i>
                             <p>
                                 Activities
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('activity-create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Activity</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-index/RC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Activities</p>
                                 </a>
                             </li>
                         </ul>
                     </li>


                     {{-- requestion --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-medkit"></i>
                             <p>
                                 Requisitions
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('requisition') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Make Requisition</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-list/RC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition List</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-pdm/RC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Request List</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- proofs --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-industry"></i>
                             <p>
                                 Payment Proof
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('proof/create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Proof</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('proof/Proof') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Payments</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- analysis --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Reports
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Farmers') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Farmer Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Activity Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/Request') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/PDM') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Analysis</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- sys settings --}}
                     <li class="nav-header">System Operations</li>
                     {{-- sms --}}
                     <li class="nav-item">
                         <a href="{{ url('sms_manager') }}" class="nav-link">
                             <i class="nav-icon fas fa-comments"></i>
                             <p>
                                 Messenger
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>


                 </ul>
             </nav>
             <!-- /.sidebar-menu -->
         @elseif(Auth::user()->hasRole('A.C'))
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                     {{-- calender --}}
                     <li class="nav-item">
                         <a href="{{ url('fullcalender') }}" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Calendar
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>

                     {{-- users & farmers --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fa fa-users"></i>
                             <p>
                                 Users
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview bg-grey text-dark border">
                             <li class="nav-item">
                                 <a href="{{ url('user-create/Farmer') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create farmer</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-farmers/AC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Farmers</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- activities --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-check-square"></i>
                             <p>
                                 Activities
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('activity-create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Activity</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-index/AC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Activities</p>
                                 </a>
                             </li>
                         </ul>
                     </li>


                     {{-- requestion --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-medkit"></i>
                             <p>
                                 Requisitions
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('requisition') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Make Requisition</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-list/AC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition List</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-pdm/AC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Request List</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- proofs --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-industry"></i>
                             <p>
                                 Payment Proof
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('proof/create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Proof</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('proof/Proof') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Payments</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- analysis --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Reports
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Farmers') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Farmer Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Activity Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/Request') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/PDM') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Analysis</p>
                                 </a>
                             </li>
                         </ul>
                     </li>
                 </ul>
             </nav>
             <!-- /.sidebar-menu -->
         @elseif(Auth::user()->hasRole('F.C'))
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->

                     {{-- calender --}}
                     <li class="nav-item">
                         <a href="{{ url('fullcalender') }}" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Calendar
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>

                     {{-- users & farmers --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fa fa-users"></i>
                             <p>
                                 Users
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview bg-grey text-dark border">
                             <li class="nav-item">
                                 <a href="{{ url('user-create/Farmer') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create farmer</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-farmers/FC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Farmers</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('farmer-attendance/FC') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Attendance</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                 </ul>
             </nav>
             <!-- /.sidebar-menu -->
         @elseif(Auth::user()->hasRole('Staff'))
             <!-- Sidebar Menu -->
             <nav class="mt-2">
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                     {{-- calender --}}
                     <li class="nav-item">
                         <a href="{{ url('fullcalender') }}" class="nav-link">
                             <i class="nav-icon fas fa-calendar"></i>
                             <p>
                                 Calendar
                                 {{-- <span class="right badge badge-danger">New</span> --}}
                             </p>
                         </a>
                     </li>

                     {{-- users & farmers --}}

                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fa fa-users"></i>
                             <p>
                                 Users
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview bg-grey text-dark border">
                             <li class="nav-item">
                                 <a href="{{ url('user-create/User') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create staff member</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-create/Farmer') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create farmer</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-users') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Users</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-farmers/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Farmers</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- activities --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-check-square"></i>
                             <p>
                                 Activities
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('activity-create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Activity</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-index/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Activities</p>
                                 </a>
                             </li>
                         </ul>
                     </li>


                     {{-- requestion --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-medkit"></i>
                             <p>
                                 Requisitions
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('requisition') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Make Requisition</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-list/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition List</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('requisition-pdm/Admin') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Request List</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- proofs --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-industry"></i>
                             <p>
                                 Payment Proof
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('proof/create') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Create Proof</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('proof/Proof') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>All Payments</p>
                                 </a>
                             </li>
                         </ul>
                     </li>


                     {{-- analysis --}}
                     <li class="nav-item has-treeview">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-chart-line"></i>
                             <p>
                                 Reports
                                 <i class="fas fa-angle-left right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview border">
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Users') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Staff Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-analysis/Farmers') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Farmer Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('expense-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Expense Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('activity-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Activity Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/Request') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Requisition Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('user-request/PDM') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Per Diem Analysis</p>
                                 </a>
                             </li>
                             <li class="nav-item">
                                 <a href="{{ url('payment-analysis') }}" class="nav-link">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Payment Analysis</p>
                                 </a>
                             </li>
                         </ul>
                     </li>

                     {{-- sys settings --}}
                     <li class="nav-header">System Operations</li>
                     {{-- sms --}}
                     <li class="nav-item">
                         <a href="{{ url('sms_manager') }}" class="nav-link">
                             <i class="nav-icon fas fa-comments"></i>
                             <p>
                                 Messenger
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- logs --}}
                     <li class="nav-item">
                         <a href="{{ url('logs') }}" class="nav-link">
                             <i class="nav-icon fas fa-user-secret"></i>
                             <p>
                                 Logs
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- otp --}}
                     <li class="nav-item">
                         <a href="{{ url('otp') }}" class="nav-link">
                             <i class="nav-icon fas fa-folder"></i>
                             <p>
                                 O.T.P
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>

                     {{-- archives --}}
                     <li class="nav-item">
                         <a href="{{ url('archives') }}" class="nav-link">
                             <i class="nav-icon fas fa-archive"></i>
                             <p>
                                 Archives
                                 <span class="badge badge-info right"></span>
                             </p>
                         </a>
                     </li>
                 </ul>
             </nav>
         @endif
     </div>
     <!-- /.sidebar -->
 </aside>
