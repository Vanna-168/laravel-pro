let cart = [];

function addToCart(id, item, price, image) {
    let existingItem = cart.find((product) => product.name === item);
    if (existingItem) {
        existingItem.quantity = 1;
    } else {
        cart.push({
            id: id,
            name: item,
            price: price,
            quantity: 1,
            image: image,
        });
    }
    updateCart();
}

function updateCart() {
    let cartList = document.getElementById("cart-items");
    let subtotal = 0;
    cartList.innerHTML = "";

    cart.forEach((product) => {
        let listItem = document.createElement("div");
        listItem.innerHTML = `<div class="d-flex align-items-center p-3 border-bottom" id="cart-item">
                            <div class="bg-light rounded me-2" style="width: 32px; height: 32px;">
                                <img src="${product.image}" class="img-fluid" alt="T-Shirt" id="image">
                            </div>
                            <div class="flex-grow-1">${product.name}</div>
                            <div class="d-flex align-items-center">
                                <button class="crease-quantity" id="decrease-quantity">-</button>
                                <div class="cart-item-quantity">${product.quantity}</div>
                                <button class="crease-quantity" id="increase-quantity">+</button>
                                <div>$${product.price}</div>
                                <div class="dropdown ms-2">
                                    <i class="fa-solid fa-trash text-danger ps-2" id="remove-item"></i>
                                </div>
                            </div>
                        </div>`;
        cartList.appendChild(listItem);
        // Add event listeners for increase and decrease buttons
        listItem
            .querySelector("#increase-quantity")
            .addEventListener("click", function () {
                product.quantity += 1;
                updateCart();
            });
        listItem
            .querySelector("#decrease-quantity")
            .addEventListener("click", function () {
                if (product.quantity > 1) {
                    product.quantity -= 1;
                    updateCart();
                } else {
                    // Remove item from cart if quantity is 0
                    cart = cart.filter((p) => p.name !== product.name);
                    updateCart();
                }
            });
        listItem
            .querySelector("#remove-item")
            .addEventListener("click", function () {
                cart = cart.filter((p) => p.name !== product.name);
                updateCart();
            });
        subtotal += product.price * product.quantity;
    });
    let total = subtotal;

    document.getElementById("subtotal").textContent = subtotal.toFixed(2);
    document.getElementById("total").textContent = total.toFixed(2);
}

