<template>
    <Head title="Welcome" />

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Tic tac toc.</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <!--<a class="nav-link active" aria-current="page" href="#">Home</a>
            <a class="nav-link" href="#">Features</a>
            <a class="nav-link" href="#">Contact</a>
            -->
        </nav>
        </div>
    </header>

    <main class="px-3" v-if="join_game == false">
        <h1>Tic tac toc.</h1>
        <p class="lead">
            El tres en línea, también conocido como ceros y cruces, tres en raya, cerito cruz, michi, triqui, cuadritos, juego del gato, gato, tatetí, totito, triqui traka, equis cero, tic-tac-toe o la vieja es un juego de lápiz y papel entre dos jugadores: O y X, que marcan los espacios de un tablero de 3×3 alternadamente.
            <a href="https://es.wikipedia.org/wiki/Tres_en_l%C3%ADnea" class="fw-bold border-white ">Wikipedia</a>
        </p>
        <p class="lead">
        <a href="#" ></a>
            <Link  :href="route('playing')" method="post" :data="{ name:hasName() , new_m:true }" class="btn btn-lg btn-secondary fw-bold border-white bg-white">
                - Nueva partida -
            </Link>
        </p>

        <p class="lead">
            <button type="button" class="btn btn-lg btn-secondary fw-bold border-white bg-white" @click="joinGame()">
                Unirse a partida
            </button>
        </p>
    </main>

    <main class="px-3" v-else>
        <form class="">
            
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Codigo</label>
                <input type="text" class="form-control" v-model="code" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Ingrese el codigo para unirte a la partida.</div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre usuario</label>
                <input type="text" class="form-control" v-model="user_name">
                <div  class="form-text">Tambien puedes ingresar con un nombre se usuario personalizado.</div>
            </div>

            <Link  :href="route('playing')" method="post" :data="{ name: user_name , code: code ,new_m:true }" class="w-100 mb-2 btn btn-lg rounded-4 btn-primary">
                Unirse
            </Link>
            
            <small class="text-muted">By clicking Sign up, you agree to the terms of use.</small>
            
            <hr class="my-4">
            
            <h2 class="fs-5 fw-bold mb-3">O cree una nueva partida e invite un amigo.</h2>

            <Link  :href="route('playing')" :data="{ name: hasName() , code: code , new_m:true }" class="btn btn-lg btn-secondary fw-bold border-white bg-white">
                - Nueva partida -
            </Link>        
        </form>
    </main>


    <footer class="mt-auto text-white-50">
        <p>Cover template for <a href="https://getbootstrap.com/" class="text-white">Bootstrap</a>,
        by <a href="https://twitter.com/mdo" class="text-white">@mdo</a>,
            Implemented by <a href="https://github.com/JohannDevFull" target="_blank" class="text-white">Johann Ramirez</a>
        </p>
    </footer>

</div>

</template>

<script >

import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    props:['player'],
    name: 'Wolcome',
    components: {
        Head,
        Link
    },
    data(){
        return {
            code:'',
            join_game:false,
            user_name:''
        }
    },
    mounted(){

      if( this.player.name != undefined) 
      {
        this.user_name=this.player.name;
      }
    },
    methods:{
      hasName()
      {
        let name;
        if (this.player.name == '') 
        {

          if (this.join_game == true) 
          { 
            name ="Player 2"  
          }
          else
          { 
            name ="Player 1" 
          }
        }
        else
        {
          name=this.user_name
        }

        return name;
      },
      joinGame()
      {
        this.user_name= this.player.name == '' ? 'Player 2' : this.player.name ;
        
        this.user_name="Player 2"
        this.join_game=true;
      }

    }
}

</script>

<style scoped>

    

    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
    }



      /*
  * Globals
  */


  /* Custom default button */
  .btn-secondary,
  .btn-secondary:hover,
  .btn-secondary:focus {
    color: #333;
    text-shadow: none; /* Prevent inheritance from `body` */
  }


  /*
  * Base structure
  */

  body {
    text-shadow: 0 .05rem .1rem rgba(0, 0, 0, .5);
    box-shadow: inset 0 0 5rem rgba(0, 0, 0, .5);
  }

  .cover-container {
    max-width: 42em;
  }


  /*
  * Header
  */

  .nav-masthead .nav-link {
    padding: .25rem 0;
    font-weight: 700;
    color: rgba(255, 255, 255, .5);
    background-color: transparent;
    border-bottom: .25rem solid transparent;
  }

  .nav-masthead .nav-link:hover,
  .nav-masthead .nav-link:focus {
    border-bottom-color: rgba(255, 255, 255, .25);
  }

  .nav-masthead .nav-link + .nav-link {
    margin-left: 1rem;
  }

  .nav-masthead .active {
    color: #fff;
    border-bottom-color: #fff;
  }
   
</style>
