<template>
    <Head title="Tablero" />
    <div class="container py-3">
   
        <header>
            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom ">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                    <span class="fs-4 text-white">Tic tac toc</span>
                </a>
                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto ">
                    <a class="p-2 btn btn-success  text-decoration-none text-white" href="#">Nuevo juego</a> 
                    -
                    <a class="me-3 p-2 btn btn-danger text-decoration-none text-white" href="#">
                        Salir
                        <i class="fas fa-window-close"></i>
                    </a>
                </nav>
            </div>
            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">{{code}}</h1>
                <p class="fs-5 text-muted" v-if="another_player_f == 0"> Invita a un amigo para jugar con este codigo.</p>
                <p class="fs-5 text-muted" v-else>
                    <span v-if="player.guest == true">
                        Bienvenido disfuta del juego con tu amigo.
                    </span>
                    <span v-else>
                        En horabuena disfuta del juego con tu invitado.
                    </span>    
                </p>
            </div>
        </header>

        <main>
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
               
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal text-dark" v-if="another_player_f != 0">
                                <span v-if="player.guest == true">
                                    ANFITRION:
                                </span>
                                <span v-else>
                                    INVITADO:
                                </span>
                                    
                                {{another_player_f}}
                            </h4>
                            <h4 class="my-0 fw-normal text-dark"  v-else>
                                Esperando invitado ... 
                                <div class="spinner-grow text-primary" role="status">
                                </div>
                            </h4>
                        </div>
                        
                        <div class="card-body">

                            <ul class="list-unstyled mt-2 mb-3">
                            </ul>
                            
                            
                            <!-- <h4 class="my-0 fw-normal text-dark"  v-else>
                                Esperando respuesta ... 
                                <div class="spinner-grow text-primary" role="status">
                                </div>
                            </h4> -->
                        </div>

                    </div>
                </div>
                
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">                     
                        <div class="card-header py-3" v-if="game_over == false">
                            <h4 class="my-0 fw-normal text-dark" v-if="shift__ == true">Haz tu jugada</h4>
                            <h4 class="my-0 fw-normal text-dark" v-else>Espera tu turno</h4>
                        </div>
                        <div class="card-header py-3" v-else>
                            <h4 class="my-0 fw-normal text-dark" >El juego a terminado</h4>
                            <button type="button" class="w-100 btn btn-lg btn-primary mt-2" @click="sendRequets()">
                                Empesar nuevo juego
                            </button>
                        </div>
                        
                        <div class="card-body">
                            
                            <table id="tablero" style="margin:auto; cursor: pointer;" v-if="match.board.boards_type_id ==1">
                                <tr>
                                    <td @click="play(0)">
                                        <i class="fas fa-times" v-if="board[0] == 1"></i>
                                        <i class="far fa-circle" v-if="board[0] == 2"></i>
                                    </td>
                                    <td @click="play(1)">
                                        <i class="fas fa-times" v-if="board[1] == 1"></i>
                                        <i class="far fa-circle" v-if="board[1] == 2"></i>
                                    </td>
                                    <td @click="play(2)">
                                        <i class="fas fa-times" v-if="board[2] == 1"></i>
                                        <i class="far fa-circle" v-if="board[2] == 2"></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td @click="play(3)">
                                        <i class="fas fa-times" v-if="board[3] == 1"></i>
                                        <i class="far fa-circle" v-if="board[3] == 2"></i>
                                    </td>
                                    <td @click="play(4)">
                                        <i class="fas fa-times" v-if="board[4] == 1"></i>
                                        <i class="far fa-circle" v-if="board[4] == 2"></i>
                                    </td>
                                    <td @click="play(5)">
                                        <i class="fas fa-times" v-if="board[5] == 1"></i>
                                        <i class="far fa-circle" v-if="board[5] == 2"></i>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td @click="play(6)">
                                        <i class="fas fa-times" v-if="board[6] == 1"></i>
                                        <i class="far fa-circle" v-if="board[6] == 2"></i>
                                    </td>
                                    <td @click="play(7)">
                                        <i class="fas fa-times" v-if="board[7] == 1"></i>
                                        <i class="far fa-circle" v-if="board[7] == 2"></i>
                                    </td>
                                    <td @click="play(8)">
                                        <i class="fas fa-times" v-if="board[8] == 1"></i>
                                        <i class="far fa-circle" v-if="board[8] == 2"></i>
                                    </td>
                                </tr>
                            </table>

                            <table id="tablero" style="margin:auto" v-if="match.board.boards_type_id ==2">

                                <tr>
                                    <td @click="play(0)">
                                        <i class="fas fa-times" v-if="board[0] == 1"></i>
                                        <i class="far fa-circle" v-if="board[0] == 2"></i>
                                    </td>
                                    <td @click="play(1)">
                                        <i class="fas fa-times" v-if="board[1] == 1"></i>
                                        <i class="far fa-circle" v-if="board[1] == 2"></i>
                                    </td>
                                    <td @click="play(2)">
                                        <i class="fas fa-times" v-if="board[2] == 1"></i>
                                        <i class="far fa-circle" v-if="board[2] == 2"></i>
                                    </td>
                                    <td @click="play(3)">
                                        <i class="fas fa-times" v-if="board[3] == 1"></i>
                                        <i class="far fa-circle" v-if="board[3] == 2"></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td @click="play(4)">
                                        <i class="fas fa-times" v-if="board[4] == 1"></i>
                                        <i class="far fa-circle" v-if="board[4] == 2"></i>
                                    </td>
                                    <td @click="play(5)">
                                        <i class="fas fa-times" v-if="board[5] == 1"></i>
                                        <i class="far fa-circle" v-if="board[5] == 2"></i>
                                    </td>
                                    <td @click="play(6)">
                                        <i class="fas fa-times" v-if="board[6] == 1"></i>
                                        <i class="far fa-circle" v-if="board[6] == 2"></i>
                                    </td>
                                    <td @click="play(7)">
                                        <i class="fas fa-times" v-if="board[7] == 1"></i>
                                        <i class="far fa-circle" v-if="board[7] == 2"></i>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td @click="play(8)">
                                        <i class="fas fa-times" v-if="board[8] == 1"></i>
                                        <i class="far fa-circle" v-if="board[8] == 2"></i>
                                    </td>
                                    <td @click="play(9)">
                                        <i class="fas fa-times" v-if="board[9] == 1"></i>
                                        <i class="far fa-circle" v-if="board[9] == 2"></i>
                                    </td>
                                    <td @click="play(10)">
                                        <i class="fas fa-times" v-if="board[10] == 1"></i>
                                        <i class="far fa-circle" v-if="board[10] == 2"></i>
                                    </td>
                                    <td @click="play(11)">
                                        <i class="fas fa-times" v-if="board[11] == 1"></i>
                                        <i class="far fa-circle" v-if="board[11] == 2"></i>
                                    </td>
                                </tr>

                                <tr>
                                    <td @click="play(12)">
                                        <i class="fas fa-times" v-if="board[12] == 1"></i>
                                        <i class="far fa-circle" v-if="board[12] == 2"></i>
                                    </td>
                                    <td @click="play(13)">
                                        <i class="fas fa-times" v-if="board[13] == 1"></i>
                                        <i class="far fa-circle" v-if="board[13] == 2"></i>
                                    </td>
                                    <td @click="play(14)">
                                        <i class="fas fa-times" v-if="board[14] == 1"></i>
                                        <i class="far fa-circle" v-if="board[14] == 2"></i>
                                    </td>
                                    <td @click="play(15)">
                                        <i class="fas fa-times" v-if="board[15] == 1"></i>
                                        <i class="far fa-circle" v-if="board[15] == 2"></i>
                                    </td>
                                </tr>
                            
                            </table>

                            <button type="button" class="w-100 btn btn-lg btn-outline-primary mt-3">0  vs  1</button>                           
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            
                            <input type="text" class="form-control" v-if="name_edit" v-model="user_name">
                            <h4 class="my-0 fw-normal" v-else>{{user_name}}</h4>

                        </div>
                        <div class="card-body">
                            
                            <button class="btn btn-warning pb-4 mb-1" v-if="name_edit == false" @click="editName()">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-success pb-4 mb-3" v-if="name_edit" @click="updateName()">
                                <i class="fas fa-save"></i>
                            </button>
                            -
                            <button class="btn btn-danger pb-4 mb-3" v-if="name_edit" @click="name_edit = false">
                                <i class="fas fa-times"></i>
                            </button>
                            <h4 class="card-title pricing-card-title text-dark"> Persozalice sus fichas XD </h4>
                            <i :class="icono+' text-dark'" style="font-size: 57px;position: relative;top: -5px;"></i>
                            <ul class="list-unstyled mt-1 mb-2">
                                <select v-model="icono" class="text-dark">
                                    <option>Seleccione el icono de su preferencia</option>
                                    <option v-for="(item,i) in icons">
                                        <i :class="item">{{item}}</i>
                                    </option>
                                </select>
                            </ul>

                            
                            <!-- <button type="button" class="w-100 btn btn-lg btn-primary" @click="testValidate()">
                                Empesar nuevo juego
                            </button> -->
                            <!-- <button type="button" class="w-100 btn btn-lg btn-primary" v-if="new_game" @click="newGame()">
                                Empesar nuevo juego
                            </button> -->
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="mt-auto text-white-50">
            <p>
              Cover template for 
              <a href="https://getbootstrap.com/" class="text-white">
                Bootstrap
              </a>,
              by 
              <a href="https://twitter.com/mdo" class="text-white">@mdo</a>,
              
              Implemented by  
              <a href="https://github.com/JohannDevFull" target="_blank" class="text-white">
                <i class="fab fa-github-alt"></i>
                Johann Ramirez
                <i class="fab fa-github"></i>
              </a>
            </p>
        </footer>

    </div>

