<template>
  <table class="table table-bordered" style="margin-top: 30px">
    <thead>
      <tr>
        <th>Id</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th>Trạng thái</th>
        <th>Xử lý</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" class="contact-row">
        <td>{{ user.id }}</td>
        <td>{{ user.name }}</td>
        <td>{{ user.email }}</td>
        <td>{{ user.department }}</td>
        <td>{{ user.position }}</td>
        <td>{{ user.status }}</td>
        <td>
          <button
            class="btn"
            type="button"
            data-toggle="tooltip"
            data-placement="top"
            title="edit"
          >
            <router-link :to="{ name: 'user-view', params: { id: user.id } }">
              <i class="bi bi-pencil-fill" style="color: black"></i>
            </router-link>
          </button>
          <button
            v-if="user.status === 'Active'"
            class="btn"
            type="button"
            @click="deletes(user.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="block"
          >
            <i class="bi bi-lock-fill"></i>
          </button>
          <button
            v-if="user.status === 'deActive'"
            class="btn"
            type="button"
            @click="active(user.id)"
            data-toggle="tooltip"
            data-placement="top"
            title="active"
          >
            <i class="bi bi-key-fill"></i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    users: {
      type: Array,
      required: true,
    },
  },
  emits: ["deleteUser", "activeUser"],
  setup(props, context) {
    const deletes = (id) => {
      context.emit("deleteUser", id);
    };
    const active = (id) => {
      context.emit("activeUser", id);
    };
    return {
      deletes,
      active,
    };
  },
});
</script>
