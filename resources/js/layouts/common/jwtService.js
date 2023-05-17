const userInfo='userInfo';
export const getToken= () => {
    return localStorage.getItem(userInfo);
};

export const setToken= (token) => {
    localStorage.setItem(userInfo, token)
};
 
export const destroyToken= () =>{
    localStorage.removeItem(userInfo)
};

export default {getToken, setToken, destroyToken};