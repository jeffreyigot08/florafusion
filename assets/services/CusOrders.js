const { createApp } = Vue;
createApp({
    data() {
        return {
            id:0,
            name: '',
            image: '',
            orders:[],
        }
    },
    methods: {
        StatusDeliver: function (id) {
            const vm = this;
            
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to Deliver this Orders?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Deliver it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const data = new FormData();
                    data.append('method', 'updatestatusOrders');
                    data.append('status', 'status');
                    data.append('id', id);
        
                   axios.post('../includes/router.php', data).then(r => {
                        console.log(r.data);
                          if (r.data === 200) {
                            Swal.fire({
                                title: 'Deliever',
                                icon: 'success',
                                timer: 2000, 
                                showConfirmButton: false
                            });
                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            Swal.fire('Something went wrong', '', 'error');
                        }
                    });
                }
            });
        },  
        StatusPacked: function (id) {
          const vm = this;
          
          Swal.fire({
              title: 'Are you sure?',
              text: 'Do you want to packed this Orders?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, mark as packed!'
          }).then((result) => {
              if (result.isConfirmed) {
                  const data = new FormData();
                  data.append('method', 'updatestatusPacked');
                  data.append('status', 'status');
                  data.append('id', id);
      
                 axios.post('../includes/router.php', data).then(r => {
                    // alert(r.data);
                    //   console.log(r.data);
                      if (r.status === 200) {
                        Swal.fire({
                            title: 'Packed',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                      } else {
                          Swal.fire('Something went wrong', '', 'error');
                      }
                  });
              }
          });
      },
      
      StatusShipped: function (id) {
          const vm = this;
          
          Swal.fire({
              title: 'Are you sure?',
              text: 'Do you want to Shipped this Orders?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, mark as Shipped!'
          }).then((result) => {
              if (result.isConfirmed) {
                  const data = new FormData();
                  data.append('method', 'updatestatusShipped');
                  data.append('status', 'status');
                  data.append('id', id);
      
                 axios.post('../includes/router.php', data)
                 .then(r => {
                    //   console.log(r.data);
                    //   alert(r.data);
                      if (r.status === 200) {
                        Swal.fire({
                            title: 'Shipped',
                            icon: 'success',
                            timer: 2000, 
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                      } else {
                          Swal.fire('Something went wrong', '', 'error');
                      }
                  });
              }
          });
      },
      
      StatusReceive: function (id) {
          const vm = this;
          
          Swal.fire({
              title: 'Are you sure?',
              text: 'Do you want to Receive this Orders?',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, mark as Receive!'
          }).then((result) => {
              if (result.isConfirmed) {
                  const data = new FormData();
                  data.append('method', 'updatestatusReceive');
                  data.append('status', 'status');
                  data.append('id', id);
      
                 axios.post('../includes/router.php', data).then(r => {
                    //   console.log(r.data);
                      if (r.status === 200) {
                        Swal.fire({
                            title: 'Receive',
                            icon: 'success',
                            timer: 2000, 
                            showConfirmButton: false
                        });
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                      } else {
                          Swal.fire('Something went wrong', '', 'error');
                      }
                  });
              }
          });
      },
        Orders: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "displayAllOrders");
            axios.post('../includes/router.php', data)
            .then(function (r) {
                vue.orders = [];
                for (const v of r.data) {
                    vue.orders.push({
                        id: v.id,
                        image:v.plant_image,
                        name :v.order_name,
                        date:v.date,
                        status:v.status,
                        payment:v.paymethod,
                        amount:v.amount,
                    })
                }
            })
            setTimeout(function(){
                if (!$.fn.DataTable.isDataTable('#ordersTable')) {
                  $('#ordersTable').dataTable();
                }
            }, 1000);
        },
        DeleteOrders(id) {
            Swal.fire({
              title: 'Are you sure?',
              text: 'You are about to delete this Orders',
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                const data = new FormData();
                const vm = this;
                data.append("method", "deletesellersOrders");
                data.append("id", id);
                axios.post('../includes/router.php', data)
                  .then(function (r) {
                    Swal.fire(
                      'Deleted!',
                      'Orders successfully deleted',
                      'success'
                    );
                    setTimeout(function() {
                      window.location.reload();
                    }, 3000);
                  })
                  .catch(function (error) {
                    Swal.fire(
                      'Error!',
                      'An error occurred while deleting Orders',
                      'error'
                    );
                  });
              }
            });
          },    
          fnGetDataProducts: function(id) {
            const vm = this;
            const data = new FormData();
            data.append("method", "viewsellersOrders");
            data.append("id", id);
        
            axios.post('../includes/router.php', data)
                .then(function(r) {
                    if (r.data.length > 0) {
                        const v = r.data[0]; 
                        vm.id = v.id ;
                        vm.name = v.order_name;
                        vm.date = v.date;
                        vm.price = v.product_price;
                        vm.amount = v.amount;
                        vm.image = v.ProofOFPayment;
                        vm.quantity = v.quantity;
                        vm.status = v.status;
                        vm.contact_no = v.contact_no;
                        vm.address = v.current_add;

                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        },
    },
    created: function () {
        this.Orders();
    }
}).mount('#CusOrders')