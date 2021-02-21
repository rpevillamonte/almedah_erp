@extends('layouts.app')
@section('content')

<!-- Bootstrap row -->
<div class="row p-3" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group pb-3">
            <!-- Separator with title -->
            <li class="list-group-item p-2 sidebar-separator-title text-light bg-dark text-center  menu-collapsed">
                <p class="">Menu</p>
            </li>
            <!-- /END Separator -->
            <!-- Collapse Button -->
            <a href="#top" data-toggle="sidebar-colapse" class="bg-dark  list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a>
            <!-- End of Collapse Button -->
            <!-- Menu with submenu -->
            <!-- Dashboard -->
            <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-dark ">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-columns fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Dashboard</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of dashboard -->
            <!-- Menu Item Messages -->
            <a href="#submenuMessages" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope-o fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller">Messaging</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Messages -->
            <!-- Submenu Messages content -->
            <div id='submenuMessages' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Inbox</span>
                </a>
                <a href="#" id="important-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Important</span>
                </a>
                <a href="#" id="archived-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Archived</span>
                </a>
                <a href="#submenuMalingList" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="menu-collapsed align-middle">Mailing List</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenuMalingList' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-2">My Mailing List</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-2">All Mailing List</span>
                    </a>
                </div>
            </div>
            <!-- End of Submenu Messages content -->
            <!-- Menu Item Manufacturing -->
            <a href="#submenuManufacturing" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-cogs fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Manufacturing</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Manufacturing -->
            <!-- Submenu Manufacturing content -->
            <div id='submenuManufacturing' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Item</span>
                </a>
            </div>
            <div id='submenuManufacturing' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Inventory</span>
                </a>
            </div>
            <div id='submenuManufacturing' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">BOM</span>
                </a>
            </div>
            <div id='submenuManufacturing' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Customer</span>
                </a>
            </div>
            <!-- End of Submenu Manufacturing content -->
            <!-- Menu Item Buying -->
            <a href="#submenuBuying" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-shopping-cart fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Buying</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Buying -->
            <!-- Submenu Buying content -->
            <div id='submenuBuying' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Material Request</span>
                </a>
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Order</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Invoice</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Request for Quotation</span>
                </a>
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Item</span>
                </a>
            </div>
            <!-- End of Submenu Buying content -->
            <!-- Menu Item Accounting -->
            <a href="#submenuAccounting" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calculator fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Accounting</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Accounting -->
            <!-- Submenu Accounting content -->
            <div id='submenuAccounting' class="collapse sidebar-submenu">
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Sales Invoce</span>
                </a>
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Customer</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Invoice</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Supplier</span>
                </a>
                <a href="#" id="inbox-toggle" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Company</span>
                </a>
            </div>
            <!-- End of Submenu Accounting content -->
            <!-- Menu Item Selling -->
            <a href="#submenuSelling" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-calendar fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Selling</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Selling -->
            <!-- Submenu Item Selling -->
            <div id='submenuSelling' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Customer</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Quotation</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Sales Order</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Sales Invoice</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Blanket Order</span>
                </a>
            </div>
            <!-- End of Submenu Item Selling -->
            <!-- Menu Item Stock -->
            <a href="#submenuStock" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-boxes fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Stock</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Stock -->
            <!-- Submenu Item Stock -->
            <div id='submenuStock' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Stock Entry</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Delivery Note</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Receipt</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Material Request</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Pick List</span>
                </a>
            </div>
            <!-- End of Submenu Item Stock -->
            <!-- Menu Item CRM -->
            <a href="#submenuCRM" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-users fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">CRM</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item CRM -->
            <!-- Submenu Item CRM -->
            <div id='submenuCRM' class="collapse sidebar-submenu">
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Leads</span>
                </a>
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Customers</span>
                </a>
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Contacts</span>
                </a>
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Opportunities</span>
                </a>
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Lead Details</span>
                </a>
            </div>
            <!-- End of Submenu Item CRM -->
            <!-- Menu Item Quality -->
            <a href="#submenuQuality" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-check-square fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Quality</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Quality -->
            <!-- Submenu Item Quality -->
            <div id='submenuQuality' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Quality Goal</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Quality Procedure</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Quality Review</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Quality Feedback</span>
                </a>
            </div>
            <!-- End of Submenu Item Quality -->
            <!-- Menu Item HR -->
            <a href="#submenuHR" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-project-diagram fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">HR</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item HR -->
            <!-- Submenu Item HR -->
            <div id='submenuHR' class="collapse sidebar-submenu">
                <a href="#" class="menu list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Employee</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Employee Attendance Tool</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Attendance</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Salary Structure</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Salary Structure Assignment</span>
                </a>
            </div>
            <!-- End of Submenu Item HR -->
            <!-- Menu Item Projects -->
            <a href="#submenuProjects" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-server fa-fw mr-3 menu"></span>
                    <span class="menu-collapsed align-middle smaller menu">Projects</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Projects -->
            <!-- Submenu Item Projects -->
            <div id='submenuProjects' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Project</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Task</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Gantt Chart</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Timesheet</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Activity Type</span>
                </a>
            </div>
            <!-- End of Submenu Item Projects -->
            <!-- Menu Item Retail -->
            <a href="#submenuRetail" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fas fa-search-dollar fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Retail</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Retail -->
            <!-- Submenu Item Retail -->
            <div id='submenuRetail' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Point-of-Sale Profile</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">POS</span>
                </a>
            </div>
            <!-- End of Submenu Item Retail -->
            <!-- Menu Item Sales -->
            <a href="#submenuSales" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-chart-line fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Sales</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Sales -->
            <!-- Submenu Item Sales -->
            <div id='submenuSales' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Customers</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Contacts</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Products & Services</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Sale Quotations</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Sale Orders</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Mass Cust. Stock Move Invoicing</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">ABC Analysis</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Historical</span>
                </a>
                <a href="#submenuSalesReport" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-chart-bar fa-fw mr-3"></span>
                        <span class="menu-collapsed align-middle">Reportings</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenuSalesReport' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Salesperson</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Sales Manager</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Sales Details</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Turnover Study</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Customers</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Maps</span>
                        <span class="submenu-icon ml-auto"></span>
                    </a>
                </div>
                <a href="#submenuSalesConfiguration" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-cog fa-fw mr-3"></span>
                        <span class="menu-collapsed align-middle">Configuration</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenuSalesConfiguration' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Timetable Templates</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Cancel Reasons</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Durations</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Shipping Cost</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Partnet Price List</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Price List</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Quotation Template</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Taxes</span>
                    </a>
                </div>
            </div>
            <!-- End of Submenu Item Sales -->
            <!-- Menu Item Purchases -->
            <a href="#submenuPurchases" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-shopping-cart fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Purchases</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Purchases -->
            <!-- Submenu Item Purchases -->
            <div id='submenuPurchases' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Suppliers</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Contacts</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Products & Services</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Internal Purchase Request</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Quotations</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Purchase Orders</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Mass Suppl. Stock Move Invoicing</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">ABC Analysis</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Historical</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-secondary">
                    <span class="menu-collapsed align-middle">Supplier Consultations</span>
                </a>
                <a href="#submenuPurchasesReport" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-chart-bar fa-fw mr-3"></span>
                        <span class="menu-collapsed align-middle">Reportings</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenuPurchasesReport' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Purchase Buyer</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Purchase Manager</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Purchase Order</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Suppliers Maps</span>
                        <span class="submenu-icon ml-auto"></span>
                    </a>
                </div>
                <a href="#submenuPurchasesConfiguration" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                        <span class="fa fa-cog fa-fw mr-3"></span>
                        <span class="menu-collapsed align-middle">Configuration</span>
                        <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <div id='submenuPurchasesConfiguration' class="collapse sidebar-submenu">
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Partner Price List</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Price List</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-secondary text-light">
                        <span class="menu-collapsed align-middle mx-3">Purchase Request Creator</span>
                    </a>
                </div>
            </div>
            <!-- End of Submenu Item Purchases -->
            <!-- Menu Item Job Costing -->
            <a href="#submenuJobCosting" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-list-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Job Costing</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Job Costing -->
            <!-- Menu Item Invoicing Project -->
            <a href="#submenuInvoicingProject" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-server fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Invoicing Project</span>
                </div>
            </a>
            <!-- End of Menu Item Invoicing Project -->
            <!-- Menu Item Invoicing -->
            <a href="#submenuInvoicing" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-file-alt fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Invoicing</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Invoicing -->
            <!-- Menu Item Cash Management -->
            <a href="#submenuCashManagement" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-money-bill fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Cash Management</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Cash Management -->
            <!-- Menu Item Stock Management -->
            <a href="#submenuStockManagement" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-cubes fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Stock Management</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Stock Management -->
            <!-- Menu Item Application Config -->
            <a href="#submenuApplicationConfig" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-cog fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Application Config</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Application Config -->
            <!-- Menu Item Administration -->
            <a href="#submenuAdministration" data-toggle="collapse" aria-expanded="false" class="bg-dark  list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-wrench fa-fw mr-3"></span>
                    <span class="menu-collapsed align-middle smaller menu">Administration</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- End of Menu Item Administration -->
        </ul>
        <!-- List Group END-->
    </div>
    <!-- sidebar-container END -->
    <!-- MAIN -->

    <div class="col p-3 div-tab" id="divMain">
    </div>
    <!-- Main Col END -->
</div>
<script src="{{ asset('js/custom-side-nav.js') }}"></script>
<script src="{{ asset('js/custom-tab-nav.js') }}"></script>
@endsection