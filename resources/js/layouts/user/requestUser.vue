<template>
  <div class="panel">
    <div class="panel-hdr">
      <h2 class="title" style="padding-top: 10px">Yêu cầu của tôi</h2>
      <div>
        <h2 style="padding: 10px 20px 0px 0px">
          Số ngày phép còn lại: {{ user.leave_days }}
        </h2>
      </div>
    </div>

    <div class="panel-container">
      <div class="panel-content">
        <router-link :to="{ name: 'new-request' }">
          <button class="btn btn-primary btn-sm waves-effect waves-themed">
            + Thêm yêu cầu
          </button>
        </router-link>
      </div>
      <div class="panel-content">
        <table class="table table-bordered" style="margin-top: 30px">
          <thead>
            <tr>
              <th>Nội dung</th>
              <th>Trạng thái</th>
              <th>Người xử lí</th>
              <th>Thời hạn</th>
              <th>Xử lí</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="contact in contacts"
              :key="contact.id"
              class="contact-row"
            >
              <td>{{ contact.contents }}</td>
              <td>
                <div
                  class="status"
                  v-if="contact.color"
                  v-bind:style="{ backgroundColor: contact.color }"
                >
                  {{ contact.statuses }}
                </div>
              </td>
              <td>{{ contact.assignee }}</td>
              <td>{{ contact.deadline }}</td>
              <td>
                <button
                  class="btn"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="View"
                >
                  <router-link
                    :to="{ name: 'view-request', params: { id: contact.id } }"
                  >
                    <i class="bi bi-eye-fill"></i>
                  </router-link>
                </button>

                <button
                  class="btn"
                  @click="deleteContacts(contact.id)"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Delete"
                >
                  <i class="bi bi-trash-fill"></i>
                </button>
              </td>
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
import {
  API_REQUEST,
  API_USER_MNG,
  API_MY_ACCOUNT,
  API_REQUEST_DELETE,
  REQUEST,
} from "../store/url";

export default {
  setup() {
    const contacts = ref([]);
    const headers = ApiService.setHeader();
    const user = ref([]);
    onMounted(async () => {
      try {
        const apiResponse = await ApiService.get(API_REQUEST, { headers });
        contacts.value = apiResponse.data.data;
        const res = await ApiService.get(API_MY_ACCOUNT, { headers });
        user.value = res.data.data;
        const userMng = await ApiService.get(API_USER_MNG, { headers });
        const assignee = userMng.data.name;
        ApiService.setDeadline(contacts, assignee);
        contacts.value = ApiService.changeContent(contacts.value);
        contacts.value = ApiService.changeStatus(contacts.value);
      } catch (error) {
        console.error(error);
      }
    });

    const deleteContacts = async (id) => {
      try {
        if (confirm("Do you really want to delete?")) {
          const res = ApiService.delete(API_REQUEST_DELETE, id, { headers });
          window.location.href = REQUEST;
        }
      } catch (error) {
        console.error(error);
      }
    };
    return {
      contacts,
      deleteContacts,
      user,
    };
  },
};
</script>

<style>
.status {
  border-radius: 15px;
  width: 75%;
  margin: auto;
  padding: 4px 0px;
  text-align: center;
  font-weight: 600;
}
.bi {
  color: black;
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
.panel-container {
  margin-top: 30px;
}
.panel .panel-container .panel-content:only-child,
.panel .panel-container .panel-content:last-child {
  border-radius: 0 0 4px 4px;
}
.panel-hdr > :first-child {
  padding-left: 1rem;
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
.btn-primary:hover {
  background-color: #7453a6;
  border-color: #6e4e9e;
}
</style>
