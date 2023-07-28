<template>
  <div class="container-fluid mt-3">
    <div class="row">
      <div class="col-sm-2 d-none d-sm-flex" style="padding: 0">
        <a-list bordered style="width: 100%">
          <TheMenu />
        </a-list>
      </div>

      <div class="col-12 col-sm-10" style="padding: 0; height: 880px">
        <TheHeader />
        <router-view></router-view>
      </div>
      <div class="footer" style="padding: 0">
        <div
          style="
            width: 50px;
            margin: auto;
            text-align: center;
            padding-top: 20px;
          "
        >
          <h1>WSM</h1>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import TheMenu from "../layouts/TheMenu.vue";
import TheHeader from "../layouts/TheHeader.vue";
export default {
  components: {
    TheHeader,
    TheMenu,
  },
};
</script>
