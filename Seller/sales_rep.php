<?php
 session_start();  
if(!isset($_SESSION['id'])){
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include DataTables from the DataTables CDN -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    
    <title>sales Report</title>
</head>
<body>
<div class="flex" id="sellerIndex">
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
                    <a href="../Seller/chat_support.php" class="flex items-center space-x-2">
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
        <button id="profile-menu-button" class="text-4xl text-green-400 absolute top-0 right-0 mr-4 mt-4"><img src="<?php echo isset($_SESSION['image']) ? '../assets/img/' . $_SESSION['image'] : ''; ?>"
                                    alt="default" style="height:35px;width:35px;border-radius: 40px;"></i></button>
    <!-- <i class="fas fa-user-circle text-4xl text-green-400 absolute top-0 right-0 mr-4 mt-4"></i> -->
    <h2 class="mt-20 fs-1 ">Sales Report</h2>
    <br>
    <!-- Sales report table -->
    <table id="sales_reports" class="display text-center">
    <thead>
        <tr>
            <th scope="col">Month</th>
            <th scope="col">Year</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
</table>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button id="close" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="modal-container">
    
      <div class="flex justify-end">
      </div>
      <h2 class="text-2xl text-center font-semibold">Sales Report for the month of</h2>
      <h2 class="text-center fs-3" id="monthandyear"></h2>
      <!-- Sales Table -->
      <table class="table-auto w-full mb-4 modal-view">
        <thead>
          <tr>
            <th class="px-4 py-2">Plant Name</th>
            <th class="px-4 py-2">Units Sold</th>
            <th class="px-4 py-2">Total Sales</th>
          </tr>
        </thead>
      </table>
      <div class="d-flex justify-content-between">
        <h3>Total: </h3>
        <h3 id="totalamount"></h3>
      </div>

      <!-- Notes -->
      <div class="mb-4">
        <p><strong>Notes:</strong><br> * Majority of the orders were paid through GCash. </p>
      </div>
 
  </div>
      </div>
      <div class="modal-footer">
       
        <button id="close-b" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php include '../Seller/sales_Modal.php'; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="../assets/salesrep_modal.js"></script> -->
<script src="../assets/services/axios.js"></script>
<!-- <script src="../assets/css/jquery.js"></script> -->
<script src="../assets/salesrep_Up_modal.js"></script>
</body>
</html>