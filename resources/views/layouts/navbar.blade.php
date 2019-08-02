<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="{{ (request()->is('admin')) ? 'active' : ''}}">
                <a href="{{ route('home') }}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>
            {{-- @can('user-list') --}}
            <li class="{{ (request()->is('admin/users*')) ? 'active' : ''}}">
                <a href="{{ route('users') }}"><i class="fa fa-users"></i><span>Users Management</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>
            {{-- @endcan --}}
            @can('role-list')
            <li class="{{ (request()->is('admin/roles*')) ? 'active' : ''}}">
                <a href="{{ route('roles') }}"><i class="fa fa-user-circle"></i><span>Role Management</span>
                <span class="pull-right-container">
                </span>
                </a>
            </li>
            @endcan
            @can('customer-list')
            <li class="treeview {{ (request()->is('admin/customer*')) ? 'active' : '' }}">
                <a href="#">
                <i class="fa fa-users"></i><span>Customers</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   @can('customer-create')
                   <li class="{{ (request()->is('admin/customercreate')) ? 'active' : '' }}"><a href="{{ route('customercreate') }}">Add Customer</a></li>
                   @endcan
                   <li class="{{ (request()->is('admin/customers')) ? 'active' : '' }}"><a href="{{ route('customers') }}">List</a></li>
                </ul>
            </li>
            @endcan
            <li class="treeview {{ (request()->is('admin/lead*')) ? 'active' : '' }}">
                <a href="#">
                <i class="fa fa-users"></i><span>Leads</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   @can('customer-create')
                   <li class="{{ (request()->is('admin/leadcreate')) ? 'active' : '' }}"><a href="{{ route('leadcreate') }}">Add Lead</a></li>
                   @endcan
                   <li class="{{ (request()->is('admin/leads')) ? 'active' : '' }}"><a href="{{ route('leads') }}">List</a></li>
                </ul>
            </li>
            {{-- @can('customer-list') --}}
            <li class="treeview {{ (request()->is('admin/sales*')) ? 'active' : '' }}">
                <a href="#">
                <i class="fa fa-shopping-cart"></i><span>Sales</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   <li class="{{ (request()->is('admin/salesdirectdebit')) ? 'active' : '' }}"><a href="{{ route('directdebit') }}">Direct Debit Sales</a></li>
                   <li class="{{ (request()->is('admin/salesweb')) ? 'active' : '' }}"><a href="{{ route('websales') }}">Web Sales</a></li>
                   <li class="{{ (request()->is('admin/salesdigital')) ? 'active' : '' }}"><a href="{{ route('digitalsales') }}">Digital Sales</a></li>
                </ul>
            </li>
            <li class="treeview {{ (request()->is('admin/doc*')) || (request()->is('admin/directdebitform')) || (request()->is('admin/websalesform')) || (request()->is('admin/digitalsalesform')) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-list"></i><span>Documents</span>
                    <span class="pull-right-container"><i class="fa fa-angle-left float-right"></i></span>
                </a>
                <ul class="treeview-menu">
                   {{-- @can('customer-create') --}}
                   <li class="{{ (request()->is('admin/websalesform')) ? 'active' : '' }}"><a href="{{ route('websalesform') }}">Web Sales Form</a></li>
                   <li class="{{ (request()->is('admin/digitalsalesform')) ? 'active' : '' }}"><a href="{{ route('digitalsalesform') }}">Digital Sales Form</a></li>
                   <li class="{{ (request()->is('admin/directdebitform')) ? 'active' : '' }}"><a href="{{ route('directdebitform') }}">Direct Debit Form</a></li>
                   <li class="{{ (request()->is('admin/docs/1')) ? 'active' : '' }}"><a href="{{ route('docs',1) }}">SEO Packages</a></li>
                   <li class="{{ (request()->is('admin/docs/2')) ? 'active' : '' }}"><a href="{{ route('docs',2) }}">Web Packages</a></li>
                   <li class="{{ (request()->is('admin/docs/3')) ? 'active' : '' }}"><a href="{{ route('docs',3) }}">Domain and Hosting Packages</a></li>
                   <li class="{{ (request()->is('admin/docs/4')) ? 'active' : '' }}"><a href="{{ route('docs',4) }}">Social Media Packages</a></li>
                   <li class="{{ (request()->is('admin/docs/5')) ? 'active' : '' }}"><a href="{{ route('docs',5) }}">Case Studies</a></li>
                   {{-- @endcan --}}
                </ul>
            </li>
            <li class="treeview {{ (request()->is('admin/master*')) ? 'active' : '' }}">
                <a href="#">
                <i class="fa fa-list"></i><span>Master</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   {{-- @can('customer-create') --}}
                   <li class="{{ (request()->is('admin/master/industry*')) ? 'active' : '' }}"><a href="{{ route('masterindustry') }}">Industry</a></li>
                   <li class="{{ (request()->is('admin/master/document*')) ? 'active' : '' }}"><a href="{{ route('masterdocuments') }}">Documents</a></li>
                   {{-- @endcan --}}
                </ul>
            </li>
            {{-- @endcan --}}
            {{-- <li class="treeview">
                <a href="#">
                <i class="fa fa-users"></i><span>Customers</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   <li><a href="add-customer.html">Add Customer</a></li>
                   <li><a href="clist.html">List</a></li>
                   <li><a href="group.html">Groups</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                <i class="fa fa-shopping-basket"></i><span>Transaction</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left float-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                   <li><a href="deposit.html">New Deposit</a></li>
                   <li><a href="expense.html">New Expense</a></li>
                   <li><a href="transfer.html">Transfer</a></li>
                   <li><a href="view-tsaction.html">View transaction</a></li>
                   <li><a href="balance.html">Balance Sheet</a></li>
                   <li><a href="treport.html">Transfer Report</a></li>
                </ul>
            </li> --}}
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>
<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
