const { createApp } = Vue;
createApp({
    data() {
        return {
            p_name: '',
            p_price: '',
            p_quantity: '',
            p_totalPrice: '',
            qrCoding: '',
            pimage: '',
            image: 0,
            ids: [],
            inte: 1,
            c: [],
            carts: [],
            wishlist: [],
            cartlistLength: 0,
            wishlistLength: 0,
            id: 0,
            order_id: 0,
            paymentMethodModel: '',
            proofPayment: '',
            checkOUt: [],
            cartData: [],
            // selectedCartItemId: null,
        }
    },
    methods: {
        decrement(item) {
            if (item.p_quantity > 1) {
                item.p_quantity--;
                this.updateTotalPrice(item);
            }
        },
        increment(item) {
            item.p_quantity++;
            this.updateTotalPrice(item);
        },
        updateTotalPrice(item) {
            const data = new FormData();
            const vue = this;

            data.append("method", "updateCartIdPrice");
            data.append("quantity", item.p_quantity); // Use item.p_quantity instead of cartItem.quantity
            data.append("cart_id", item.id); // Use item.id instead of cartItem.cart_id

            axios.post('/florafusionmarket/includes/router.php', data)
                .then(function (r) {
                    if (r.data === 1) {
                        vue.displayCart();
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });

            item.p_totalPrice = item.p_price * item.p_quantity;
            this.calculateTotalPrice();
        },
        handleFileChange(event) {
            this.image = event.target.files[0];
        },
        displayCart: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "DisplayCart");
            axios.post('/florafusionmarket/includes/router.php', data)
                .then(function (r) {
                    vue.carts = [];
                    console.log(r.data);
                    // vue.allcarts = r.data.length;
                    for (var v of r.data) {
                        vue.qrCoding = v.qr_image;
                        vue.usid = v.userID;
                        vue.ids.push(v.cart_id);
                        vue.carts.push({
                            pimage: v.product_image,
                            p_name: v.product_name,
                            p_price: v.product_price,
                            shop_name:v.shop_name,
                            p_quantity: v.quantity,
                            p_totalPrice: v.totalPrice,
                            id: v.cart_id,
                            stats: v.status
                        })
                    }
                    vue.cartlistLength = r.data.length;
                    vue.calculateTotalPrice(); // Move this line up to be executed
                    return vue.cartlistLength;
                });
        },
        dipslayWishlist: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "dipslayWishlist");
            axios.post('/florafusionmarket/includes/router.php', data)
                .then(function (r) {
                    vue.wishlist = [];
                    for (var v of r.data) {
                        vue.wishlist.push({
                            product_name: v.product_name,
                            product_price: v.product_price,
                            product_image: v.product_image,
                            id: v.wishlist_id,
                        });
                    }
                    vue.wishlistLength = r.data.length;
                    return vue.wishlistLength;
                });
        },
        calculateTotalPrice: function () {
            const totalCartPrice = this.carts.reduce((total, item) => total + item.p_totalPrice, 0);
            const t = document.getElementById('f');
            t.textContent = totalCartPrice;
        },

        deleteCart: function (id) {
            const vue = this;
            var data = new FormData();
            data.append("method", "DeleteCart");
            data.append("id", id);

            axios.post('/florafusionmarket/includes/router.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.displayCart();
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted to Cart',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                })
        },
        paymethod: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "payMethod");
            data.append("id", this.selectedCartItemId);
            data.append("paymethod", vue.paymentMethodModel);
            data.append("image", vue.image);
            axios.post('../includes/router.php', data)
                .then(function (r) {
                    if (r.data == 200) {
                        vue.displayCart();
                        console.log(r.data);
                        toastr.success('Successfully paid');
                        //   window.location.reload();
                    } else {
                        toastr.error('Failed to pay!');
                        console.log(r.data);
                    }
                })
                .catch(function (error) {
                    console.error('Error uploading file: ', error);
                });
        },
        checkout: function (id) {
            const vue = this;
            var data = new FormData();
            data.append("method", "selectID");
            data.append("id", id);
            axios.post('../includes/router.php', data)
                .then(function (r) {
                    vue.cartData.push(r.data);
                })
        },
        handleFileProofImg: function (event) {
            // Update proofPayment when the file input changes
            this.proofPayment = event.target.files[0];
        },
        processPlaceOrder: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "placeOrder");
            data.append("paymethod", vue.paymentMethodModel);
            data.append("image", vue.proofPayment);
            data.append("cartData", JSON.stringify(vue.cartData));

            axios.post('../includes/router.php', data)
                .then(function (r) {
                    console.log(r.data);

                    var orderDetailsModal = document.getElementById('order-details-modal');

                    if (orderDetailsModal) {
                        orderDetailsModal.style.display = 'none';
                    }

                    window.location.reload();
                })
                // window.location.reload();

        },

        //   checkout:function(id) {
        //     const vue = this;
        //     var data = new FormData();
        //     data.append("method", "itemCheckOut");
        //     data.append("id",id);
        //     axios.post('../includes/router.php', data)
        //     .then(function (r) {
        //     console.log(r.data);
        //     })
        //     .catch(function (error) {
        //     console.error('Error: ', error);
        //     });
        //   },
        //   getID(id) {
        //     this.selectedCartItemId = id;
        //   },
    },
    created: function () {
        this.displayCart();
        this.dipslayWishlist();
    }
}).mount('#cart')