document.addEventListener("DOMContentLoaded", function () {

    const authModal = document.getElementById("authModal");
    const openAuthModal = document.getElementById("openAuthModal");
    const closeAuthModal = document.getElementById("closeAuthModal");
    const authOverlay = document.getElementById("authOverlay");

    const loginForm = document.getElementById("loginFormWrapper");
    const registerForm = document.getElementById("registerFormWrapper");

    const showRegister = document.getElementById("showRegister");
    const showLogin = document.getElementById("showLogin");


    // Open modal
    if (openAuthModal) {
        openAuthModal.addEventListener("click", function (e) {
            e.preventDefault();

            authModal.classList.add("active");

            document.body.style.overflow = "hidden";
        });
    }


    // Close modal
    function closeModal() {
        authModal.classList.remove("active");

        document.body.style.overflow = "";
    }


    if (closeAuthModal) {
        closeAuthModal.addEventListener("click", closeModal);
    }


    if (authOverlay) {
        authOverlay.addEventListener("click", closeModal);
    }


    // Login -> Register
    if (showRegister) {
        showRegister.addEventListener("click", function () {

            loginForm.classList.remove("active");

            registerForm.classList.add("active");

        });
    }


    // Register -> Login
    if (showLogin) {
        showLogin.addEventListener("click", function () {

            registerForm.classList.remove("active");

            loginForm.classList.add("active");

        });
    }


    // ESC closes modal
    document.addEventListener("keydown", function (e) {

        if (e.key === "Escape") {
            closeModal();
        }

    });

   

});

 document.addEventListener("DOMContentLoaded", function () {

    const profileButton = document.getElementById("profileButton");
    const profileDropdown = document.getElementById("profileDropdown");

    if (!profileButton || !profileDropdown) {
        return;
    }

    profileButton.addEventListener("click", function (event) {

        event.stopPropagation();

        profileDropdown.classList.toggle("active");

    });


    // Close when clicking outside
    document.addEventListener("click", function (event) {

        if (
            !profileDropdown.contains(event.target) &&
            !profileButton.contains(event.target)
        ) {
            profileDropdown.classList.remove("active");
        }

    });


    // Close with ESC
    document.addEventListener("keydown", function (event) {

        if (event.key === "Escape") {

            profileDropdown.classList.remove("active");

        }

    });

});