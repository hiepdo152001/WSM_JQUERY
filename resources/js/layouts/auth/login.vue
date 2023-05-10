<template>
	<div class="container">
		<div class="row justify-content-center">
			
			<div class="col-sm-4 mt-5">
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
	export default{
		setup(){
		const errors = ref([])
		const check=ref('')
		const router= useRouter()
		const form = reactive({
			email:'er@gmail.com',
			password:'123'
		});
		const login = async()=>{
		try{
			let res = await axios.post('api/auth/login',form)
			if(res.data.status===true){
			await router.push('/home')
			alert(res.data.message)
			}
				}
		catch (error) {
		    console.log(error.response.data)
			if (error.response.status === 401) {
					for (const key in error.response.data) {
						errors.value = error.response.data
					}
					console.log( errors.value.message)
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
