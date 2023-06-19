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
