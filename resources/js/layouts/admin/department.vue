<template>
  <div class="col-md-11">
    <h2>Phòng ban</h2>
  </div>
  <div class="col-md-1" style="margin-top: 0px">
    <button class="btn btn-primary" type="button">
      <router-link :to="{ name: 'department-new' }">
        <i class="bi bi-plus" style="color: white"></i>
      </router-link>
    </button>
  </div>

  <div class="contacts" style="margin: 20px">
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Id</th>
          <th>Tên phòng ban</th>
          <th>Xử lý</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="department in departments" class="contact-row">
          <td>{{ department.id }}</td>
          <td>{{ department.name }}</td>
          <td>
            <button
              class="btn"
              type="button"
              data-toggle="tooltip"
              data-placement="top"
              title="Edit"
            >
              <router-link
                :to="{ name: 'edit-department', params: { id: department.id } }"
              >
                <i class="bi bi-pencil-fill" style="color: black"></i>
              </router-link>
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
import { DEPARTMENT_GETS } from "../store/url";
import { useRouter } from "vue-router";

export default {
  setup() {
    const departments = ref([]);
    const headers = ApiService.setHeader();
    const router = useRouter();
    const check = ref();
    onMounted(async () => {
      try {
        const res = await ApiService.get(DEPARTMENT_GETS, { headers });

        departments.value = res.data[0];
      } catch (error) {
        console.error(error);
      }
    });

    return {
      departments,
      router,
      check,
    };
  },
};
</script>
<style src="../../components/style.css"></style>
