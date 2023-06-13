<template>
  <div class="panel-hdr">
    <h2>Tìm Kiếm theo id</h2>
  </div>

  <form
    class="navbar-form navbar-left"
    @submit.prevent="SearchUser"
    enctype="multipart/form-data"
  >
    <div class="input-group">
      <input
        type="text"
        class="form-control"
        placeholder="Search"
        v-model="search.search"
      />
      <button class="btn btn-primary mt-2" type="submit">Tìm Kiếm</button>
    </div>
  </form>
  <div
    style="margin-top: 100px"
    class="alert alert-danger"
    :class="{ 'd-none': active !== 'error' }"
  >
    Không tồn tại user id
  </div>
  <div :class="{ 'd-none': active !== 'active' }">
    <div class="panel">
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
                  <label class="form-label">Số diện thoại</label>
                </div>
                <input
                  type="text"
                  class="form-control"
                  required
                  v-model="form.phone"
                />
              </div>
              <div class="col-md-6">
                <div class="form-gruop">
                  <label class="form-label">Project</label>
                </div>
                <input
                  class="form-control"
                  type="text"
                  required
                  v-model="form.project"
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
            <div class="form-group">
              <div class="col-md-6">
                <div class="form-gruop">
                  <label class="form-label">Số ngày phép</label>
                </div>
                <input
                  type="number"
                  class="form-control"
                  required
                  v-model="form.leave_days"
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
  </div>
</template>
<script>
import { ref, onMounted, reactive } from "vue";
import ApiService from "../common/apiService";
import {
  GET_USER,
  PATH_IMAGE,
  API_UPDATE_MEMBER,
  API_AVATAR,
} from "../store/url";

export default {
  setup() {
    const search = reactive({
      search: "",
    });
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
      leave_days: "",
    });
    const active = ref("");
    const user = ref([]);
    const filename = ref("");
    const fileInput = ref(null);
    const file = ref(null);
    const headers = ApiService.setHeader();

    const SearchUser = async () => {
      try {
        const id = search.search;
        const res = await ApiService.getParameter(GET_USER, id, { headers });
        if (res) {
          const { data } = res.data;

          user.value = data;
          filename.value = PATH_IMAGE + data.avatar;

          Object.assign(form, {
            sex: data.sex,
            department: data.department,
            position: data.position,
            age: data.age,
            permanent_address: data.permanent_address,
            temporary_address: data.temporary_address,
            cccd: data.cccd,
            date_range: data.date_range,
            issued_by: data.issued_by,
            tax_code: data.tax_code,
            phone: data.phone,
            project: data.project,
            leave_days: data.leave_days,
          });
          active.value = "active";
        }
      } catch (error) {
        if (error.response.status === 404) {
          active.value = "error";
        }
      }
    };

    const updateProfile = async () => {
      try {
        const id = search.search;

        let formData = new FormData();
        formData.append("image_data", file.value);

        const updateUser = await ApiService.putMember(
          API_UPDATE_MEMBER,
          id,
          form,
          {
            headers,
          }
        );

        if (updateUser != null) {
          alert("Update successful!");
        }
      } catch (error) {
        console.log(1);
      }
    };

    return {
      search,
      form,
      SearchUser,

      updateProfile,
      active,
      filename,
      fileInput,
    };
  },
};
</script>
