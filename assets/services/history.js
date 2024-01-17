const { createApp } = Vue;
createApp({
    data(){
        return{
            name:'',
            h: [],
            history:[],
            lengthSold: 0,
            SumTP: 0,
            search: '',
        }
    },
    methods:{
        getHistory: function () {
            const vue = this;
            var data = new FormData();
            data.append("method", "history");
            axios.post('../includes/router.php', data)
                .then(function (r) {
                    vue.history = [];
                    let totalQuantitySold = 0;
                    let totalPriceSum = 0;
        
                    for (var v of r.data) {
                        vue.history.push({
                            name: v.product_name,
                            qty: v.quantity,
                            amount: v.total_amount,
                            TP: v.totalPrice,
                            date: v.order_date
                        });
        
                        // Update the total quantity sold and total price sum
                        totalQuantitySold += parseInt(v.quantity);
                        totalPriceSum += parseFloat(v.totalPrice);
                    }
                    vue.lengthSold = totalQuantitySold;
                    vue.SumTP = totalPriceSum;
                })
        },
    },
    computed:{
        searchData(){
            if(!this.search){
                return this.history;
            }

            console.log(this.search);
            return this.history.filter(h => h.name.toLowerCase().includes(this.search.toLowerCase()) );
        }
    },
    created:function(){
        this.getHistory();

    }
}).mount('#histo');