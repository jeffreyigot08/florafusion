<?php
class data
{
    public function doLoginData()
    {
        return "SELECT * FROM `user_table` WHERE `email` = ? AND `password` = ?";
    }

    public function doRegisterData()
    {
        return "INSERT INTO `user_table` (`name`,`email`,`password`,`role`,`status`,`image`,`qr_image`,`current_add`,`permanent_add`,`shop_name`,`contact_no`,`gender`,`birthday`) VALUES (?,?,?,?,1,?,?,?,?,?,?,?,?)";
    }
    // public function doReportData()
    // {
    //     return "INSERT INTO `report` (`query_type`, `issue`, `seller_name`, `order_no`, `comments`, `image`, `sellername`, `shopname`, `report_id`, `id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    // }
    
    public function Lockseller()
    {
        return "UPDATE `user_table` SET `role`= 3 WHERE id = ?";
    }
    public function doAddUserInfoData()
    {
        return "UPDATE `user_table` SET  `name` = ?, `email` = ?, `image` = ?, `current_add` = ?, `permanent_add` = ?, `contact_no` = ?, `gender` = ?, `birthday` = ? WHERE `id` = ?";
    }
    public function doGetByIdpay()
    {
        return "SELECT * FROM `my_cart` where cart_id = ?";
    }
    public function doGetProductByIdData()
    {
        return "SELECT p.userID,p.product_name, p.product_des, p.product_price,p.product_ID, p.product_image,p.product_image2,product_image3, u.shop_name, u.image
        FROM products AS p
        INNER JOIN user_table AS u ON p.userID = u.id
        WHERE product_ID = ?";
    }
    public function sellerProducts(){
        return "SELECT * FROM `products` WHERE product_ID = ?";
    }
    public function getProdByID()
    {
        return "SELECT p.product_name, p.product_des, p.product_price, p.product_image, u.shop_name, u.image
        FROM products AS p
        INNER JOIN user_table AS u ON p.userID = u.id
        WHERE product_ID = ?";
    }

    public function getDisplayAllData()
    {
        return "SELECT * FROM `products` WHERE product_ID = ?";
    }
    public function AdminInven()
    {
        return "SELECT p.*, u.image AS revImage, u.shop_name
        FROM products AS p
        INNER JOIN user_table AS u ON  p.userID = u.id";
    }
    public function getPurch()
    {
        return "SELECT t.customer_id, t.*, p.product_name, p.product_image, p.created_date, u.name
        FROM `transaction` AS t
        INNER JOIN products AS p ON t.product_id = p.product_ID
        INNER JOIN user_table AS u ON t.customer_id = u.id
        WHERE t.`status` IN (1, 2, 3, 4) AND t.`customer_id` = ?;
        ";
    }
    
    
    public function doDeleteProductData()
    {
        return "DELETE FROM `products` WHERE `product_ID` = ?";
    }
       public function getRevByIDdata()
    {
        return "SELECT r.*, u.image AS revImage, u.name AS revFullname, r.review_text, p.userID,
        p.product_ID AS actual_product_id
        FROM reviews AS r INNER JOIN user_table AS u ON r.customer_id = u.id 
        INNER JOIN products AS p ON r.product_id = p.product_ID WHERE r.product_id = ?";
    }
    public function getAllProductFromIndex()
    {
        return "SELECT * FROM `products`";
    }

    public function getAllProductsQuery()
    {
        return "SELECT * FROM `products` WHERE `userID` = ? ORDER BY `created_date` desc";
    }

