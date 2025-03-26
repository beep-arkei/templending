
document.addEventListener("DOMContentLoaded", function () {
    const incomeSource = document.getElementById("incomeSource");
    const incomeSpecifyLabel = document.getElementById("incomeSpecifyLabel");
    const incomeSpecify = document.getElementById("incomeSpecify");
  
    const monthlyIncome = document.getElementById("monthlyIncome");
    const loanAmount = document.getElementById("loanAmount");
    const paymentPlan = document.getElementById("paymentPlan");
    const paymentPerMonth = document.getElementById("paymentPerMonth");
  
    // Show or hide the "Specify" textbox for income source
    incomeSource.addEventListener("change", function () {
      if (incomeSource.value === "job" || incomeSource.value === "others") {
        incomeSpecifyLabel.classList.remove("hidden");
      } else {
        incomeSpecifyLabel.classList.add("hidden");
        incomeSpecify.value = "";
      }
    });
  
    // Update Loan Amount dropdown based on Monthly Income
    monthlyIncome.addEventListener("input", function () {
      const income = parseFloat(monthlyIncome.value);
      if (income > 0) {
        loanAmount.innerHTML = `
          <option value="${income}">1x Monthly Income (₱${income})</option>
          <option value="${income * 3}">3x Monthly Income (₱${income * 3})</option>
          <option value="${income * 5}">5x Monthly Income (₱${income * 5})</option>
          <option value="${income * 10}">10x Monthly Income (₱${income * 10})</option>
        `;
      } else {
        loanAmount.innerHTML = `<option value="">Input Monthly Income First</option>`;
      }
    });
  
    // Compute Monthly Payment when Loan Amount or Payment Plan changes
    function computeMonthlyPayment() {
      const loan = parseFloat(loanAmount.value);
      const months = parseInt(paymentPlan.value);
      if (!loan || !months) return;
  
      // Compute with 10% monthly compounding interest
      const interestRate = 0.10;
      const totalPayment = loan * Math.pow(1 + interestRate, months);
      const monthlyPayment = totalPayment / months;
  
      paymentPerMonth.value = `₱${monthlyPayment.toFixed(2)}`;
    }
  
    loanAmount.addEventListener("change", computeMonthlyPayment);
    paymentPlan.addEventListener("change", computeMonthlyPayment);
  });

  document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loanForm");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        const formData = new FormData(form);

        fetch("submit.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Show success or error message
            if (data.success) form.reset(); // Clear form if submission is successful
        })
        .catch(error => console.error("Error:", error));
    });
});
