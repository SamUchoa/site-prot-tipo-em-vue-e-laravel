<script>
import Cookies from "js-cookie";
import Navbar from "../components/Navbar.vue";
import axios from "axios";

export default {
  components: { Navbar },
  created() {
    if (!Cookies.get("JSONWebToken")) {
      this.$router.push({ name: "login" });
    }
  },
  methods: {
    TwoFA: () => {
      axios
        .post("http://localhost:8000/user/two-factor-authentication")
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<template>
  <Navbar></Navbar>

  <button class="btn" @click="TwoFA">Activate 2fa</button>
  <div>(função em andamento)</div>
</template>
