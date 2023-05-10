<template>
	<div class="container">
		<div class="row justify-content-center">
			
			<div class="col-sm-4 mt-5">
				<form @submit.prevent="changePassword" >
          <div class="form-group">
						<label for="email">Email</label>
            <input type="email"  class="form-control" v-model="form.email" required/>
					</div>	
					<div class="form-group">
						<label for="old_password">Old Password</label>
            <input type="password"  class="form-control" v-model="form.old_password" required/>
					</div>			
					<div class="form-group">
						<label for="new_password">New Password</label>
		        <input type="password" class="form-control" v-model="form.new_password" required/>
					</div>			
          <div class="form-group">
						<label for="confirm_password"> Confirm Password</label>
            <input type="password"  class="form-control" v-model="form.confirm_password" required/>
					</div>
					<div class="alert alert-danger" v-if="message">
						{{ message }}
					</div>
					<button type="submit" class="btn btn-dark">Change Password</button>
				</form>
			</div>
			
		</div>
	</div>
</template>

  <script>
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  import { reactive,ref } from 'vue';
  export default{
   setup(){
        const errors=ref([])
        const message=ref('')
        const router= useRouter()
        const form=reactive({
            email:'a123@gmail.com',
            old_password:'12345678',
            new_password:'123456',
            confirm_password:'123456'
        });
        const changePassword=async()=>{
            try {
              if(form.new_password !== form.confirm_password){
                 message.value="confirm password not match!"
              }
              else{
                let res=await axios.post('api/auth/change-password',form);
                if(res.data.status===true){
                  await router.push('/login')
                  alert(res.data.message)
                }
              }
            } catch (error) {
                  if(error.response.status===404){
                    for(const key in error.response.data){
                      errors.value = error.response.data
                    }
                  message.value=errors.value.message
                  }
                  if(error.response.status===422){
                    for(const key in error.response.data.error){
                    errors.value = error.response.data.error
                    }
                   if(errors.value.hasOwnProperty('new_password')){
                    message.value=errors.value.new_password[0];
                   
                   }
                  }
            }
        } 
        return{
        form,
        changePassword,
        message
        }
    }
  }
</script>