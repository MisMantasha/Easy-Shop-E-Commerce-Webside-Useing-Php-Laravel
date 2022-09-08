@push('css')

<style>
    /* List */
    table.errorlist .counter {
        text-align: right;
    }

    table.errorlist .counter span {
        background-color: #eee;
        border-radius: 2px;
        padding: 1px 5px;
    }

    /* Summaries*/
    table.summaries td {
        padding-right: 40px;
    }

    table.summaries td.critical {
        color: #e6614f;
    }

    table.summaries div.value {
        font-size: 40px;
        margin-top: 10px;
    }

    /* Bar Chart */
    .barchart {
        font-size: 9px;
        line-height: 15px;
        table-layout: fixed;
        text-align: center;
        width: 100%;
        height: 226px;
    }

    .barchart tr:nth-child(1) td {
        vertical-align: bottom;
        height: 200px;
    }

    .barchart .bar {
        background: #0DA58E;
        padding: 0px 2px 0;
    }

    .barchart .bar1 {
        background: #0da547;
        padding: 0px 2px 0;
    }

    .barchart .bar2 {
        background: #e78568;
        padding: 0px 2px 0;
    }

    .barchart .label {
        background-color: black;
        margin-top: -30px;
        padding: 0 3px;
        color: white;
        border-radius: 4px;
    }

    /* Start PI Chart */
    #chartdiv {
        width: 100%;
        height: 245px;
    }

    /* End PI Chart */
</style>

@endpush
<x-app-layout>
    <x-slot name="title">
        {{ __('DASHBOARD') }}
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="rounded">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18 ml-2">Dashboard</h4>
                    <div class="page-title-right">
                       <!--  <ol class="breadcrumb m-0 mr-2">
                            <li class="breadcrumb-item text-light font-size-16"><a href="javascript: void(0);"
                                    style="color:#fdfffe;">Dashboards</a></li>
                            <li class="breadcrumb-item active font-size-16" style="color:#fdfffe;">Home</li>
                        </ol> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card" style="background-color: #42569f;">
                    <div>
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h6 class="text-light">Welcome To</h6>
                                    <h5 class="text-light">@if($companyInfo) {{$companyInfo->name}} @endif</h5>
                                    <ul class="pl-3 mb-0">
                                        <li class="py-2 text-light">
                                            <a href="{{route('contact-info.all-user-list')}}" class="text-white">
                                                {{$allUser}}+ Users
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img @if($companyInfo) src="{{ asset('storage/photo/'.$companyInfo->logo) }}" @endif
                                    style="height:125px;width:100%;background-image: cover;" alt=""
                                    class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card" style="background-color: #61daff;">
                            <div class="card-body">
                                <a href="{{ route('order.order-processing') }}">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-xs mr-3">
                                            <span
                                                class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                                <i class="bx bx-copy-alt"></i>
                                            </span>
                                        </div>
                                        <h5 class="font-size-14 mb-0">Processing Orders</h5>
                                    </div>
                                    <div class="text-muted mt-4">
                                        <h2>{{ $orders_count }}</h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                       
                    </div>

                    <div class="col-sm-4">
                       
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>

        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="clearfix">
                            <h4 class="card-title mb-4">Top Selling Product</h4>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-centered mb-0">
                                <tbody>
                                    @foreach ($best_Selling_products as $best_Selling_product)
                                    <tr>
                                        <td>
                                            <h5 class="font-size-14 mb-1">@if($best_Selling_product->Product)
                                                {{$best_Selling_product->Product->name}} @endif</h5>
                                            <p class="text-muted mb-0">@if($best_Selling_product->Product)
                                                {{$best_Selling_product->Product->featured}} @endif</p>
                                        </td>
                                        <td>
                                            <div id="radialchart-1" class="apex-charts"></div>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-1">Sales</p>
                                            <h5 class="mb-0">{{ intval(($best_Selling_product->quantity *
                                                100)/$total_quantity)}} %</h5>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Top Ten Customer</h4>

                        <div class="mt-4">
                            <div data-simplebar>

                                <div class="table-responsive">
                                    <table class="table table-nowrap table-centered table-hover mb-0">
                                        <tbody>
                                            @foreach ($top_five_customers as $top_five_customer)

                                            <tr>
                                                <td>
                                                    <h5 class="font-size-14 mb-1">
                                                        @if(isset($top_five_customer->Contact))
                                                        {{$top_five_customer->Contact->business_name}}-{{$top_five_customer->Contact->first_name}} @endif
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        @if(isset($top_five_customer->Contact))
                                                        {{$top_five_customer->Contact->mobile}} @endif
                                                    </p>
                                                </td>

                                                <td>
                                                    <div id="radialchart-1" class="apex-charts"></div>
                                                </td>
                                                <td>
                                                    <p class="text-muted mb-1">Total Purchase Amount</p>
                                                    <h5 class="mb-0">{{ intval($top_five_customer->payable_amount)}}</h5>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
        <!-- Resources -->
        <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

        <!-- Chart code -->
        <script>
            am5.ready(function() {

// Create root element
var root = am5.Root.new("chartdiv");


// Set themes
root.setThemes([
  am5themes_Animated.new(root)
]);


// Create chart
var chart = root.container.children.push(am5percent.PieChart.new(root, {
  layout: root.verticalLayout
}));


// Create series
var series = chart.series.push(am5percent.PieSeries.new(root, {
  valueField: "value",
  categoryField: "category"
}));

var one=document.getElementById("one").value;
var two=document.getElementById("two").value;
var three=document.getElementById("three").value;
var four=document.getElementById("four").value;
var five=document.getElementById("five").value;
var six=document.getElementById("six").value;
var seven=document.getElementById("seven").value;
var eight=document.getElementById("eight").value;
var nine=document.getElementById("nine").value;
var ten=document.getElementById("ten").value;
var eleven=document.getElementById("eleven").value;
var twelve=document.getElementById("twelve").value;

// Start Current Month
var monthName = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
var d = new Date();
d.setDate(1);
var all_months = [];
for (i=0; i<=11; i++) {
    all_months[i] = monthName[d.getMonth()];
    d.setMonth(d.getMonth() - 1);
}
// End Current Month
// Set data
// https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
series.data.setAll([
  { value: one, category: all_months[11] },
  { value: two, category: all_months[10] },
  { value: three, category: all_months[9] },
  { value: four, category: all_months[8] },
  { value: five, category: all_months[7] },
  { value: six, category: all_months[6] },
  { value: seven, category: all_months[5] },
  { value: eight, category: all_months[4] },
  { value: nine, category: all_months[3] },
  { value: ten, category: all_months[2] },
  { value: eleven, category: all_months[1] },
  { value: twelve, category: all_months[0] },
]);


// Play initial series animation
// https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
series.appear(1000, 100);

}); // end am5.ready()
        </script>
    </div>
</x-app-layout>
@push('scripts')
<!-- plugin js -->
<script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Calendar init -->
<script src="{{ URL::asset('assets/js/pages/dashboard.init.js') }}"></script>
<!-- plugin js -->


@endpush
