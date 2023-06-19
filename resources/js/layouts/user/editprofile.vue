<template>
  <div class="panel">
    <div class="panel-hdr">
      <h2>Cập nhật profile</h2>
    </div>
    <div class="panel-container">
      <div class="panel-content">
        <form
          class="form-horizontal"
          @submit.prevent="updateProfile"
          enctype="multipart/form-data"
        >
          <div class="form-group">
            <div class="col-md-12">
              <label class="form-label">
                <span class="translation_missing">Avatar</span>
              </label>
            </div>
            <div class="form-row">
              <div class="col-sm-6">
                <img
                  :src="filename"
                  alt="Avatar Image"
                  style="width: 250px; height: auto; margin-bottom: 20px"
                />
                <br />
                <input type="file" ref="fileInput" @change="handleFileUpload" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-4">
              <div>
                <label class="form-label">Giới tính</label>
              </div>
              <div class="frame-wrap d-flex">
                <div class="form-check" style="margin-right: 20px">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault1"
                    v-model="form.sex"
                    value="Nam"
                  />
                  <label class="form-check-label" for="flexRadioDefault1"
                    >Nam</label
                  >
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="flexRadioDefault"
                    id="flexRadioDefault2"
                    v-model="form.sex"
                    value="Nữ"
                  />
                  <label class="form-check-label" for="flexRadioDefault2"
                    >Nữ
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-2">
              <div class="form-gruop">
                <label class="form-label">Bộ phận</label>
              </div>
              <select
                class="form-control"
                aria-label="Default select example"
                v-model="form.department_id"
                readonly="readonly"
              >
                <option
                  v-for="option in departments"
                  :value="option.id"
                  disabled
                >
                  {{ option.name }}
                </option>
              </select>
            </div>
            <div class="col-md-2">
              <div class="form-gruop">
                <label class="form-label">Vị trí</label>
              </div>
              <input
                type="text"
                class="form-control"
                v-model="form.position"
                readonly="readonly"
              />
            </div>
            <div class="col-md-4">
              <div class="form-gruop">
                <label class="form-label">Ngày sinh</label>
              </div>
              <input
                class="form-control datetimepicker"
                type="date"
                required
                v-model="form.age"
              />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Địa chỉ thường trú</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.permanent_address"
              />
            </div>
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Địa chỉ tạm trú</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.temporary_address"
              />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Số CCCD</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.cccd"
              />
            </div>
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Ngày cấp</label>
              </div>
              <input
                class="form-control datetimepicker"
                type="date"
                required
                v-model="form.date_range"
              />
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Nơi cấp</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.issued_by"
              />
            </div>
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Mã số thuế</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.tax_code"
              />
            </div>
          </div>
          <div>
            <button
              type="submit"
              class="btn btn-success waves-effect waves-themed"
              style=""
            >
              <i class="fal fa-save"></i>
              Lưu
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted, reactive } from "vue";
import ApiService from "../common/apiService";
import {
  API_MY_ACCOUNT,
  API_AVATAR,
  API_UPDATE_ACCOUNT,
  PATH_IMAGE,
  PROFILE,
  DEPARTMENT_GETS,
} from "../store/url";

export default {
  setup() {
    const headers = ApiService.setHeader();
    const user = ref([]);
    const file = ref(null);
    const fileInput = ref(null);
    const filename = ref("");
    const departments = ref([]);
    const form = reactive({
      sex: "",
      department_id: "",
      position: "",
      age: "",
      permanent_address: "",
      temporary_address: "",
      cccd: "",
      date_range: "",
      issued_by: "",
      tax_code: "",
    });
    const handleFileUpload = (event) => {
      file.value = event.target.files[0];
      if (fileInput.value.files && fileInput.value.files[0]) {
        const reader = new FileReader();

        reader.onload = (e) => {
          filename.value = e.target.result;
        };

        reader.readAsDataURL(fileInput.value.files[0]);
      }
    };

    onMounted(async () => {
      try {
        const headers = ApiService.setHeader();
        const res = await ApiService.get(API_MY_ACCOUNT, { headers });
        const response = await ApiService.get(DEPARTMENT_GETS, { headers });
        departments.value = response.data[0];
        const { data } = res.data;

        user.value = data;
        filename.value = PATH_IMAGE + data.avatar;

        Object.assign(form, {
          sex: data.sex,
          department_id: data.department_id,
          position: data.position,
          age: data.age.substring(0, 10),
          permanent_address: data.permanent_address,
          temporary_address: data.temporary_address,
          cccd: data.cccd,
          date_range: data.date_range.substring(0, 10),
          issued_by: data.issued_by,
          tax_code: data.tax_code,
        });
      } catch (error) {
        console.error(error);
      }
    });

    const updateProfile = async () => {
      try {
        if (file.value === null) {
          const updateUser = await ApiService.putAvatar(
            API_UPDATE_ACCOUNT,
            form,
            { headers }
          );
          if (updateUser != null) {
            alert("Update successful!");
            window.location.href = PROFILE;
          }
        }
        let formData = new FormData();
        formData.append("image_data", file.value);
        const res = await ApiService.postAuth(API_AVATAR, formData, {
          headers,
        });
        const updateUser = await ApiService.putAvatar(
          API_UPDATE_ACCOUNT,
          form,
          {
            headers,
          }
        );
        if (res != null && updateUser != null) {
          alert("Update successful!");
          window.location.href = PROFILE;
        }
      } catch (error) {
        console.error(error);
      }
    };
    return {
      form,
      updateProfile,
      handleFileUpload,
      fileInput,
      filename,
      departments,
    };
  },
};
</script>
<style>
.panel {
  border: 1px solid gray;
}
.panel-hdr {
  border-bottom: 1px solid gray;
}
.panel,
.panel-container,
.panel-content:last-child {
  border-radius: 4px;
}
.panel-content {
  padding-left: 5px;
  padding-right: 5px;
}
.panel,
.panel-container,
.panel-content {
  padding: 10px 10px;
}
</style>
