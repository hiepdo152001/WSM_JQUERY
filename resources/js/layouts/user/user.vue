<template>
  <div>
    <div>
      <div class="panel-hdr">
        <h2 class="text-center">Thông tin cá nhân</h2>
      </div>
      <div class="col-6">
        <router-link :to="{ name: 'edit-profile' }">
          <button
            class="btn btn-primary btn-sm waves-effect waves-themed"
            style="margin: 15px 0px 0px 15px"
          >
            <i class="bi bi-pencil"></i>
          </button>
        </router-link>
      </div>
    </div>
  </div>
  <div class="d-flex mt-4">
    <div class="col-md-6">
      <div class="panel-hdr">
        <h2 class="text-center">Thông tin nhân viên</h2>
      </div>

      <!-- <img :src="filename" alt="Avatar Image">
        <input type="file" class="form-control" id="customFile" /> -->
      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr v-for="(value, key) in users" :key="key">
            <td
              v-if="
                key !== 'created_at' &&
                key !== 'updated_at' &&
                key !== 'use_property' &&
                key !== 'avatar'
              "
              :key="key"
            >
              <strong>{{ key }}</strong>
            </td>
            <td
              v-if="
                key !== 'created_at' &&
                key !== 'updated_at' &&
                key !== 'use_property' &&
                key !== 'avatar'
              "
              :key="key"
            >
              {{ value }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-6">
      <div class="panel-hdr">
        <h2 class="text-center">Tài sản đang sử dụng</h2>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <tbody>
          <tr v-for="item in asset[0]" :key="item.id">
            <td>
              <strong>{{ item.name }}- {{ item.code }}</strong>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import ApiService from "../common/apiService";
import { API_MY_ACCOUNT, PATH_IMAGE, API_GET_ASSETS } from "../store/url";
export default {
  setup() {
    const users = ref([]);
    const asset = ref([]);
    const filename = ref("");
    onMounted(async () => {
      try {
        const headers = ApiService.setHeader();
        const apiResponse = await ApiService.get(API_MY_ACCOUNT, { headers });
        const assets = await ApiService.get(API_GET_ASSETS, { headers });
        console.log(assets);
        users.value = apiResponse.data.data;
        asset.value = assets.data;

        filename.value = PATH_IMAGE + users.value.avatar;
      } catch (error) {
        console.error(error);
      }
    });
    return {
      users,
      filename,
      asset,
    };
  },
};
</script>
<style>
.table-bordered {
  border: 1px solid #e9e9e9;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
}
.table-hover tbody tr:hover {
  color: #212529;
  background-color: #fdfdfd;
}
.table-hover tbody tr:hover {
  box-shadow: inset 1px 0 0 #dadce0, inset -1px 0 0 #dadce0,
    0 1px 2px 0 rgba(60, 64, 67, 0.3), 0 1px 3px 1px rgba(60, 64, 67, 0.15);
  z-index: 1;
}
</style>
