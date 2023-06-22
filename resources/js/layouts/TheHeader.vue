<template>
  <div class="panels d-flex">
    <div class="col-sm-11">
      <form class="navbar-form navbar-left">
        <input type="text" class="form-control" placeholder="Search" />
      </form>
    </div>
    <div class="dropdown col-sm-1">
      <div class="btn custom-dropdown" type="button" data-toggle="dropdown">
        <img
          v-if="filename"
          class="profile-image rounded-circle"
          :src="filename"
          alt=""
        />
        <img
          v-else
          class="profile-image rounded-circle"
          src="../../../public/images/andanh.jpg"
          alt=""
        />
      </div>
      <ul class="dropdown-menu dropdown-menu-left">
        <div
          class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top"
        >
          <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
            <span class="mr-2">
              <img
                v-if="filename"
                class="profile-image rounded-circle"
                :src="filename"
                alt=""
              />
              <img
                v-else
                class="profile-image rounded-circle"
                src="../../../public/images/andanh.jpg"
                alt=""
              />
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
        <li>
          <router-link :to="{ name: 'user' }">
            <a class="dropdown-item">Profile</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'change-password-auth' }">
            <a class="dropdown-item">Đổi mật khẩu</a>
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: 'yeu-cau-cua-toi' }">
            <a class="dropdown-item">Danh sách yêu cầu</a>
          </router-link>
        </li>
        <li style="padding-left: 20px">
          <form>
            <form @submit.prevent="logout">
              <button type="submit" class="dropdown-item">Logout</button>
            </form>
          </form>
        </li>
      </ul>
    </div>
  </div>
</template>
<style>
.panels {
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
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
.ant-list-bordered {
  border: none !important;
}
.dropdown {
  float: right;
  margin-top: 8px;
}
.dropdown-menu {
  right: 63px !important;
  margin-top: 10px;
  left: unset !important;
}
.dropdown-item:hover,
.dropdown-item:focus {
  color: #6e4e9e;
  text-decoration: none;
  background-color: #f8f9fa;
}
</style>
<script>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import ApiService from "./common/apiService";
import { API_LOGOUT, APP_URL, API_MY_ACCOUNT } from "./store/url";
import jwtService from "./common/jwtService";
export default {
  setup() {
    const router = useRouter();
    const users = ref([]);
    const name = ref("");
    const email = ref("");
    const filename = ref("");
    const an = ref("");
    onMounted(async () => {
      try {
        const headers = ApiService.setHeader();
        const apiResponse = await ApiService.get(API_MY_ACCOUNT, { headers });
        users.value = apiResponse.data.data;
        name.value = users.value.name;
        email.value = users.value.email;
        if (users.value.avatar !== null) {
          filename.value = "../../../storage/" + users.value.avatar;
        } else {
          an.value = "an";
        }
      } catch (error) {
        console.error(error);
      }
    });

    const logout = async () => {
      let res = await ApiService.get(API_LOGOUT, "");
      if (res.data.status === true) {
        jwtService.destroyToken();
        window.location.href = APP_URL;
      }
    };
    return {
      logout,
      filename,
      name,
      email,
      an,
    };
  },
};
</script>
<style>
.dropdown-item {
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
.info-card-text {
  padding-left: 20px;
}
.info-card-text > span {
  font-size: 16px;
  display: block;
  font-weight: 300;
}
</style>
