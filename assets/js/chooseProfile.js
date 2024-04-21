document.addEventListener("DOMContentLoaded", function () {
    const employeeBtn = document.getElementById("employeeBtn");
    const employerBtn = document.getElementById("employerBtn");
    const employeeForm = document.getElementById("employeeForm");
    const employerForm = document.getElementById("employerForm");

    employeeBtn.addEventListener("click", function () {
        employeeForm.style.display = "block";
        employerForm.style.display = "none";
    });

    employerBtn.addEventListener("click", function () {
        employerForm.style.display = "block";
        employeeForm.style.display = "none";
    });
});
