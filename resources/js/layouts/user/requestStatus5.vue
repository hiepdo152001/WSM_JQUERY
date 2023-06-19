<template>
  <div :class="{ 'd-none': check !== 'null' }" style="text-align: center">
    <h3 style="line-height: 50px">Không có dữ liệu</h3>
  </div>
  <div
    class="contacts"
    v-if="position === 'tld'"
    :class="{ 'd-none': check === 'null' }"
  >
    <table class="table table-bordered" style="margin-top: 30px">
      <thead>
        <tr>
          <th>Nội dung</th>
          <th>Người tạo</th>
          <th>Loại request</th>
          <th>Thời hạn</th>
          <th>Xử lí</th>
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
  API_GET_ASSETS_ID,
} from "../store/url";

export default {
  setup() {
    const contacts = ref([]);

    const position = ref([]);
    const headers = ApiService.setHeader();
    const check = ref();
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
        if (contacts.value.length === 0 || res.data.data.position !== "tld") {
          check.value = "null";
        }
        contacts.value.forEach(async (contact) => {
          const res = await ApiService.getParameter(
            API_USER_CREATE,
            contact.id,
            { headers }
          );
          contact.userCreate = res.data[0];
        });
        contacts.value.forEach(async (contact) => {
          if (contact.content === "device_recall") {
            const assetId = contact.assets_id;
            if (assetId !== null) {
              const assets = await ApiService.getParameter(
                API_GET_ASSETS_ID,
                assetId,
                {
                  headers,
                }
              );
              if (assets.data.length > 0) {
                contact = ApiService.changeContent(contact, assets.data[0]);
              }
            } else {
              contact = ApiService.changeContent(contact, null);
            }
          } else {
            contact = ApiService.changeContent(contact, null);
          }
        });
        contacts.value = ApiService.changeTypeRequest(contacts.value);
      } catch (error) {
        console.error(error);
      }
    });

    return {
      contacts,
      position,
      check,
    };
  },
};
</script>
