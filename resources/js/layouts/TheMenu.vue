<template>
  <a-menu
  v-model:openKeys="openKeys"
  v-model:selectedKeys="selectedKeys"
  mode="inline"
> 

  <a-menu-item key="lich-lam-viec">
   <router-link :to="{name: 'lich-lam-viec'}">
    <span>lich lam viec</span>
   </router-link>
  </a-menu-item>
  <a-sub-menu key="menu-request" >
    <template #icon>
      <MailOutlined />
    </template>
    <template #title>Cac yeu cau</template>
    <a-menu-item key="yeu-cau-cua-toi">
      <router-link :to="{name: 'yeu-cau-cua-toi'}">
       <span>Yeu cau cua toi</span>
      </router-link>
     </a-menu-item>
    <a-menu-item key="member-request">
      <router-link :to="{name: 'member-request'}">
       <span>Yeu cau can duyet</span>
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
 