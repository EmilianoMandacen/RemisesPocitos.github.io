document.addEventListener("DOMContentLoaded", function () {
    const dropdownToggle = document.querySelector(".dropdown-toggle");
    const dropdown = document.querySelector(".dropdown");
    const dropdown_menu = document.querySelector(".dropdown-menu");
    
    dropdownToggle.addEventListener("click", function () {
        dropdown.classList.toggle("active");
    });

    window.addEventListener("click", function (event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove("active");
        }
    });


    $(document).ready(function () {
        const buttonContainers = $("[id^='buttonContainer']");
        
        $("[id^='showButtons']").click(function () {
            const index = $(this).attr("id").replace("showButtons", "");
            buttonContainers.not(buttonContainers[index]).hide();
            buttonContainers.eq(index).toggle();
        });
    });
    
    
});

