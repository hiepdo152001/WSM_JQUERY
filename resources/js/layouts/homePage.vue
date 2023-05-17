<template>
  <div class="header">
    <a class="custom-button" href="/">Home</a>
    <div class="button-container">
      <div> 
        <router-link :to="{name: 'login-auth'}">
          <button class="custom-button" >Login</button>
        </router-link>
       
      </div>
      <div> 
        <router-link :to="{name: 'register-auth'}">
          <button class="custom-button" >Register</button>
        </router-link>
       
      </div>
      <div> 
        <router-link :to="{name: 'change-password-auth'}">
          <button class="custom-button" >Change Password</button>
        </router-link>
       
      </div>
    </div>
    
  </div>

  <div>
    <router-view></router-view>
  </div>
</template>

<style>
.button-container {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 20px;
}
.header{
  border: 1px solid gray;
  background-image: url('../assets/header.jpg');
}
.custom-button {
  padding: 10px 20px;
  background-color: #95421c;
  color: white;
  border-right-color:1px solid #110f0e ;
  cursor: pointer;
  font-size: 16px;
}

.custom-button:hover {
  background-color: #09071b;
}

.custom-button:active {
  background-color: #3e8e41;
}
.form-container {
  max-width: 400px;
  margin: 0 auto;
  border: 1px solid #ccc;
  padding: 20px;
}

.form-container label {
  display: block;
  margin-bottom: 10px;
}

.form-container input {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
}

.form-container button {
  display: block;
  width: 100%;
  padding: 10px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.form-container button:hover {
  background-color: #3e8e41;
}
</style>

