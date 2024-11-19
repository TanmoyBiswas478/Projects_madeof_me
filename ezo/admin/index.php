<!doctype html>
<html lang="en" ng-app="myApp">

<head>
    <title>Billing Software</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fw/css/all.css">

    <!-- Angular JS  -->
    <script src="../assets/js/angular.min.js"></script>
    <script src="../assets/js/angular-router.min.js"></script>
    <script src="../assets/js/angular-cookies.min.js"></script>
    <script></script>


    <style>
        /* General body and container styling */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
        }

        .container-fluid {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        /* Left Sidebar */
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #fdd835;
        }

        .sidebar .nav-link {
            color: #13e3e6;
            padding: 10px;
            text-decoration: none;
            display: block;
        }

        .sidebar .nav-link:hover {
            background-color: #444;
            color: white;
        }

        /* Dropdown Menu on Hover */
        .nav-item.dropdown .dropdown-menu {
            display: none;
            /* Hidden by default */
            position: absolute;
            left: 100%;
            /* Position it to the right of the parent */
            top: 0;
            /* Align it at the top of the parent */
            background-color: #444;
            border-radius: 5px;
            margin-top: 0;
            /* Adjust spacing */
            width: 200px;
            /* Adjust width if needed */
            z-index: 1000;
            /* Ensure it appears above other content */
        }

        .dropdown-menu .dropdown-item {
            color: #fff;
            padding: 8px 15px;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #555;
        }

        /* Ensure the dropdown shows on hover with a delay */
        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            transition: opacity 0.2s ease-in-out;
            /* Smooth transition for display */
        }

        /* Main Content Area */
        #main-content {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            width: 100%;
            background-color: #3b5998;
            color: white;
            padding: 15px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .header button {
            background-color: #fdd835;
            color: #3b5998;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            margin-top: 5px;
        }

        .cards {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            width: 100%;
            max-width: 1200px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            font-size: 16px;
            margin: 0;
        }

        .card p {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .card a {
            text-decoration: none;
            color: #f57c00;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            flex-wrap: wrap;
            width: 100%;
            max-width: 1200px;
        }

        .actions button {
            background-color: #3b5998;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            flex: 1;
            font-size: 14px;
        }

        .transactions {
            background-color: #fdd835;
            border-radius: 50px;
            padding: 25px 15px;
            text-align: center;
            margin-top: 20px;
            color: rgb(14, 1, 1);
            font-size: 16px;
            width: 100%;
            max-width: 600px;
        }

        .transactions p {
            margin: 0;
        }

        .transactions a {
            color: rgb(11, 1, 1);
            font-size: 14px;
            text-decoration: underline;
            display: block;
            margin-top: 5px;
        }

        .add-button {
            background-color: #3b5998;
            color: white;
            padding: 15px;
            border-radius: 30px;
            font-size: 18px;
            text-align: center;
            margin: 20px auto 0;
            cursor: pointer;
            width: 100%;
            max-width: 600px;
        }

        /* Responsive Design */
        @media (min-width: 600px) {
            .cards {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (min-width: 992px) {
            .cards {
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                flex-direction: row;
                overflow-x: auto;
                white-space: nowrap;
            }

            .sidebar h2 {
                display: none;
            }

            .nav-link {
                padding: 10px;
                font-size: 14px;
            }
        }

        .container-fluid {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        .full-page {
            width: 80vw;
            height: 8Q0vh;
            padding: 0;
            margin: 0;
            overflow-y: auto;
        }

        @media (max-width: 476px) {
            .card-text {
                font-size: 10px !important;
            }
        }

        /* Sticky footer styles */
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .hidden {
            display: none;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 15px;
        }

        .card-header {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .footer-icons {
            font-size: 18px;
        }

        .service-card {
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
        }

        .service-name {
            font-weight: bold;
        }

        .service-cost,
        .service-total {
            font-size: 14px;
        }

        .service-control-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            background-color: #e0e0e0;
            color: #333;
            font-size: 18px;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
            margin: 0 5px;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
        }

        @media (max-width: 576px) {
            .container {
                padding: 10px;
            }

            .card {
                margin-bottom: 15px;
            }

            .btn {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="sidebar" ng-init="isDropdownOpen = false">
            <h2>Admin Dashboard</h2>
            <a class="nav-link" href="#!/index"><i class="fas fa-home"></i> Home</a>

            <!-- Dropdown with ng-click for Angular control -->
            <div class="nav-item dropdown">
                <a class="nav-link" href="" style="color: #13e3e6;">
                    <i class="fas fa-people-roof"></i> Masters Entry <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#!/role"><i class="fas fa-angles-right"></i> Role Section</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!/location"><i class="fas fa-angles-right"></i> Location Section</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!/staff"><i class="fas fa-angles-right"></i> Staff Section</a>
                    <!-- <div class="dropdown-divider"></div> -->
                    <!-- <a class="dropdown-item" href="#!/item"><i class="fas fa-angles-right"></i> Item Section</a> -->

                </div>
            </div>

            <a class="nav-link" href="#!/item"><i class="fas fa-product"></i> Item Section</a>
            <a class="nav-link" href="#!/bill"><i class="fas fa-product"></i> Bill Section</a>

            <div class="nav-item dropdown">
                <a class="nav-link" href="" style="color: #13e3e6;">
                    <i class="fas fa-book"></i> Reports <i class="fas fa-caret-down"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#!/collection"><i class="fas fa-rupee"></i> Today's Collection</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#!/location"><i class="fas fa-angles-right"></i> Item wise Report</a>
                    <div class="dropdown-divider"></div>
                    <!-- <a class="dropdown-item" href="#!/staff"><i class="fas fa-angles-right"></i> Staff Section</a> -->
                    <!-- <div class="dropdown-divider"></div> -->
                    <!-- <a class="dropdown-item" href="#!/item"><i class="fas fa-angles-right"></i> Item Section</a> -->

                </div>
            </div>
            <!-- <a class="nav-link" href="#!/collection"><i class="fas fa-rupee"></i> Today's Collection</a> -->


            <a class="nav-link" href="#!/inv_reprint"><i class="fas fa-key"></i> Invoice Reprint</a>
            <a class="nav-link" href="#!/change_pass"><i class="fas fa-key"></i> Change Password</a>
            <a class="nav-link" href="../assets/api/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </nav>



        <!-- Main Content -->
        <div id="main-content">
            <div class="header">
                <h1>Food Corner</h1>
                <p>Billing Details | ABC</p>
                <!-- <button>ADD LUCKY IMAGE</button> -->
            </div>
            <div ng-view class="full-page">
                <div class="cards">
                    <div class="card">
                        <h2>Sale (Today)</h2>
                        <p>₹ 0</p>
                        <a href="#">Check Report</a>
                    </div>
                    <div class="card">
                        <h2>Money In (Today)</h2>
                        <p>₹ 0</p>
                        <a href="#">Check Reports</a>
                    </div>
                    <div class="card">
                        <h2>Receivable</h2>
                        <p>₹ 0</p>
                        <a href="#">Check Reports</a>
                    </div>
                    <div class="card">
                        <h2>Reports</h2>
                        <p>₹ 0</p>
                        <a href="#">Check Report</a>
                    </div>
                </div>

                <!-- <div class="actions">
                    <button>RATE EZO</button>
                    <button>BUY EZO</button>
                    <button>REFRESH</button>
                </div> -->

                <div class="transactions">
                    <p>Click on + BILL/INVOICE to open Invoice Form.</p>
                    <a href="#">Skip</a>
                </div>

                <div class="add-button">
                    + SALE/INVOICE
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-bottom" style="padding: 5px 0;">
    <ul class="navbar-nav w-100 d-flex flex-row justify-content-between">
        <li class="nav-item text-center" style="padding: 0 10px;">
            <a class="nav-link" href="#!/index">
                <i class="fas fa-home"></i>
                <span class="d-block">Home</span>
            </a>
        </li>
        <li class="nav-item text-center" style="padding: 0 10px;">
            <a class="nav-link" href="#!/bill">
                <i class="fas fa-plus"></i>
                <span class="d-block">Bill</span>
            </a>
        </li>
        <li class="nav-item text-center" style="padding: 0 10px;">
            <a class="nav-link" href="#">
                <i class="fas fa-bell"></i>
                <span class="d-block">Notifications</span>
            </a>
        </li>
        <li class="nav-item text-center" style="padding: 0 10px;">
            <a class="nav-link" href="#">
                <i class="fas fa-user"></i>
                <span class="d-block">Profile</span>
            </a>
        </li>
    </ul>
</nav>







    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="controller/main.js"></script>
    <script src="controller/validation.js"></script>
    <script>
        const prices = {
            hairCut: 200.00,
            hairShampoo: 300.00,
            babyHairCut: 100.00
        };

        function updateQuantity(service, change) {
            const input = document.getElementById(service);
            let quantity = parseInt(input.value);
            quantity = isNaN(quantity) ? 0 : quantity;
            quantity += change;

            if (quantity < 0) quantity = 0; // Prevent negative values

            input.value = quantity;
            updateTotal(service, quantity);
        }

        function updateTotal(service, quantity) {
            const cost = prices[service];
            const totalElement = document.getElementById('total' + capitalizeFirstLetter(service));
            const total = cost * quantity;
            totalElement.textContent = total.toFixed(2);
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            Object.keys(prices).forEach(service => {
                const quantity = parseInt(document.getElementById(service).value);
                grandTotal += prices[service] * quantity;
            });
            document.getElementById('grandTotal').textContent = grandTotal.toFixed(2);
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }

        function showSecondPart() {
            document.getElementById('first-part').classList.add('hidden');
            document.getElementById('second-part').classList.remove('hidden');
        }

        function showfirstPart() {
            document.getElementById('first-part').classList.remove('hidden');
            document.getElementById('second-part').classList.add('hidden');
        }
    </script>
</body>

</html>