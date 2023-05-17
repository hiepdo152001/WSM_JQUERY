<template>
  <nav class="navbar " style="border: 1px solid gray;">
    <div class="container-fluid">
      <form class="navbar-form navbar-left" action="/action_page.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <div class="dropdown">
        <div class="btn btn-primary dropdown-toggle custom-dropdown" type="button" data-toggle="dropdown">Profile</div>
        <!-- <span class="caret"></span></button> -->
        <ul class="dropdown-menu dropdown-menu-left">
          <div class="dropdown-header">thong tin</div>
          <li><router-link :to="{name: 'user'}">
            <a class="profile" >Profile</a>
            </router-link></li>
            <li> 
              <form>
                <form @submit.prevent="logout" >
                  <button type="submit" class="btn btn-dark">Logout</button>
                </form>
               </form>
            </li>
        </ul>
      </div>
    </div>
  </nav>

</template>
<style>
.dropdown {
  float: right;
  margin-top: 8px;
}
.dropdown-menu{
 right: 63px!important;
 margin-top: 10px;
 left: unset!important;
}
</style>  
<script>
   import { reactive, ref, onMounted } from 'vue';
   import { useRouter } from 'vue-router'
   import axios from 'axios';
   import ApiService from './common/apiService'
	import { APILOGOUT,APP_URL } from './store/url'
	import jwtService from './common/jwtService'
   export default{
    setup(){
      const router = useRouter()
      const logout =async()=>{
          let res = await ApiService.get(APILOGOUT,'')
          if(res.data.status===true){
            jwtService.destroyToken();
            window.location.href = APP_URL
          }
        }
    return {
      logout,
    }
  }
   }
 
  </script>