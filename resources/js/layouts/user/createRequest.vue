<template>
    <div class="header">
      <h2>Tạo mới yêu cầu</h2>
    </div>
    <div class="col-md-6">
      <form @submit.prevent="createRequest">
        <div class="form-row">
            <div class="col-md-6">
        <select class="form-select" aria-label="Default select example" v-model="form.content">
          <option value="Nghỉ phép có lương">Nghỉ phép có lương</option>
          <option value="Nghỉ phép không lương">Nghỉ phép không lương</option>
          <option value="Làm thêm giờ">Làm thêm giờ</option>
          <option value="Mang thiết bị về nhà">Mang thiết bị về nhà</option>
          <option value="Cập nhật thời gian làm việc">Cập nhật thời gian làm việc</option>
          <option value="Thu hồi thiết bị">Thu hồi thiết bị</option>
          <option value="Nghỉ việc riêng có lương">Nghỉ việc riêng có lương</option>
        </select>
        </div>
        <div class="col-md-6">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked v-model="form.check" >
                <label class="form-check-label" for="flexSwitchCheckChecked">Request bù</label>
              </div>
        </div>
        </div>
        <div class="form-row">
          <div class="form-group js-request-end-at col-md-6">
            <label class="form-group forgot-to-check-label" for="time_start">Từ</label>
            <input class="form-control datetimepicker" type="date" v-model="form.time_start" required/>
          </div>
          <div class="form-group js-request-end-at col-md-6">
            <label class="form-label other-labels" for="time_end">Đến</label>
            <input class="form-control datetimepicker" type="date" v-model="form.time_end" required/>
          </div>
        </div>
        <div class="form-group md-6">
          <label for="phone">Số điện thoại</label>
          <input type="number" class="form-control" v-model="form.phone" required/>
        </div>
        <div class="form-group md-6">
          <label for="project">Dự án</label>
          <input type="text" class="form-control" v-model="form.project" required/>
        </div>
        <div class="form-group md-6">
          <label for="reason" class="form-label">Lý do</label>
          <textarea class="form-control" id="validationTextarea" v-model="form.reason" required></textarea>
        </div>
       
          <button type="submit" class="btn btn-success waves-effect waves-themed">
            <i class="fal fa-save"></i>
            Lưu
          </button>
        
      </form>
    </div>
  </template>
  

<script>
import { reactive,ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import ApiService from '../common/apiService';
import {APICREATEREQUEST,APIMYACCOUNT,REQUEST} from '../store/url';

export default{
    setup(){
        const router= useRouter()
        const headers = ApiService.setHeader();
        const form = reactive({
			content:'',
            check:'',
            time_start:'',
            time_end:'',
            phone:'',
            project:'',
            reason:'',
		});
        
        onMounted(async () => {
        try {
          const userLogin = await ApiService.get(APIMYACCOUNT, { headers });
          form.phone=userLogin.data.data.phone;
          form.project=userLogin.data.data.project;
          if(form.check===false){
            form.type=1;
          }else{
          form.type=2;
          }
        } catch (error) {
          console.error(error);
        }
      });
    const createRequest=async ()=>{
       try{
         console.log(form);
         const res= await ApiService.postAuth(APICREATEREQUEST,form, { headers });
         alert('create request success!')
         await router.push(REQUEST)
       }
     catch (error) {
          console.error(error);
        }
    }
    return {
        form,
        createRequest
    }
    }
};

</script>