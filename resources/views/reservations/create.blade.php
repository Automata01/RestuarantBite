<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Reserve a Table | Bite & Co.</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="{{ asset('css/reservation.css') }}">

</head>

<body>

<div class="reservation-page">

    <div class="reservation-card">

        <button
            type="button"
            class="reservation-close"
            onclick="window.location='{{ route('welcome') }}'">

            <i class="ri-close-line"></i>

        </button>


        <div class="reservation-header">

            <p>BITЕ & CO.</p>

            <h1>Reserve Your Table</h1>

            <span>
                Choose your table, time and location.
            </span>

        </div>


        <form
            method="POST"
            action="{{ route('reservations.store') }}"
            id="reservationForm">

            @csrf


            <!-- =========================
                 STEP 1
            ========================== -->

            <div class="reservation-step active"
                 id="step1">

                <div class="step-title">

                    <span>01</span>

                    <div>
                        <h2>Choose Your Table</h2>

                        <p>
                            Select the table that fits your party.
                        </p>
                    </div>

                </div>


                <div class="table-grid">

                    @foreach($tables as $table)

                        <label class="table-option">

                            <input
                                type="radio"
                                name="restaurant_table_id"
                                value="{{ $table->id }}"
                                data-seats="{{ $table->seats }}"
                                data-location="{{ $table->location }}"
                                required>

                            <div class="table-card">

                                <div class="table-icon">

                                    <i class="ri-restaurant-line"></i>

                                </div>

                                <div>

                                    <h3>
                                        {{ $table->table_number }}
                                    </h3>

                                    <p>
                                        {{ $table->seats }} seats
                                    </p>

                                    <small>
                                        {{ $table->location }}
                                    </small>

                                </div>

                                <i class="ri-check-line table-check"></i>

                            </div>

                        </label>

                    @endforeach

                </div>


                <button
                    type="button"
                    class="reservation-next"
                    id="nextStep1">

                    Continue

                    <i class="ri-arrow-right-line"></i>

                </button>

            </div>


            <!-- =========================
                 STEP 2
            ========================== -->

            <div class="reservation-step"
                 id="step2">

                <div class="step-title">

                    <span>02</span>

                    <div>

                        <h2>Date & Time</h2>

                        <p>
                            Select when you'd like to dine.
                        </p>

                    </div>

                </div>


                <div class="reservation-fields">

                    <div class="reservation-field">

                        <label>
                            Date
                        </label>

                        <input
                            type="date"
                            name="reservation_date"
                            id="reservationDate"
                            min="{{ date('Y-m-d') }}"
                            required>

                    </div>


                    <div class="reservation-field">

                        <label>
                            Time
                        </label>

                        <input
                            type="time"
                            name="reservation_time"
                            id="reservationTime"
                            required>

                    </div>


                    <div class="reservation-field">

                        <label>
                            Location
                        </label>

                        <select
                            name="location"
                            id="reservationLocation"
                            required>

                            <option value="">
                                Select location
                            </option>

                            <option value="Indoor">
                                Indoor
                            </option>

                            <option value="Outdoor">
                                Outdoor
                            </option>

                            <option value="Private">
                                Private Dining
                            </option>

                        </select>

                    </div>

                </div>


                <div class="step-buttons">

                    <button
                        type="button"
                        class="back-button"
                        id="backStep2">

                        <i class="ri-arrow-left-line"></i>

                        Back

                    </button>

                    <button
                        type="button"
                        class="reservation-next"
                        id="nextStep2">

                        Continue

                        <i class="ri-arrow-right-line"></i>

                    </button>

                </div>

            </div>


            <!-- =========================
                 STEP 3
            ========================== -->

            <div class="reservation-step"
                 id="step3">

                <div class="step-title">

                    <span>03</span>

                    <div>

                        <h2>Advance Food Order?</h2>

                        <p>
                            Would you like to prepare your food in advance?
                        </p>

                    </div>

                </div>


                <div class="advance-options">

                    <button
                        type="button"
                        class="advance-option"
                        id="foodYes">

                        <i class="ri-restaurant-2-line"></i>

                        <strong>Yes, order food</strong>

                        <span>
                            Choose your food before arrival.
                        </span>

                    </button>


                    <button
                        type="button"
                        class="advance-option"
                        id="foodNo">

                        <i class="ri-close-circle-line"></i>

                        <strong>No, thank you</strong>

                        <span>
                            I'll order when I arrive.
                        </span>

                    </button>

                </div>


                <button
                    type="button"
                    class="back-button full-back"
                    id="backStep3">

                    <i class="ri-arrow-left-line"></i>

                    Back

                </button>

            </div>


            <!-- =========================
                 STEP 4 FOOD
            ========================== -->

            <div class="reservation-step"
                 id="step4">

                <div class="step-title">

                    <span>04</span>

                    <div>

                        <h2>Choose Your Food</h2>

                        <p>
                            Select items you'd like prepared in advance.
                        </p>

                    </div>

                </div>


                <div class="food-layout">

                    <div class="food-grid">

                        @foreach($menuItems as $food)

                            <div
                                class="food-card"
                                data-id="{{ $food->id }}"
                                data-name="{{ $food->name }}"
                                data-price="{{ $food->price }}">

                                <div class="food-image">

                                    @if($food->image)

                                        <img
                                            src="{{ asset($food->image) }}"
                                            alt="{{ $food->name }}">

                                    @else

                                        <i class="ri-restaurant-2-line"></i>

                                    @endif

                                </div>


                                <div class="food-info">

                                    <h3>
                                        {{ $food->name }}
                                    </h3>

                                    <p>
                                        {{ $food->description }}
                                    </p>

                                    <strong>
                                        ${{ number_format($food->price, 2) }}
                                    </strong>

                                </div>


                                <div class="food-quantity">

                                    <button
                                        type="button"
                                        class="quantity-minus">

                                        −

                                    </button>

                                    <span class="quantity">
                                        0
                                    </span>

                                    <button
                                        type="button"
                                        class="quantity-plus">

                                        +

                                    </button>

                                </div>

                            </div>

                        @endforeach

                    </div>


                    <!-- CART -->

                    <div class="food-cart">

                        <h3>
                            Your Order
                        </h3>

                        <div
                            class="cart-items"
                            id="cartItems">

                            <p class="empty-cart">
                                No food selected.
                            </p>

                        </div>


                        <div class="cart-total">

                            <span>
                                Food Total
                            </span>

                            <strong id="foodTotal">
                                $0.00
                            </strong>

                        </div>

                    </div>

                </div>


                <div class="step-buttons">

                    <button
                        type="button"
                        class="back-button"
                        id="backStep4">

                        <i class="ri-arrow-left-line"></i>

                        Back

                    </button>


                    <button
                        type="button"
                        class="reservation-next"
                        id="reserveWithFood">

                        Continue

                        <i class="ri-arrow-right-line"></i>

                    </button>

                </div>

            </div>


            <!-- =========================
                 HIDDEN ITEMS
            ========================== -->

            <div id="hiddenItems">
            </div>


            <!-- =========================
                 STEP 5
            ========================== -->

            <div class="reservation-step"
                 id="step5">

                <div class="step-title">

                    <span>05</span>

                    <div>

                        <h2>Confirm Reservation</h2>

                        <p>
                            Check your reservation before confirming.
                        </p>

                    </div>

                </div>


                <div class="confirmation-box">

                    <div>
                        <span>Table</span>
                        <strong id="confirmTable">-</strong>
                    </div>

                    <div>
                        <span>Seats</span>
                        <strong id="confirmSeats">-</strong>
                    </div>

                    <div>
                        <span>Date</span>
                        <strong id="confirmDate">-</strong>
                    </div>

                    <div>
                        <span>Time</span>
                        <strong id="confirmTime">-</strong>
                    </div>

                    <div>
                        <span>Location</span>
                        <strong id="confirmLocation">-</strong>
                    </div>

                    <div>
                        <span>Food Total</span>
                        <strong id="confirmTotal">$0.00</strong>
                    </div>

                </div>


                <div class="step-buttons">

                    <button
                        type="button"
                        class="back-button"
                        id="backStep5">

                        <i class="ri-arrow-left-line"></i>

                        Back

                    </button>


                    <button
                        type="submit"
                        class="reservation-submit">

                        Confirm Reservation

                        <i class="ri-check-line"></i>

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>


<script src="{{ asset('js/reservation.js') }}"></script>

</body>
</html>