<template>
  <div class="col-sm-12">
    <div class="panel">
      <div class="panel-container">
        <div class="panel-content">
          <form
            class="form-horizontal"
            @submit.prevent="createAssets"
            enctype="multipart/form-data"
          >
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Tên</label>
              </div>
              <input
                type="text"
                class="form-control"
                required
                v-model="form.name"
              />
            </div>
            <div class="col-md-6">
              <div class="form-gruop">
                <label class="form-label">Mã</label>
              </div>
              <input
                class="form-control"
                type="number"
                required
                v-model="form.code"
              />
            </div>
            <div>
              <button
                type="submit"
                class="btn btn-success waves-effect waves-themed"
                style="margin-top: 20px; margin-left: 15px"
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
import { useRouter } from "vue-router";
import { API_ASSETS_NEW } from "../store/url";

export default {
  setup() {
    const router = useRouter();
    const form = reactive({
      name: "",
      code: "",
      location: "",
    });

    const headers = ApiService.setHeader();
    const createAssets = async () => {
      try {
        const id = router.currentRoute.value.params.id;
        form.user_id = id;

        const res = await ApiService.postAuth(API_ASSETS_NEW, form, {
          headers,
        });
        if (res.status === 200) {
          alert("Thêm thành công");
        }
      } catch (error) {}
    };

    return {
      createAssets,
      form,
    };
  },
};
</script>
