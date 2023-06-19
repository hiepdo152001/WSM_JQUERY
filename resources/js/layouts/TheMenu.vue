<template>
  <a-menu
    v-model:openKeys="openKeys"
    v-model:selectedKeys="selectedKeys"
    mode="inline"
  >
    <a-menu-item key="lich-lam-viec">
      <router-link :to="{ name: 'lich-lam-viec' }">
        <i class="fal fa-window"></i>
        <span>Lịch làm việc</span>
      </router-link>
    </a-menu-item>

    <a-menu-item key="yeu-cau-cua-toi" :class="{ 'd-none': ad === 'ad' }">
      <router-link :to="{ name: 'yeu-cau-cua-toi' }">
        <span>Yêu cầu của tôi</span>
      </router-link>
    </a-menu-item>
    <a-menu-item key="member-request" :class="{ 'd-none': ad === 'ad' }">
      <router-link :to="{ name: 'member-request' }">
        <span>Yêu cầu cần duyệt</span>
      </router-link>
    </a-menu-item>
    <a-menu-item key="member" :class="{ 'd-none': ad !== 'ad' }">
      <router-link :to="{ name: 'member' }">
        <span>Quản lý User</span>
      </router-link>
    </a-menu-item>
    <a-menu-item key="department" :class="{ 'd-none': ad !== 'ad' }">
      <router-link :to="{ name: 'department' }">
        <span>Phòng ban</span>
      </router-link>
    </a-menu-item>
  </a-menu>
</template>
<script>
import { reactive, toRefs, onMounted, ref } from "vue";
import ApiService from "./common/apiService";
import { API_MY_ACCOUNT } from "./store/url";
export default {
  setup() {
    const state = reactive({
      selectedKeys: ["lich-lam-viec"],
      openKeys: [""],
    });
    const headers = ApiService.setHeader();
    const ad = ref("");
    onMounted(async () => {
      try {
        const res = await ApiService.get(API_MY_ACCOUNT, { headers });
        ad.value = res.data.data.position;
      } catch (error) {
        console.error(error);
      }
    });
    return {
      ...toRefs(state),
      ad,
    };
  },
};
</script>
<style>
.ant-list,
.ant-spin-nested-loading,
.ant-spin-container,
.ant-menu {
  background-color: #7656a7;
}
.ant-menu {
  border: none !important;
}
.ant-menu-item-selected {
  background-color: #330c6e !important;
}
.ant-menu-title-content span {
  color: white;
}
</style>
