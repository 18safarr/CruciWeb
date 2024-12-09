document.addEventListener("DOMContentLoaded", () => {
    const loginModal = document.getElementById("loginModal");
    const openLoginModal = document.getElementById("openLoginModal");
    const closeLoginModal = document.getElementById("closeLoginModal");

    // Ouvrir le modal de connexion
    openLoginModal.addEventListener("click", () => {
        loginModal.classList.add("visible");
    });

    // Fermer le modal de connexion
    closeLoginModal.addEventListener("click", () => {
        loginModal.classList.remove("visible");
    });

    // Fermer le modal en cliquant en dehors
    loginModal.addEventListener("click", (event) => {
        if (event.target === loginModal) {
            loginModal.classList.remove("visible");
        }
    });
});
