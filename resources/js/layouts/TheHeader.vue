<template>
  <nav class="navbar " style="border: 1px solid gray;">
    <div class="container-fluid">
      <div class="col-sm-11">
      <form class="navbar-form navbar-left" action="/action_page.php">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
      <div class="dropdown col-sm-1" >
        <div class="btn  custom-dropdown" type="button" data-toggle="dropdown" >
          <img :src="filename" alt="Avatar Image" style="width:50px;height:50px; border-radius:50px">
         </div>
        <ul class="dropdown-menu dropdown-menu-left">
          <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
            <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
              <span class="mr-2">
                <img class="profile-image rounded-circle" :src="filename" alt="">
              </span>
              <div class="info-card-text">
                 <div class="fs-lg text-truncate text-truncate-lg">
                 {{ name }}
                 </div>
                 <span class="text-truncate text-truncate-md opacity-80">
                  {{ email }}
                 </span>
              </div>
            </div>
          </div>
          <li><router-link :to="{name: 'user'}">
            <a class="dropdown-item" >Profile</a>
            </router-link>
          </li>
          <li><router-link :to="{name: 'change-password-auth'}">
            <a class="dropdown-item" >Đổi mật khẩu</a>
            </router-link>
          </li>
          <li><router-link :to="{name: 'yeu-cau-cua-toi'}">
            <a class="dropdown-item" >Danh sách yêu cầu</a>
            </router-link>
          </li>
          <li style="padding-left: 20px;"> 
            <form>
              <form @submit.prevent="logout" >
                <button type="submit" class="dropdown-item " >Logout</button>
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
.dropdown-item:hover,
.dropdown-item:focus {
  color: #6e4e9e;
  text-decoration: none;
  background-color: #f8f9fa;
}
</style>  
<script>
  import { ref, onMounted } from 'vue';
   import { useRouter } from 'vue-router'
   import ApiService from './common/apiService'
	import { APILOGOUT,APP_URL,APIMYACCOUNT} from './store/url'
	import jwtService from './common/jwtService'
   export default{
    setup(){
      const router = useRouter()
      const users = ref([]);
      const name=ref('')
      const email=ref('')
      const filename=ref('')
      onMounted(async () => {
        try {
          const headers = ApiService.setHeader();
          const apiResponse = await ApiService.get(APIMYACCOUNT,{ headers});
          users.value = apiResponse.data.data;
          name.value=users.value.name
          email.value=users.value.email
          filename.value='../../../storage/' + users.value.avatar
        } catch (error) {
          console.error(error);
        }
      });
      
      const logout =async()=>{
          let res = await ApiService.get(APILOGOUT,'')
          if(res.data.status===true){
            jwtService.destroyToken();
            window.location.href = APP_URL
          }
        }
    return {
      logout,
      filename,
      name,
      email
    }
  }
   }
 
  </script>
  <style>
.dropdown-item{
  font-weight: 400;
  cursor: pointer;
  display: block;
  width: 100%;
  padding: 0.75rem 1.5rem;
  clear: both;
  font-weight: 400;
  color: #212529;
  text-align: inherit;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
}
.bg-trans-gradient {
  background: linear-gradient(250deg, #3e93d6, #8a75aa);
}
.profile-image {
  width: 60px;
  height: 60px;
}
.color-white {
  color: #fff;
}
.info-card-text {
  font-size: 18px;
  display: inline-block;
  vertical-align: middle;
  font-weight: 500;
  line-height: 1.35;
}
.text-truncate-lg {
  max-width: 200px;
}
.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
.info-card-text{
  padding-left: 20px;
}
.info-card-text>span {
  font-size: 16px;
  display: block;
  font-weight: 300;
}
</style>