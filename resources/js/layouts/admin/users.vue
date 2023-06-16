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
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Id</th>
          <th>Tên</th>
          <th>Email</th>
          <th>Phòng ban</th>
          <th>Chức vụ</th>
          <th>Trạng thái</th>
          <th>Xử lý</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users" class="contact-row">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>{{ user.department }}</td>
          <td>{{ user.position }}</td>
          <td>{{ user.status }}</td>
          <td>
            <button
              class="btn"
              type="button"
              data-toggle="tooltip"
              data-placement="top"
              title="View"
            >
              <router-link :to="{ name: 'user-view', params: { id: user.id } }">
                <i class="bi bi-eye-fill" style="color: black !important"></i>
              </router-link>
            </button>
            <button
              :class="{ 'd-none': user.status === 'deActive' }"
              class="btn"
              type="button"
              @click="deletes(user.id)"
              data-toggle="tooltip"
              data-placement="top"
              title="delete"
            >
              <i class="bi bi-trash-fill"></i>
            </button>
            <button
              v-if="user.status === 'deActive'"
              class="btn"
              type="button"
              @click="active(user.id)"
              data-toggle="tooltip"
              data-placement="top"
              title="active"
            >
              <i class="bi bi-key"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { ref, onMounted, reactive } from "vue";
import ApiService from "../common/apiService";
import {
  AllUser,
  SEARCH,
  API_DELETE_USER,
  API_ACTIVE_USER,
  DEPARTMENT_GETS,
} from "../store/url";
import { useRouter } from "vue-router";

export default {
  setup() {
    const users = ref([]);
    const search = reactive({
      search: "",
    });
    const headers = ApiService.setHeader();
    const router = useRouter();
    const check = ref();
    onMounted(async () => {
      try {
        const res = await ApiService.get(AllUser, { headers });
        users.value = res.data[0];
        const departments = await ApiService.get(DEPARTMENT_GETS, { headers });
        users.value = ApiService.changeDepartment(
          users.value,
          departments.data[0]
        );
      } catch (error) {
        console.error(error);
      }
    });
    const SearchUser = async () => {
      try {
        const key = search.search;
        const res = await ApiService.getParameter(SEARCH, key, { headers });
        users.value = res.data[0];
        const departments = await ApiService.get(DEPARTMENT_GETS, { headers });
        users.value = ApiService.changeDepartment(
          users.value,
          departments.data[0]
        );
      } catch (error) {
        if (error.response.status === 404) {
          active.value = "error";
        }
      }
    };

    const deletes = async (id) => {
      try {
        const res = await ApiService.delete(API_DELETE_USER, id, {
          headers,
        });

        if (res.status === 202) {
          const user = res.data[0];
          users.value = ApiService.changeStatusUser(users.value, user);
        }
      } catch (error) {}
    };
    const active = async (id) => {
      try {
        const res = await ApiService.put(API_ACTIVE_USER, id, {
          headers,
        });
        if (res.status === 202) {
          const user = res.data[0];
          users.value = ApiService.changeStatusUser(users.value, user);
        }
      } catch (error) {}
    };
    return {
      users,
      search,
      deletes,
      active,
      SearchUser,
      router,
      check,
    };
  },
};
</script>
<style>
.bi-eye-fil {
  color: black;
}
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.panel .panel-container {
  position: relative;
  border-radius: 0 0 4px 4px;
}
.panel .panel-container .panel-content {
  padding: 1rem 1rem;
}
.nav-tabs-clean {
  height: 45px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}
.nav-tabs .nav-item {
  margin-bottom: -1px;
}
span {
  font-weight: 500;
  font-size: 16px;
  color: black;
}
.table {
  margin-top: 30px;
  width: 100%;
  border-collapse: collapse;
}
.panel .panel-container .panel-content {
  padding: 0px 10px;
}
.contacts {
  margin: 20px;
}

.title {
  font-size: 24px;
  margin-bottom: 10px;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.contact-row {
  border-bottom: 1px solid #ccc;
}

.contact-row:hover {
  background-color: #f5f5f5;
}

th {
  font-size: 18px;
  text-align: center;
  font-weight: 700;
  padding: 10px;
  background-color: #f0f0f0;
}

td {
  text-align: center;
  font-weight: 600;
}

.status-processing {
  color: #ff9800;
}

.status-completed {
  color: #4caf50;
}

.status-pending {
  color: #2196f3;
}
</style>
