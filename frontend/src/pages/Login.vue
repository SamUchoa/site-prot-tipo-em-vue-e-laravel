<script>
import Cookies from "js-cookie";
import InputTemplate from "../components/InputTemplate.vue";
import MessageBox from "../components/MessageBox.vue";

import axios from "axios";

export default {
  components: { InputTemplate, MessageBox },
  methods: {
    loginSubmit: function () {
      axios
        .get("http://localhost:8000/sanctum/csrf-cookie", {
          withCredentials: true,
        })
        .then(() => {
          axios
            .post("http://localhost:8000/api/login", this.fields)
            .then((res) => {
              Cookies.set("JSONWebToken", res.data.token, { expires: 7 });
              axios.defaults.headers.common["X-CSRF-TOKEN"] =
                Cookies.get("XSRF-TOKEN");
              this.$router.push({ name: "main" });
              console.log(Cookies.get("XSRF-TOKEN"));
            })
            .catch((err) => {
              console.log(err);
              Cookies.remove("XSRF-TOKEN");
            });
        });
    },
  },
  data() {
    return {
      fields: { email: "", password: "" },
    };
  },
  created() {
    if (Cookies.get("JSONWebToken")) {
      this.$router.push({ name: "main" });
    }
  },
};
</script>

<template>
  <div class="form-wraper container">
    <form action="" class="loginForm" @submit.prevent="loginSubmit">
      <div class="logo logo-login"></div>
      <InputTemplate
        fa-icon-class="fa-solid fa-user"
        input-placeholder="login"
        input-label="login"
        input-type="text"
        class="login-field"
        v-model="fields.email"
      ></InputTemplate>
      <InputTemplate
        fa-icon-class="fa-solid fa-lock"
        input-placeholder="password"
        input-label="password"
        input-type="password"
        class="login-field"
        v-model="fields.password"
      ></InputTemplate>

      <div class="login-field field-wrapper">
        <span class="check-wraper">
          <input type="checkbox" id="remember-me" class="remember-me" />
          <label for="remember-me" class="remember-label">Remember me?</label>
        </span>
        <a href="" class="link">Doesn't have an account?</a>
      </div>
      <button type="submit" class="btn btn_submit">Login</button>
    </form>
  </div>
  <!-- <MessageBox message="Teste"></MessageBox> -->
</template>

<style scoped>
.form-wraper {
  min-height: inherit;
  display: flex;
  align-items: center;
  justify-content: center;
}

.loginForm {
  width: 100%;
  max-width: 475px;
  display: flex;
  flex-direction: column;
}

.logo {
  width: 6rem;
  height: 6rem;
  background-image: url(../assets/arc.png);
  background-size: contain;
}

.logo-login {
  margin-bottom: 1rem;
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 1em;
}

.login-field {
  margin-bottom: 1rem;
}

.btn_submit {
  width: 80%;
  margin: 0 auto;
}

.remember-me {
  width: 1.5em;
  height: 1.5em;
  margin-right: 1em;
}

.check-wrapper {
  display: flex;
  align-items: center;
}

.field-wrapper {
  font-size: 0.75em;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
</style>
