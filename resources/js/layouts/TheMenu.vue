<template>
  <a-menu
  v-model:openKeys="openKeys"
  v-model:selectedKeys="selectedKeys"
  mode="inline"
> 

  <a-menu-item key="lich-lam-viec">
   <router-link :to="{name: 'lich-lam-viec'}">
    <i class="fal fa-window"></i>
    <span>Lịch làm việc</span>
   </router-link>
  </a-menu-item>
  <a-sub-menu key="menu-request" >
    <template #icon>
      <MailOutlined />
    </template>
    <template #title>
      <i class="fal fa-share-square"></i>
      Các yêu cầu</template>
    <a-menu-item key="yeu-cau-cua-toi">
      <router-link :to="{name: 'yeu-cau-cua-toi'}">
       <span>Yêu cầu của tôi</span>
      </router-link>
     </a-menu-item>
    <a-menu-item key="member-request">
      <router-link :to="{name: 'member-request'}">
       <span>Yêu cầu cần duyệt</span>
      </router-link>
     </a-menu-item>
    
  </a-sub-menu>
  
  </a-menu>
  </template>
  <script>
import { defineComponent, reactive, toRefs } from 'vue';
export default defineComponent({
 
  setup() {
    const state = reactive({
      selectedKeys: ['lich-lam-viec'],
      openKeys: [''],
     
    });
 
    return {
      ...toRefs(state),
     
    };
  },
});
</script>

 