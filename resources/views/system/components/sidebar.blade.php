<style>
    .sidebar-link[aria-expanded="true"] .dropdown-icon {
        transform: rotate(180deg);
        transition: transform 0.3s ease;
    }

    .dropdown-icon {
        transition: transform 0.3s ease;
    }
</style>
<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar" style="border-right: 1px solid #ae48df; width:280px;">
        <a class="sidebar-brand" href="{{ url('/') }}" style="text-decoration: none;">
            <img style="width: 50px;height: 50px;border-radius: 20px;" src="{{ asset('img/logo.png') }}" alt="">
            <span class="align-middle" style="margin-top: -10px;">Water Power</span>
        </a>


        <ul class="sidebar-nav">
            <li class="sidebar-item mt-3">
                <a class="sidebar-link" href="{{ url('/') }}">
                    <i class="fa fa-th-large"></i>
                    <span class="align-middle" style="font-size: 16px;margin-left: 10px;">Dashboard</span>
                </a>
            </li>


            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#settingsMenu1" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-cogs"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Company Manage</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="settingsMenu1" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ url('/companies') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Company</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ url('/branches') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Branch</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ url('/zones') }}"><span><i class="fa-regular fa-circle-right"></i> Branch
                                Zone</span></a>
                    </li>
                </ul>
            </li>




            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#ProductsManagement" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-brands fa-empire"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Products Manage</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="ProductsManagement" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('taxes.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add tax</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('taxes.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage tax</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('brands.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Brand</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('brands.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Brand</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('sku_departments.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Department </span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('sku_departments.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Department</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('sku_sub_departments.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Sub Department</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('sku_sub_departments.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Sub Department</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('categories.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add SKUS Category </span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('categories.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage SKUS Category</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('skus.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add SKUS</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('skus.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage SKUS</span></a>
                    </li>
                </ul>
            </li>




            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#backoffice" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-brands fa-empire"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Back Office</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="backoffice" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('suppliers.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Supplier</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('suppliers.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Supplier</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('damagewastages.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Damage/Wastage Entry</span></a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('damagewastages.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Damage/Wastage</span></a>
                    </li>
                </ul>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#stockModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Stock Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>
                <ul style="margin-left: 20px;" id="stockModule" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('stocks.create') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Stock</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Update Stock</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('stock_requests.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Add Stock Request</span></a>
                    </li>
                </ul>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#CustomerManagement" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-cogs"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Customer Manage</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="CustomerManagement" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ route('customers.create') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Add Customer</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ route('customers.index') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Manage Customer</span></a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#ShareHolder" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-cogs"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Share Holder Manage</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="ShareHolder" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ route('shareholders.create') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Add Share Holder</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ route('shareholders.index') }}"><span><i class="fa-regular fa-circle-right"></i>
                                Manage Share Holder</span></a>
                    </li>
                </ul>
            </li>






            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#salesModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-puzzle-piece"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Sales Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="salesModule" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('sales_invoices.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Sales Invoice</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Print Invoice</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Return Invoice</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Sales Deposit</span></a>
                    </li>
                </ul>
            </li>






            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#hrModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">HR Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul id="hrModule" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">

                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#employeeAttendance" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Employee Attendance</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>



                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="employeeAttendance"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i> Biometric Attendance</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i> Manual Attendance</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i> All Attendance List</a>
                            </li>
                        </ul>

                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#employeeManagement" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Employee Management</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="employeeManagement"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('departments.index') }}"><i
                                        class="fa-regular fa-circle-right"></i> Add Department</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('designations.index') }}"><i
                                        class="fa-regular fa-circle-right"></i> Add Designation</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('shifts.index') }}"><i
                                        class="fa-regular fa-circle-right"></i> Working Shift</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('employees.create') }}"><i
                                        class="fa-regular fa-circle-right"></i> Add Employee</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('employees.index') }}"><i
                                        class="fa-regular fa-circle-right"></i> All Employee List</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('export.employees') }}"><i
                                        class="fa-regular fa-circle-right"></i> Employee Export</a>
                            </li>

                        </ul>
                    </li>

                </ul>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#LeaveModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Leave Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="LeaveModule" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Leave Entry</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Leave Management</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Leave List</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Leave Export</span></a>
                    </li>

                </ul>
            </li>




            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#PayrollModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Payroll Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="PayrollModule" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Payroll Head</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Employee's Payscale</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Generate Salary Sheet</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Employee's Salary Pay</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Employee's Salary Report</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Employee's Pay Slip Print</span></a>
                    </li>

                </ul>
            </li>







            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#FinanceModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-arrow-down-wide-short"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Finance Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="FinanceModule" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Bank Deposit</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Bank Withdraw</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Income / Expense</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Supplier Payment</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Shareholder Invest</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Commission Withdraw</span></a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#reportsModule" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">Reports Module</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul id="reportsModule" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item">

                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#SupplierAttendance" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Supplier Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>
                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="SupplierAttendance"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Supplier List</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Supplier Balance</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Stock vs Payment</a>
                            </li>
                        </ul>



                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#CustomerReports" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Customer Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="CustomerReports"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Customer List</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Dues Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Dues Details</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Customer Ledger</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Yearly Discount</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Deposit History</a>
                            </li>

                        </ul>


                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#SKUManagement" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> SKUs Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="SKUManagement"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  SKUS List</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Damages List</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Price Change</a>
                            </li>


                        </ul>

                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#StockManagement" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Stock Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="StockManagement"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i> SKU Wise Stock</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Valuation Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Stock Additional Cost</a>
                            </li>


                        </ul>


                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#SalesManagement" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Sales Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="SalesManagement"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Invoices</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Details</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Return</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>   Sales Discount</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>   Special Discount</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Deposit</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Sales Commission</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>   Sales Com. History</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Coll. Com. History</a>
                            </li>

                        </ul>



                        <a class="sidebar-link d-flex justify-content-between align-items-center"
                            style="margin-left: 13px;" href="#" data-bs-toggle="collapse"
                            data-bs-target="#FinanceManagement" aria-expanded="false">
                            <span><i class="fa-regular fa-circle-right"></i> Finance Reports</span>
                            <i class="fa fa-chevron-down dropdown-icon"></i>
                        </a>

                        <!-- Nested Submenu -->
                        <ul style="margin-left: 29px;" id="FinanceManagement"
                            class="sidebar-dropdown list-unstyled collapse">
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Deposit Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Deposit Details</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Withdraw Summary</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Withdraw Details</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Bank Balance</a>
                            </li>


                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>   Income Report</a>
                            </li>


                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Expense Report</a>
                            </li>


                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Cash in Hands</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  VAT Report</a>
                            </li>

                            <li class="sidebar-item">
                                <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><i
                                        class="fa-regular fa-circle-right"></i>  Com. Withdraw</a>
                            </li>

                        </ul>

                    </li>

                </ul>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link d-flex justify-content-between align-items-center" href="#"
                    data-bs-toggle="collapse" data-bs-target="#manageUsers" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-bug"></i>
                        <span class="align-middle ms-2" style="font-size: 16px;">User Manage</span>
                    </div>
                    <i class="fa fa-chevron-down dropdown-icon"></i>
                </a>

                <ul style="margin-left: 20px;" id="manageUsers" class="sidebar-dropdown list-unstyled collapse"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;"
                            href="{{ url('users/create') }}"><span><i class="fa-regular fa-circle-right"></i> Add
                                User</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('permissions.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Permission</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href="{{ route('roles.index') }}"><span><i
                                    class="fa-regular fa-circle-right"></i> Manage Role</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> User activities</span></a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" style="font-size: 14px;font-weight: 400;" href=""><span><i
                                    class="fa-regular fa-circle-right"></i> Reload Permission</span></a>
                    </li>

                </ul>
            </li>


        </ul>
    </div>
</nav>
