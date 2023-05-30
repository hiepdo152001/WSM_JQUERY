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
                v-model="form.department"
              >
                <option selected="selected" value="d1">Division 1</option>
                <option value="d1">Division 1</option>
                <option value="d2">Division 2</option>
                <option value="d3">Division 3</option>
                <option value="d4">Division 4</option>
              </select>
            </div>
            <div class="col-md-2">
              <div class="form-gruop">
                <label class="form-label">Vị trí</label>
              </div>
              <select
                class="form-control"
                aria-label="Default select example"
                v-model="form.position"
              >
                <option selected="selected" value="ceo">CEO</option>
                <option value="dl">Division Leader</option>
                <option value="sgl">Support Group Leader</option>
                <option value="tl">Technical Leader</option>
                <option value="vdl">Vice Division Leader</option>
                <option value="tld">Team Leader</option>
                <option value="dev">Developer</option>
                <option value="comtor">Comtor</option>
                <option value="tester">Tester</option>
                <option value="hr">Human Resources</option>
                <option value="acc">Accountant</option>
                <option value="ad">Admin</option>
                <option value="incom">Internal Communication</option>
                <option value="intern">Intern</option>
                <option value="fl">Freelancer</option>
              </select>
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
} from "../store/url";

export default {
  setup() {
    const headers = ApiService.setHeader();
    const user = ref([]);
    const file = ref(null);
    const fileInput = ref(null);
    const filename = ref("");
    const form = reactive({
      sex: "",
      department: "",
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

        user.value = res.data.data;
        form.sex = user.value.sex;
        form.department = user.value.department;
        form.position = user.value.position;
        form.age = user.value.age;
        form.permanent_address = user.value.permanent_address;
        form.temporary_address = user.value.temporary_address;
        form.cccd = user.value.cccd;
        form.date_range = user.value.date_range;
        form.issued_by = user.value.issued_by;
        form.tax_code = user.value.tax_code;
        filename.value = PATH_IMAGE + user.value.avatar;
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