    public function geTAddToCartData()
    {
        return "INSERT INTO `my_cart` (customer_id,seller_id,product_id,product_price,quantity,is_checkout) SELECT ?,userID,product_ID,product_price,1,1 FROM `products` where product_ID = ?";
    }
    public function alreadyInCart()
    {
        return "SELECT * FROM `my_cart` WHERE customer_id = ? AND product_id = ?";
    }
    public function getDisplayCartData()
    {
        return "SELECT c.cart_id,p.product_image, p.product_name,p.product_price,c.quantity, u.qr_image, c.quantity * p.product_price as totalPrice, u.qr_image 
        FROM `my_cart` AS c 
        inner join user_table as u 
        inner join products AS p ON c.product_id = p.product_ID and p.userID = u.id 
        WHERE c.customer_id = ? and c.is_checkout = 1";
    }
    public function getDeleteCartData()
    {
        return "DELETE FROM my_cart where cart_id = ?";
    }
    public function getAddToWishlistData()
    {
        return "INSERT INTO `wishlist` (`customer_id`, `product_id`) SELECT ?,product_ID FROM `products` WHERE `product_id` = ?";
    }
    public function ADDWL()
    {
        return "INSERT INTO `wishlist` (`customer_id`, `product_id`) SELECT ?,product_ID FROM `products` WHERE `product_id` = ?";
    }
    public function getDisplayWishlistData()
    {
        return "SELECT w.wishlist_id, p.product_image,p.product_name,p.product_price,p.product_ID FROM `wishlist` AS w INNER JOIN products as p INNER JOIN user_table AS u on w.customer_id = u.id and w.product_id = p.product_ID WHERE w.customer_id = ?";
    }
    public function doUpdatePrice()
    {
        return "UPDATE my_cart SET quantity = ? WHERE cart_id = ?";
    }
    // not functional
    public function getDeleteWishlistData()
    {
        return "DELETE FROM wishlist WHERE wishlist_id = ?";
    }
    public function alreadyExist()
    {
        return "SELECT * FROM `wishlist` WHERE customer_id = ? AND product_id = ?";
    }

    // public function doCheckOut(){
    //     return "INSERT INTO `orders`( `customer_id`,`seller_id`, `product_id`, `total_amount`, `order_date`) SELECT ?,seller_id,product_id,product_price*quantity,now() FROM `my_cart` WHERE cart_id = ?";
    // }
    public function paymentData()
    {
        return "INSERT INTO `orders`(`customer_id`, `seller_id`, `product_id`,`quantity`, `total_amount`, `paymethod`, `image`, `order_date`)
        SELECT customer_id, seller_id, product_id, quantity, product_price*quantity,?,?,now()
        FROM my_cart AS m WHERE m.cart_id = ?";
    }
    public function displayOrderDetailsData()
    {
        return "SELECT t.*, u.name, u.email, u.permanent_add, u.contact_no, p.product_name, p.product_price,o.quantity
        FROM transaction as t
        INNER JOIN products as p ON t.product_id = p.product_ID
        INNER JOIN user_table as u ON t.customer_id = u.id
        INNER JOIN orders as o ON t.customer_id = o.customer_id
        WHERE t.customer_id = ?
        ORDER BY t.id ASC";
    }
    // public function updateStatus()
    // {
    //     return "UPDATE `my_cart` SET `is_checkout`= 1  WHERE cart_id = ?";
    // }
    public function updateStatus()
    {
        return "DELETE FROM `my_cart` WHERE `cart_id` = ?";
    }
    public function getCustomerData()
    {
        return "SELECT * FROM `user_table` WHERE `role` = 1 ORDER BY `created_date`";
    }
    public function getSellerData()
    {
        return "SELECT * FROM `user_table` WHERE `role` = 2 ORDER BY `created_date`";
    }
    public function UpdateLock(){
        return "UPDATE `user_table` SET `disabled` = ? WHERE id = ?";
    }
    public function UpdateUnlockData(){
        return "UPDATE `user_table` SET `disabled` = 0 WHERE id = ?";
    }
    public function DeleteCus()
    {
        return "DELETE FROM `user_table` WHERE id = ? ";
    }

    public function countCustomer()
    {
        return "SELECT COUNT(*) FROM `user_table` WHERE `role` = 1";
    }
    public function countSeller()
    {
        return "SELECT COUNT(*) FROM `user_table` WHERE `role` = 2";
    }
    public function countPlant()
    {
        return "SELECT COUNT(*) FROM products WHERE userID = ?";
    }
    public function countOrder()
    {
        return "SELECT COUNT(*) FROM orders WHERE seller_id = ?";
    }

