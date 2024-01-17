<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: index.php');
}
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <link rel="stylesheet" href="../assets/css/sweetalert.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="../assets/css/jquery.js"></script>
    <title>Orders</title>
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
            <!-- <i class="fas fa-user-circle text-4xl text-green-400 absolute top-0 right-0 mr-4 mt-4"></i> -->
            <div class="flex justify-between items-center mb-4 mt-20">
                <div class="mb-4">
                    <div class="flex space-x-4">
                        <!-- <button class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-md">All
                            Orders</button>
                        <button
                            class="bg-yellow-300 hover:bg-yellow-400 text-yellow-700 px-4 py-2 rounded-md">Pending</button>
                        <button
                            class="bg-green-300 hover:bg-green-400 text-green-700 px-4 py-2 rounded-md">Completed</button> -->
                    </div>
                </div>
                <div class="relative ml-auto">
                    <!-- <input type="text" v-model="search"
                        class="border border-gray-300 rounded-md px-3 py-2 pr-10 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Search"> -->
                </div>
            </div>

            <table id="der" class="w-1/2 min-w-full divide-y divide-gray-800 border border-gray-800">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Plant Image</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Order ID</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Payment Method</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody id="orders" class="bg-white divide-y divide-gray-200">

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade view-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class="text-2xl text-center font-semibold mb-4">Order Details</h2>
                    
                    <div class=" d-flex">
                        <p><strong>Order Number: &nbsp; <p class="d-flex" id="orderNumber"></p></strong></p>
                    </div>

                  
                    <div class="d-flex">
                        <p><strong>Date: &nbsp;</strong>
                        <p class="d-flex" id="orderDate"></p>
                    </div>

                    
                    <div class="d-flex">
                        <p><strong>Customer Name: &nbsp;</strong>
                        <p id="cname"></p>
                        </p>
                    </div>
                    
                    <div class="d-flex">
                        <p><strong>Address: &nbsp;</strong>
                        <p id="add"></p>
                        </p>
                    </div>
             
                    <div class="d-flex">
                        <p><strong>Contact Number: &nbsp;</strong>
                        <p id="cnum"></p>
                        </p>
                    </div>
                  
                    <div>
                        <p><strong>Proof Of Payment &nbsp;</strong></p>
                        <img :src="'/florafusionmarket/assets/img/' + image" id="image" class="rounded" style="height:100px; width:150px; object-fit:cover !important;">
                    </div>
                    &nbsp;

            
                    <table id="product-info" class="table-auto w-full mb-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Product Name</th>
                                <th class="px-4 py-2">Quantity</th>
                                <th class="px-4 py-2">Price</th>
                                <th class="px-4 py-2">Proof Of Payment</th>
                                <th class="px-4 py-2">Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="mb-4" id="payDetails">

                    </div>
                </div>
                <div class="modal-footer">
                <button id="delivered" class="btn btn-success" >Delivered</button>
                <button id="packed"class="btn btn-success">Packed</button>
                <button id="shipped" class="btn btn-info" >Ship</button>
                <button id="received" class="btn btn-warning">Receive</button>
</div>

            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $("#packed").click(function () {
            // Hide the "Packed" button
            $("#packed").hide();
            // Show the "Ship" button
            $("#shipped").show();
        });

        $("#shipped").click(function () {
            // Hide the "Ship" button
            $("#shipped").hide();
            // Show the "Receive" button
            $("#received").show();
        });

        $("#received").click(function () {
            // Hide the "Receive" button
            $("#received").hide();
            // Show the "Delivered" button
            $("#delivered").show();
        });
    });
</script>


    <script src="../assets/viewDetailsModal.js"></script>
    <script src="../assets/css/toastr.js"></script>
    <script src="../assets/services/axios.js"></script>
    <script src="../assets/css/sweetalert.js"></script>
    <script src="../assets/services/jquery.js"></script>
    <script src="../assets/dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-..." crossorigin="anonymous"></script>
</body>

</html>