function printDiv(divId) {
    document.getElementById("remove-item").style.display = "none";
    document.getElementById("print").style.display = "none";
    var content = document.getElementById(divId).innerHTML;
    var originalContent = document.body.innerHTML;
    document.body.innerHTML = content;
    window.print();
    document.body.innerHTML = originalContent;
}
//img
function loadFile(event) {
    var img = document.getElementById("photo");
    img.src = URL.createObjectURL(event.target.files[0]);
}
// Add click listener to each menu item
document.addEventListener("DOMContentLoaded", function () {
    const menuItems = document.querySelectorAll(".nav-item");

    menuItems.forEach((item) => {
        const link = item.querySelector("a");
        if (link && link.href === window.location.href) {
            item.classList.add("active");
        } else {
            item.classList.remove("active");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Initialize time filter buttons
    const timeButtons = document.querySelectorAll(".time-filter .btn");
    timeButtons.forEach((button) => {
        button.addEventListener("click", function () {
            timeButtons.forEach((btn) => btn.classList.remove("active"));
            this.classList.add("active");

            // Here you would typically fetch data for the selected time period
            // and update the charts and statistics
            updateDashboardData(this.textContent.trim());
        });
    });

    // Initialize Income Donut Chart
    const incomeCtx = document.getElementById("incomeChart").getContext("2d");
    const incomeChart = new Chart(incomeCtx, {
        type: "doughnut",
        data: {
            labels: ["Closhes", "Shoes", "Dress"],
            datasets: [
                {
                    data: [8000, 5000, 7000], // $20,000 total
                    backgroundColor: [
                        "#FFA500", // Orange for Ice Coffee
                        "#000000", // Black for Hot Coffee
                        "#E0E0E0", // Light Gray for Drinks
                    ],
                    borderWidth: 0,
                    cutout: "70%",
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            const value = context.raw;
                            const total = context.dataset.data.reduce(
                                (a, b) => a + b,
                                0
                            );
                            const percentage = Math.round(
                                (value / total) * 100
                            );
                            return `$${value.toLocaleString()} (${percentage}%)`;
                        },
                    },
                },
            },
        },
    });

    // Initialize Daily Selling Line Chart
    const dailyCtx = document
        .getElementById("dailySellingChart")
        .getContext("2d");
    const dailySellingChart = new Chart(dailyCtx, {
        type: "line",
        data: {
            labels: ["6am", "8am", "10am", "12pm", "2pm", "4pm", "6pm", "8pm"],
            datasets: [
                {
                    label: "Sales",
                    data: [
                        14000, 15000, 14500, 13000, 13500, 15000, 14000, 13800,
                    ],
                    backgroundColor: "rgba(255, 165, 0, 0.2)",
                    borderColor: "#FFA500",
                    borderWidth: 2,
                    pointBackgroundColor: "#FFA500",
                    pointRadius: 0,
                    tension: 0.4,
                    fill: true,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    min: 5000,
                    max: 20000,
                    ticks: {
                        stepSize: 5000,
                        callback: function (value) {
                            return value.toLocaleString();
                        },
                    },
                    grid: {
                        color: "rgba(0, 0, 0, 0.05)",
                    },
                },
                x: {
                    grid: {
                        display: false,
                    },
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            return `$${context.raw.toLocaleString()}`;
                        },
                    },
                },
            },
        },
    });

    // Function to update dashboard data based on selected time period
    function updateDashboardData(timePeriod) {
        console.log(`Updating dashboard for: ${timePeriod}`);

        // This is where you would fetch data from your backend
        // For demonstration, we'll just simulate different data for different time periods

        let incomeData, dailyData, totalBalance, totalIncome, totalExpense;
        let incomeIncrease, expenseIncrease;

        switch (timePeriod) {
            case "Today":
                incomeData = [8000, 5000, 7000];
                dailyData = [
                    14000, 15000, 14500, 13000, 13500, 15000, 14000, 13800,
                ];
                totalBalance = 30000;
                totalIncome = 4000;
                totalExpense = 2000;
                incomeIncrease = 20;
                expenseIncrease = 30;
                break;
            case "This Week":
                incomeData = [35000, 25000, 30000];
                dailyData = [60000, 65000, 70000, 68000, 72000, 75000, 70000];
                totalBalance = 120000;
                totalIncome = 18000;
                totalExpense = 9000;
                incomeIncrease = 15;
                expenseIncrease = 25;
                break;
            case "This Month":
                incomeData = [150000, 100000, 130000];
                dailyData = [
                    250000, 270000, 290000, 280000, 300000, 310000, 290000,
                ];
                totalBalance = 500000;
                totalIncome = 80000;
                totalExpense = 40000;
                incomeIncrease = 18;
                expenseIncrease = 22;
                break;
            case "This Year":
                incomeData = [1800000, 1200000, 1500000];
                dailyData = [
                    3000000, 3200000, 3500000, 3400000, 3600000, 3800000,
                    3700000,
                ];
                totalBalance = 6000000;
                totalIncome = 950000;
                totalExpense = 450000;
                incomeIncrease = 25;
                expenseIncrease = 20;
                break;
            default:
                return;
        }

        // Update donut chart
        incomeChart.data.datasets[0].data = incomeData;
        incomeChart.update();

        // Update line chart
        dailySellingChart.data.datasets[0].data = dailyData;
        dailySellingChart.update();

        // Update balance information
        document.querySelector(
            ".text-success"
        ).textContent = `$${totalBalance.toLocaleString()}`;
        document.querySelectorAll(
            ".balance-item h5"
        )[0].textContent = `$${totalIncome.toLocaleString()}`;
        document.querySelectorAll(
            ".balance-item h5"
        )[1].textContent = `$${totalExpense.toLocaleString()}`;
        document.querySelectorAll(
            ".text-muted"
        )[0].textContent = `(+ ${incomeIncrease}% Increase)`;
        document.querySelectorAll(
            ".text-muted"
        )[1].textContent = `(+ ${expenseIncrease}% Increase)`;

        // Update center text of donut chart
        const totalIncomeValue = incomeData.reduce((a, b) => a + b, 0);
        document.querySelector(
            ".chart-center-text span"
        ).textContent = `$${totalIncomeValue.toLocaleString()}`;
    }

    // Add coffee images to the best sale items
    const coffeeImages = [
        "/images/product/6u1Shb0OFADPnfYizTEaVY29REtI5g5CfFvFAYbQ.jpg",
        "/images/product/AhiS1gbF3hioPvTpeW6tnBzzddG3H0PnMAaqwSv3.jpg",
        "/images/product/JaskV3Qe2XTOBSN9jud1j332WHtvYAzAMBxr0QsA.jpg",
        "/images/product/SONJ3VHE8zpsF4jGWUhu1zRP74tuP3xHCzbAvowa.jpg",
    ];

    const saleImages = document.querySelectorAll(".best-sale-item img");
    saleImages.forEach((img, index) => {
        img.src = coffeeImages[index % 4];
    });
});

const checkoutBtn = document.getElementById("checkout-btn");
const completeBtn = document.getElementById("complete-btn");

//checkout order button
checkoutBtn.addEventListener("click", function () {
    if (cart.length === 0) {
        showEmptyModal();
        setTimeout(() => {
            closeEmptyModal();
        }, 1000);
    }
    fetch("/checkout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({
            cart: cart,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            // Handle response from controller
            // alert("Checkout successful!");
            showCheckoutModal();
            setTimeout(() => {
                closeCheckoutModal();
            }, 500);
            checkoutBtn.classList.add("d-none");
            completeBtn.classList.remove("d-none");
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
completeBtn.addEventListener("click", function () {
    if (cart.length === 0) {
        showEmptyModal();
        setTimeout(() => {
            closeEmptyModal();
        }, 500);
    }
    fetch("/complete", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ cart: cart }),
    })
        .then((response) => response.json())
        .then((data) => {
            showCheckoutModal();
            setTimeout(() => {
                closeCheckoutModal();
            }, 1000);
            cart = []; // Clear the cart after checkout
            updateCart(); // Update the cart display
            completeBtn.classList.add("d-none");
            checkoutBtn.classList.remove("d-none");
            window.location.href = `/invoice`;
        })
        .catch((error) => {
            console.error("Error:", error);
        });
});
function showCheckoutModal() {
    $("#checkoutModal").modal("show");
}
function closeCheckoutModal() {
    $("#checkoutModal").modal("hide");
}
function showEmptyModal() {
    $("#emptyModal").modal("show");
}
function closeEmptyModal() {
    $("#emptyModal").modal("hide");
}
