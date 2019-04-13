<template xmlns:v-slot="http://www.w3.org/1999/XSL/Transform">
    <v-app id="inspire">
        <v-content>
            <v-container  fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm7 md6 lg4 xl6>
                        <div class="login_card">
                            <div v-if="loading">
                                <v-progress-linear :indeterminate="true"></v-progress-linear>
                            </div>
                            <div style="padding: 29px;" v-bind:class="{ canot_events: loading }" class="login_card">
                                <div class="title font-weight-regular" style="text-align: center;" v-if="header">
                                    <!--<img src="/assets/logo.gif" alt="" width="70%">-->
                                    <img src="/assets/minecraft.png">
                                    <div class="login-card-title">
                                        <!--<span>{{ currentTitle }}</span>-->
                                    </div>
                                </div>
                                <v-alert
                                        :value="alert.state"
                                        :type="alert.type"
                                        dismissible
                                        outline
                                >
                                    {{ alert.msg }}
                                </v-alert>
                                <v-window v-model="step" >
                                    <v-window-item :value="1">
                                        <v-text-field
                                                prepend-icon="person"
                                                v-model="username"
                                                label="Username"
                                        ></v-text-field>
                                        <v-text-field
                                                prepend-icon="lock"
                                                v-model="password"
                                                label="Password"
                                                type="password"
                                        ></v-text-field>
                                    </v-window-item>

                                    <v-window-item :value="2">
                                        <v-card-text>
                                            <div class="pa-3 text-xs-center">
                                                <v-avatar
                                                        :tile="false"
                                                        :size="100"
                                                        color="grey lighten-4"
                                                >
                                                    <img src="https://q1.qlogo.cn/g?b=qq&s=640&nk=2758417019" alt="avatar">
                                                </v-avatar>
                                                <h3 class="title font-weight-light mb-2">Hi,admin.</h3>
                                                <h3 class="title font-weight-light mb-2">Welcome to BorderCraft</h3>
                                            </div>
                                            <v-text-field
                                                    v-model="code"
                                                    label="Two-step Code"
                                                    type="text"
                                            ></v-text-field>
                                            <span class="caption black--text text--darken-1">
                                                Please enter your TWO STEP TOKEN. Powered by Authy.
                                            </span>
                                        </v-card-text>
                                    </v-window-item>

                                    <v-window-item :value="3">
                                        <div class="pa-3 text-xs-center">
                                            <img src="/assets/logo.gif" alt="" width="70%">
                                            <h3 class="title font-weight-light mb-2">Welcome to BorderCraft</h3>
                                            <span class="caption black--text">Powered by Amadeus Server Manager.</span>
                                        </div>
                                    </v-window-item>
                                </v-window>

                                <v-divider></v-divider>
                                <v-card-actions>
                                    <v-btn
                                            color="black"
                                            flat
                                            @click="step--"
                                            :disabled="step === 1 || step === 3"
                                            style="border-radius: 30px"

                                    >
                                        BACK
                                    </v-btn>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                            color="primary"
                                            depressed
                                            @click="next()"
                                            :disabled="step === 3"
                                            style="border-radius: 30px"
                                    >
                                        NEXT
                                    </v-btn>
                                </v-card-actions>
                            </div>
                        </div>
                        <!--<v-footer class="pa-3 ps-footer" style="background-color:transparent;color: white">
                            <div>&copy; {{ new Date().getFullYear() }} Amadeus.</div>
                            <v-spacer></v-spacer>
                            &lt;!&ndash;<div style="color: white"><a href="">Home</a> &nbsp&nbsp <a href="">About</a> &nbsp&nbsp <a href="">Help</a></div>&ndash;&gt;
                        </v-footer>-->
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>

</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                step: 1,
                loading: false,
                alert: {
                    'state': false,
                    'msg': 'Error! dhdj ',
                    'type': 'error'
                },
                username: null,
                password: null,
                code: null,
            }
        },
        computed: {
            header () {
                switch (this.step) {
                    case 1: return true
                    case 2: return false
                    default: return false
                }
            }
        },
        methods: {
            next: function () {
                this.loading = false;
                this.alert.state = false
                if (this.step === 1) {
                    // this.step = 2
                    fetch('/login',{
                        method: 'post',
                        headers: {
                            'content-type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf
                        },
                        cache: 'no-cache',
                        body: JSON.stringify({
                            name: this.username,
                            password: this.password
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data)
                            if(data.success){
                                this.step = 3
                                setTimeout(function () {
                                    window.location.href="/"
                                },3000)
                            }else{
                                this.alert.msg = data.message
                                this.alert.type = "error"
                                this.alert.state = true
                            }
                        })
                        .catch(error => {
                            console.error(error)
                            this.alert.msg = "Please check your network connection."
                            this.alert.type = "error"
                            this.alert.state = true
                        });


                }else if(this.step === 2){
                    this.step = 3

                }
            },
        }

    }
</script>

<style scoped>
    #inspire{
        background: url("//acg.bakayun.cn/randbg.php?Type=302&t=dfproject") no-repeat center;
        background-size: cover;
        width: 100%;
        height: 100vh;
        overflow: auto;
        /*background-color: black;*/
    }
    .login-card{
        border-radius:10px;
    }
    .login_card{
        background-color: rgba(255, 255, 255, 0.58);
        border-radius:15px;
    }
    .canot_events{
        pointer-events:none;
        user-focus-pointer: none;
        -webkit-touch-callout: none;
        -moz-user-select: none; /*火狐*/
        -webkit-user-select: none;  /*webkit浏览器*/
        -ms-user-select: none;   /*IE10*/
        user-select: none;
    }
    .login-card-title{
        color: #202124;
        padding-top: 16px;
        font-family: 'Google Sans','Noto Sans Myanmar UI',arial,sans-serif;
        line-height: 1.3333;
        margin-bottom: 0;
        margin-top: 0;
        font-size: 16px;
        padding-bottom: 5px;
    }
    .v-divider{
        display: none;
    }
    .ps-footer a{
        -webkit-border-radius: 2px;
        border-radius: 2px;
        color: white;
        padding: 5px;
        -webkit-transition: background .2s;
        transition: background .2s;
        text-decoration:none;
    }
    .v-progress-linear{
        border-radius:10000px; /* 苟盒子：盘他 !*/
    }
</style>