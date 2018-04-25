@include('header')
<html lang="en">
    
<head>
    <meta charset="utf-8">
   

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Gestion</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.css">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--  <style>
body {
    background-color: #e0f7fa ;
}
</style> -->
  

</head>

<body bgcolor="#90caf9">
    
   
  <div clmlpass="col-md-30">
   <nav class="navbar navbar-light navbar-ststic-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" >   Gestion des equipes </a>
    </div>
  </div>
</nav>
  
  

  <div class="table table-responsive">
    <table class="table table-bordered" id="table" >
      <tr>
       
        <th>nom</th>
        <th>chef</th>
           <th>description</th>
        <th>last update</th>
        <th class="text-center" width="50px">
          <a href="#" class="add-modal btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
                   

       
        
                          
                            {{ csrf_field() }}
                      
                        <tbody>
                            @foreach($equipes as $equipe)
                                <tr class="item{{$equipe->id}} ">
                                   
                                    <td>{{$equipe->nom}}</td>
                                    <td>{{$equipe->chef}} </td>
                                    <td>{{$equipe->description}}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $equipe->updated_at)->diffForHumans() }}</td>
                                    <td width="150px">
                                        
                                        <button class="show-modal btn btn-info" data-id="{{$equipe->id}}" data-nom="{{$equipe->nom}}" data-chef="{{$equipe->chef}}" data-description="{{$equipe->description}}">
                                        <span class="glyphicon glyphicon-eye-open"></span></button>
                                        <button class="edit-modal btn btn-warning" data-id="{{$equipe->id}}" data-nom="{{$equipe->nom}}" data-chef="{{$equipe->chef}}" data-description="{{$equipe->description}}" >
                                        <span class="glyphicon glyphicon-edit"></span></button>
                                        <button class="delete-modal btn btn-danger" data-id="{{$equipe->id}}" data-nom="{{$equipe->nom}}" data-chef="{{$equipe->chef}}" data-description="{{$equipe->description}}">
                                        <span class="glyphicon glyphicon-trash"></span></button>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
       
                    </table>
       {{ $equipes->links() }}
    
            </div>
         
       <!-- /.panel-body -->
        <!-- /.panel panel-default -->
    <!-- /.col-md-8 -->
  </div>
    <!-- Modal form to add a post -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"  style="text-align:center"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nom">nom:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nom_add" autofocus>
                                
                                <p class="errornom text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="chef">Chef:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="chef_add" cols="40" ></textarea>
                                
                                <p class="errorchef text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description_add" cols="40" rows="5"></textarea>
                                
                                <p class="errordescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Ajouter
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span>Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to show a post -->
    <div id="showModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"> Afficher </h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                       
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nom">nom:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nom_show" disabled>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="chef">Chef:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="chef_show" cols="40"  disabled></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description_show" cols="40" rows="5" disabled></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to edit a form -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        
                        
                          <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" autofocus>
                                <p class="errornom text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nom">nom:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nom_edit" autofocus>
                                <p class="errornom text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="chef">Chef:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="chef_edit" cols="40" ></textarea>
                                <p class="errorchef text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="control-label col-sm-2" for="description">Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description_edit" cols="40" rows="5"></textarea>
                                <p class="errordescription text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Modifier
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to delete a form -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Êtes-vous sûr de vouloir supprimer cet equipe !?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_delete" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="nom">nom:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nom_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Supprimer
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Fermer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   <style type="text/css">
.table {
    margin: 0 auto;
    width: 80%;
}
</style>
    
    
    
     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#equipeTable').removeAttr('style');
        })
    </script>

   
    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        
          // delete a post
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Supprimer');
            $('#id_delete').val($(this).data('id'));
            $('#nom_delete').val($(this).data('nom'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'equipes/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Equipe supprimé avec succée', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
        
        
        
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text(  'Ajouter');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'equipes',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nom': $('#nom_add').val(),
                     'chef': $('#chef_add').val(),
                    'description': $('#description_add').val()
                },
                success: function(data) {
                    $('.errornom').addClass('hidden');
                    $('.errorchef').addClass('hidden');
                    $('.errordescription').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nom) {
                            $('.errornom').removeClass('hidden');
                            $('.errornom').text(data.errors.nom);
                        }
                        if (data.errors.chef) {
                            $('.errorchef').removeClass('hidden');
                            $('.errorchef').text(data.errors.chef);
                        }
                         if (data.errors.description) {
                            $('.errordescription').removeClass('hidden');
                            $('.errordescription').text(data.errors.description);
                        }
                    } else {
                        toastr.success('equipe ajouté avec succé!', 'Success Alert', {timeOut: 5000});
                        $('#equipeTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.nom + "</td><td>" + data.chef + "</td><td>" + data.description + "</td><td class='text-center'><input  data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "' data-description='" + data.description +  "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                       
                       
                       
                    }
                },
            });
        });

        // Show a post
        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Afficher');
            $('#id_show').val($(this).data('id'));
            $('#nom_show').val($(this).data('nom'));
            $('#chef_show').val($(this).data('chef'));
             $('#description_show').val($(this).data('description'));
            $('#showModal').modal('show');
        });


        // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Modifier');
            $('#id_edit').val($(this).data('id'));
            $('#nom_edit').val($(this).data('nom'));
            $('#chef_edit').val($(this).data('chef'));
            $('#description_edit').val($(this).data('description'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'equipes/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'nom': $('#nom_edit').val(),
                     'chef': $('#chef_edit').val(),
                    'description': $('#description_edit').val()
                },
                success: function(data) {
                    $('.errornom').addClass('hidden');
                    $('.errorchef').addClass('hidden');
                      $('.errordescription').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nom) {
                            $('.errornom').removeClass('hidden');
                            $('.errornom').text(data.errors.nom);
                        }
                        if (data.errors.chef) {
                            $('.errorchef').removeClass('hidden');
                            $('.errorchef').text(data.errors.chef);
                        }
                         if (data.errors.description) {
                            $('.errordescription').removeClass('hidden');
                            $('.errordescription').text(data.errors.description);
                        }
                    } else {
                        toastr.success(' Equipe a été modifié avec succé!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.nom + "</td><td>" + data.chef + "</td><td>" + data.description + "</td><td>Right now</td><input data-id='" + data.id + "'></td><td><button class='show-modal btn btn-info' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "' data-description='" + data.descriptions + "'><span class='glyphicon glyphicon-eye-open'></span> </button> <button class='edit-modal btn btn-warning' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "'data-description='" + data.description + "'><span class='glyphicon glyphicon-edit'></span></button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nom='" + data.nom + "' data-chef='" + data.chef + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-trash'></span> </button></td></tr>");

                       
                        
                       
                       
                    }
                }
            });
        });

      
    </script>

</body>
</html>