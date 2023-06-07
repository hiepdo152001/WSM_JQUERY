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
            <button
              class="btn btn-primary"
              type="button"
              @click="confirm(contact.id)"
              data-toggle="tooltip"
              data-placement="top"
              title="Xác nhận"
              style="margin-right: 30px"
            >
              Xác nhận
            </button>
            <button
              class="btn btn-primary"
              type="button"
              @click="cancel(contact.id)"
              data-toggle="tooltip"
              data-placement="top"
              title="Từ chối"
            >
              Từ chối
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
import { useRouter } from "vue-router";

export default {
  setup() {
    const contacts = ref([]);
    const form = reactive({
      status: 2,
    });

    const position = ref([]);
    const headers = ApiService.setHeader();
    const router = useRouter();

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
    const confirm = async (id) => {
      try {
        const res = await ApiService.putStatus(API_REQUEST_UPDATE, id, form, {
          headers,
        });
        if (res.data.status === true) {
          alert("Xác nhận thành công!");
        }
      } catch (error) {}
    };
    const cancel = async (id) => {
      try {
        form.status = 4;
        const res = await ApiService.putStatus(API_REQUEST_UPDATE, id, form, {
          headers,
        });
        if (res.data.status === true) {
          alert("Bạn đã từ chối yêu cầu !");
        }
      } catch (error) {}
    };
    return {
      contacts,
      confirm,
      position,
      cancel,
      router,
    };
  },
};
</script>