</template>

<script >

import { Head, Link } from '@inertiajs/inertia-vue3';

    export default {
        props:[ 'shift' , 'code' , 'player' , 'match' , 'session_match' , 'another_player' ],
        name: 'Board',
        components: {
            Head,
            Link
        },
        data(){
            return {
                user_name:"Player 2",
                another_player_f:0,
                
                board:[0,0,0,0,0,0,0,0,0],
                board_test:[],
                shift__:false,
                set_interval:'',
                set_interval_player:'',
                blocked:false,


                time_i:'',
                time_b:'',

                game_over:false,
                name_player:'',
                name_edit:false,
                new_game:false,
                new_game:false,
                waiting_response:false,
                icono:'fas fa-times',
                nitefied:false,
                nitefied_game_over:false,
                icons:[
                    'fas fa-user',
                    'fas fa-cat',
                    'fas fa-dog',
                    'fas fa-user-astronaut',
                    'fas fa-shuttle-space',
                    'fas fa-satellite',
                    'fas fa-meteor',
                    'fas fa-skull',
                    'fas fa-ghost',
                    'fas fa-hat-wizard',
                    'fas fa-heart',
                    'fas fa-shield-halved',
                    'fas fa-skull-crossbones',
                    'fas fa-wand-sparkles',
                    'fas fa-bugs',
                    'fas fa-crow'
                ]
            }
        },
        mounted(){

            this.shift__=this.shift;
            this.user_name=this.player.name;

            if ( typeof this.match.board.board_fields == 'string') {
                this.board=JSON.parse(this.match.board.board_fields);
            }else{
                this.board=this.match.board.board_fields;
            }

            this.another_player_f=this.another_player;
            this.game_over=this.match.board.game_over;
            this.icono= this.player.guest == true ? 'fas fa-circle' : 'fas fa-times'; 
            

            if ( this.match.player_guest != 0 ) 
            {
                if ( this.player.guest == false ) 
                {
                    this.another_player_f=this.match.player_guest.name;
                }else{
                    this.another_player_f=this.match.player_host.name;
                }
            }
            else
            {
                this.set_interval_player=setInterval(()=> {
                    this.getAnotherPlayer();
                }, 2500);
            }
            

            if ( this.shift == false ) 
            {
                this.set_interval = setInterval(()=> {
                    this.updateInfoGame();
                }, 2500);
            }
            else
            {
                //Para cuando tiene el turno pero el juego a terminado y se a refrescado la pagina
                if (this.match.board.game_over) 
                {
                    this.set_interval = setInterval(()=> {
                        this.updateInfoGame();
                    }, 2500);
                }
            }      
        },
        methods:{
            play(pos)
            {
                if(this.game_over != true )
                {

                    if ( this.shift__ == true ) 
                    {
                        this.board[pos] = this.player.guest == true ? 2 : 1 ;
                        this.shift__=false;
                        let payLoad={
                            board:this.board,
                            code:this.code,
                            player:this.player
                        }
                        axios.post('play' , payLoad )
                        .then(response => {
                            this.shift__=false;
                            
                            if (response.data.winner == true )  
                            {
                                this.game_over=true
                                alert("Ganasteeeeeeeeeeeeeeee");

                                // this.new_game=true;
                                
                                setTimeout(()=>{
                                    this.updateInfoGame();
                                },2500); 
                            }
                            setTimeout(()=>{
                                this.set_interval = setInterval(()=> {
                                    this.updateInfoGame(); 
                                }, 2500);
                            },200);    
                        })
                        .catch(error => {
                            
                            console.log("Error - play() ")
                        });
                    }
                    else{
                        alert("Nooooo pudes jugar todavia")
                    }
                }
                else
                {
                    this.notaGameOver()
                }
            },
            updateInfoGame()
            {
                let payLoad={
                    code:   this.code,
                    player: this.player
                }

                axios.post('get-info-update-game',payLoad)
                .then(response => {

                    if(response.data.board.game_over != true )
                    {
                        if ( response.data.shift_ == true ) 
                        {
                            
                            this.shift__= true;
                            if (response.data.winner == false )  
                            {
                                clearInterval(this.set_interval)
                            }
                        }

                        setTimeout(()=>{
                            this.game_over=false;

                        },1000);
                        this.nitefied=false;
                        this.nitefied_game_over=false;
                        console.log("juego en curso")
                    }
                    else
                    {

                        console.log("juego terminado -- winner::"+ response.data.winner)
                    }

                    this.board=JSON.parse(response.data.board.board_fields);

                    if (response.data.winner == true ) 
                    {
                        if (this.nitefied_game_over == false)
                        {
                            if (response.data.board.game_over == true) 
                            {
                                alert("Game Oveeeer XD")

                                setTimeout(()=>{

                                    this.nitefied_game_over=true;
                                    this.game_over=true;
                                    console.log("winer sii")
                                },200);
                            }
                            else
                            {

                                console.log("Game Oveeeer XD .,.,.,.,.")
                            }
                            console.log("nitefied_game_over Noo")
                        }
                        else
                        {

                            console.log("nitefied_game_over sii")
                        }

                        
                    }
                








                    if (response.data.board.request == 1 && response.data.board.ref_player_rerquest != this.player.id) 
                    {

                        this.confirmNewGame();
                            console.log("nitefied_ NOOOO")

                    }else{
                            console.log("nitefied ---- sii")

                    }

                    if (this.player.guest)
                    {

                        this.another_player_f=response.data.players.guest.name==this.another_player_f?this.another_player_f:response.data.players.host.name;
                    }
                    else
                    {

                        this.another_player_f=response.data.players.guest.name==this.another_player_f?this.another_player_f:response.data.players.guest.name;
                    }
                })
                .catch(error => {
                });

                // Mejor traer el jugador en request
                if (this.another_player_f == 0){this.getAnotherPlayer(); }
            },
            getAnotherPlayer()
            {
                let payLoad={
                    guest:this.player.guest
                };
                axios.post('get-another-player/'+this.code , payLoad )
                .then(response => {
                    this.another_player_f=response.data;
                    if ( response.data != 0 ) {clearInterval(this.set_interval_player)}
                })
                .catch(error => {
                    console.log("Error - getAnotherPlayer()");
                });
            },
            confirmNewGame()
            {
                //Ingresamos un mensaje a mostrar
                if (this.nitefied==false)
                {

                    var mensaje = confirm( this.another_player_f +" ¿Quires jugar de nuevo?");
                    //Detectamos si el usuario acepto el mensaje
                    if (mensaje) {
                        alert("¡Listo a jugar se dijo!");
                        this.startNewGame();
                    }
                    else {
                        //Detectamos si el usuario denegó el mensaje
                        alert("¡Ok en otra ocacipon sera, gracias por participar!");
                    }

                    this.nitefied=true;
                }
            },
            startNewGame()
            {
                this.nitefied_game_over=false;
                this.game_over=false;

                let payLoad={
                    match:this.match,
                    code:this.code
                }

                axios.post('new-game' , payLoad )
                .then(response => {
                    console.log("New Game start ----------------------------------------------------------------------")
                    this.nitefied=false;
                    
                })
                .catch(error => {
                    // var data = error.response.data;
                    this.shift__=false;
                    
                });
            },
            sendRequets()
            {
                let payLoad={
                    id_player:this.player.id,
                    code:this.code
                }

                axios.post('send-request' , payLoad )
                .then(response => {
                    this.waiting_response=true;
                })
                .catch(error => {
                    // var data = error.response.data;
                    this.shift__=false;
                });
            },
            editName(){
                
                this.name_edit=true;
            },
            updateName(){
                let payLoad={
                    id: this.player.id,
                    name: this.user_name
                }
                axios.post('update-name', payLoad )
                .then(response => {
                    this.name_player=response.data;
                    this.name_edit=false;
                })
                .catch(error => {
                    // var data = error.response.data;
                    this.shift__=false;
                });
            },
            notaGameOver()
            {
                //Ingresamos un mensaje a mostrar
                var mensaje = confirm( "Hola, "+this.player.name +": El juego a terminado, ¿ quieres Empesar un juego nuevo ? da click en aceptar");
                //Detectamos si el usuario acepto el mensaje
                if (mensaje) {
                    alert("¡Listo a jugar se dijo!");
                    this.startNewGame();
                }
                else {
                    //Detectamos si el usuario denegó el mensaje
                    alert("¡Ok en otra ocacipon sera, gracias por participar!");
                }
            },






            testValidate()
            {

                let payLoad={
                    board:this.board,
                    code:this.code
                }

                axios.post('test-validate' , payLoad )
                .then(response => {
                })
                .catch(error => {
                    // var data = error.response.data;
                    this.shift__=false;
                    
                });
            }
        }
    }

</script>

<style>
    #tablero td {
        color: #222;
        font-size: 36px;
        text-shadow: 1px 1px 1px rgba(255,255,255,.6);
        width: 50px;
        height: 50px;
    }


    td{
        border: black 1px solid;
    }
</style>