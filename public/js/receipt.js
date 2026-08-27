document.addEventListener("DOMContentLoaded", function () {

    const receiptModal =
        document.getElementById("receiptModal");

    const openReceipt =
        document.getElementById("openReceiptModal");

    const closeReceipt =
        document.getElementById("receiptClose");

    if (!receiptModal || !openReceipt) {
        return;
    }


    // Open

    openReceipt.addEventListener("click", function (e) {

        e.preventDefault();

        receiptModal.classList.add("active");

    });


    // Close

    closeReceipt.addEventListener("click", function () {

        receiptModal.classList.remove("active");

    });


    // Click outside

    const overlay =
        receiptModal.querySelector(".receipt-overlay");

    overlay.addEventListener("click", function () {

        receiptModal.classList.remove("active");

    });


    // ESC

    document.addEventListener("keydown", function (e) {

        if (e.key === "Escape") {

            receiptModal.classList.remove("active");

        }

    });

});