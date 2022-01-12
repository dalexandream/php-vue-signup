<!DOCTYPE html>
<html>
<head>
	<title>Example of the Vue.js simple Registration form with PHP and MySQLi</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="page-header text-right">Vue.js Registration with PHP/MySQLi</h1>
	<div id="register">
		<div class="col-xl-4">
 
			<div class="live panel panel-success">
			  	<div class="live panel-heading"><span class="live glyphicon glyphicon-client"></span> Client Registration</div>
			  	<div class="live panel-body">
			    	<label>Client Email:</label>
			    	<input type="text" class="live form-control" ref="email" v-model="dtlRegInfo.email" v-on:keyup="clientKeycheck">
			    	<div class="text-right" v-if="emailErr">
			    		<span style="font-size:13px;">{{ emailErr }}</span>
			    	</div>
			    	<label>client Password:</label>
			    	<input type="password" class="form-control" ref="password" v-model="dtlRegInfo.password" v-on:keyup="clientKeycheck">
			    	<div class="text-right" v-if="passErr">
			    		<span style="font-size:13px;">{{ passErr }}</span>
			    	</div>
			  	</div>
			  	<div class="live panel-footer">
			  		<button class="live btn btn-default btn-block" @click="clientReg();"><span class="live glyphicon glyphicon-check"></span>Registration</button>
			  	</div>
			</div>
 
			<div class="alert alert-danger text-right" v-if="msgError">
				<button type="button" class="close" @click="msgCls();"><span aria-hidden="true">×</span></button>
				<span class="live glyphicon glyphicon-alert"></span> {{ msgError }}
			</div>
 
			<div class="alert alert-success text-right" v-if="msgofSuccess">
				<button type="button" class="close" @click="msgCls();"><span aria-hidden="true">×</span></button>
				<span class="live glyphicon glyphicon-check"></span> {{ msgofSuccess }}
			</div>
 
		</div>
 
		<div class="col-xl-8">
			<h3>Customers Table</h3>
			<table class="table">
				<thead>
					<th>Client ID</th>
					<th>client Email</th>
					<th>client Password</th>
				</thead>
				<tbody>
					<tr v-for="client in Customers">
						<td>{{ client.id_client }}</td>
						<td>{{ client.email }}</td>
						<td>{{ client.password }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="vue.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="main.js"></script>
</body>
</html>