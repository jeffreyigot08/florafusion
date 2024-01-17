<?php
session_start();
if(!isset($_SESSION['id'])) {
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
    <link rel="stylesheet" href="../assets/css/sweetalert.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/tailwind.css">
    <title>Inventory</title>
</head>

<body>
    <div class="flex" id="adminUP">
        <div class="bg-green-600 text-black p-4">
            <div class="bg-green-600 text-black h-screen w-64 flex flex-col">
                <div class="mt-10 mb-8 flex items-center gap-2">
                    <img src="../assets/img/FloraFusion.jpg" class="rounded-full w-14" alt="Plant Logo" />
                    <h2 class="text-2xl text-white font-bold">FloraFusion <span class="font-normal">Market</span></h2>
                </div>
                <ul class="flex flex-col space-y-3">
    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
        <a href="../Admin/index.php" class="flex items-center space-x-2">
            <i class="fas fa-chart-line h-5 w-5 fill-current text-white"></i>
            <span class="text-white font-medium hover:text-gray-300">Dashboard</span>
        </a>
    </li>
    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
        <a href="../Admin/cus_profile.php" class="flex items-center space-x-2">
            <i class="fas fa-address-book h-5 w-5 fill-current text-white"></i>
            <span class="text-white font-medium hover:text-gray-300">Customer Profiles</span>
        </a>
    </li>
    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
        <a href="../Admin/seller_profile.php" class="flex items-center space-x-2">
            <i class="fas fa-user-circle h-5 w-5 fill-current text-white"></i>
            <span class="text-white font-medium hover:text-gray-300">Seller Profiles</span>
        </a>
    </li>
    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
        <a href="../Admin/inventory.php" class="flex items-center space-x-2">
            <i class="fas fa-boxes h-5 w-5 fill-current text-white"></i>
            <span class="text-white font-medium hover:text-gray-300">Inventory</span>
        </a>
    </li>
    <li class="hover:bg-green-700 p-2 rounded-md cursor-pointer">
        <a href="../Admin/reports.php" class="flex items-center space-x-2">
            <i class="fas fa-chart-pie h-5 w-5 fill-current text-white"></i>
            <span class="text-white font-medium hover:text-gray-300">Reports</span>
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
            <!-- Profile Icon in the top right corner -->
            <button id="profile-menu-button" class="text-4xl text-green-400 absolute top-0 right-0 mr-4 mt-4"><img
                    src="<?php echo isset($_SESSION['image']) ? '../assets/img/'.$_SESSION['image'] : ''; ?>"
                    alt="default" style="height:35px;width:35px;border-radius: 40px;"></i></button>
            <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md mb-4 mt-20"><a
                    href="inventory.php" class="text-white no-underline">Back</a></button>
            <div class="flex justify-between items-center mb-4">
                <div class="relative ml-auto">
                    <input type="search" v-model="search"
                        class="border border-gray-300 rounded-md px-3 py-2 pr-10 placeholder-gray-400 focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Search">
                </div>
            </div>



            <!-- Table -->
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-3 bg-gray-200">Seller Shop</th>
                        <th class="py-2 px-3 bg-gray-200">Plant Image</th>
                        <th class="py-2 px-3 bg-gray-200">ID Number</th>
                        <th class="py-2 px-3 bg-gray-200">Plant Name</th>
                        <th class="py-2 px-3 bg-gray-200">Quantity</th>
                        <th class="py-2 px-3 bg-gray-200">Price</th>
                        <th class="py-2 px-3 bg-gray-200">Description</th>
                        <!-- <th class="py-2 px-3 bg-gray-200">Actions</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample inventory items (you can use a loop to populate these) -->
                    <tr v-for="Aup in searchData">
                        <td class="px-6 py-4 whitespace-nowrap flex items-center">
                            <!-- Seller Image -->
                            <img :src="'../assets/img/' +Aup.revImage" alt="Seller Profile" class="w-8 h-8 rounded-full mr-2">
                            <!-- Seller Shop Name -->
                            <span>{{ Aup.shop_name }}</span>
                        </td>
                        <td class="py-2 px-3"><img :src="'../assets/img/' + Aup.image" alt="" class="w-16 h-16" /></td>
                        <td class="py-2 px-3">{{ Aup.id }}</td>
                        <td class="py-2 px-3">{{ Aup.name }}</td>
                        <td class="py-2 px-3">{{ Aup.qty }}</td>
                        <td class="py-2 px-3">{{ Aup.price }}</td>
                        <td class="py-2 px-3">{{ Aup.desc }}</td>
                        <!-- <td class="py-2 px-3">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md ml-2"
                        data-bs-toggle="modal" data-bs-target="#displayprod">Display</button>
                    <button class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-md ml-2"
                        data-bs-toggle="modal" data-bs-target="#updateprod">Update</button>
                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-md ml-2"
                        data-bs-toggle="modal" data-bs-target="#deleteprod">Delete</button>
                </td> -->
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Modal for Add Category -->
        <!-- <div class="modal fade" id="addprod" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4">
                    <div class="modal-header">
                        <h5 class="modal-title text-2xl font-semibold mb-4" id="addprod">Add Products</h5>
                    </div> -->
                    <!-- <form @submit="addproducts" class="productform"> -->
                        <!-- Image -->
                        <!-- <input type="file" class="mt-1 p-2 w-full border rounded" name="file" id="image"> -->
                        <!-- Product -->
                        <!-- <input type="text" placeholder="Product Name" class="mt-1 p-2 w-full border rounded"
                            name="name"> -->
                        <!-- Total Products -->
                        <!-- <input type="text" placeholder="Total Products" class="mt-1 p-2 w-full border rounded"
                            name="price"> -->
                        <!-- Total Products -->
                        <!-- <input type="text" placeholder="Total Price" class="mt-1 p-2 w-full border rounded" name="qty"> -->
                        <!-- Description -->
                        <!-- <input type="text" placeholder="Description" class="mt-1 p-2 w-full border rounded" name="desc"> -->
                        <!-- Add Button -->
                        <!-- <div class="d-flex flex-row-reverse">
                            <button
                                class="bg-green-500 mt-3 text-white rounded-md py-2 px-4 mx-2 my-2 hover:bg-green-600">Add</button>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    


        <script src="../assets/css/sweetalert.js"></script>
        <script src="../assets/css/bootstrap.js"></script>
        <script src="../assets/services/axios.js"></script>
        <script src="../assets/services/vue.3.js"></script>
        <script src="../assets/services/adminUP.js"></script>
</body>

</html>