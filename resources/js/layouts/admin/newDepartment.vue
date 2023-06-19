<template>
  <div class="panel">
    <div class="panel-hdr">
      <h2>Tạo mới phòng ban</h2>
    </div>
    <div class="panel-container">
      <div class="panel-content">
        <form @submit.prevent="register">
          <div class="form-group col-md-3">
            <label for="name">Name</label>
            <input class="form-control" required />
          </div>
          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
      <div class="alert alert-danger" v-if="checkName">
        {{ checkName }}
      </div>
    </div>
  </div>
</template>
<script>
import { reactive, ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import ApiService from "../common/apiService";
import { DEPARTMENT_NEW, DEPARTMENT } from "../store/url";

export default {
  setup() {
    const errors = ref([]);
    const checkName = ref("");

    const form = reactive({
      name: "",
    });
    const headers = ApiService.setHeader();
    const register = async () => {
      try {
        let res = await ApiService.postAuth(DEPARTMENT_NEW, form, { headers });
        if (res.status === 200) {
          window.location.href = DEPARTMENT;
        }
      } catch (error) {
        if (error.response.status === 422) {
          checkName.value = error.response.data.error.name[0];
        }
      }
    };
    return {
      form,
      register,
      errors,
      checkName,
    };
  },
};
</script>
