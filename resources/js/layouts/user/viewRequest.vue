<template>
  <div class="panel">
    <div class="panel-hdr" style="padding: 15px 10px 5px 10px">
      <h2 class="title">Chi tiết yêu cầu</h2>
    </div>

    <div class="panel-container">
      <div class="panel-content">
        <table class="table table-bordered" style="margin-top: 30px">
          <tbody>
            <tr>
              <td scope="row">Nội dung</td>
              <td>{{ contact.contents }}</td>
            </tr>
            <tr>
              <td scope="row">Trạng thái</td>
              <td>
                <div
                  class="stt"
                  v-if="contact.color"
                  v-bind:style="{ backgroundColor: contact.color }"
                >
                  {{ contact.statuses }}
                </div>
              </td>
            </tr>
            <tr>
              <td scope="row">Thời hạn</td>
              <td>{{ contact.time_start }} {{ contact.time_end }}</td>
            </tr>
            <tr>
              <td scope="row">Số Điện Thoại</td>
              <td>{{ contact.phone }}</td>
            </tr>
            <tr>
              <td scope="row">Dự án</td>
              <td>{{ contact.project }}</td>
            </tr>
            <tr>
              <td scope="row">Lý do</td>
              <td>{{ contact.reason }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import ApiService from "../common/apiService";
import { useRouter } from "vue-router";
import { GET_REQUEST, REQUEST } from "../store/url";

export default {
  setup() {
    const router = useRouter();
    const contact = ref([]);
    const headers = ApiService.setHeader();
    onMounted(async () => {
      try {
        const id = router.currentRoute.value.params.id;
        const res = await ApiService.getParameter(GET_REQUEST, id, {
          headers,
        });

        res.data = ApiService.changeStatus(res.data);
        res.data = ApiService.changeContent(res.data);
        contact.value = res.data[0];
      } catch (error) {
        console.error(error);
      }
    });

    return {
      contact,
    };
  },
};
</script>

<style>
.stt {
  border-radius: 20px;
  width: 16%;
  padding: 4px 0;
  text-align: center;
  font-weight: 600;
}
.page-content .panel {
  margin-bottom: 1.5rem;
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
.panel-hdr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  justify-content: space-between;

  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  background: #fff;
  min-height: 3rem;
  border-bottom: 1px solid rgba(0, 0, 0, 0.07);
  border-radius: 4px 4px 0 0;
  -webkit-transition: background-color 0.4s ease-out;
  transition: background-color 0.4s ease-out;
}
.panel .panel-container {
  position: relative;
  border-radius: 0 0 4px 4px;
}

.panel .panel-container .panel-content:only-child,
.panel .panel-container .panel-content:last-child {
  border-radius: 0 0 4px 4px;
}
.panel-hdr > :first-child {
  padding-left: 1rem;
}
.table {
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

th {
  text-align: left;
  font-weight: bold;
  padding: 10px;
}

td {
  text-align: left !important;
  padding: 15px !important;
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
.btn-primary:hover {
  background-color: #7453a6;
  border-color: #6e4e9e;
}
</style>
