<template>
  <div class="contacts" v-if="position === 'tld'">
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Nội dung</th>
          <th>Người tạo</th>
          <th>Loại request</th>
          <th>Thời hạn</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id" class="contact-row">
          <td>{{ contact.contents }}</td>
          <td>{{ contact.userCreate }}</td>
          <td>{{ contact.type }}</td>
          <td>{{ contact.time_start }} -> {{ contact.time_end }}</td>
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
  API_REQUEST_STATUS,
  API_USER_CREATE,
  API_MY_ACCOUNT,
  API_REQUEST_UPDATE,
} from "../store/url";

export default {
  setup() {
    const contacts = ref([]);
    const form = reactive({
      status: 2,
    });
    const position = ref([]);
    const headers = ApiService.setHeader();
    onMounted(async () => {
      try {
        const type = ApiService.getTypeParameter();

        const res = await ApiService.get(API_MY_ACCOUNT, { headers });
        position.value = res.data.data.position;
        const apiResponse = await ApiService.getParameter(
          API_REQUEST_STATUS,
          type,
          { headers }
        );

        contacts.value = apiResponse.data.data;
        contacts.value.forEach(async (contact) => {
          const res = await ApiService.getParameter(
            API_USER_CREATE,
            contact.id,
            { headers }
          );
          contact.userCreate = res.data[0];
        });

        contacts.value = ApiService.changeContent(contacts.value);
        contacts.value = ApiService.changeTypeRequest(contacts.value);
      } catch (error) {
        console.error(error);
      }
    });

    return {
      contacts,
      position,
    };
  },
};
</script>
