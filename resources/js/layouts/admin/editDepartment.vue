<template>
  <div class="col-sm-12">
    <div class="panel">
      <div class="panel-container">
        <div class="panel-content">
          <form
            class="form-horizontal"
            @submit.prevent="editDepartment"
            enctype="multipart/form-data"
            style="padding: 20px 0px 20px 20px"
          >
            <div class="form-group">
              <div class="col-md-4">
                <div>
                  <label class="form-label">Tên</label>
                </div>
                <div class="alert alert-danger" v-if="checkName">
                  {{ checkName }}
                </div>
                <div class="frame-wrap">
                  <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault2"
                      >Id
                      <input
                        type="text"
                        class="form-control"
                        required
                        readonly="readonly"
                        v-model="form.id"
                      />
                    </label>
                  </div>
                </div>
                <div class="frame-wrap">
                  <div class="form-check">
                    <label class="form-check-label" for="flexRadioDefault2"
                      >Name
                      <input
                        type="text"
                        class="form-control"
                        required
                        v-model="form.name"
                      />
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-1">
              <button
                type="submit"
                class="btn btn-success waves-effect waves-themed"
                style=""
              >
                <i class="fal fa-save"></i>
                Sửa
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
import { DEPARTMENT_GETS, DEPARTMENT_EDIT, DEPARTMENT } from "../store/url";
import { useRouter } from "vue-router";

export default {
  setup() {
    const headers = ApiService.setHeader();
    const router = useRouter();
    const check = ref();
    const checkName = ref("");
    const form = reactive({
      id: "",
      name: "",
    });
    onMounted(async () => {
      try {
        const id = router.currentRoute.value.params.id;
        const res = await ApiService.getParameter(DEPARTMENT_GETS, id, {
          headers,
        });
        form.name = res.data[0].name;
        form.id = res.data[0].id;
      } catch (error) {
        console.error(error);
      }
    });
    const editDepartment = async () => {
      try {
        const res = await ApiService.patch(DEPARTMENT_EDIT, form.id, form, {
          headers,
        });
        if (res.status === 200) {
          window.location.href = DEPARTMENT;
        }
      } catch (error) {
        if (error.response.status === 422) {
          checkName.value = error.response.data.error.name[0];
        }
      }
    };

    return {
      router,
      check,
      form,
      checkName,
      editDepartment,
    };
  },
};
</script>
