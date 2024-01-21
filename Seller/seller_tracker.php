<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
}
$role = $_SESSION['role'];
$role = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/css.css">
    <link rel="stylesheet" href="../assets/css/floating.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/tracking.css">
    <script src="../assets/css/jquery.js"></script>
    <title>Tracker</title>
</head>

<body class="bg-gray-100">
    <div id="CusOrders">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
      <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto relative">
        <div class="flex items-center">
          <img src="../assets/img/FloraFusion.jpg" class="h-8 mr-3" alt="Plant Logo" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">FloraFusion Market</span>
        </div>
        <div class="flex items-center md:order-2">
          <ul class="flex" style="margin: 0;padding: 0;list-style: none;display: flex;">
            <li>
              <a href="seller_wishlist.php" class="text-gray">
                <i class="fas fa-heart"></i>
                <span class="text-sm text-gray-600 font-normal" v-if="wishlistLength > 0">{{wishlistLength}}</span>
              </a>
            </li>
            <li>
              <a href="seller_cart.php" class="text-gray ">
                <i class="fas fa-shopping-cart"></i>
                <span class="text-sm text-gray-600 font-normal" v-if="allcarts > 0">{{allcarts}}</span>
              </a>
            </li>
            <!-- Profile Dropdown Trigger -->
            <li style="margin-right: 15px;">
              <button id="profile-menu-button"><img
                  src="<?php echo isset($_SESSION['image']) ? '../assets/img/' . $_SESSION['image'] : ''; ?>"
                  alt="default" style="height:35px;width:35px;border-radius: 40px;"></i></button>
            </li>
          </ul>
        </div>
        <!-- Profile Dropdown -->
        <ul id="profile-menu"
          class="absolute mt-3 top-10 right-0 hidden bg-white text-gray-800 shadow-md rounded-lg w-48 space-y-2 py-2">
          <li><a href="index.php"><i class="mr-2 text-blue-500 fas fa-chart-line ml-5"></i>Seller
              Dashboard</a></li>
          <li><a href="seller_tracker.php"><i class="mr-2 text-blue-500 fas fa-map-marker-alt ml-5"></i>Order
              Tracker</a></li>
          <li><a href="seller_purchase.php"><i class="mr-2 text-green-500 fas fa-shopping-cart ml-5"></i>Purchase
              History</a></li>
          <li><a href="seller_profile.php"><i class="mr-2 text-blue-500 fas fa-user-circle ml-5"></i>Seller
              Profile</a></li>
          <li><a href="seller_up_profile.php"><i class="mr-2 text-purple-500 fas fa-user-edit ml-5"></i>Update
              Profile</a></li>
          <li><a href="seller_help_center.php"><i class="mr-2 text-purple-500 fas fa-question-circle ml-5"></i>Help Center</a></li>
          <li><a href="../includes/logout.php"><i class="mr-2 text-gray-500 fas fa-sign-out-alt ml-5"></i>Logout</a>
          </li>
        </ul>
        <!-- End Profile Dropdown -->
        <div class="items-center justify-between hidden md:flex md:w-auto md:order-1" id="mobile-menu-2">
          <ul
            class="flex flex-col font-medium md:p-0  md:flex-row md:space-x-8 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700"
            style="margin: 0;padding: 0;list-style: none;display: flex;">
            <li style="margin-right: 15px;">
              <a href="seller_index.php"
                class="block py-2 pl-3 pr-4 text-gray-900 font-bold transition duration-300 ease-in-out transform hover:bg-gray-100 hover:text-gray-600 rounded md:hover:bg-transparent md:p-0 dark:text-white md:dark:hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                style="text-decoration: none;color: #333;font-weight: bold;transition: color 0.3s ease;">Home</a>
            </li>
            <li style="margin-right: 15px;">
              <a href="seller_products.php"
                class="block py-2 pl-3 pr-4 text-gray-900 font-bold transition duration-300 ease-in-out transform hover:bg-gray-100 hover:text-gray-600 rounded md:hover:bg-transparent md:p-0 dark:text-white md:dark:hover:text-gray-600 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700"
                style="text-decoration: none;color: #333;font-weight: bold;transition: color 0.3s ease;">Plants</a>
            </li>
          </ul>
        </div>

      </div>
    </nav>


        <div class="container mx-auto mt-8 p-4">
            <h1 class="text-2xl font-semibold mb-4 text-center mt-8">My Orders</h1>

        </div>


<section>
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-stepper text-black mb-2 " style="border-radius: 16px;" v-for="o in customerOrders">

          <div class="card-body p-5">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <div class="d-flex align-items-center"> 
                    <img :src="'../assets/img/' + o.image" alt="Product 1" class="img-fluid me-lg-4 mb-3 mb-lg-0">
                    <div class="text-start"> 
                        <h5>{{o.productname}}</h5>
                        <h5>quantity <span>{{o.quantity}}</span></h5>
                        <h5>Price <span>{{o.amount}}</span></h5>
                    </div>
                </div>
                <div class="text-end">
                    <p class="mb-0">DATE <span>2023</span></p>
                    <p class="mb-0">ORDER # <span class="font-weight-bold">{{o.order_id}}</span></p>
                </div>
            </div>

            <ul id="progressbar-2" class="d-flex justify-content-between mx-0">
            <li :class="{ 'active': o.orderstatus >= 1 }" class="text-center" id="step1"></li>
            <li :class="{ 'active': o.orderstatus >= 2 }" class="text-center" id="step2"></li>
            <li :class="{ 'active': o.orderstatus >= 3 }" class="text-center" id="step3"></li>
            <li :class="{ 'active': o.orderstatus == 4 }" class="text-end" id="step4"></li>
            </ul>


            <div class="d-flex justify-content-between">
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-clipboard-list fa-2x me-lg-4 mb-3 mb-lg-0"></i>
                <div>
                  <p class="fw-bold mb-1">Order </p>
                  <p class="fw-bold mb-0">Deliver</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-box-open fa-2x me-lg-4 mb-3 mb-lg-0"></i>
                <div>
                  <p class="fw-bold mb-1">Order</p>
                  <p class="fw-bold mb-0">Packed</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-shipping-fast fa-2x me-lg-4 mb-3 mb-lg-0"></i>
                <div>
                  <p class="fw-bold mb-1">Order</p>
                  <p class="fw-bold mb-0">Shipped</p>
                </div>
              </div>
              <div class="d-lg-flex align-items-center">
                <i class="fas fa-home fa-2x me-lg-4 mb-3 mb-lg-0"></i>
                <div>
                  <p class="fw-bold mb-1">Order</p>
                  <p class="fw-bold mb-0">Arrived</p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</section>



<script src="../assets/services/vue.3.js"></script>
  <script src="../assets/services/axios.js"></script>
  <script src="../assets/services/CusOrders.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
        <script src="../assets/drop_down.js"></script>

</body>

</html>