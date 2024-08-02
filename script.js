const { createApp } = Vue;

createApp({
  data(){
    return{
    title: 'Diario di Viaggio',
    apiUrl: 'server.php',
    travel_list: [],
    }
  },

  methods:{
    getApi(){
      axios.get(this.apiUrl)
      .then(result => {
        // console.log(result.data);
        this.travel_list = result.data;
        // console.log(this.travel_list);
      })
    }
  },

  mounted(){
    this.getApi();
  }

}).mount('#app')