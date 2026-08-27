<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reservation Receipt | Bite & Co.</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css"
        rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
            background: #050505;
            color: #fff;
            font-family: Poppins, sans-serif;
        }

        .receipt {
            width: 100%;
            max-width: 520px;
            background: #0b0b0b;
            border: 1px solid #292929;
            padding: 40px;
        }

        .receipt-header {
            text-align: center;
            padding-bottom: 25px;
            border-bottom: 1px solid #292929;
        }

        .receipt-header p {
            color: #C41E2B;
            font-size: 10px;
            letter-spacing: 4px;
        }

        .receipt-header h1 {
            font-family: "Playfair Display", serif;
            font-size: 35px;
            margin: 8px 0;
        }

        .receipt-header span {
            color: #666;
            font-size: 10px;
        }

        .receipt-section {
            padding: 20px 0;
            border-bottom: 1px solid #292929;
        }

        .receipt-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 7px 0;
            font-size: 11px;
        }

        .receipt-row span:first-child {
            color: #666;
        }

        .receipt-row span:last-child {
            color: #ddd;
            text-align: right;
        }

        .receipt-food h3 {
            font-family: "Playfair Display", serif;
            font-size: 18px;
            margin-bottom: 12px;
        }

        .food-row {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
            color: #aaa;
            font-size: 10px;
        }

        .total {
            display: flex;
            justify-content: space-between;
            padding: 20px 0;
            font-size: 14px;
        }

        .total strong {
            color: #C41E2B;
            font-size: 22px;
        }

        .receipt-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .receipt-actions a,
        .receipt-actions button {
            flex: 1;
            padding: 14px;
            border: 1px solid #292929;
            background: transparent;
            color: #fff;
            text-align: center;
            text-decoration: none;
            font-family: Poppins, sans-serif;
            font-size: 10px;
            cursor: pointer;
        }

        .receipt-actions a:hover,
        .receipt-actions button:hover {
            background: #C41E2B;
            border-color: #C41E2B;
        }

        @media (max-width: 600px) {

            body {
                padding: 15px;
            }

            .receipt {
                padding: 25px 20px;
            }

        }

        @media print {

            body {
                background: white;
                color: black;
                padding: 0;
            }

            .receipt {
                background: white;
                color: black;
                border: none;
                max-width: 100%;
            }

            .receipt-actions {
                display: none;
            }

        }

    </style>

</head>

<body>

<div class="receipt">

    <div class="receipt-header">

        <p>BITE & CO.</p>

        <h1>Reservation Confirmed</h1>

        <span>
            Thank you, {{ $reservation->user->name }}
        </span>

    </div>


    {{-- RESERVATION INFORMATION --}}

    <div class="receipt-section">

        <div class="receipt-row">
            <span>Reservation #</span>
            <span>
                RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Status</span>
            <span>
                {{ ucfirst($reservation->status) }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Table</span>
            <span>
                {{ $reservation->restaurantTable->table_number }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Seats</span>
            <span>
                {{ $reservation->restaurantTable->seats }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Date</span>
            <span>
                {{ $reservation->reservation_date->format('M d, Y') }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Time</span>
            <span>
                {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}
            </span>
        </div>

        <div class="receipt-row">
            <span>Location</span>
            <span>
                {{ $reservation->location }}
            </span>
        </div>

    </div>


    {{-- FOOD --}}

    @if($reservation->items->count())

        <div class="receipt-section receipt-food">

            <h3>Advance Food Order</h3>

            @foreach($reservation->items as $item)

                <div class="food-row">

                    <span>
                        {{ $item->menuItem->name }}
                        × {{ $item->quantity }}
                    </span>

                    <span>
                        ${{ number_format(
                            $item->price * $item->quantity,
                            2
                        ) }}
                    </span>

                </div>

            @endforeach

        </div>

    @endif


    {{-- TOTAL --}}

    <div class="total">

        <span>
            Total
        </span>

        <strong>
            ${{ number_format($reservation->total_amount, 2) }}
        </strong>

    </div>


    {{-- ACTIONS --}}

    <div class="receipt-actions">

        <a href="{{ route('reservations.index') }}">
            Home
        </a>

        <button type="button" onclick="window.print()">
            <i class="ri-printer-line"></i>
            Print Receipt
        </button>

    </div>

</div>

</body>

</html>