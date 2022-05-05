<template>
    
    <div class="container py-3">
        
        <header>

            <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                    <span class="fs-4">Pricing example</span>
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Features</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Enterprise</a>
                    <a class="me-3 py-2 text-dark text-decoration-none" href="#">Support</a>
                    <a class="py-2 text-dark text-decoration-none" href="#">Pricing</a>
                </nav>
            </div>

            <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                <h1 class="display-4 fw-normal">{{code}}</h1>
                <p class="fs-5 text-muted">Invita a un amigo para jugar con este codigo.</p>
            </div>

        </header>

        <main>
            
            <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
               
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal text-dark" v-if="another_player != 0">
                                {{another_player}}
                            </h4>
                            <h4 class="my-0 fw-normal text-dark"  v-else>
                                Esperando invitado ... 
                                <div class="spinner-grow text-primary" role="status">
                                  <span class="sr-only">Loading...</span>
                                </div>
                            </h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>10 users included</li>
                                <li>2 GB of storage</li>
                                <li>Email support</li>
                                <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
                        </div>
                    </div>
                </div>
                
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">                     
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal text-dark" v-if="shift__ == true">Haz tu jugada</h4>
                            <h4 class="my-0 fw-normal text-dark" v-else>Espera tu turno</h4>
                        </div>
                        
                        <div class="card-body">
                            
                            <table id="tablero" style="margin:auto">
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

                            <button type="button" class="w-100 btn btn-lg btn-outline-primary mt-3">0  vs  1</button>                           
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-white bg-primary border-primary">
                            <h4 class="my-0 fw-normal">{{user_name}}</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                            <li>30 users included</li>
                            <li>15 GB of storage</li>
                            <li>Phone and email support</li>
                            <li>Help center access</li>
                            </ul>
                            <button type="button" class="w-100 btn btn-lg btn-primary">Contact us</button>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>

</template>

<script >

    export default {
        props:[ 'shift' , 'code' , 'player' , 'match' , 'session_match' ],
        name: 'Board',
        components: {
        },
        data(){
            return {
                join_game:false,
                user_name:"Player 2",
                player_type:0,
                another_player:"",
                
                board:[0,0,0,0,0,0,0,0,0],
                board_test:[],
                shift__:false
            }
        },
        mounted(){

            if ( this.shift == false ) 
            {
                setInterval(()=> {this.updateInfoGame()}, 3000);
            }

            if( this.player.name != undefined) 
            {
                this.shift__=this.shift;
                this.user_name=this.player.name;
                // this.board=JSON.stringify(this.match.board.board_fields)
                this.board=JSON.parse(this.match.board.board_fields);
                this.getAnotherPlayer();
            }
        },
        methods:{ 

            joinGame()
            {

                this.join_game=true;
            },

            play(pos)
            {
                if (this.shift__ == true ) 
                {

                    this.board[pos]=this.player.guest == true ? 2 : 1 ;

                    this.shift__=false;

                    let payLoad={
                        board:this.board,
                        code:this.code
                    }

                    axios.post('play' , payLoad )
                    .then(response => {
                        this.shift__=false;
                        setInterval(()=> {this.updateInfoGame()}, 2500);
                    })
                    .catch(error => {
                        // var data = error.response.data;
                        this.shift__=false;
                    });
                }
            },

            getAnotherPlayer()
            {
                let payLoad={
                    guest:this.player.guest
                };

                axios.post('get-another-player/'+this.code , payLoad )
                .then(response => {

                    this.another_player=response.data.name;


                })
                .catch(error => {
                    // var data = error.response.data;
                });
            },

            updateInfoGame()
            {

                axios.get('get-info-update-game/'+this.code+'/'+this.player.id)
                .then(response => {
                    if (response.data.shift_ == true) 
                    { 
                        this.shift__= true; 
                        this.board= JSON.parse(response.data.board.board_fields); 
                    }
                })
                .catch(error => {

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