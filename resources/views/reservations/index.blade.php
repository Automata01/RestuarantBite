<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bite & Co.</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <nav>
        <a href="#" class="logo">Bite & Co.</a>

        <ul class="nav-links">
            <li><a href="#hero">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#menu">Menu</a></li>
            <li><a href="#gallery">Gallery</a></li>
        </ul>

        @auth
        <div class="auth-nav">

            <a href="{{ route('reservations.create') }}"
   class="reservation-icon"
   title="Reserve a Table">
    <i class="ri-calendar-event-line"></i>
</a>

            <!-- Receipt -->
<a href="#"
   class="reservation-icon"
   id="openReceiptModal"
   title="My Receipts">
    <i class="ri-receipt-line"></i>
</a>

            <!-- Profile -->
            <div class="profile-wrapper">

                <button type="button"
                    class="profile-button"
                    id="profileButton"
                    aria-label="Open profile menu">

                    <span class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>

                </button>

                <!-- Profile Popup -->
                <div class="profile-dropdown" id="profileDropdown">

                    <div class="profile-header">

                        <div class="profile-avatar profile-avatar-large">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <div class="profile-user-info">
                            <h4>{{ auth()->user()->name }}</h4>
                            <p>{{ auth()->user()->email }}</p>
                        </div>

                    </div>

                    <div class="profile-divider"></div>

                    <div class="profile-menu">

                        <a href="{{ route('reservations.index') }}"
   class="profile-menu-item">

    <span class="profile-menu-icon">
        <i class="ri-history-line"></i>
    </span>

    <span>
        <strong>Order History</strong>
        <small>View your reservations</small>
    </span>

    <i class="ri-arrow-right-s-line profile-arrow"></i>

</a>

                        <!-- Settings -->
                        <a href="#"
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

                    <!-- Logout -->
                    <form action="{{ route('logout') }}"
                        method="POST"
                        class="profile-logout-form">

                        @csrf

                        <button type="submit" class="profile-logout">

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

        </div>

        @else

        <button type="button"
            class="reserve-btn"
            id="openAuthModal">
            Reserve
        </button>

        @endauth
    </nav>
    <section id="hero">
        <div class="hero-left">
            <p class="hero-p">An Elevated Dining Experience</p>

            <h1 class="hero-h1">
                A Taste Worth
                <br>
                Coming Back For
            </h1>

            <span class="hero-line"></span>
            <p class="hero-des">
                Discover beautifully crafted dishes made with quality ingredients and served in a space designed for unforgettable moments.
            </p>
            <button class="hero-btn">Reserve Table</button>
        </div>

        <div class="hero-right">
            <img src="{{ asset('images/hero-img.png') }}" alt="">
        </div>
    </section>
    <section id="about">
        <div class="about-left">
            <img src="{{ asset('images/about-img.png') }}" alt="Chef preparing omakase">
        </div>
        <div class="about-right">
            <p class="about-number">01</p>
            <p class="about-p">About Us</p>
            <h2 class="about-h2">
                Discipline as an
                <br>
                Act of Care
            </h2>
            <span class="about-line"></span>
            <p class="about-des">
                Bite & Co. is a modern dining experience built around quality ingredients, bold flavors, and meaningful moments. Every dish is thoughtfully prepared with care and creativity, bringing together familiar favorites and contemporary flavors in a warm, inviting atmosphere. We believe great food is more than a meal—it’s something meant to be shared, enjoyed, and remembered.
            </p>
        </div>
    </section>
    <section id="menu">
        <p class="menu-label">The Omakase</p>
        <h2 class="menu-h2">Tasting Menu</h2>
        <div class="list_menu">
            <p class="list_number">01</p>
            <div class="list-detail">
                <h3 class="list-name">Salmon Aburi Sushi</h3>
                <p class="list-des">Seared salmon, sushi rice, ponzu, and scallions.</p>
            </div>
            <p class="list_price">$6</p>
        </div>
        <div class="list_menu">
            <p class="list_number">02</p>
            <div class="list-detail">
                <h3 class="list-name">Tuna Tataki</h3>
                <p class="list-des">Seared premium tuna with sesame, citrus ponzu, and daikon.</p>
            </div>
            <p class="list_price">$7</p>
        </div>
        <div class="list_menu">
            <p class="list_number">03</p>
            <div class="list-detail">
                <h3 class="list-name">Bite & Co. Signature Roll</h3>
                <p class="list-des">Salmon, avocado, cucumber, and spicy mayo topped with seared tuna.</p>
            </div>
            <p class="list_price">$8</p>
        </div>
        <div class="list_menu">
            <p class="list_number">04</p>
            <div class="list-detail">
                <h3 class="list-name">Wagyu Donburi</h3>
                <p class="list-des">Sliced wagyu beef over steamed Japanese rice with onsen egg and tare sauce.</p>
            </div>
            <p class="list_price">$11</p>
        </div>
        <div class="menu-btn-wrapper">
            <a href="#" class="menu-btn">
                View Full Menu
                <span>→</span>
            </a>
        </div>
    </section>
    <section id="gallery">
        <div class="gallery-item">
            <img src="{{ asset('images/gallary-1.png') }}" alt="">
            <img src="{{ asset('images/gallary-2.jpg') }}" alt="">
            <img src="{{ asset('images/gallary-3.jpg') }}" alt="">
            <img src="{{ asset('images/gallary-4.jpg') }}" alt="">
        </div>
    </section>
    <section id="reservation">
        <p class="reserve_label">
            Reservations
        </p>
        <h1 class="reserve-h1">Twelve seats, one counter, <br> every evening</h1>
        <p class="reserve-des">Seatings open six weeks in advance. We recommend booking early for weekend evenings.</p>
        <button class="reserve-btn">Reserve a Table</button>
    </section>
    <section id="footer">

        <div class="footer_top">
            <div class="footer_logo">
                <a href="#" class="logo">Bite & Co.</a>
                <p class="logo-des">
                    Experience thoughtfully crafted dishes in a warm, contemporary setting where every bite brings people together.
                </p>
            </div>
            <div class="footer_nav_link">
                <p class="footer-label-link">Navigation</p>
                <ul class="footer-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#menu">Menu</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                </ul>
            </div>
            <div class="footer_contact">
                <p class="footer-label-link">Visit Us</p>
                <p>123 Sakura Street</p>
                <p>Tokyo, Japan</p>
                <p>+81 123 456 789</p>
                <p>hello@BiteCo.com</p>
            </div>
            <div class="footer_soc-med">
                <p class="footer-label-link">Follow Us</p>
                <div class="social-links">
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-facebook-circle-line"></i></a>
                    <a href="#"><i class="ri-twitter-x-line"></i></a>
                    <a href="#"><i class="ri-tiktok-line"></i></a>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <p>© 2026 Bite & Co.</p>
        </div>
    </section>

    <!-- =========================
     RECEIPT MODAL
