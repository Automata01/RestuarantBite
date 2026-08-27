document.addEventListener("DOMContentLoaded", function () {

    let currentStep = 1;

    const selectedItems = {};


    /* =========================
       STEP NAVIGATION
    ========================= */

    function showStep(step) {

        document
            .querySelectorAll(".reservation-step")
            .forEach(element => {
                element.classList.remove("active");
            });

        const target = document.getElementById(`step${step}`);

        if (target) {
            target.classList.add("active");
        }

        currentStep = step;

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    }


    /* =========================
       STEP 1
    ========================= */

    const nextStep1 = document.getElementById("nextStep1");

    if (nextStep1) {

        nextStep1.addEventListener("click", function () {

            const selected = document.querySelector(
                'input[name="restaurant_table_id"]:checked'
            );

            if (!selected) {

                alert("Please select a table.");

                return;
            }

            showStep(2);
        });
    }


    /* =========================
       STEP 2
    ========================= */

    const nextStep2 = document.getElementById("nextStep2");

    if (nextStep2) {

        nextStep2.addEventListener("click", function () {

            const date =
                document.getElementById("reservationDate").value;

            const time =
                document.getElementById("reservationTime").value;

            const location =
                document.getElementById("reservationLocation").value;


            if (!date || !time || !location) {

                alert(
                    "Please select the date, time and location."
                );

                return;
            }

            showStep(3);
        });
    }


    /* =========================
       STEP 3
    ========================= */

    const foodYes = document.getElementById("foodYes");

    if (foodYes) {

        foodYes.addEventListener("click", function () {

            showStep(4);

        });
    }


    const foodNo = document.getElementById("foodNo");

    if (foodNo) {

        foodNo.addEventListener("click", function () {

            /*
             * Clear food items because
             * user selected NO.
             */
            clearHiddenItems();

            updateConfirmation();

            showStep(5);

        });
    }


    /* =========================
       BACK BUTTONS
    ========================= */

    const backStep2 =
        document.getElementById("backStep2");

    if (backStep2) {

        backStep2.addEventListener("click", function () {

            showStep(1);

        });
    }


    const backStep3 =
        document.getElementById("backStep3");

    if (backStep3) {

        backStep3.addEventListener("click", function () {

            showStep(2);

        });
    }


    const backStep4 =
        document.getElementById("backStep4");

    if (backStep4) {

        backStep4.addEventListener("click", function () {

            showStep(3);

        });
    }


    const backStep5 =
        document.getElementById("backStep5");

    if (backStep5) {

        backStep5.addEventListener("click", function () {

            /*
             * If food was selected,
             * go back to food selection.
             */
            const hasFood = Object.values(selectedItems)
                .some(item => item.quantity > 0);

            if (hasFood) {

                showStep(4);

            } else {

                showStep(3);

            }

        });
    }


    /* =========================
       FOOD INITIALIZATION
    ========================= */

    document
        .querySelectorAll(".food-card")
        .forEach(card => {

            const id = card.dataset.id;

            const name = card.dataset.name;

            const price =
                parseFloat(card.dataset.price);


            selectedItems[id] = {

                id: id,

                name: name,

                price: price,

                quantity: 0

            };


            const minus =
                card.querySelector(".quantity-minus");

            const plus =
                card.querySelector(".quantity-plus");

            const quantity =
                card.querySelector(".quantity");


            /* PLUS */

            if (plus) {

                plus.addEventListener("click", function () {

                    selectedItems[id].quantity++;

                    quantity.textContent =
                        selectedItems[id].quantity;

                    updateCart();

                });
            }


            /* MINUS */

            if (minus) {

                minus.addEventListener("click", function () {

                    if (
                        selectedItems[id].quantity > 0
                    ) {

                        selectedItems[id].quantity--;

                        quantity.textContent =
                            selectedItems[id].quantity;

                        updateCart();
                    }

                });
            }

        });


    /* =========================
       UPDATE CART
    ========================= */

    function updateCart() {

        const cart =
            document.getElementById("cartItems");

        const totalElement =
            document.getElementById("foodTotal");


        if (!cart || !totalElement) {
            return;
        }


        cart.innerHTML = "";


        let total = 0;

        let hasItems = false;


        Object.values(selectedItems)
            .forEach(item => {

                if (item.quantity > 0) {

                    hasItems = true;


                    const subtotal =
                        item.price * item.quantity;


                    total += subtotal;


                    const row =
                        document.createElement("div");


                    row.className =
                        "cart-item";


                    row.innerHTML = `

                        <span>
                            ${item.name}
                            × ${item.quantity}
                        </span>

                        <span>
                            $${subtotal.toFixed(2)}
                        </span>

                    `;


                    cart.appendChild(row);

                }

            });


        if (!hasItems) {

            cart.innerHTML = `

                <p class="empty-cart">
                    No food selected.
                </p>

            `;
        }


        totalElement.textContent =
            `$${total.toFixed(2)}`;
    }


    /* =========================
       FOOD CONTINUE
    ========================= */

    const reserveWithFood =
        document.getElementById("reserveWithFood");


    if (reserveWithFood) {

        reserveWithFood.addEventListener(
            "click",
            function () {

                const hasFood =
                    Object.values(selectedItems)
                        .some(
                            item => item.quantity > 0
                        );


                if (!hasFood) {

                    alert(
                        "Please select at least one food item, or go back and choose 'No, thank you'."
                    );

                    return;
                }


                createHiddenItems();

                updateConfirmation();

                showStep(5);

            }
        );
    }


    /* =========================
       CREATE HIDDEN FOOD INPUTS
    ========================= */

    function createHiddenItems() {

        const container =
            document.getElementById("hiddenItems");


        if (!container) {
            return;
        }


        container.innerHTML = "";


        let index = 0;


        Object.values(selectedItems)
            .forEach(item => {

                if (item.quantity > 0) {

                    container.insertAdjacentHTML(
                        "beforeend",
                        `

                        <input
                            type="hidden"
                            name="items[${index}][menu_item_id]"
                            value="${item.id}"
                        >

                        <input
                            type="hidden"
                            name="items[${index}][quantity]"
                            value="${item.quantity}"
                        >

                        `
                    );


                    index++;
                }

            });
    }


    /* =========================
       CLEAR FOOD INPUTS
    ========================= */

    function clearHiddenItems() {

        const container =
            document.getElementById("hiddenItems");


        if (container) {

            container.innerHTML = "";

        }
    }


    /* =========================
       CONFIRMATION
    ========================= */

    function updateConfirmation() {

        /* TABLE */

        const table =
            document.querySelector(
                'input[name="restaurant_table_id"]:checked'
            );


        if (table) {

            const card =
                table.closest(".table-option");


            const tableName =
                card
                    .querySelector("h3")
                    .textContent
                    .trim();


            const confirmTable =
                document.getElementById(
                    "confirmTable"
                );


            if (confirmTable) {

                confirmTable.textContent =
                    tableName;

            }


            const confirmSeats =
                document.getElementById(
                    "confirmSeats"
                );


            if (confirmSeats) {

                confirmSeats.textContent =
                    `${table.dataset.seats} seats`;

            }

        }


        /* DATE */

        const confirmDate =
            document.getElementById(
                "confirmDate"
            );


        if (confirmDate) {

            confirmDate.textContent =
                document.getElementById(
                    "reservationDate"
                ).value;

        }


        /* TIME */

        const confirmTime =
            document.getElementById(
                "confirmTime"
            );


        if (confirmTime) {

            const time =
                document.getElementById(
                    "reservationTime"
                ).value;


            if (time) {

                const [hours, minutes] =
                    time.split(":");


                const date =
                    new Date();


                date.setHours(
                    parseInt(hours),
                    parseInt(minutes)
                );


                confirmTime.textContent =
                    date.toLocaleTimeString(
                        [],
                        {
                            hour: "2-digit",
                            minute: "2-digit"
                        }
                    );

            }

        }


        /* LOCATION */

        const confirmLocation =
            document.getElementById(
                "confirmLocation"
            );


        if (confirmLocation) {

            confirmLocation.textContent =
                document.getElementById(
                    "reservationLocation"
                ).value;

        }


        /* FOOD TOTAL */

        let total = 0;


        Object.values(selectedItems)
            .forEach(item => {

                total +=
                    item.price * item.quantity;

            });


        const confirmTotal =
            document.getElementById(
                "confirmTotal"
            );


        if (confirmTotal) {

            confirmTotal.textContent =
                `$${total.toFixed(2)}`;

        }


        /*
         * Make sure the latest food
         * selection is submitted.
         */
        createHiddenItems();
    }


    /* =========================
       FORM SUBMIT
    ========================= */

    const reservationForm =
        document.getElementById(
            "reservationForm"
        );


    if (reservationForm) {

        reservationForm.addEventListener(
            "submit",
            function () {

                /*
                 * Always rebuild hidden inputs
                 * before sending to Laravel.
                 */
                createHiddenItems();

            }
        );
    }


    /* =========================
       INITIAL CART
    ========================= */

    updateCart();

});