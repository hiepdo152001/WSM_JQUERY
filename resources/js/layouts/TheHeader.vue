<template>
<div>
  <form>
    <div class="row justify-content-center">
			
			<div class="col-sm-4 mt-5">
				<form @submit.prevent="logout" >
					
					<button type="submit" class="btn btn-dark">Logout</button>
				</form>
			</div>
		</div>
  </form>
</div>
</template>
  
  <script>
 import { reactive, ref, onMounted } from 'vue';
 import { useRouter } from 'vue-router'
 import axios from 'axios';
 export default{
  setup(){
    const router = useRouter()
    const logout =async()=>{
				let res = await axios.get('api/auth/logout')
        console.log(res.data)
        if(res.data.status===true){
          await router.push("/")
        }
			}
  return {
    logout,
    
    
  }
}

 }
  
  
  </script>