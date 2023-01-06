

import { createApp } from "vue";
import App from "./components/App.vue";
import ListData from "./components/ListData.vue";
// import SaveData from "./components/SaveData.vue"

let app= createApp({});

app.component("home", App);
app.component("list",ListData );
// app.component("savedata",SaveData);

app.mount("#app");
