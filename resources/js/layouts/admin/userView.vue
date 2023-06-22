<template>
  <div class="col-sm-12">
    <div class="panel">
      <div class="panel-container">
        <div class="panel-content">
          <form
            class="form-horizontal"
            @submit.prevent="updateProfile"
            enctype="multipart/form-data"
            style="padding: 20px 0px 20px 20px"
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
                    v-if="filename"
                    class="profile-image rounded-circle"
                    :src="filename"
                    alt=""
                  />
                  <img
                    v-else
                    class="profile-image rounded-circle"
                    src="../../../../public/images/andanh.jpg"
                    alt=""
                  />
                  <br />
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-4">
                <div>
                  <label class="form-label">Tên</label>
                </div>
                <div class="frame-wrap d-flex">
                  <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault2"
                      >{{ user.name }}
                    </label>
                  </div>
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
                >
                  <option v-for="option in departments" :value="option.id">
                    {{ option.name }}
                  </option>
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
            <div style="padding-bottom: 40px">
              <div class="col-md-1">
                <button
                  type="submit"
                  class="btn btn-success waves-effect waves-themed"
                  style=""
                >
                  <i class="fal fa-save"></i>
                  Lưu
                </button>
              </div>
              <div class="col-md-3">
                <button
                  class="btn btn-success waves-effect waves-themed"
                  type="button"
                  data-toggle="tooltip"
                  data-placement="top"
                  v-if="user.id"
                >
                  <router-link
                    :to="{ name: 'asset-user', params: { id: user.id } }"
                  >
                    <span style="color: white">Thêm tài sản sử dụng</span>
                  </router-link>
                </button>
              </div>
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
import { GET_USER, API_UPDATE_MEMBER, DEPARTMENT_GETS } from "../store/url";
import { useRouter } from "vue-router";
export default {
  setup() {
    const search = reactive({
      search: "",
    });
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
      leave_days: "",
    });

    const user = ref([]);
    const filename = ref("");
    const fileInput = ref(null);
    const file = ref(null);
    const headers = ApiService.setHeader();
    const router = useRouter();
    const departments = ref([]);
    onMounted(async () => {
      try {
        const id = router.currentRoute.value.params.id;
        const res = await ApiService.getParameter(GET_USER, id, { headers });
        const response = await ApiService.get(DEPARTMENT_GETS, { headers });
        departments.value = response.data[0];
        if (res) {
          const { data } = res.data;
          user.value = data;
          if (data.avatar !== null) {
            filename.value = "../../../storage/" + data.avatar;
          }

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
            phone: data.phone,
            project: data.project,
            leave_days: data.leave_days,
          });
        }
      } catch (error) {}
    });

    const updateProfile = async () => {
      try {
        const id = router.currentRoute.value.params.id;

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
      } catch (error) {}
    };

    return {
      search,
      form,
      user,
      updateProfile,
      filename,
      fileInput,
      departments,
    };
  },
};
</script>
