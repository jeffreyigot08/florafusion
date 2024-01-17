const { createApp } = Vue;
createApp({
    data(){
        return{
            reports: [],

        }
    },
    methods:{
        displayReport:function(){
            const vue = this;
            var data = new FormData();
            data.append("method","displayReport");
            axios.post('../includes/router.php',data)
            .then(function(r){
                vue.reports = [];
                for(const v of r.data){
                    vue.reports.push({
                        typeOfComplaints : v.typeOfComplaints,
                        selectType : v.selectType,
                        shopName : v.shopName,
                        sellerName : v.sellerName,
                        orderNo : v.orderNo,
                        yourName : v.yourName,
                        email : v.email,
                        phoneNo : v.phoneNo,
                        comments : v.comments,
                        image : v.image,
                    })
                }
            })
        }
    },
    created:function(){
        this.displayReport();
    }
}).mount('#cusReport')