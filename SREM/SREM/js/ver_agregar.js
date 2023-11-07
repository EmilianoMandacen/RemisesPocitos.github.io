document.addEventListener("DOMContentLoaded", function() {
    const modalButtons = document.querySelectorAll(".modal-button");
    const modals = document.querySelectorAll(".modal");
    const closeBtns = document.querySelectorAll(".close");
  
    modalButtons.forEach(button => {
      button.addEventListener("click", () => {
        const modalId = button.getAttribute("data-modal-id");
        const modal = document.getElementById(modalId);
        modal.style.display = "block";
      });
    });
  
    closeBtns.forEach(closeBtn => {
      closeBtn.addEventListener("click", (event) => {
        event.preventDefault(); // Evitar comportamiento predeterminado del enlace
        const modal = closeBtn.closest(".modal");
        modal.style.display = "none";
      });
    });
  
    window.addEventListener("click", (event) => {
      modals.forEach(modal => {
        if (event.target === modal) {
          modal.style.display = "none";
        }
      });
    });
  });
  