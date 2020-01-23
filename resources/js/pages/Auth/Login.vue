<template>
  <div class="login-form">
    <form>
      <div class="avatar">
        <i class="material-icons"></i>
        <img src alt />
      </div>
      <h4 class="modal-title">Login to Your Account</h4>
      <div class="form-group">
        <input v-model="username" type="text" class="form-control" placeholder="Username" />
      </div>
      <div class="form-group">
        <input v-model="password" type="password" class="form-control" placeholder="Password" />
      </div>
      <div class="form-group small clearfix">
        <a href="#" class="forgot-link">Forgot Password?</a>
      </div>
      <input @click="login" type="submit" class="btn btn-primary btn-block btn-lg" value="Login" />
    </form>
    <!-- <div class="text-center small">
      Don't have an account?
      <a href="#">Sign up</a>
    </div>-->
  </div>
</template>
<script>
import NotificationTemplate from '../Notifications/NotificationTemplate';

export default {
  data() {
    return {
      username: null,
      password: null,
    };
  },
  components: {
    NotificationTemplate,
  },
  methods: {
    async login() {
      this.$axios.post('api/auth/login', {
        username: this.username,
        password: this.password,
      }).then((response) => {
        console.log('here');
      }).catch((error) => {
        let message =
          error.response.data.errors;
          for (let [key, value] of Object.entries(message)) {
            this.$notify({
              message: value[0],
              component: NotificationTemplate,
              icon: "ti-close",
              horizontalAlign: 'right',
              verticalAlign: 'top',
              type: 'danger'
            });
          }        
      })
    },
  }
};
</script>
<style type="text/css">
body {
  color: #999;
  background: #f5f5f5;
  font-family: "Varela Round", sans-serif;
  background-image: url("../../assets/img/login-bg.jpg");
  background-repeat: no-repeat;
  background-size: cover;
}
.form-control {
  box-shadow: none;
  border-color: #ddd;
}
.form-control:focus {
  border-color: #4aba70 !important;
}
.login-form {
  width: 350px;
  margin: 0 auto;
  padding: 30px 0;
}
.login-form form {
  color: #434343;
  border-radius: 1px;
  margin-bottom: 15px;
  background: #fff;
  border: 1px solid #f3f3f3;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h4 {
  text-align: center;
  font-size: 22px;
  margin-bottom: 20px;
}
.login-form .avatar {
  color: #fff;
  margin: 0 auto 30px;
  text-align: center;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  z-index: 9;
  background: #29c7e0;
  padding: 15px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar i {
  font-size: 62px;
}
.login-form .form-group {
  margin-bottom: 20px;
}
.login-form .form-control,
.login-form .btn {
  min-height: 40px;
  border-radius: 2px;
  transition: all 0.5s;
}
.login-form .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.login-form .btn {
  background: #29c7e0;
  border: none;
  line-height: normal;
}
.login-form .btn:hover,
.login-form .btn:focus {
  background: #27dae5;
}
.login-form .checkbox-inline {
  float: left;
}
.login-form input[type="checkbox"] {
  margin-top: 2px;
}
.login-form .forgot-link {
  float: right;
}
.login-form .small {
  font-size: 13px;
}
.login-form a {
  color: #29c7e0;
}
</style>
