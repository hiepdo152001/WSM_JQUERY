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
      <TheHeader />
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id" class="contact-row">
          <td>{{ contact.contents }}</td>
          <td>{{ contact.user_name }}</td>
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
  API_GET_ASSETS_ID,
} from "../store/url";
import { useRouter } from "vue-router";
import TheHeader from "../../components/headerRequest.vue";
export default {
  components: {
    TheHeader,
  },
  setup() {
    const contacts = ref([]);
    const form = reactive({
      status: 2,
    });

    const position = ref([]);
    const headers = ApiService.setHeader();
    const router = useRouter();
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
    const confirm = async (id) => {
      try {
        const res = await ApiService.putStatus(API_REQUEST_UPDATE, id, form, {
          headers,
        });
        if (res.status === 200) {
          alert("Xác nhận thành công!");
          location.reload();
        }
      } catch (error) {}
    };
    const cancel = async (id) => {
      try {
        form.status = 4;
        const res = await ApiService.putStatus(API_REQUEST_UPDATE, id, form, {
          headers,
        });
        if (res.status === 200) {
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
      check,
    };
  },
};
</script>
