<template>
  <div id="app">
    <div class="login-page">
      <div class="wallpaper-register"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
            <div class="card login" v-if="!registerActive">
              <form @submit.prevent="login">
                <div class="form-group">
                  <label class="form-label" for="email">Email</label>
                  <input
                    type="email"
                    class="form-control"
                    v-model="formlogin.email"
                    required
                  />
                </div>
                <div class="form-group">
                  <label class="form-label" for="password">Password</label>
                  <input
                    type="password"
                    class="form-control"
                    v-model="formlogin.password"
                    required
                  />
                </div>
                <div class="alert alert-danger" v-if="check">
                  {{ check }}
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">
                    Đăng nhập
                  </button>
                </div>
              </form>
              <div class="mt-4" style="border: 1px solid gray"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, ref } from "vue";
import ApiService from "./common/apiService";
import { API_LOGIN, APP_URL, API_REGISTER, HOME_CALENDAR } from "./store/url";
import jwtService from "./common/jwtService";

export default {
  setup() {
    const registerActive = ref(false);
    const errors = ref([]);
    const check = ref("");
    const errorregis = ref([]);
    const checkEmail = ref("");
    const checkPassword = ref("");
    const formregis = reactive({
      name: "",
      email: "",
      password: "",
    });
    const formlogin = reactive({
      email: "admin@gmail.com",
      password: "12345678",
    });
    const login = async () => {
      try {
        let res = await ApiService.post(API_LOGIN, formlogin);
        if (res.data.status === true) {
          jwtService.setToken(JSON.stringify(res.data.token));
          window.location.href = HOME_CALENDAR;
          alert(res.data.message);
        }
      } catch (error) {
        if (error.response.status === 401) {
          for (const key in error.response.data) {
            errors.value = error.response.data;
          }
          check.value = errors.value.message;
        }
      }
    };
    const register = async () => {
      try {
        let res = await ApiService.post(API_REGISTER, formregis);
        if (res.data.status === true) {
          alert(res.data.message);
          window.location.href = APP_URL;
        }
      } catch (error) {
        if (error.response.status === 422) {
          checkEmail.value = "";
          checkPassword.value = "";
          for (const key in error.response.data.error) {
            errorregis.value = error.response.data.error;
          }
          if (errorregis.value.hasOwnProperty("email"))
            checkEmail.value = errorregis.value.email[0];
        }
        if (errorregis.value.hasOwnProperty("password")) {
          checkPassword.value = errorregis.value.password[0];
        }
      }
    };
    return {
      login,
      formlogin,
      register,
      formregis,
      errorregis,
      check,
      registerActive,
      checkEmail,
      checkPassword,
    };
  },
};
</script>
<style>
p {
  line-height: 1rem;
}

.card {
  padding: 20px;
}
.register {
  margin: auto;
  margin-top: 20px;
}

input {
  margin-bottom: 20px;
  padding: 25px 10px !important;
}

.login-page {
  align-items: center;
  display: flex;
  height: 100vh;
}
h1 {
  margin-bottom: 20px;
}

.error {
  animation-name: errorShake;
  animation-duration: 0.3s;
}

@keyframes errorShake {
  0% {
    transform: translateX(-25px);
  }
  25% {
    transform: translateX(25px);
  }
  50% {
    transform: translateX(-25px);
  }
  75% {
    transform: translateX(25px);
  }
  100% {
    transform: translateX(0);
  }
}
</style>
