<template>
  
  <div class="container-fluid mt-3">
    <div class="row">
      <div class="col-sm-2 d-none d-sm-flex">
        <a-list bordered style="width: 100%">
          <TheMenu />
          <template #header>
            <div>BẢNG ĐIỀU KHIỂN</div>
          </template>
        </a-list>
      </div>

      <div class="col-12 col-sm-10" >
        <TheHeader />
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>
  <script>
  import TheMenu from "../layouts/TheMenu.vue";
  import TheHeader from "../layouts/TheHeader.vue";
  import { reactive,ref, onMounted } from 'vue';
	import axios from 'axios';
  export default {
    components: {
       TheHeader,
      TheMenu,
    },
  }
  </script>