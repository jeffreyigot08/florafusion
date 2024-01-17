<?php
session_start();
$shopName = $_SESSION['shop_name'];
if (!isset($_SESSION['id'])) {
    header('location: index.php');
}
// var_dump($_SESSION);
$role = $_SESSION['role'];
$role = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>Seller Dashboard</title>
</head>

<body>
    <div class="flex">
        <div class="bg-green-600 text-black p-4">
            <div class="bg-green-600 text-black h-screen w-64 flex flex-col">
                <div class="mt-10 mb-8 flex items-center gap-2">
                    <img src="../assets/img/FloraFusion.jpg" class="rounded-full w-14" alt="Plant Logo" />
                    <h2 class="text-2xl text-white font-bold">FloraFusion <span class="font-normal">Market</span></h2>
                </div>
                <ul class="flex flex-col space-y-3">
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/index.php" class="flex items-center space-x-2">
                            <i class="fas fa-tachometer-alt h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Dashboard</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/Inventory.php" class="flex items-center space-x-2">
                            <i class="fas fa-box h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Inventory</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/orders.php" class="flex items-center space-x-2">
                            <i class="fas fa-shopping-cart h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Orders</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/list_orders.php" class="flex items-center space-x-2">
                            <i class="fas fa-list-alt h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">List of Orders</span>
                        </a>
                    </li>

                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/sales_rep.php" class="flex items-center space-x-2">
                            <i class="fas fa-chart-bar h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Sales Report</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Seller/sold_his.php" class="flex items-center space-x-2">
                            <i class="fas fa-history h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Sold History</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../Chats/chat.php" class="flex items-center space-x-2">
                            <i class="fas fa-comments h-5 w-5 fill-current text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Chat Support</span>
                        </a>
                    </li>
                    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
                        <a href="../includes/logout.php" class="flex items-center space-x-2">
                            <i class="fas fa-sign-out-alt h-5 w-5 text-white"></i>
                            <span class="text-white font-medium hover:text-gray-300">Log out</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex-1 bg-white p-4 shadow-md">
                <button id="profile-menu-button" class="text-4xl text-green-400 absolute top-0 right-0 mr-4 mt-4"><img src="<?php echo isset($_SESSION['image']) ? '../assets/img/' . $_SESSION['image'] : ''; ?>" alt="default" style="height:35px;width:35px;border-radius: 40px;"></i></button>
                  <div class="flex justify-between items-center mt-28">
                    <div class="relative ml-auto">
                        <input type="search" v-model="search" class="border border-gray-300 rounded-md px-3 py-2 pr-10 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-500" placeholder="Search">
                    </div>
                </div>


            <div class="mb-4 ml-8">
                <div class="bg-white">
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('all')">All</button>
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('placed')">Order Placed</button>
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('packed')">Packed</button>
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('to-ship')">To Ship</button>
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('to-receive')">To Receive</button>
                    <button class="py-2 px-3 bg-gray-100 border border-gray-300 hover:bg-gray-400" onclick="filterOrders('completed')">Completed</button>
                </div>


                <table id="page" class="w-full bg-white border border-gray-800 m-3">
                    <tbody id="orders" class="bg-white divide-y divide-gray-200">
                    <tr class="bg-white jusify-center text-center">
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Plant Image</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Plant Name</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Order Number</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Total Price</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Quantity</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Date</td>
                            <td class="py-2 px-3 bg-gray-100 border border-gray-300">Payment Method</td>
                        </tr>
                        <!-- Order 1: Order Placed -->
                        <tr data-status="placed">
                            <td class="jusify-center text-center"><img src="../assets/img/Cactus.jpg" class="your-image-class w-40 ml-8 mb-3 mt-3"></td>
                            <td class="jusify-center text-center">Cactus</td>
                            <td class="jusify-center text-center">12</td>
                            <td class="jusify-center text-center">300.00</td>
                            <td class="jusify-center text-center">Qty: 1</td>
                            <td class="jusify-center text-center">2023-12-23 14:12:33	</td>
                            <td class="jusify-center text-center">COD</td>
                        </tr>

                        <!-- Order 2: Packed -->
                        <tr data-status="packed">
                            <td class="jusify-center text-center"><img src="../assets/img/Lavender.jpg" class="your-image-class w-40 ml-8 mb-3 mt-3"></td>
                            <td class="jusify-center text-center">Lavender</td>
                            <td class="jusify-center text-center">4</td>
                            <td class="jusify-center text-center">300.00</td>
                            <td class="jusify-center text-center">Qty: 1</td>
                            <td class="jusify-center text-center">2023-12-23 14:12:33	</td>
                            <td class="jusify-center text-center">GCASH</td>
                        </tr>

                        <!-- Order 3: To Ship -->
                        <tr data-status="to-ship">
                            <td class="jusify-center text-center"><img src="../assets/img/Spider Plant.jpg" class="your-image-class w-40 ml-8 mb-3 mt-3"></td>
                            <td class="jusify-center text-center">Spider Plant</td>
                            <td class="jusify-center text-center">22</td>
                            <td class="jusify-center text-center">300.00</td>
                            <td class="jusify-center text-center">Qty: 1</td>
                            <td class="jusify-center text-center">2023-12-23 14:12:33	</td>
                            <td class="jusify-center text-center">COD</td>
                        </tr>

                        <!-- Order 4: To Receive -->
                        <tr data-status="to-receive">
                            <td class="jusify-center text-center"><img src="../assets/img/Orchids.jpg" class="your-image-class w-40 ml-8 mb-3 mt-3"></td>
                            <td class="jusify-center text-center">Orchids</td>
                            <td class="jusify-center text-center">8</td>
                            <td class="jusify-center text-center">300.00</td>
                            <td class="jusify-center text-center">Qty: 1</td>
                            <td class="jusify-center text-center">2023-12-23 14:12:33	</td>
                            <td class="jusify-center text-center">GCASH</td>
                        </tr>

                        <!-- Order 5: Completed -->
                        <tr data-status="completed">
                            <td class="jusify-center text-center"><img src="../assets/img/Sun Flower.jpg" class="your-image-class w-40 ml-8 mb-3 mt-3"></td>
                            <td class="jusify-center text-center">Sun Flower</td>
                            <td class="jusify-center text-center">6</td>
                            <td class="jusify-center text-center">300.00</td>
                            <td class="jusify-center text-center">Qty: 1</td>
                            <td class="jusify-center text-center">2023-12-23 14:12:33	</td>
                            <td class="jusify-center text-center">GCASH</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            function filterOrders(status) {
                const rows = document.querySelectorAll('#orders tr');

                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status');

                    if (status === 'all' || status === rowStatus) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        </script>
</body>

</html>