    // orders.php
    public function displayOrdersseller()
    {
        return "SELECT u.name AS order_name,u.name AS user_name,u.contact_no,u.current_add,t.id,t.date,t.amount,t.paymethod,t.status
        FROM `transaction` AS t
        INNER JOIN user_table AS u ON t.customer_id = u.id
        WHERE t.seller_id = ?";
    }

    // order.php delete
    public function displayOrderDelete()
    {
        return "DELETE FROM `transaction` WHERE id = ?";
    }

    // order.php view details 
    public function displayOrderView()
    {
        return "SELECT u.name AS order_name, u.name AS user_name, u.contact_no, u.current_add,t.date,t.amount,t.paymethod,t.image AS ProofOFPayment,t.id,p.product_name,p.product_price,o.quantity,t.status
        FROM `transaction` AS t
        INNER JOIN user_table AS u ON t.customer_id = u.id
        INNER JOIN products AS p ON p.product_ID = t.product_ID
        INNER JOIN orders AS o  ON o.customer_id = t.customer_id
        WHERE t.id = ?";
    }

    public function displayDetialsData()
    {
        return "SELECT u.name AS order_name, u.name AS user_name, u.contact_no, u.current_add,t.date,t.amount,t.id,p.product_name,p.product_price,o.quantity,t.paymethod,t.status
        FROM `transaction` AS t
        INNER JOIN user_table AS u ON t.customer_id = u.id
        INNER JOIN products AS p ON p.product_ID = t.product_ID
        INNER JOIN orders AS o ON t.product_id = o.product_id
        WHERE t.id = ?";
    }

    //order.php delivered 
    public function deliveredItem()
    {
        return "UPDATE `transaction` SET status = 1 WHERE id = ?";
    }
    public function PackedItem()
    {
        return "UPDATE `transaction` SET status = 2 WHERE id = ?";
    }
    public function ShippedItem()
    {
        return "UPDATE `transaction` SET status = 3 WHERE id = ?";
    }
    public function ReceiveItem()
    {
        return "UPDATE `transaction` SET status = 4 WHERE id = ?";
    }

    // index.php display all products
    public function displayallprod()
    {
        return "SELECT * FROM products";
    }

    //index.php individual view product 
    public function displayediprod()
    {
        return "SELECT * FROM products WHERE product_ID = ?";
    }

    //sellers_report
    public function displaySelleresReport()
    {
        return "SELECT 
        SUM(o.total_amount) AS total_amount,
        o.order_date AS orderdate,
        MONTHNAME(o.order_date) AS month,
        YEAR(o.order_date) AS orderyear,
		p.product_name AS category,
        COUNT(p.product_ID - m.quantity) AS unitSOld
        FROM user_table AS u
        INNER JOIN orders AS o ON u.id = o.seller_id
        INNER JOIN products AS p ON p.product_ID = o.product_id
        INNER JOIN my_cart AS m ON m.product_id = o.product_id
        WHERE o.seller_id = ?
        GROUP BY o.order_date
    ";
    }
    //monthly sellers_report
    public function displayMonthSellers()
    {
        return "SELECT p.product_name,o.quantity, o.total_amount AS amount, MONTHNAME(o.order_date) AS monthname, YEAR(o.order_date) AS year
        FROM orders AS o
        INNER JOIN user_table AS u ON u.id = o.seller_id
        INNER JOIN products AS p ON p.product_id = o.product_id
        WHERE o.order_date = ?
        ORDER BY o.order_id";
    }

    // total amount report
    public function displaytotalamount()
    {
        return "SELECT SUM(o.total_amount) AS totalamount
            FROM orders AS o
            INNER JOIN user_table AS u ON o.seller_id = u.id
            WHERE o.order_date = ? ";
    }

    //INVENTORY
    public function doAddinventory()
    {
        return "INSERT INTO products (userID, product_image,product_image2,product_image3, product_name, product_qty, product_price, product_des) VALUES (?,?,?,?,?,?,?,?)";
    }

