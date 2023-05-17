<template>
    <div class="contacts">
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
	import { APIREQUESTSTATUS,APIUSERMNG } from '../store/url'

  export default {
 
    setup() {
      const contacts = ref([]);
      
      onMounted(async () => {
        try {
          
          const type= ApiService.getTypeParameter();
          const headers = ApiService.setHeader()
         
          const apiResponse = await ApiService.getParameter(APIREQUESTSTATUS,type, { headers });
          
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