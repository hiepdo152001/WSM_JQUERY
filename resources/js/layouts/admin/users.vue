<template>
  <div class="col-md-11">
    <div class="panel-hdr">
      <h2>Tìm Kiếm</h2>
    </div>

    <form
      class="navbar-form navbar-left"
      @submit.prevent="SearchUser"
      enctype="multipart/form-data"
    >
      <div class="input-group">
        <input
          type="text"
          class="form-control"
          placeholder="Search"
          v-model="search.search"
        />
        <button class="btn btn-primary mt-2" type="submit">Tìm Kiếm</button>
      </div>
    </form>
  </div>
  <div class="col-md-1" style="margin-top: 95px">
    <button class="btn btn-primary" type="button" title="Từ chối">
      <router-link :to="{ name: 'register' }">
        <i class="bi bi-plus" style="color: white"></i>
      </router-link>
    </button>
  </div>
  <div class="contacts" style="margin: 20px">
    <user-component
      :users="users.data"
      @deleteUser="deletes"
      @activeUser="active"
    />
  </div>
  <div class="page">
    <Bootstrap5Pagination :data="users" @pagination-change-page="getUsers" />
  </div>
</template>

<script>
import { ref, onMounted, reactive } from "vue";
import ApiService from "../common/apiService";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
import UserComponent from "../../components/user.vue";
import { AllUser, API_DELETE_USER, DEPARTMENT_GETS } from "../store/url";
import { useRouter } from "vue-router";

export default {
  components: {
    Bootstrap5Pagination,
    UserComponent,
  },
  setup() {
    const users = ref([]);
    const search = reactive({
      search: "",
    });
    const pages = ref();
    const headers = ApiService.setHeader();
    const router = useRouter();
    const check = ref();
    onMounted(async () => {
      try {
        const res = await ApiService.get(AllUser, { headers });
        users.value = res.data[0];
        const departments = await ApiService.get(DEPARTMENT_GETS, { headers });
        users.value.data = ApiService.changeDepartment(
          users.value.data,
          departments.data[0]
        );
      } catch (error) {
        console.error(error);
      }
    });
    const SearchUser = async () => {
      try {
        const key = search.search;

        if (pages.value === undefined) {
          pages.value = 1;
        }
        const res = await ApiService.get(`${AllUser}?page=${pages.value}`, {
          params: { search: key },
          headers: headers,
        });

        users.value = res.data[0];
        const departments = await ApiService.get(DEPARTMENT_GETS, { headers });
        users.value.data = ApiService.changeDepartment(
          users.value.data,
          departments.data[0]
        );
      } catch (error) {
        if (error.response.status === 404) {
          active.value = "error";
        }
      }
    };
    const getUsers = async (page = 1) => {
      try {
        pages.value = page;
        const res = await ApiService.get(`${AllUser}?page=${page}`, {
          headers,
        });
        users.value = res.data[0];
        const departments = await ApiService.get(DEPARTMENT_GETS, { headers });
        users.value.data = ApiService.changeDepartment(
          users.value.data,
          departments.data[0]
        );
      } catch (error) {}
    };
    const deletes = async (id) => {
      try {
        const deActive = id + "/deActive";
        const res = await ApiService.putUser(API_DELETE_USER, deActive, "", {
          headers,
        });
        if (res.status === 202) {
          const user = res.data[0];
          users.value.data = ApiService.changeStatusUser(
            users.value.data,
            user
          );
        }
      } catch (error) {}
    };
    const active = async (id) => {
      try {
        const active = id + "/active";
        const res = await ApiService.putUser(API_DELETE_USER, active, "", {
          headers,
        });
        if (res.status === 202) {
          const user = res.data[0];
          users.value.data = ApiService.changeStatusUser(
            users.value.data,
            user
          );
        }
      } catch (error) {}
    };
    return {
      users,
      search,
      deletes,
      active,
      SearchUser,
      getUsers,
      router,
      check,
    };
  },
};
</script>
<style src="../../components/style.css"></style>
