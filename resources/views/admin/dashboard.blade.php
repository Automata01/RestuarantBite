<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bite & Co. | Admin Dashboard</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css"
        rel="stylesheet">

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #050505;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }

        /* =========================
           DASHBOARD
        ========================== */

        .dashboard {
            width: 100%;
            max-width: 1350px;
            margin: auto;
            padding: 100px 20px;
        }


        /* =========================
           KPI
        ========================== */

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .kpi-card {
            background: #0c0c0c;
            border: 1px solid #242424;
            padding: 25px;
        }

        .kpi-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
        }

        .kpi-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #292929;
            color: #C41E2B;
            font-size: 18px;
        }

        .kpi-label {
            color: #777;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kpi-value {
            font-size: 27px;
            font-weight: 500;
            margin-top: 5px;
        }

        /* =========================
           CHARTS
        ========================== */

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }

        .chart-card {
            background: #0c0c0c;
            border: 1px solid #242424;
            padding: 25px;
        }

        .chart-header {
            margin-bottom: 20px;
        }

        .chart-header h2 {
            font-family: "Playfair Display", serif;
            font-size: 20px;
        }

        .chart-header p {
            color: #666;
            font-size: 10px;
            margin-top: 4px;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 300px;
        }

        /* =========================
           TABLES
        ========================== */

        .tables-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }

        .table-card {
            background: #0c0c0c;
            border: 1px solid #242424;
            padding: 25px;
            overflow: hidden;
        }

        .table-card h2 {
            font-family: "Playfair Display", serif;
            font-size: 20px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            color: #555;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px;
            border-bottom: 1px solid #242424;
        }

        td {
            padding: 13px 10px;
            border-bottom: 1px solid #181818;
            font-size: 11px;
        }

        td small {
            color: #666;
        }

        /* =========================
           STATUS
        ========================== */

        .status {
            display: inline-block;
            padding: 5px 9px;
            border: 1px solid #333;
            font-size: 9px;
            text-transform: capitalize;
        }

        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 1100px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .charts-grid,
            .tables-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 800px) {
            nav {
                padding: 0 20px;
            }

            .nav-links {
                display: none;
            }

            .dashboard {
                padding: 25px 20px;
            }
        }

        @media (max-width: 600px) {
            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-header h1 {
                font-size: 30px;
            }

            .chart-container {
                height: 250px;
            }

            .chart-card,
            .table-card,
            .kpi-card {
                padding: 20px;
            }

            .profile-dropdown {
                right: -10px;
                width: 270px;
            }
        }
    </style>
</head>