========================= -->

@auth
<div class="receipt-modal" id="receiptModal">

    <div class="receipt-overlay"></div>

    <div class="receipt-box">

        <button
            type="button"
            class="receipt-close"
            id="receiptClose">
            <i class="ri-close-line"></i>
        </button>

        <div class="receipt-header">

            <p class="receipt-label">
                Bite & Co.
            </p>

            <h2>My Receipts</h2>

            <p>
                View your reservations and advance food orders.
            </p>

        </div>


        @if($reservations->isNotEmpty())
            @php($reservation = $reservations->first())

        <div class="receipt-card">

            <div class="receipt-card-header">

                <div>
                    <span>Reservation</span>
                    <h3>
                        #RES-{{ str_pad($reservation->id, 4, '0', STR_PAD_LEFT) }}
                    </h3>
                </div>

                <span class="receipt-status">
                    {{ ucfirst($reservation->status) }}
                </span>

            </div>


            <div class="receipt-details">

                <div>
                    <span>Table</span>
                        <strong>{{ $reservation->restaurantTable->table_number }}</strong>
                </div>

                <div>
                    <span>Guests</span>
                        <strong>{{ $reservation->restaurantTable->seats }} People</strong>
                </div>

                <div>
                    <span>Date</span>
                        <strong>{{ $reservation->reservation_date->format('M d, Y') }}</strong>
                </div>

                <div>
                    <span>Time</span>
                        <strong>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</strong>
                </div>

                <div>
                    <span>Location</span>
                        <strong>{{ $reservation->location }}</strong>
                </div>

            </div>


            <div class="receipt-food">

                <div class="receipt-food-header">
                    <span>Advance Food Order</span>
                </div>

                @forelse($reservation->items as $item)
                    <div class="receipt-food-item">
                        <span>
                            {{ $item->menuItem->name }} x {{ $item->quantity }}
                        </span>

                        <strong>
                            ${{ number_format($item->price * $item->quantity, 2) }}
                        </strong>
                    </div>
                @empty
                    <div class="receipt-food-item">
                        <span>No advance food order</span>
                    </div>
                @endforelse

                <div class="receipt-total">

                    <span>Total</span>

                    <strong>
                        ${{ number_format($reservation->total_amount, 2) }}
                    </strong>

                </div>

            </div>


            <a
                href="{{ route('reservations.receipt', $reservation->id) }}"
                class="receipt-view-btn">

                View Receipt

                <i class="ri-arrow-right-line"></i>

            </a>

        </div>
        @else
            <div class="receipt-card">
                <p>No reservations yet.</p>
                <a href="{{ route('reservations.create') }}" class="receipt-view-btn">
                    Reserve a Table
                    <i class="ri-arrow-right-line"></i>
                </a>
            </div>
        @endif

    </div>

</div>
@endauth
    <script src="{{ asset('js/receipt.js') }}"></script>
    <script src="{{ asset('js/scroll.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>

</body>

</html>