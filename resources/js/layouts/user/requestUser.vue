<template>
    <div class="contacts">
      <div>
      <h1 class="title">Yêu cầu của tôi</h1>
  </div>
  <router-link :to="{name: 'new-request'}">
    <button class="profile" >+ Thêm yêu cầu</button>
    </router-link>
      <table class="table">
        <thead>
          <tr>
            <th>Nội dung</th>
            <th>Trạng thái</th>
            <th>Người xử lí</th>
            <th>Thời hạn</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="contact in contacts" :key="contact.id" class="contact-row">
            <td>{{ contact.content }}</td>
            <td >{{ contact.status }}</td>
            <td>{{ contact.assignee }}</td>
            <td>{{ contact.deadline }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  import ApiService from '../common/apiService'
	import { APIREQUEST,APIUSERMNG } from '../store/url'

  export default {
    setup() {
      const contacts = ref([]);
     
      onMounted(async () => {
        try {
          const headers = ApiService.setHeader()
          const apiResponse = await ApiService.get(APIREQUEST, { headers });
          contacts.value = apiResponse.data.data;

          const usermng= await ApiService.get(APIUSERMNG,{headers});
          const assignee=usermng.data.name;
          ApiService.setDealine(contacts,assignee);
         
        } catch (error) {
          console.error(error);
        }
      });
      return {
        contacts,
      };
    },
  };
  </script>
  
  <style>
  .contacts {
    margin: 20px;
  }
  
  .title {
    font-size: 24px;
    margin-bottom: 10px;
  }
  
  .table {
    width: 100%;
    border-collapse: collapse;
  }
  
  .contact-row {
    border-bottom: 1px solid #ccc;
  }
  
  .contact-row:hover {
    background-color: #f5f5f5;
  }
  
  th {
    text-align: left;
    font-weight: bold;
    padding: 10px;
    background-color: #f0f0f0;
  }
  
  td {
    padding: 10px;
  }
  
  .status-processing {
    color: #ff9800;
  }
  
  .status-completed {
    color: #4caf50;
  }
  
  .status-pending {
    color: #2196f3;
  }
  </style>
  