<body>

    {{-- =========================
         NAVIGATION
    ========================== --}}

    <nav>

        <a href="#" class="logo">
            Bite & Co.
        </a>

        <ul class="nav-links">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('reservations.index') }}">
                    Reservations
                </a>
            </li>

            <li>
                <a href="#">
                    Menu
                </a>
            </li>

            <li>
                <a href="#">
                    Tables
                </a>
            </li>

        </ul>


        {{-- Profile --}}

        <div class="profile-wrapper">

            <button
                type="button"
                class="profile-button"
                id="profileButton"
                aria-label="Open profile menu">

                <span class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>

            </button>


            <div
                class="profile-dropdown"
                id="profileDropdown">

                <div class="profile-header">

                    <div class="profile-avatar profile-avatar-large">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div class="profile-user-info">

                        <h4>
                            {{ auth()->user()->name }}
                        </h4>

                        <p>
                            {{ auth()->user()->email }}
                        </p>

                    </div>

                </div>


                <div class="profile-divider"></div>


                <div class="profile-menu">

                    <a
                        href="{{ route('reservations.index') }}"
                        class="profile-menu-item">

                        <span class="profile-menu-icon">
                            <i class="ri-calendar-line"></i>
                        </span>

                        <span>
                            <strong>Reservations</strong>
                            <small>Manage reservations</small>
                        </span>

                        <i class="ri-arrow-right-s-line profile-arrow"></i>

                    </a>


                    <a
                        href="#"
                        class="profile-menu-item">

                        <span class="profile-menu-icon">
                            <i class="ri-settings-3-line"></i>
                        </span>

                        <span>
                            <strong>Settings</strong>
                            <small>Manage your account</small>
                        </span>

                        <i class="ri-arrow-right-s-line profile-arrow"></i>

                    </a>

                </div>


                <div class="profile-divider"></div>


                <form
                    action="{{ route('logout') }}"
                    method="POST"
                    class="profile-logout-form">

                    @csrf

                    <button
                        type="submit"
                        class="profile-logout">

                        <span class="profile-menu-icon">
                            <i class="ri-logout-box-r-line"></i>
                        </span>

                        <span>
                            <strong>Logout</strong>
                            <small>Sign out of your account</small>
                        </span>

                    </button>

                </form>

            </div>

        </div>

    </nav>


    {{-- =========================
         DASHBOARD
    ========================== --}}

    <main class="dashboard">


      

        {{-- =========================
             KPI
        ========================== --}}

        <div class="kpi-grid">


            {{-- Total Revenue --}}

            <div class="kpi-card">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Total Revenue
                        </div>

                        <div class="kpi-value">
                            ${{ number_format($totalRevenue ?? 0, 2) }}
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="ri-money-dollar-circle-line"></i>
                    </div>

                </div>

            </div>


            {{-- Total Reservations --}}

            <div class="kpi-card">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Total Reservations
                        </div>

                        <div class="kpi-value">
                            {{ number_format($totalReservations ?? 0) }}
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="ri-calendar-check-line"></i>
                    </div>

                </div>

            </div>


            {{-- Today's Reservations --}}

            <div class="kpi-card">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Today's Reservations
                        </div>

                        <div class="kpi-value">
                            {{ number_format($todayReservations ?? 0) }}
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="ri-calendar-event-line"></i>
                    </div>

                </div>

            </div>


            {{-- Pending --}}

            <div class="kpi-card">

                <div class="kpi-top">

                    <div>

                        <div class="kpi-label">
                            Pending Reservations
                        </div>

                        <div class="kpi-value">
                            {{ number_format($pendingReservations ?? 0) }}
                        </div>

                    </div>

                    <div class="kpi-icon">
                        <i class="ri-time-line"></i>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             CHARTS
        ========================== --}}

        <div class="charts-grid">


            {{-- Revenue Bar Chart --}}

            <div class="chart-card">

                <div class="chart-header">

                    <h2>
                        Monthly Revenue
                    </h2>

                    <p>
                        Revenue for the last six months
                    </p>

                </div>

                <div class="chart-container">

                    <canvas id="revenueChart"></canvas>

                </div>

            </div>


            {{-- Reservation Donut --}}

            <div class="chart-card">

                <div class="chart-header">

                    <h2>
                        Reservation Status
                    </h2>

                    <p>
                        Current reservation distribution
                    </p>

                </div>

                <div class="chart-container">

                    <canvas id="reservationChart"></canvas>

                </div>

            </div>

        </div>


        {{-- =========================
             TABLES
        ========================== --}}

        <div class="tables-grid">


            {{-- Recent Reservations --}}

            <div class="table-card">

               

                <div class="table-wrapper">
 <h2>
                    Recent Reservations
                </h2>
                    <table>

                        <thead>

                            <tr>

                                <th>Customer</th>
                                <th>Table</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Total</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($recentReservations ?? [] as $reservation)

                                <tr>

                                    <td>
                                        {{ $reservation->user->name ?? 'Guest' }}
                                    </td>

                                    <td>
                                        {{ $reservation->restaurantTable->table_number ?? '-' }}
                                    </td>

                                    <td>

                                        @if($reservation->reservation_date)

                                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td>

                                        @if($reservation->reservation_time)

                                            {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}

                                        @else

                                            -

                                        @endif

                                    </td>

                                    <td>

                                        <span class="status">

                                            {{ str_replace(
                                                '_',
                                                ' ',
                                                $reservation->status ?? 'pending'
                                            ) }}

                                        </span>

                                    </td>

                                    <td>

                                        ${{ number_format(
                                            $reservation->total_amount ?? 0,
                                            2
                                        ) }}

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6">
                                        No reservations found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- Popular Menu --}}

            <div class="table-card">

               

                <div class="table-wrapper">
 <h2>
                    Popular Menu Items
                </h2>
                    <table>

                        <thead>

                            <tr>

                                <th>Menu Item</th>
                                <th>Sold</th>
                                <th>Revenue</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($popularMenuItems ?? [] as $item)

                                <tr>

                                    <td>
                                        {{ $item->menuItem->name ?? 'Unknown' }}
                                    </td>

                                    <td>
                                        {{ number_format($item->total_quantity ?? 0) }}
                                    </td>

                                    <td>
                                        ${{ number_format(
                                            $item->total_revenue ?? 0,
                                            2
                                        ) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3">
                                        No food orders found.
                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>


    {{-- =========================
         JAVASCRIPT
    ========================== --}}

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            /*
            |--------------------------------------------------------------------------
            | PROFILE DROPDOWN
            |--------------------------------------------------------------------------
            */

            const profileButton =
                document.getElementById("profileButton");

            const profileDropdown =
                document.getElementById("profileDropdown");


            if (profileButton && profileDropdown) {

                profileButton.addEventListener("click", function (event) {

                    event.stopPropagation();

                    profileDropdown.classList.toggle("active");

                });


                document.addEventListener("click", function () {

                    profileDropdown.classList.remove("active");

                });

            }


            /*
            |--------------------------------------------------------------------------
            | CHART DATA
            |--------------------------------------------------------------------------
            */

            const revenueData =
                @json($monthlyRevenue ?? []);

            const statusData =
                @json($reservationStatus ?? []);


            /*
            |--------------------------------------------------------------------------
            | REVENUE BAR CHART
            |--------------------------------------------------------------------------
            */

            const revenueCanvas =
                document.getElementById("revenueChart");


            if (revenueCanvas) {

                new Chart(
                    revenueCanvas,
                    {
                        type: "bar",

                        data: {

                            labels: revenueData.map(function (item) {
                                return item.month;
                            }),

                            datasets: [

                                {
                                    label: "Revenue",

                                    data: revenueData.map(function (item) {
                                        return Number(item.revenue || 0);
                                    }),

                                    borderWidth: 0,

                                    borderRadius: 4

                                }

                            ]

                        },

                        options: {

                            responsive: true,

                            maintainAspectRatio: false,

                            plugins: {

                                legend: {
                                    display: false
                                }

                            },

                            scales: {

                                x: {

                                    grid: {
                                        display: false
                                    },

                                    ticks: {
                                        color: "#777"
                                    }

                                },

                                y: {

                                    beginAtZero: true,

                                    grid: {
                                        color: "#1c1c1c"
                                    },

                                    ticks: {

                                        color: "#777",

                                        callback: function (value) {

                                            return "$" +
                                                Number(value).toLocaleString();

                                        }

                                    }

                                }

                            }

                        }

                    }
                );

            }


            /*
            |--------------------------------------------------------------------------
            | RESERVATION DONUT
            |--------------------------------------------------------------------------
            */

            const reservationCanvas =
                document.getElementById("reservationChart");


            if (reservationCanvas) {

                new Chart(
                    reservationCanvas,
                    {
                        type: "doughnut",

                        data: {

                            labels: statusData.map(function (item) {

                                return String(item.status)
                                    .replaceAll("_", " ")
                                    .replace(/\b\w/g, function (letter) {
                                        return letter.toUpperCase();
                                    });

                            }),

                            datasets: [

                                {

                                    data: statusData.map(function (item) {

                                        return Number(item.count || 0);

                                    }),

                                    borderWidth: 0

                                }

                            ]

                        },

                        options: {

                            responsive: true,

                            maintainAspectRatio: false,

                            cutout: "70%",

                            plugins: {

                                legend: {

                                    position: "bottom",

                                    labels: {

                                        color: "#999",

                                        padding: 15,

                                        font: {
                                            size: 10
                                        }

                                    }

                                }

                            }

                        }

                    }
                );

            }

        });

    </script>

    <script src="{{ asset('js/scroll.js') }}"></script>
</body>

</html>