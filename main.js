var main = new Vue({
	el: '#register',
	data:{
		msgofSuccess: "",
		msgError: "",
		emailErr: "",
		passErr: "",
		Customers: [],
		dtlRegInfo: {email: '', password: ''},
	},
 
	mounted: function(){
		this.getAllCustomers();
	},
 
	methods:{
		getAllCustomers: function(){
			axios.get('api.php')
				.then(function(dataRes){
					if(dataRes.data.error){
						main.msgError = dataRes.data.message;
					}
					else{
						main.Customers = dataRes.data.Customers;
					}
				});
		},
 
		clientReg: function(){
			var regForm = main.toFormData(main.dtlRegInfo);
			axios.post('api.php?do_act=register', regForm)
				.then(function(dataRes){
					console.log(dataRes);
					if(dataRes.data.email){
						main.emailErr = dataRes.data.message;
						main.emailFocus();
						main.msgCls();
					}
					else if(dataRes.data.password){
						main.passErr = dataRes.data.message;
						main.emailErr='';
						main.passFocus();
						main.msgCls();
					}
					else if(dataRes.data.error){
						main.msgError = dataRes.data.message;
						main.emailErr='';
						main.passErr='';
					}
					else{
						main.msgofSuccess = dataRes.data.message;
					 	main.dtlRegInfo = {email: '', password:''};
					 	main.emailErr='';
						main.passErr='';
					 	main.getAllCustomers();
					}
				});
		},
 
		emailFocus: function(){
			this.$refs.email.focus();
		},
 
		passFocus: function(){
			this.$refs.password.focus();
		},
 
		clientKeycheck: function(event) {
       		if(event.key == "Enter"){
         		main.clientReg();
        	}
       	},
 
		toFormData: function(obj){
			var liveFormData = new FormData();
			for(var key in obj){
				liveFormData.append(key, obj[key]);
			}
			return liveFormData;
		},
 
		msgCls: function(){
			main.msgError = '';
			main.msgofSuccess = '';
		}
 
	}
});