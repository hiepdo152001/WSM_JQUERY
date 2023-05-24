import axios from "axios";
import JwtService from "./jwtService";
import { API_URL} from "./config"
import { ref, onMounted } from 'vue';

export const axiosClient = axios.create({
    baseURL: API_URL
});

const AppService={
    setHeader(){
        return Headers={
            'Authorization': `Bearer ${JSON.parse(JwtService.getToken())}`
          
        };
    },
    getTypeParameter(){
        const url = window.location.href;
          
          const params = new URLSearchParams(window.location.search);
          const type = params.get('type');
          return type;
    },
    get(resource,params){
        return axiosClient.get(`${resource}`,params);
       
    },
    getParameter(resource,slug, params) {
        return axiosClient.get(`${resource}/${slug}`, params);
      },
    post(resource,data){
        return axiosClient.post(`${resource}`,data);
    },
    postAuth(resource,data,header){
        return axiosClient.post(`${resource}`,data,header);
    },
    putAvatar(resource,data,header){
        return axiosClient.put(`${resource}`,data,header);
    },
    put(resource,slug, params) {
        return axiosClient.put(`${resource}/${slug}`, params);
      },
    setDealine(contacts,assignee){
        const timestamp=ref('');
        const deadline =ref('');
        const currentTime = new Date();
        const datenow = Math.floor(currentTime.getTime() ); 
        contacts.value.forEach(element => {
            
            timestamp.value=element.created_at ;
            
            const millisecondsInADay = 24 * 60 * 60 * 1000;
            const threeDaysMilliseconds = 3 * millisecondsInADay;
            
            const date = new Date(timestamp.value);
            const newtimestamp = date.getTime() + threeDaysMilliseconds;
            //so sanh time  with now
            if(newtimestamp < datenow){
                element.deadline="het han"
                element.assignee=assignee;
            }else{
            const newdate = new Date(newtimestamp);
            const year = newdate.getFullYear();
            const month = newdate.getMonth() + 1; // Vì tháng được đếm từ 0 đến 11, ta cộng thêm 1
            const day = newdate.getDate();
            const hours = newdate.getHours();
            deadline.value=hours + "h " + day + "-" +  month + "-" + year;
            //set contacts
            element.assignee=assignee;
            element.deadline=deadline.value;
            }
       }); 
    },
    
    getTimeCheck(res,checks){
        const time_in=res.time_in;
        const date= new Date(time_in);
        const checkin =date.getHours() + ":" + date.getMinutes();
        checks.check_in=checkin;
        if(res.time_out!==null){
        const time_out=res.time_out;
        const date_out= new Date(time_out);
        const checkout =date_out.getHours() + ":" + date_out.getMinutes();
        checks.check_out=checkout;
        }
    }
};  


export default AppService;


 
