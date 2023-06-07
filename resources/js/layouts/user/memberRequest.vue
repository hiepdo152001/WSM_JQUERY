<template>
  <div class="panel">
    <div class="panel-container">
      <div class="panel-content">
        <ul class="nav nav-tabs nav-tabs-clean" style="display: block">
          <li class="nav-item">
            <router-link :to="{ name: 'pending', query: { type: 'pending' } }">
              <span class="custom-span">Đang chờ duyệt</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ name: 'confirmed', query: { type: 'confirmed' } }"
            >
              <span class="custom-span">Đã xác nhận</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ name: 'approved', query: { type: 'approved' } }"
            >
              <span class="custom-span">Đã chấp nhận</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ name: 'declined', query: { type: 'declined' } }"
            >
              <span class="custom-span">Đã từ chối</span>
            </router-link>
          </li>
          <li>
            <router-link
              :to="{ name: 'canceled', query: { type: 'canceled' } }"
            >
              <span class="custom-span">Đã hủy</span>
            </router-link>
          </li>
        </ul>
        <div>
          <router-view></router-view>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bi-eye-fil {
  color: black;
}
.panel {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
  -ms-flex-direction: column;
  flex-direction: column;
  position: relative;
  background-color: #fff;
  -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
  margin-bottom: 1.5rem;
  border-radius: 4px;
  border: 1px solid rgba(0, 0, 0, 0.09);
  border-bottom: 1px solid #e0e0e0;
  border-radius: 4px;
  -webkit-transition: border 500ms ease-out;
  transition: border 500ms ease-out;
}
.panel .panel-container {
  position: relative;
  border-radius: 0 0 4px 4px;
}
.panel .panel-container .panel-content {
  padding: 1rem 1rem;
}
.nav-tabs-clean {
  height: 45px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}
.nav {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}
.nav-tabs .nav-item {
  margin-bottom: -1px;
}
span {
  font-weight: 500;
  font-size: 16px;
  color: black;
}
</style>
