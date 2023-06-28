<template>
    <section v-if="this.logged">
        <h1>Hey, you logged In</h1>
        <button @click="logout" type="submit" class="btn btn-warning">Log out</button>
    </section>
    <section v-else>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input v-model.lazy="username" type="text" class="form-control" id="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="examppasswordleInputPassword1" class="form-label">Password</label>
                <input v-model.lazy="password" type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-success">Login</button>
        </form>
    </section>
</template>

<script>
import VueCookies from 'vue-cookies'

export default {
    name: "LoginForm",
    data() {
        return {
            logged: false,
            username: "",
            password: "",
            loginUrl: "http://localhost:80/login-process/src/api/login.php",
            serverUrl: "http://localhost:80/login-process/src/api/server.php",
            token: ""
        }
    },
    methods: {
        async login() {
            try {
                await fetch(this.loginUrl, {
                    method: "POST",
                    body: JSON.stringify({
                        username: this.username,
                        password: this.password
                    })
                }).then((response) => response.json()
                ).then((data) => {
                    if (data.success) {
                        this.token = data.sessionToken; 
                    }
                });

            } catch (error) {
                console.log(error);
            }
            VueCookies.set("session", this.token, "30d");
            this.logged = true;
            console.log(VueCookies.get("session"));
        },
        logout() {
            if (VueCookies.isKey("session")) {
                VueCookies.remove("session");
                this.logged = false;
            }
        }
    },
    created() {
        if(VueCookies.isKey("session")) {
            this.logged = true;
        }
    }
}

</script>