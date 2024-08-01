const { createApp } = Vue;

createApp({
  data(){
    return{
    title: 'Diario di viaggi',
    apiUrl: 'server.php',
    }
  },

  methods:{
    getApi(){
      axios.get(this.apiUrl)
      .then(result => {
        console.log(result.data);
      })
    }
  },

  mountes(){
    this.getApi();
  }

}).mount('#app')