    //INVENTORY DISPLAY PRODUCTS ADDED 
    public function displayInventory()
    {
        return "SELECT p.product_name, p.product_qty,product_price,product_image, p.product_ID AS pid
            FROM products AS p
            INNER JOIN user_table AS u ON u.id = p.userID
            WHERE p.userID =  ? ";
    }

    //INVENTORY UPDATE 
    public function updateinventory()
    {
        return "UPDATE `products` SET  `product_image` = ?  ,`product_image2` = ?, `product_image3` =?,`product_name` = ?, `product_qty` = ?, `product_price` =? , `product_des` = ?, `status` = ? where `product_ID` = ?";
    }

    //INVENTORY GET FOR UPDATE
    public function displayUpdateINfo()
    {
        return "SELECT * FROM products WHERE product_ID = ? ";
    }
    //INVENTORY DELETE
    public function deleteInve()
    {
        return "DELETE FROM products WHERE product_ID = ?";
    }

    public function dchart()
    {
        return "SELECT MONTHNAME(o.order_date) AS month, SUM(o.total_amount) AS total_sum
        FROM user_table AS u
        INNER JOIN orders AS o ON o.seller_id = u.id
        WHERE o.seller_id = ?
        GROUP BY MONTH(o.order_date)
        ORDER BY MONTH(o.order_date)";
    }
    public function adminchart()
    {
        return "SELECT
        MONTHNAME(o.order_date) AS month,
        COUNT(DISTINCT o.seller_id) AS Sellers
    FROM
        user_table AS u
    INNER JOIN
        orders AS o ON o.seller_id = u.id
    GROUP BY
        MONTH(o.order_date)
    ORDER BY
        MONTH(o.order_date)";
    }
    public function getHisto()
    {
        return "SELECT p.product_ID, p.product_name, o.quantity, o.total_amount, (o.total_amount*o.quantity) AS totalPrice, o.order_date, t.status
        FROM orders AS o 
        INNER JOIN products AS p ON p.product_ID = o.product_id
        INNER JOIN transaction t ON t.product_id = o.product_id
        WHERE o.seller_id = ?
        AND t.status = 1";
    }
    public function doAddReview()
    {
        return "INSERT INTO reviews (`review_id`,`customer_id`,`seller_id`,`product_id`,`review_text`, `review_date`) VALUES (?,?,?,?,?,now())" ;
    }
    // public function doAddReviews()
    // {
    //     return "INSERT INTO `reviews`(`customer_id`, `seller_id`, `product_id`, `rating`, `review_text`, `review_date`) 
    //     SELECT customer_id, seller_id, product_id, ?, ?, now() FROM orders AS o WHERE product_id = product_id";
    // }
    public function doAddVoteData()
    {
        return "INSERT INTO best_store (`store_id`,`seller_id`,`customer_id`,`rating`,`date`) VALUES (?,?,?,?,now())" ;
    }
    
