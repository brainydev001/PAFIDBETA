<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
                </div>
                <div class="info">
                    {{-- <a href="#" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a> --}}
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
                    {{-- reminders --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tree"></i>
                            <p>
                                Reminders
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>

                    {{-- members --}}
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
                                <a href="{{ url('user-farmers') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Farmers</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- modules --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
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
                                <a href="{{ url('activity-index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Activities</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- modules --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Requisitions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('admin_output') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Make Requisition</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('module/Activity') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Analysis</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Expenses --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Expenses
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('expense_create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Expenses</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Queries --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Approvals
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('query') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Activity Approval</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Queries</p>
                            </a>
                        </li> --}}
                        </ul>
                    </li>

                    {{-- payments --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Payments
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('payment') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payment</p>
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

                    {{-- Business Intelligence --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-powerpoint"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('user_analysis') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Data Analysis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('input_analysis') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Input Data Analysis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Output Data Analysis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Payments Data Analysis</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- sys settings --}}
                    <li class="nav-header">System Settings</li>

                    {{-- regions --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-powerpoint"></i>
                            <p>
                                Region
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview border">
                            <li class="nav-item">
                                <a href="{{ url('region/Region') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Regions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('region/Constituency') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Constituencies</p>
                                </a>
                            </li>
                            {{-- suggested to be irrerevant --}}
                            {{-- <li class="nav-item">
                           <a href="{{ url('region/Ward') }}" class="nav-link">
                               <i class="far fa-circle nav-icon"></i>
                               <p>Wards</p>
                           </a>
                       </li> --}}
                        </ul>
                    </li>

                    {{-- types --}}
                    <li class="nav-item">
                        <a href="{{ url('type_index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users-cog"></i>
                            <p>
                                Membership Types
                            </p>
                        </a>
                    </li>

                    {{-- security & access control --}}
                    <li class="nav-item">
                        <a href="{{ url('access_control') }}" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Security & Access Control
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>

                    {{-- user logs --}}
                    <li class="nav-item">
                        <a href="{{ url('user_logs') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                User Logs
                                <span class="badge badge-info right"></span>
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
