<template>
  <nav class="navbar ">
    <div class="">
      <ul class="nav navbar-nav">
        <li> 
          <router-link :to="{name: 'pending'}">
            <span class="custom-span">Đang chờ duyệt</span>
          </router-link>
         
        </li>
        <li> 
          <router-link :to="{name: 'confirmed'}">
            <span class="custom-span">Đã xác nhận</span>
          </router-link>
         
        </li>
        <li> 
          <router-link :to="{name: 'approved'}">
            <span class="custom-span" >Đã chấp nhận</span>
          </router-link>
         
        </li>
        <li> 
          <router-link :to="{name: 'declined'}">
            <span class="custom-span" >Đã từ chối</span>
          </router-link>
         
        </li>
        <li> 
          <router-link :to="{name: 'canceled'}">
            <span class="custom-span" >Đã hủy</span>
          </router-link>
         
        </li>
      </ul>
      
    </div>
  </nav>
    
  <div>
    <router-view></router-view>
  </div>
  </template>
  
  <style>
  .container {
    display: flex;
    justify-content: left;
    margin-bottom: 20px;
  }
  .header{
    border: 1px solid gray;

  }
  span{
    color: black;
  }

  </style>
  
  