    public function displayReview()
    {
        return "SELECT u.image AS userImage, u.shop_name, u.permanent_add,r.product_id,  r.rating
        FROM reviews AS r 
        INNER JOIN user_table AS u ON u.id = r.seller_id
        WHERE r.seller_id = r.seller_id";
    }
    public function displayBestStoreData()
    {
        return"SELECT 
        bs.seller_id,
        seller.image AS sellerImage, 
        seller.name AS sellerFullname,
        seller.shop_name AS sellerShopname,
        seller.permanent_add AS sellerAddress, 
        customer.image AS customerImage,
        customer.name AS customerFullname,
        SUM(bs.rating) AS totalRating
    FROM best_store AS bs 
    INNER JOIN user_table AS seller ON bs.seller_id = seller.id 
    INNER JOIN user_table AS customer ON bs.customer_id = customer.id 
    WHERE bs.seller_id = bs.seller_id
    GROUP BY bs.seller_id, seller.image, seller.name, seller.shop_name, seller.permanent_add, customer.image, customer.name
    ORDER BY totalRating DESC
    LIMIT 3;
    ";
    }
    public function DisplayINFO()
    {
        return "SELECT * FROM `user_table` WHERE id = ?";
    }
    public function doProdUsers()
    {
        return "SELECT p.product_name, p.product_des, p.product_price, p.product_image, u.shop_name,  u.image
        FROM products AS p
        INNER JOIN user_table AS u ON p.userID = u.id
        WHERE userID = ?";
    }
    public function dataDisplaySellerProfile()
    {
        return "SELECT u.*, COUNT(p.userID) AS productCount ,p.userID as seller_id
        FROM user_table AS u 
        LEFT JOIN products AS p ON p.userID = u.id 
        WHERE u.id = ?
        GROUP BY u.id";
    }
    public function dataDisplaySellerProducts()
    {
        return "SELECT * FROM products WHERE userID = ?";
    }
    public function becomeS()
    {
        return "UPDATE user_table SET qr_image = ?, permanent_add = ?, shop_name = ?,`role` = 2 WHERE id = ?";
    }
    public function report()
    {
        return "INSERT INTO `complaints`(`typeOfComplaints`, `selectType`, `shopName`, `sellerName`, `orderNo`, `yourName`, `email`, `phoneNo`, `comments`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    }
    public function startInboxQuery()
    {
        return "INSERT INTO `inbox` (`sender_id`, `receiver_id`, `created_at`) 
        VALUES (?, ?, NOW())";
    }
    public function checkIfExistInbox()
    {
        return "SELECT * FROM inbox WHERE sender_id = ? AND receiver_id = ?";
    }
    public function getInboxDataQuery()
    {
        return "SELECT inbox.*, 
                       CASE WHEN inbox.sender_id = ? THEN user_table_receiver.name ELSE user_table_sender.name END as other_user_name,
                       CASE WHEN inbox.sender_id = ? THEN user_table_receiver.image ELSE user_table_sender.image END as other_user_image
                FROM inbox
                LEFT JOIN user_table AS user_table_sender ON inbox.sender_id = user_table_sender.id
                LEFT JOIN user_table AS user_table_receiver ON inbox.receiver_id = user_table_receiver.id
                WHERE user_table_sender.id = ? OR user_table_receiver.id = ?";
    }
    public function checkIfExistMessageInbox()
    {
        return "SELECT * FROM message WHERE inbox_id = ?";
    }
    public function insertMessageQuery()
    {
        return "INSERT INTO `message` (`inbox_id`, `sender_id`, `receiver_id`, `message`, `created_at`)
        VALUES (?, ?, ?, ?, NOW())";
    }
    public function getConversationQuery()
    {
        return "SELECT 
                message.*, 
                sender.image AS sender_image, 
                receiver.image AS receiver_image
            FROM message
            LEFT JOIN user_table AS sender ON message.sender_id = sender.id
            LEFT JOIN user_table AS receiver ON message.receiver_id = receiver.id
            WHERE message.inbox_id = ?
        ";
    }
    //    public function getRevByIDdata()
    // {
    //     return "SELECT r.*, u.image AS revImage, u.name AS revFullname, r.review_text,
    //     p.product_ID AS actual_product_id
    //     FROM reviews AS r INNER JOIN user_table AS u ON r.customer_id = u.id 
    //     INNER JOIN products AS p ON r.product_id = p.product_ID WHERE r.product_id = ?";
    // }

    public function SELECTID()
    {
        return "SELECT * FROM `my_cart` WHERE cart_id = ?";
    }
    public function dataOrderProcess()
    {
        return [
            "INSERT INTO `orders` (`customer_id`, `seller_id`, `product_id`, `quantity`, `total_amount`, `order_date`) 
             VALUES (?, ?, ?, ?, ?, NOW())",
            "DELETE FROM `my_cart` WHERE `cart_id` = ?",
            "UPDATE `products` SET `product_qty` = `product_qty` - ? WHERE `product_id` = ?",
        ];
    }
    public function dataOrderTransactionProcess()
    {
        return "INSERT INTO `transaction` (`customer_id`, `seller_id`, `product_id`, `amount`, `paymethod`, `image`, `status`, `date`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
    }
    public function displayReport()
    {
        return "SELECT * FROM `complaints` ";
    }
    public function DELETEHISTO()
    {
        return "DELETE FROM `transaction` WHERE id = ?";
    }
}
