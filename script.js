const { createApp } = Vue;

createApp({
  data(){
    return{
    title: 'Diario di Viaggio',
    apiUrl: 'server.php',
    travel_list: [],
    // tappe_list: [], 
    }
  },

  methods:{
    getApi(){
      axios.get(this.apiUrl)
      .then(result => {
        // console.log(result.data);
        this.travel_list = result.data;
        console.log(this.travel_list);
      })
    },

    addNewVote(title, day, vote){

      console.log(title, day, vote);
      const data = new FormData();

      data.append('title', title);
      data.append('day', day);
      data.append('vote', vote);

      axios.post(this.apiUrl, data)
      .then(result =>{
        this.travel_list = result.data;
      })
    },

    getApiTappe(){
      axios.get(this.apiUrl)
      .then(result => {
         console.log(result.data);
        this.tappe_list = result.data;
        // console.log(this.travel_list);
      })
      const urlParams = new URLSearchParams(window.location.search);
      const tappa = urlParams.get('tappa');  // Ottieni il valore di 'tappa' dalla query string
      this.title = tappa || 'Default Title';  // Imposta il titolo se esiste il parametro
      const travel = this.tappe_list.find(item => item.title === tappa);
      return travel ? travel.tappe : []; 
    }
  },

  computed: {
    filteredTravelList() {
      // Filtra la lista per mostrare solo l'elemento corrispondente
      // console.log(travel_list)
    }
  },

  mounted(){
    this.getApi();
    // this.getApiTappe();
  }

}).mount('#app')