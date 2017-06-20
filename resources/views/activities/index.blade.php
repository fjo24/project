<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vue.js</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-xs-6">
                    <h1 v-if="lists.length > 0">Agregar una tarea</h1>
                    <h1 v-else="lists">Crea una tarea</h1>
                    <input type="text" class="form-control" v-on:keyup.enter="addKeep" v-model="newKeep">
                </div>    
                <div class="col-xs-6">
                    <h1 v-if="lists.length > 0">Listado de tarea</h1>
                    <h1 v-else="lists">No hay tareas registradas</h1>
                    <ul class="list-group">
                        <li class="list-group-item"
                            v-for="item in lists" 
                            v-bind:class="item.completed == true ? 'disabled' : ''"
                            @click="item.completed = ! item.completed">
                            {{ item.keep }}
                        </li>
                    </ul>
                </div>
            </div>            
            <div class="row">
                <div class="col-xs-12">       
                    <hr>                     
                    <pre>
                        {{ $data | json }}
                    </pre>
                </div>
            </div>        
            <div class="row">
                <div class="col-xs-12">       
                    <hr>                     
                    <p class="text-center mute">
                        Rimorsoft Online - @italomoralesf
                    </p>                    
                </div>
            </div>
        </div>        
    </div>
    
    <script src="{{ asset ('vuejs/vue.js') }}"></script>
    <script src="{{ asset ('vuejs/script.js') }}"></script>
</body>
</html>