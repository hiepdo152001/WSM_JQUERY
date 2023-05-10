<template>
  <div>
    <h1>Trang chủ</h1>
    <div class="button-container">
      <div> 
        <router-link :to="{name: 'login-auth'}">
          <button >Login</button>
        </router-link>
       
      </div>
      <div> 
        <router-link :to="{name: 'register-auth'}">
          <button >Register</button>
        </router-link>
       
      </div>
      <div> 
        <router-link :to="{name: 'change-password-auth'}">
          <button >Change Password</button>
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
  justify-content: center;
  margin-bottom: 20px;
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
