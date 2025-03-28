@extends('system.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 col-xxl-12 d-flex">
            <div class="w-100">
                <div class="row">


                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body"
                                style="display: flex;justify-content: center;align-items:center;flex-direction: column; background: #9C27B3; ">
                                <span style="font-size: 40px; color: #ffffff;"><i class="fa-solid fa-users"></i></span>
                                <h3 style="font-size: 26px;font-weight: 800;color: #ffffff !important;margin-top: 9px;letter-spacing: .5px;margin-bottom: 12px;"
                                    class="text-muted">Total Customers</h3>
                                <h4 style="font-size: 23px;color: #ffffff !important;font-weight: 500;" class="mt-1 mb-3">
                                    1090</h4>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body"
                                style="display: flex;justify-content: center;align-items:center;flex-direction: column;background: #7A1FA2;">
                                <span style="font-size: 40px; color: #ffffff;"><i class="fa-solid fa-turn-up"></i></span>
                                <h3 style="font-size: 26px;font-weight: 800;color: #ffffff !important;margin-top: 9px;letter-spacing: .5px;margin-bottom: 12px;"
                                    class="text-muted">Total Orders</h3>
                                <h4 style="font-size: 23px;color: #ffffff !important;font-weight: 500;" class="mt-1 mb-3">43
                                </h4>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body"
                                style="display: flex;justify-content: center;align-items:center;flex-direction: column;background: #6A1B9A;">
                                <span style="font-size: 40px; color: #fcfcfc;"><i class="fa-solid fa-turn-up"></i></span>
                                <h3 style="font-size: 26px;font-weight: 800;color: #ffffff !important;margin-top: 9px;letter-spacing: .5px;margin-bottom: 12px;"
                                    class="text-muted">Today Sales</h3>
                                <h4 style="font-size: 23px;color: #ffffff !important;font-weight: 500;" class="mt-1 mb-3">
                                    678</h4>

                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3">
                        <div class="card">
                            <div class="card-body"
                                style="display: flex;justify-content: center;align-items:center;flex-direction: column;background: #4A148C;">
                                <span style="font-size: 40px; color: #ffffff;"><i class="fa-solid fa-turn-down"></i></span>
                                <h3 style="font-size: 26px;font-weight: 800;color: #ffffff !important;margin-top: 9px;letter-spacing: .5px;margin-bottom: 12px;"
                                    class="text-muted">Total Payables</h3>
                                <h4 style="font-size: 23px;color: #ffffff !important;font-weight: 500;" class="mt-1 mb-3">0
                                </h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Orders</h5>

                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="chartjs-bar"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-size: 19px;color: #3d3c3c;font-weight: 600;">Today Orders List</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Zone</th>
                                <th>QTY</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>3</td>
                                <td>400</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>5</td>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>3</td>
                                <td>100</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>6</td>
                                <td>5000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 style="font-size: 19px;color: #3d3c3c;font-weight: 600;">Today Customer's Deposit</h4>

                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Zone</th>
                                <th>Name</th>
                                <th>Top Up</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>2000</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>5000</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>3000</td>
                            </tr>
                            <tr>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>7000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h6 style="font-size: 19px;color: #3d3c3c;font-weight: 600; margin-bottom: -14px;">User Logged In</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Branch</th>
                                <th>Zone</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Logged In</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img style="width: 50px;"
                                        src="https://waterpowermetal.com/media/user/20230514221129_factory%20division%20(2).jpg"
                                        alt="">
                                </td>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>01906492202</td>
                                <td>
                                    <h3><i style="background-color: green;border-radius: 50%;color: green;"
                                            class="fa-regular fa-circle"></i></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="width: 50px;"
                                        src="https://waterpowermetal.com/media/user/20230514221129_factory%20division%20(2).jpg"
                                        alt="">
                                </td>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>01906492202</td>
                                <td>
                                    <h3><i style="background-color: green;border-radius: 50%;color: green;"
                                            class="fa-regular fa-circle"></i></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="width: 50px;"
                                        src="https://waterpowermetal.com/media/user/20230514221129_factory%20division%20(2).jpg"
                                        alt="">
                                </td>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>01906492202</td>
                                <td>
                                    <h3><i style="background-color: green;border-radius: 50%;color: green;"
                                            class="fa-regular fa-circle"></i></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <img style="width: 50px;"
                                        src="https://waterpowermetal.com/media/user/20230514221129_factory%20division%20(2).jpg"
                                        alt="">
                                </td>
                                <td>Ukhiya Division</td>
                                <td>Moniccha /Courtbazar/Ukhiya /palongkhali/Teknaf</td>
                                <td>Monirul ASM</td>
                                <td>01906492202</td>
                                <td>
                                    <h3><i style="background-color: green;border-radius: 50%;color: green;"
                                            class="fa-regular fa-circle"></i></h3>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
