<template>
    <div>
      <form>
        <div class="row justify-content-center">
                <div class="col-sm-4 mt-5">
                    <form @submit.prevent="logout" >
                        <span type="submit" class="btn ">Logout</span>
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
        let isAuthenticated =ref(true)
        const router = useRouter()
        const logout =async()=>{
                    let res = await axios.get('api/auth/logout')
             router.push("/")
             router.go(0)
                }
      return {
        logout,
        isAuthenticated,
      }
    }
     }
      
      
</script>