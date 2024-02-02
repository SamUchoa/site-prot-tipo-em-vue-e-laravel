<script>
import Cookies from "js-cookie";
import axios from "axios";
import { RouterLink } from "vue-router";
export default {
  methods: {
    logout: async function () {
      const token = `Bearer ${Cookies.get("JSONWebToken")}`;
      return await axios
        .post(
          "http://localhost:8000/api/logout",
          {},
          {
            headers: {
              Accept: "application/json",
              Authorization: token,
            },
          }
        )
        .then(() => {
          Cookies.remove("JSONWebToken");
          Cookies.remove("XSRF-TOKEN");
          this.$router.push({ name: "login" });
        })
        .catch((err) => console.log(err.response.data));
    },
  },
};
</script>
<template>
  <div class="navbar">
    <strong>Arc</strong>
    <nav>
      <ul>
        <li>config</li>
        <li>test</li>
        <li>Test 2</li>
      </ul>
    </nav>
    <button class="btn" @click.prevent="logout">Logout</button>
  </div>
</template>
<style scoped>
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: rgb(255, 152, 152);
  padding: 0.5rem 4rem 0.5rem;
}
ul {
  display: flex;
  list-style: none;
}
li {
  margin: 0 0.5rem;
}
</style>
