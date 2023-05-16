<template>
	<div class="container">
		<div class="card card-default" style="padding-bottom: 50px;">
			<div class="card-header">Login</div>
			<div class="col-sm-4 mt-5" style="margin: auto;">
				<form @submit.prevent="login" >
					<div class="form-group">
						<label for="email">Email</label>
              			<input type="email"  class="form-control" v-model="form.email" required/>
					</div>			
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" v-model="form.password" required/>
					</div>			
					<div class="alert alert-danger" v-if="check">
						{{ check }}
					</div>
					<button type="submit" class="btn btn-dark">Login</button>
				</form>
			</div>
			
		</div>
	</div>
</template>
<script>
	import { reactive,ref, onMounted } from 'vue';
	import axios from 'axios';
    import { useRouter } from 'vue-router';
	import ApiService from '../common/apiService'
	import { APILOGIN,HOME } from '../store/url'
	import jwtService from '../common/jwt.service'
	export default{
		setup(){
		const errors = ref([])
		const check=ref('')
		const router= useRouter()
		const form = reactive({
			email:'admin@gmail.com',
			password:'12345678'
		});
		const login = async()=>{
		try{
			let res = await ApiService.post(APILOGIN,form)
			 console.log(res.data.token);
			if(res.data.status===true){
				jwtService.setToken(JSON.stringify(res.data.token));
				window.location.href = HOME
				alert(res.data.message)
			    	}
			}
		catch (error) {
			if (error.response.status === 401) {
					for (const key in error.response.data) {
						errors.value = error.response.data
					}
					check.value= errors.value.message
				}
		}
	    };
		return {
			form,
			login,
			errors,
			check
				}
		}
}
</script>
